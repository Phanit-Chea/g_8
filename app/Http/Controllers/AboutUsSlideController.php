<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutUsSlideResource;
use App\Models\AboutUsSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutUsSlideController extends Controller
{
    public function index()
    {
        $imageSlide = AboutUsSlide::all();
        // $imageSlide = AboutUsSlideResource::collection($imageSlide);
        return response(['success' => true, 'data' => $imageSlide], 200);
    }

    public function createSlide(Request $request)
    {
        // Validate the incoming request data
        $validatedData = Validator::make($request->all(), [
            'imageSlide' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if validation fails
        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validatedData->errors(),
                'success' => false
            ], 400);
        }

        // Handle file upload
        if ($request->hasFile('imageSlide')) {
            $img = $request->file('imageSlide');
            $ext = $img->getClientOriginalExtension();
            $imageSlideName = time() . '.' . $ext;
            $img->move(public_path('/aboutUs/imageSlide/'), $imageSlideName);
            $imageSlide = 'http://127.0.0.1:8000/aboutUs/imageSlide/' . $imageSlideName;
        } else {
            return response()->json([
                'message' => 'imageSlide not found in request',
                'success' => false
            ], 400);
        }

        // Create new AboutUsSlide record
        try {
            $aboutUsSlide = AboutUsSlide::create([
                'imageSlide' => $imageSlide,
            ]);

            // Return success response
            return response()->json([
                'message' => 'Slide created successfully',
                'pathSlide' => asset('http://127.0.0.1:8000/aboutUs/imageSlide/' . $imageSlideName),
                'success' => true,
                'slide' => new AboutUsSlideResource($aboutUsSlide)
            ], 201);
        } catch (\Exception $e) {
            // Handle database insertion errors
            return response()->json([
                'message' => 'Failed to create slide',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
