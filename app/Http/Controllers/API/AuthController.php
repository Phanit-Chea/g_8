<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UpdateProfileResource;
use App\Http\Resources\userRegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => User::all(), 'message' => 'Hello World'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Log incoming request data
        \Log::info('Update profile request received', $request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'profile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'sometimes|string|max:255',
            'gender' => 'sometimes|in:Male,Female,Other',
            'dateOfBirth' => 'sometimes|date',
            'phoneNumber' => 'sometimes|string|max:20',
        ]);

        // Handle file upload
        if ($request->hasFile('profile')) {
            $img = $request->file('profile');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $profilePath = 'storage/images';
            $img->move(public_path($profilePath), $imageName);
            $validatedData['profile'] = $profilePath . '/' . $imageName;
        }

        // Update user profile
        $user->update($validatedData);
        $user = User::find($user->id);
        $userData = $user->toArray();
        // $userData['remember_token'] = $user->remember_token;

        \Log::info('Profile updated successfully', $userData);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirmPassword' => 'required|same:password',
            'dateOfBirth' => 'required|date',
            'gender' => 'required|string',
            'phoneNumber' => 'required|string',
            'address' => 'required|string',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }
    
        $img = $request->file('profile');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $profilePath = 'storage/images';
        $img->move(public_path($profilePath), $imageName);
        $profile = $profilePath . '/' . $imageName;
    
        // Create user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'profile' => $profile
        ]);
        $token  = $user->createToken('auth_token')->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'success' => true,
            'user' => new userRegisterResource($user)
        ], 201);
    }
}
