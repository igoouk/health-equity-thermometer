<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\VerificationCode;
use App\Models\Result;

class VerificationMailController extends Controller
{
    
    /**
     * Send verification code to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendCode(Request $request)
    {

        
        $userFound = User::where('email', $request->email)->first();
        if ($userFound) {
            # code...
        }else{
            $userFound = User::create([
                'email' => $request->email
            ]);
        }
        $tempCode = $this->generateRandomString(5);
        $verificationCode = VerificationCode::create([
            'user_id' => $userFound->id,
            'code' => $tempCode,
        ]);
        session(['user_id' => $userFound->id]);
        $result = Mail::to($request->email)->send(new VerificationMail($verificationCode));

        echo $result;
    }

    public function verifyCode(Request $request)
    {
        $user_id = session()->get('user_id', 'default');
        $mostRecentRequestedCode = VerificationCode::where('user_id', $user_id)->orderByDesc('created_at')->limit(1)->first();
        if ($request->code == $mostRecentRequestedCode->code) {
            session(['verified' => "1"]);
            $previousResult = Result::where("user_id", session()->get('user_id'))->first();
            if ($previousResult == null) {
                return "/quiz/1";
            }else{
                return "/quiz/2";
            }
            
        }else{
            return "0";
        }
        
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}