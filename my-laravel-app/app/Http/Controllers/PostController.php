<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return response()->json(Post::all(), Response::HTTP_OK);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create($validatedData);

        return response()->json($post, Response::HTTP_CREATED);
    }

    // Display the specified resource.
    public function show(Post $post)
    {
        return response()->json($post, Response::HTTP_OK);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($validatedData);

        return response()->json($post, Response::HTTP_OK);
    }

    // Remove the specified resource from storage.
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    // Search for posts by title or body.
    public function search(Request $request)
    {
    
        // Retrieve the search term from the query parameter
        $searchTerm = $request->query('search');

        // Validate the search term (optional, but good practice)
        if (!$searchTerm) {
            return response()->json(['error' => 'Search term is required'], Response::HTTP_BAD_REQUEST);
        }

        // Search posts by title or body
        $posts = Post::where('title','like', "%{$searchTerm}%")->get();

        // Return the search results as a JSON response
        return response()->json($posts, Response::HTTP_OK);
    }
}
