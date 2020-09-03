<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Listing;
use App\Http\Resources\Listing as ListingResource;
use Auth;
class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listing=Listing::orderBy('rating','DESC')->paginate(10);
        return ListingResource::collection($listing);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validate=$request->validate([
             'space_address' => ['required'],
             'space_location' => ['required'],
            'space_type' => ['required'],
            'space_for' => ['required'],
            'rent' => ['required']
        ]);
        
        $listing=new Listing();

    //    die(Auth::user()->id);

        $listing->space_type=$request->input('space_type');
        $listing->space_for=$request->input('space_for');
        $listing->space_location=$request->input('space_location');
        $listing->space_address=$request->input('space_address');
        $listing->rent=$request->input('rent');
        $listing->payer_gender=$request->input('payer_gender');
        $listing->available_from=$request->input('available_from');
        $listing->rating=1;
        $listing->bedroom_type=$request->input('bedroom_type');
        $listing->about_property=$request->input('about_property');
        $listing->about_cohabitation=$request->input('about_cohabitation');
        $listing->slug=Str::slug($request->input('space_type'));
        $listing->user_id=Auth::user()->id;
        $listing->save();

        return response()->json(['success'=>true,'msg'=>"listing created"],200);
    }





    public function listingByLocation()
    {
        $listing=Listing::orderBy('rating','DESC')->paginate(10);
        return ListingResource::collection($listing);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listingBySlug($slug)
    {
        $list=Listing::where('slug',$slug)->first();
        return new ListingResource($list);
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
        $userId=Auth::user()->id;
        $post=Listing::findOrFail($id);
        if ($post->user_id == $userId) {
            $post->delete();
           return response()->json(['success'=>true,'msg'=>"listing deleted"],200);
            
        }else {
            return response()->json(['success'=>false,'msg'=>"You have no permission to delete this post"],400);
        }
    }
}
