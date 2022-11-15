<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\UserSession;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function saveDemographics(Request $request)
    {
        $uservalues = $request->formValues;
        $valid = "1";
        $getPreviousResults = false;
        foreach ($uservalues as $key => $item) {
           if (!isset($item["value"]) || $item["value"] == null || $item["value"] == "" ||  $item["value"] == "Choose country" ||  $item["value"] == "Choose city" ) {
                $valid = "0";
           }
           if ($item["value"] == "Review") {
               $getPreviousResults = true;
           }
        }

        if ($valid != "0") {
            $userSession = UserSession::create([
                'user_id' => session()->get('user-id'),
                'session_values' => json_encode($uservalues)
            ]);
            /*$previousResult = Result::where("user_id", session()->get('user-id'))->first();
            if ($previousResult == null) {
                return "/quiz/1";
            }else{
                return "/quiz/2";
            }*/
            if ($getPreviousResults) {
                return "/previous-results";
            }else{
                return "/quiz/1";
            }
            
        }
        

        return $valid;
    }
 
}
