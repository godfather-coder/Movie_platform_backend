<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUserData()
    {
        $user = User::where('id', auth()->id())->with('genres')->first();
        return response([
            'user' => $user
        ], 200);
    }
    public function storeUserData(ProfileRequest $request)
    {
        $user = User::where('id', auth()->id())->with('genres')->first();
        $user->update($request->only('name', 'username'));
        $user->genres()->sync($request->genres);
        return response([
            'user' => $user->refresh()
        ], 200);
    }

}