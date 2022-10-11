<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
 
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
        $userFound = User::find($request->email);
        if ($userFound) {
            # code...
        }else{
            User::create([
                'email' => $request->email
            ]);
        }

        $result = Mail::to($request->email)->send(new VerificationMail());

        echo $result;
    }
}