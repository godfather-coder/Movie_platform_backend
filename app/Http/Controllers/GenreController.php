<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\GenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $geners = Genre::paginate(10);

        return response([
            'genres' => $geners,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $data = $request->validated();
        $genre = Genre::create($data);

        return response([
            'genre' => $genre,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return response([
            'genre' => $genre,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        $data = $request->validated();
        $genre->update($data);

        return response([
            'genre' => $genre->refresh(),
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response([
            'message' => 'Genre delete',
        ], 200);
    }
}
