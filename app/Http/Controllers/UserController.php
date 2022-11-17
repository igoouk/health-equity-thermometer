<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\UserSession;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

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
    public static function getDemographics($id)
    {
        return UserSession::where("user_id", $id)->orderByDesc('created_at')->limit(1)->first();
    }
    public function usePreviousDemographics()
    {
        $previousSession = UserSession::where("user_id" , session()->get('user-id'))->orderByDesc('created_at')->limit(1)->first();
        $newSession = $previousSession->replicate();
        $newSession->created_at = Carbon::now();
        try {
            $newSession->save();
            return "/quiz/1";
        } catch (\Throwable $th) {
            return $th;
        }
        
        
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
           if (isset($item["value"]) && $item["value"] == "Review") {
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
