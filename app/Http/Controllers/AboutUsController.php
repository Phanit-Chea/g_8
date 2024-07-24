<?php

namespace App\Http\Controllers;

use App\Http\Resources\aboutUsResource;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function createAboutUs(Request $request)
    {
        // Validate the incoming request data
        $validatedData = Validator::make($request->all(), [
            'imageDetail' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'sometimes|string',
            'recommentFood' => 'sometimes|string',
            'ourMission' => 'sometimes|string',
            'ourVision' => 'sometimes|string',
        ]);

        // Check if validation fails
        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validatedData->errors(),
                'success' => false
            ], 422);
        }
        // Handle image upload
        if ($request->hasFile('imageDetail')) {
            $img = $request->imageDetail;
            $ext = $img->getClientOriginalExtension();
            $imageDetailName = time() . '.' . $ext;
            $img->move(public_path() . '/aboutUs/imageDetail/', $imageDetailName);
            $imageDetail = 'http://127.0.0.1:8000/aboutUs/imageDetail/' . $imageDetailName;
        } else {
            return response()->json([
                'message' => 'Image not found in request',
                'success' => false
            ], 400);
        }

        // Create new AboutUs record
        try {
            $aboutUs = AboutUs::create([
                'imageDetail' =>  $imageDetail,
                'description' => $request->input('description'),
                'recommentFood' => $request->input('recommentFood'),
                'ourMission' => $request->input('ourMission'),
                'ourVision' => $request->input('ourVision'),
            ]);

            // Return success response
            return response()->json([
                'message' => 'User created successfully',
                'pathDetail' => asset('/aboutUs/imageDetail/' .$imageDetailName),
                'success' => true,
                'user' => new aboutUsResource($aboutUs)
            ], 201);
        } catch (\Exception $e) {
            // Handle database insertion errors
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getLatest()
    {
        $latestAboutUs = AboutUs::latest('id')->first();
        return response()->json($latestAboutUs);
    }
}
