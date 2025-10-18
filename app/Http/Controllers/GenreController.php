<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index()
    {
        // 1. Ambil data
        $genres = Genre::all();

        // 2. Cek ketersediaan data
        if ($genres->isEmpty()) {
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
            'data' => $genres
        ], 200);
    }

    public function store(Request $request)
    {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
            'description' => 'required|string',
        ]);

        // 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 4. insert data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 5. response
        return response()->json([
            'success' => true,
            'message' => "Resource added successfully!",
            'data' => $genre
        ], 201);
    }
}