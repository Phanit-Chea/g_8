<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getuserList()
    {
        $user = User::all();
        return response()->json(['success' => true, 'data'=>$user,], 200);
    }

    public function login(Request $request): JsonResponse
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
        ]);
    
        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Get the credentials from the request
        $credentials = $request->only('email', 'password');
    
        // Attempt to authenticate the user with the provided credentials
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // Create a new token for the user
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // Optionally store the token in the remember_token field (if needed)
        $user->remember_token = $token;
        $user->save();
    
        // Convert the user model to an array to include all fields
        $userData = $user->toArray();
    
        // Add the access_token to the user data
        $userData['remember_token'] = $token;
        
    
        return response()->json([
            'message'       => 'Login successful',
            'user'          => $userData
        ]);
    }
    
    
    public function index(Request $request)
    {
        $user = $request->user();
        // $permissions = $user->getAllPermissions();
        // $roles = $user->getRoleNames();
        return response()->json([
            'message' => 'Login success',
            'data' =>$user,
        ]);
    }

    public function update(Request $request, string $id)
    {
        User::store($request, $id);
        return ['success' => true, 'Message' => 'User Was updated successfully'];
    }
}
