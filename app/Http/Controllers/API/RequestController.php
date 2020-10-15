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

    public function searchReq(Request $request)
    {

        $value=$request->query('s');
        $req=Requests::where('about_property','LIKE',"%$value%")->orWhere('space_type','LIKE',"%$value%")->latest()->paginate(20);
        return RequestResource::collection($req);
    }
    /**
     * Store a newly created resource in storage.
     *]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

         $validate=$request->validate([
            // 'about' => ['required'],
            'space_for' => ['required'],
            'space_location' => ['required'],
            'space_type' => ['required'],
            'min_budget' => ['required'],
            'max_budget' => ['required']
        ]);

        $requests=new Requests();

    //    die(Auth::user()->id);

        $requests->space_for=$request->input('space_for');
        $requests->min_budget=$request->input('min_budget');
        $requests->max_budget=$request->input('max_budget');
        $requests->space_location=$request->input('space_location');
        $requests->space_type=$request->input('space_type');
        $requests->about_property=$request->input('about_property');
        $requests->about_cohabitation=$request->input('about_cohabitation');
        $requests->user_id=Auth::user()->id;
        $requests->save();

        return response()->json(['success'=>true,'msg'=>"Request sent"],200);
    }



    public function requestLimitGuest()
    {
        $requests=Requests::take(6)->get();
        return RequestResource::collection($requests); 
    }

    
    public function requestLimit()
    {
        $requests=Requests::where('space_location',Auth::user()->location)->take(6)->get();;
        return RequestResource::collection($requests); 
    }


    public function requestByLocation()
    {
        $requests=Requests::orderBy('created_at','DESC')->where('space_location',Auth::user()->location)->paginate(9);
        return RequestResource::collection($requests);
    }

    public function requestByFilterLocation(Request $request)
    {
        $requests=Requests::where('space_location',$request->query('location'))->paginate(12);
        return RequestResource::collection($requests);
    }

    
    public function filterRange(Request $request)
    {
        // return response()->json([$request->min_budget]);

        $requests=Requests::whereBetween('min_budget',array($request->min_budget,$request->max_budget))->orWhereBetween('max_budget',array($request->min_budget,$request->max_budget))->paginate(20);
        return RequestResource::collection($requests);
    }

    public function requestGuest()
    {
        $requests=Requests::orderBy('created_at','DESC')->paginate(20);
        return RequestResource::collection($requests);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function requestById($id)
    {

        $request=Requests::where('id',$id)->firstOrFail();
        return new RequestResource($request);
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
