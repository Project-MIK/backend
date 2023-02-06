<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePattientRequest;
use App\Http\Requests\UpdatePattientRequest;
use App\Models\Pattient;

class PattientController extends Controller
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
     * @param  \App\Http\Requests\StorePattientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePattientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pattient  $pattient
     * @return \Illuminate\Http\Response
     */
    public function show(Pattient $pattient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pattient  $pattient
     * @return \Illuminate\Http\Response
     */
    public function edit(Pattient $pattient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePattientRequest  $request
     * @param  \App\Models\Pattient  $pattient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePattientRequest $request, Pattient $pattient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pattient  $pattient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pattient $pattient)
    {
        //
    }
}
