<?php

namespace App\Http\Controllers;

use App\Models\Wishes;
use App\Http\Requests\StoreWishesRequest;
use App\Http\Requests\UpdateWishesRequest;

class WishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWishesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWishesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishes  $wishes
     * @return \Illuminate\Http\Response
     */
    public function show(Wishes $wishes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishes  $wishes
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishes $wishes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWishesRequest  $request
     * @param  \App\Models\Wishes  $wishes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWishesRequest $request, Wishes $wishes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishes  $wishes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishes $wishes)
    {
        //
    }
}
