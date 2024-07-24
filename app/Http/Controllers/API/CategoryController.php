<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShowCategoryResource;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // $categories = ShowCategoryResource::collection($categories);
        return response(['success' => true, 'data' => $categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::createOrUpdate($request);
        return response()->json([
            'data' => $category
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $category = Category::find($id);
        // $category = new ShowCategoryResource($category);
        // return ["success" => true, "data" => $category];

        $category = Category::find($id);
        $category = new ShowCategoryResource($category);
        return ["success" => true, "data" => $category];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->title = $request->input('title');
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
                Storage::delete('public/CategoryImage/' . $category->image);
            }
            $path = $request->file('image')->store('public/CategoryImage');
            $category->image = basename($path);
        }

        $category->save();

        return response()->json([
            "success" => true,
            "data" => new ShowCategoryResource($category),
            "message" => "The Category was updated successfully!"
        ], 200);
    }

    //     public function update(Request $request, string $id)
    // {
    //     // Find the category by ID
    //     $category = Category::findOrFail($id);

    //     // Check if a file is present in the request
    //     if ($request->hasFile('image')) {
    //         // Store the new file and update the media_id
    //         $file = $request->file('image');
    //         $path = $file->store('images', 'public'); // Adjust the path and disk as needed
    //         $request['image'] = $path;
    //         $media = Media::create($request['image']);
    //         $request['media_id'] = $media->id;
    //     } else {
    //         // Keep existing media_id if no new file is uploaded
    //         $request['media_id'] = $category->media_id;
    //     }

    //     // Update the category with the provided data
    //     $category->update($request->only(['title', 'name', 'description', 'media_id']));

    //     return response()->json([
    //         "success" => true,
    //         "data" => new ShowCategoryResource($category),
    //         "message" => "The Category was updated successfully!"
    //     ], 200);
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return ["success" => true, "Message" => "The Category was deleted successfully!"];
    }
}
