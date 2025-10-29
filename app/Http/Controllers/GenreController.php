<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // READ
    public function index()
    {
        $genre = Genre::all();

        if ($genre->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!",
                "data"    => []
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data"    => $genre
        ], 200);
    }

    // CREATE
    public function store(Request $request)
    {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. insert data
        $genre = Genre::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        // 4. response
        return response()->json([
            'success' => true,
            'message' => "Resource added successfully!",
            'data'    => $genre
        ], 201);
    }

    // SHOW
    public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "Get detail resource",
            'data'    => $genre
        ], 200);
    }

    // UPDATE
    public function update(string $id, Request $request)
    {
        // 1. mencari data
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found",
            ], 404);
        }

        // 2. validator
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. siapkan data yang ingin diupdate
        $data = [
            'name'        => $request->name,
            'description' => $request->description,
        ];

        // 4. update data baru ke database
        $genre->update($data);

        // 5. response
        return response()->json([
            'success' => true,
            'message' => "Resource updated successfully!",
            'data'    => $genre
        ], 200);
    }

    // DELETE
    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found",
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => "Delete resource successfully",
        ], 200);
    }
}
