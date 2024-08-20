<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    // Display a listing of the users with their roles.
    public function index()
    {
        // Get all users with their roles
        $users = User::with('roles')->get();

        // Return users with roles as a JSON response
        return response()->json($users, Response::HTTP_OK);
    }

    // Display a specific user with their roles.
    public function show($id)
    {
        // Find the user by ID with their roles
        $user = User::with('roles')->findOrFail($id);

        // Return the user with roles as a JSON response
        return response()->json($user, Response::HTTP_OK);
    }
}
