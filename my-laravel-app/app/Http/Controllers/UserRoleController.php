<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;

class UserRoleController extends Controller
{
    // Assign a role to the authenticated user
    public function assignRole(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user already has the role
        if ($user->roles()->where('role_id', $request->role_id)->exists()) {
            return response()->json(['message' => 'Role already assigned.'], Response::HTTP_CONFLICT);
        }

        // Attach the role to the user
        $user->roles()->attach($request->role_id);

        return response()->json(['message' => 'Role assigned successfully.'], Response::HTTP_OK);
    }
}
