<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\UserSession;

class UserSessionController extends Controller
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
     * @param  \App\Models\UserSession  $UserSession
     * @return \Illuminate\Http\Response
     */
    public function show(UserSession $UserSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSession  $UserSession
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSession $UserSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSession  $UserSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSession $UserSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSession  $UserSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSession $UserSession)
    {
        //
    }
    public static function getLatestUserSession()
    {
        $sessionData =  UserSession::where("user_id" , session()->get('user-id'))->orderByDesc('created_at')->limit(1)->first();
        $userSessionValues = json_decode($sessionData["session_values"]);
        return $userSessionValues;
    }
}
