<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAuthUser()
    {
        $user=User::find(Auth::user()->id);
         if ($user->id_verified_at && $user->phone_verified_at && $user->email_verified_at) {
            $user->verified=true;
        }else{
            $user->verified=false;
        }
        return new UserResource($user);

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
    public function updateUser(Request $request)
    {
        
        $validate=$request->validate([
           'email' => ['email', 'max:255', 'unique:users,email,'.Auth::user()->id]

       ]);

        $user=User::find(Auth::user()->id);
        if (Auth::user()->email !=$request->input('email') ) {
            $user->update([
                'email_verified_at'=>null
            ]);
        }
        if (Auth::user()->phoneNo !=$request->input('phoneNo') ) {
            $user->update([
                'phone_verified_at'=>null
            ]);
        }
        $user->update($request->all());
        return response()->json(['success'=> $user,'msg'=>'updated successfully'],200);
        // or $user->update($request->has('password') ? $request->all() : $request->except(['password']));
    }




    public function uploadFile(Request $request)
    {
        $validate=$request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,svg|max:1048'
        ]);
        // 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        if ($request->file()) {

            if($request->input('field')=='profile'){
                $fileName = 'profile'.time().'.'.$request->file->extension();  
                $request->file->move(public_path('uploads/profile-images'), $fileName);
                $user=User::find(Auth::user()->id);
                $user->update([
                "profile_pic_filename"=>$fileName
                ]);

            }

    
            return response()->json(['success'=>'Uploaded'],200);
        }
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
