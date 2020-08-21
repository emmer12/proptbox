<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;
use Illuminate\Support\Str;
use App\Http\Resources\Property as PropertyResource;
use Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $property=Property::all();
        return PropertyResource::collection($property);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $validate=$request->validate([
        //     'property_title' => ['required'],
        //     'property_descrition' => ['required'],
        //     'property_price' => ['required'],
        //     'property_location' => ['required'],
        //     'property_type' => ['required']
        // ]);

        $property=new ProPerty();

    //    die(Auth::user()->id);

        $property->property_title=$request->input('property_title');
        $property->property_description=$request->input('property_description');
        $property->property_price=$request->input('property_price');
        $property->property_location=$request->input('property_location');
        $property->property_type=$request->input('property_type');
        $property->slug=Str::slug($request->input('property_title'));
        $property->user_id=Auth::user()->id;
        $property->save();

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
