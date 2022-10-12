<?php

namespace App\Http\Controllers;

use App\Models\VerificationCode;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
/*
    public function getLatest(String $user_id = null)
    {
        $verificationCode = VerificationCode::where('user_id', $user_id)->orderByDesc('created_at')->limit(1);
        return $verificationCode;
    }*/

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationCode $verificationCode)
    {
        //
    }
}
