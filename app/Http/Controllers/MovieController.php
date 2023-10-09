<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Service\FileService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct(private FileService $fileService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(15);

        return response([
            'movies' => $movies,
        ], 202);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->fileService->fileUpload($data->only('image'), 'Movie')['path'];
        $movie = Movie::create($data);

        return response([
            'movie' => $movie,
        ], 202);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return response([
            'message' => '',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        return response([
            'message' => '',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        return response([
            'message' => '',
        ], 200);
    }
}