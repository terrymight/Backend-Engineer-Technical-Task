<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\user\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:view_users')->only(['index', 'show']);
        $this->middleware('permission:create_users')->only('store');
        $this->middleware('permission:edit_users')->only('update');
        $this->middleware('permission:delete_users')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')
                     ->latest()
                     ->paginate(15);

        return $this->success($users, 'User successfully Returned');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        // Access validated data directly from the request
        $validated = $request->validated();

        $user = User::creat([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if (isset($validated['role'])) {
            $user->assignRole($validated['role']);
        } else {
            // Assign a default role if needed
            $user->assignRole('Basic User');
        }

        return $this->success(
            ['user' => $user->only('id', 'name', 'email')],
            'User created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles:id,name');

        return $this->success(
            $user,
            'User fetched successfully',
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|exists:roles,name',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        if (isset($validated['role'])) {
            $user->syncRoles([$validated['role']]); // Efficiently replace all existing roles
        }

        return $this->success(
            ['user' => $user->only('id', 'name', 'email')],
            'User updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Professional check: Prevent users from deleting themselves or Super Admins
        if (auth()->id() === $user->id || $user->hasRole('Super Admin')) {
            return response()->json(['message' => 'Unauthorized action or protected user'], 403);
        }
        
        $user->delete();

        return $this->success(
            null,
            'User deleted successfully',
            204
        );
    }
}
