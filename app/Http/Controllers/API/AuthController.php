<?php

namespace App\Http\Controllers\API;

use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Laravel\Passport\Client;
use App\IdVerify;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {

        $validator = $request->validate([
            // 'username' => 'required',
            'email' => 'required|unique:users',
            'fullname' => ['required', 'string', 'max:255'],
            'password' => 'required|min:6|confirmed',
            'location' => ['required', 'string', 'max:255'], 
            'phone' => ['required', 'string', 'max:255'],
        ]);

        $user = new User();

        $user->fullname = $request->input('fullname');
        $user->location = $request->input('location');
        $user->phoneNo =$request->input('phone');
        // $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        // $user->sendEmailVerificationNotification();
        $token = $user->createToken('proptbox-v1')->accessToken;


        return response()->json(['success' => true,"access_token"=>$token], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginP(Request $request)
    {
        $validator = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('proptbox-v1')->accessToken;
            return response()->json(['success' => true, 'token' => $token], 200);
        } else {
            return response()->json(['error' => "Invalid username or password"], 401);
        }
    }


    public function verify(Request $request)
    {
        $user = User::findOrFail($request->id);

        // Do this to allow unverified user to login 

        // if (!hash_equals((string) $request->id, (string) $user->getKey())) {
        //     throw new AuthorizationException;
        // }

        // dd($request->id);
        if (!hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                "msg" => "User already verified",
                "success" => false
            ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            "msg" => "Email Verify successfully",
            "success" => true
        ]);
    }



    public function login(Request $request)
    {

        $user = User::where('email', $request['email'])->where('email_verified_at', '<>', NULL)->first();
        $passportClient = Client::where('password_client', 1)->first();

        $data = [
            'grant_type' => 'password',
            'client_id' => $passportClient->id,
            'client_secret' => $passportClient->secret,
            'username' => $request['email'],
            'password' => $request['password'],
            'scope' => '*'
        ];

        

        $tokenRequest = Request::create('/oauth/token', 'post', $data);
        $tokenResponse = app()->handle($tokenRequest);
        $contentString = $tokenResponse->content();


        $result=json_decode($contentString);
        if (!empty($result->error)) {
            return response()->json(['msg' => "Invalid cridential"], 400);
        }
        // else if(!$user) {
        //     return response()->json(['msg' => "Email not verified"], 400);
        // }
        else{
            return response()->json([
                'data' => $result
            ]);
        }


        
    }

    public function otherSetup(Request $request)
    {
        
        $validator = $request->validate([
            'phoneNo' => 'required',
            'location' => ['required', 'string', 'max:255'],
            'age' => ['required','max:255'],
            'gender' => ['required','max:255'],

        ]);

        $user = User::whereEmail(Auth::user()->email)->first();
        

        $user->location=$request->input('location');
        $user->age=$request->input('age');
        $user->phoneNo=$request->input('phoneNo');
        $user->gender=$request->input('gender');

        $user->save();

        return response()->json([
            'success' => true
        ],200);

    }


    public function otherSetupSignup(Request $request)
    {
        
        $validator = $request->validate([
            'age' => ['required','max:255'],
            'gender' => ['required','max:255'],

        ]);

        $user = User::whereEmail(Auth::user()->email)->first();
        
        $user->age=$request->input('age');
        $user->gender=$request->input('gender');

        $user->save();

        return response()->json([
            'success' => true
        ],200);

    }


    public function idVerify(Request $request)
    {

        $validator = $request->validate([
            // 'username' => 'required',
            'name' => 'required',
            'nationality' => ['required', 'string', 'max:255'],
            'oso' => 'required',
            'front' => 'required',
            'back' => 'required',
            'id_type' => ['required'],
        ]);

        $verify = new IdVerify();

        $verify->name = $request->input('name');
        $verify->nationality = $request->input('nationality');
        $verify->oso = $request->input('oso');
        $verify->id_type = $request->input('id_type');
        $verify->front_img = $request->input('front');
        $verify->back_img = $request->input('back');
        $verify->save();

        $user=Auth::user();

        $user->id_verified_at=now();
        $user->save();

        return response()->json(['success' => true], 200);
    }



    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
