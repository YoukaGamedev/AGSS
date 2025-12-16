<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGames = Game::count();
        $totalUsers = User::count();
        $myGames = auth()->user()->games()->count();
        $recentGames = Game::with('user')->latest()->take(5)->get();

        return view('dashboard', compact('totalGames', 'totalUsers', 'myGames', 'recentGames'));
    }
}