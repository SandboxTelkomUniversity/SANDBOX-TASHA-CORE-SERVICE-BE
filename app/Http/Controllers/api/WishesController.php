<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishesResource;
use App\Models\Wishes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WishesController extends Controller
{
    //get all data wishes
    public function index()
    {
        $wishes = Wishes::all();
        return new WishesResource(true, 'List Data Wishes', $wishes);
    }

    //create data wishes
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

    //get detail data wishes (by ID)
    public function show_detail($id){

        $wishes = Wishes::find($id);
        if (is_null($wishes)){
            return new WishesResource(false, 'Data Wishes Tidak Ditemukan', $wishes);
        }
            return new WishesResource(true, 'Data Wishes Ditemukan', $wishes);
      
    }
}
