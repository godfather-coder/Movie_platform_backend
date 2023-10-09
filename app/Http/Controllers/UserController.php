<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UserRequest;
use App\Http\Requests\GenreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(15);

        return response([
            'users' => $users,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $userData = "Password: {$data['password']}\n";
        $userData .= "Email: {$data['email']}\n";
        $userData .= "Name: {$data['name']}\n";
        $userData .= "------------------------\n";

        Storage::append('users.txt', $userData);

        return response([
            'User' => $user,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response([
            'user' => $user->load('genres'),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return response([
            'user' => $user->refresh(),
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'message' => 'User delete',
        ], 200);
    }
}