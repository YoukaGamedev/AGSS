<?php
namespace App\Policies;

use App\Models\Game;
use App\Models\User;

class GamePolicy
{
    public function update(User $user, Game $game)
    {
        return $user->id === $game->user_id || $user->isAdmin();
    }

    public function delete(User $user, Game $game)
    {
        return $user->id === $game->user_id || $user->isAdmin();
    }
}