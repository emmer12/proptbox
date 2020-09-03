<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Requests;
use App\Http\Resources\Request as RequestResource;
use Illuminate\Support\Str;
use Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $requests=Requests::all();
        return RequestResource::collection($requests); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

         $validate=$request->validate([
            // 'about' => ['required'],
            'space_for' => ['required'],
            'budget' => ['required'],
            'space_location' => ['required'],
            'space_type' => ['required']
        ]);

        $requests=new Requests();

    //    die(Auth::user()->id);

        $requests->space_for=$request->input('space_for');
        $requests->budget=$request->input('budget');
        $requests->space_location=$request->input('space_location');
        $requests->space_type=$request->input('space_type');
        $requests->about_property=$request->input('about_property');
        $requests->user_id=Auth::user()->id;
        $requests->save();

        return response()->json(['success'=>true,'msg'=>"Request sent"],200);
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
