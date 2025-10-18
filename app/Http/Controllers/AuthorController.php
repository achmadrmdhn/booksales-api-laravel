<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        // 1. Ambil data
        $authors = Author::all();

        // 2. Cek ketersediaan data
        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!",
                "data" => []
            ], 200);
        }

        // 3. Response Berhasil (Response 200)
        return response()->json([
            "success" => true,
            'message' => 'Get All Resource',
            'data' => $authors
        ], 200);
    }

    public function store(Request $request)
    {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048', 
            'bio' => 'required|string',
        ]);

        // 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. upload image
        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo->store('authors', 'public');
            $photoName = $photo->hashName();
        }

        // 4. insert data
        $author = Author::create([
            'name' => $request->name,
            'photo' => $photoName, 
            'bio' => $request->bio,
        ]);

        // 5. response
        return response()->json([
            'success' => true,
            'message' => "Resource added successfully!",
            'data' => $author
        ], 201);
    }
}