<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getAvatar($userId)
    {
        $user = User::findOrFail($userId);

        return Storage::disk('s3')->response('avatars/' . $userId . '/' . $user->avatar);

//        return response()->download(
//            storage_path('app/avatars/' . $userId . '/' . $user->avatar), 'avatar.png');
    }

    public function edit()
    {
        return view('profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        if ($request->hasFile('avatar')) {
            Storage::disk('s3')->delete('avatars/' . auth()->id() . '/' . auth()->user()->avatar);

            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->storeAs('avatars/' . auth()->id(), $filename, 's3');
            auth()->user()->update([
                'avatar' => $filename,
            ]);
        }
    }
}
