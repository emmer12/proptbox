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

        //  $validate=$request->validate([
        //     'requests_title' => ['required'],
        //     'requests_descrition' => ['required'],
        //     'requests_budget' => ['required'],
        //     'requests_location' => ['required'],
        //     'requests_type' => ['required']
        // ]);

        $requests=new Requests();

    //    die(Auth::user()->id);

        $requests->requests_title=$request->input('requests_title');
        $requests->requests_description=$request->input('requests_description');
        $requests->requests_budget=$request->input('requests_budget');
        $requests->requests_location=$request->input('requests_location');
        $requests->requests_type=$request->input('requests_type');
        $requests->slug=Str::slug($request->input('requests_title'));
        $requests->user_id=Auth::user()->id;
        $requests->save();

        return response()->json(['success'=>true,'msg'=>"property created"],200);
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
