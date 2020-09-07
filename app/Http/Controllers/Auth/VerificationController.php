<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function resend(Request $request){    
        if($request->user()->hasVerfiedEmail()){
            return response(['message' => 'Already Verified']);
        }
        $request->user()->sendEmailVerificationNotification();
        if($request->wantsJson()){
            return response(['message' => 'Email Sent']);
        }
        return back()->with('resent', true);
    }
    public function verify(Request $request) {

        auth()->loginUsingId($request->route('id'));

        if($request->route('id') != $request->user()->getKey()){
            throw new AuthorizationException;
        }
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        $userID = $request[‘id’];
        $user = User::findOrFail($userID);
        $date = date('Y-m-d H:i:s');
        $user->email_verified_at = $date; // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
        $user->save();
        return redirect($this->redirectPath())->with('verified', true);
    }
       /* else {
        
            $userID = $request[‘id’];
            $user = User::findOrFail($userID);
            $date = date('Y-m-d H:i:s');
            $user->email_verified_at = $date; // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
            $user->save();
            return response(['message'=>'succesfully verified']);
        */
        
    
}