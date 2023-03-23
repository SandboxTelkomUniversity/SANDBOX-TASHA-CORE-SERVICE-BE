<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishesResource;
use App\Models\Wishes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WishesController extends Controller
{
    //get
    public function index()
    {
        $wishes = Wishes::all();
        return new WishesResource(true, 'List Data Wishes', $wishes);
    }

    //create data
    Public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'wishes' => 'required',
        ],
            [
                'title.required' => 'Masukkan wish...'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Masukkan wish anda...',
                'data' => $validator->errors()
            ],401);

        } else{
            $post = Wishes::create([
                'wishes' => $request->input('wishes'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Wish berhasil disimpan!',
                ], 200);
            } else{
                return response()->json([
                    'success' => false,
                    'message' => 'Wish gagal disimpan!',
                ], 401);
            }
        }

    }
}
