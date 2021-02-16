<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function getAvatar($userId)
    {
        $user = User::findOrFail($userId);

        return response()->download(
            storage_path('app/avatars/' . $userId . '/' . $user->avatar), 'avatar.png');
    }
}
