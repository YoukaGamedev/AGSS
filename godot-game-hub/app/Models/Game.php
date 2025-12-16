<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title', 'description', 'thumbnail', 'zip_file', 'html_file', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}