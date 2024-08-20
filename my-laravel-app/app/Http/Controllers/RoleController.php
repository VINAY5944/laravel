<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    // Display a listing of the roles.
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles, Response::HTTP_OK);
    }

    // Store a newly created role in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $role = Role::create($validatedData);

        return response()->json($role, Response::HTTP_CREATED);
    }

    // Display the specified role.
    public function show(Role $role)
    {
        return response()->json($role, Response::HTTP_OK);
    }

    // Update the specified role in storage.
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($validatedData);

        return response()->json($role, Response::HTTP_OK);
    }

    // Remove the specified role from storage.
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
