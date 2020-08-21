<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;


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

        $validator=$request->validate([
            'name' =>'required',
            'email' =>'required|unique:users',
            // 'fullname' => ['required', 'string', 'max:255'],
            // 'phoneNo' => ['required', 'string', 'max:255'],
            // 'location' => ['required', 'string', 'max:255'],
            'password' => 'required|min:8',
        ]);

           $user = new User();
        
            // $user->fullname = $request->input('fullname');
            // $user->location = $request->input('location');
            // $user->phoneNo = $request->input('phoneNo');
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            $token = $user->createToken('proptbox-v1')->accessToken;

        return response()->json(['token'=>$token,'success'=>true],200);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator=$request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        if (Auth::attempt(['email'=>request('email'),'password'=>request('password')])){
            $user=Auth::user();
            $token=$user->createToken('proptbox-v1')->accessToken;
            return response()->json(['success'=>true,'token'=>$token],200);
        }
        else{
            return response()->json(['error'=>"Invalid username or password"],401);
      
         }

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
