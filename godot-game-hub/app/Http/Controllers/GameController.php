<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'newest');
        $search = $request->query('search');

        $games = Game::query()
            // SEARCH
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            })

            // FILTER
            ->when($filter === 'newest', function ($q) {
                $q->latest();
            })
            ->when($filter === 'popular', function ($q) {
                $q->orderByDesc('views');
            })

            ->paginate(12)
            ->withQueryString();

        return view('games.index', compact('games', 'filter'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'zip_file' => 'required|file|mimes:zip|max:102400'
        ]);

        // 1️⃣ Simpan ZIP
        $zipPath = $request->file('zip_file')->store('games', 'public');

        // 2️⃣ Tentukan folder extract (HASH / nama zip)
        $folderName = pathinfo($zipPath, PATHINFO_FILENAME);

        $extractPath = storage_path('app/public/extracted/' . $folderName);

        // 3️⃣ Extract ZIP
        $zip = new \ZipArchive;
        if ($zip->open(storage_path('app/public/' . $zipPath)) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
        }

        // 4️⃣ Cari file HTML (ABSOLUT)
        $absoluteHtmlPath = $this->findHtmlFile($extractPath);

        if (!$absoluteHtmlPath) {
            return back()->withErrors(['zip_file' => 'HTML file not found in ZIP']);
        }

        // 🔥 FIX PATH WINDOWS
        // Normalisasi slash
        $absoluteHtmlPath = str_replace('\\', '/', $absoluteHtmlPath);

        // Ambil path SETELAH storage/app/public/
        $relativeHtmlPath = Str::after(
            $absoluteHtmlPath,
            'storage/app/public/'
        );


        // 6️⃣ Thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // 7️⃣ Simpan ke database
        Game::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'thumbnail' => $thumbnailPath,
            'zip_file' => $zipPath,
            'html_file' => $relativeHtmlPath, // ✅ SUDAH BENAR
            'user_id' => auth()->id()
        ]);

        return redirect()
            ->route('games.index')
            ->with('success', 'Game uploaded successfully!');
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    // Di GameController
    public function play($id)
    {
        $game = Game::findOrFail($id);
        
        return view('games.play', compact('game'));
    }

    public function edit(Game $game)
    {
        abort_unless(auth()->user()->can('update', $game), 403);
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        abort_unless(auth()->user()->can('update', $game), 403);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($game->thumbnail) {
                Storage::disk('public')->delete($game->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $game->update($validated);
        return redirect()->route('games.index')->with('success', 'Game updated successfully!');
    }

    public function destroy(Game $game)
    {
        abort_unless(auth()->user()->can('delete', $game), 403);
        
        Storage::disk('public')->delete($game->zip_file);
        if ($game->thumbnail) {
            Storage::disk('public')->delete($game->thumbnail);
        }
        
        $extractPath = storage_path('app/public/extracted/' . pathinfo($game->zip_file, PATHINFO_FILENAME));
        $this->deleteDirectory($extractPath);
        
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game deleted successfully!');
    }

    private function findHtmlFile($dir)
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'html') {
                return 'extracted/' 
                    . basename($dir) . '/' 
                    . str_replace($dir . '/', '', $file->getPathname());
            }
        }

        return null;
    }


    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) return;
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        rmdir($dir);
    }
}