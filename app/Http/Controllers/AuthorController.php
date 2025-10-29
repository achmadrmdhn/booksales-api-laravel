<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // READ
    public function index()
    {
        // 1. Ambil data
        $author = Author::all();

        // 2. Cek ketersediaan data
        if ($author->isEmpty()) {
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
            'data' => $author
        ], 200);
    }

    // CREATE
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

    // SHOW
     public function show(string $id) {
       $author = Author::find($id);

       if (!$author) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found",
            ], 404);
       }

       return response()->json([
            'success' => true,
            'message' => "Get detail resource",
            'data' => $author
       ], 200);
    }

      // UPDATE
    public function update(string $id, Request $request)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found",
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'bio'   => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'bio'  => $request->bio,
        ];

        if ($request->hasFile('photo')) {
            // hapus foto lama jika ada
            if ($author->photo) {
                Storage::disk('public')->delete('authors/' . $author->photo);
            }
            // simpan foto baru
            $photo = $request->file('photo');
            $photo->store('authors', 'public');
            $data['photo'] = $photo->hashName();
        }

        $author->update($data);

        return response()->json([
            'success' => true,
            'message' => "Resource updated successfully!",
            'data'    => $author
        ], 200);
    }

    // DELETE
     public function destroy(string $id) {
        $author = Author::find($id);

         if (!$author) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found",
            ], 404);
        }

        if (!$author->photo) {
            // delete from storage
            Storage::disk('public')->delete('authors/' . $author->photo);
        }
        
        $author->delete();

        return response()->json([
            'success' => true,
            'message' => "Delete resource successfully",
        ], 200);
    }

}