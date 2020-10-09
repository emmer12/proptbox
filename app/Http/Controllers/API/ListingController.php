<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Listing;
use App\Tag;
use App\View;
use App\Http\Resources\Listing as ListingResource;
use Auth;
use Image;
use Input;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listing=Listing::orderBy('boosted_at','DESC')->orderBy('created_at','DESC')->paginate(10);
        return ListingResource::collection($listing);
    }



    public function searchList(Request $request)
    {

        $value=$request->query('s');

        $listing=Listing::where('bedroom_type','LIKE',"%$value%")->orWhere('space_type','LIKE',"%$value%")->orWhere('space_address','LIKE',"%$value%")->latest()->paginate(20);
        return ListingResource::collection($listing);
    }


    public function filterRange(Request $request)
    {

        $listing=Listing::whereBetween('rent',array($request->min_budget,$request->max_budget))->paginate(20);
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
            'rent' => ['required'],
            'duration' => ['required'],
            'images' => ['required'],

        ]);
        
        $listing=new Listing();

    //    die(Auth::user()->id);

        $listing->space_type=$request->input('space_type');
        $listing->space_for=$request->input('space_for');
        $listing->space_location=$request->input('space_location');
        $listing->space_address=$request->input('space_address');
        $listing->rent=$request->input('rent');
        $listing->duration=$request->input('duration');
        $listing->payer_gender=$request->input('payer_gender');
        $listing->available_from=$request->input('available_from');
        $listing->bedroom_type=$request->input('bedroom_type');
        $listing->about_property=$request->input('about_property');
        $listing->about_cohabitation=$request->input('about_cohabitation');
        $listing->images=$request->input('images');
        $listing->user_id=Auth::user()->id;
        $listing->save();

        foreach ($request->input('selectedTags') as $tag) {
            // $tags[]=[
            //     'listing_id'=>$listing->id,
            //     'name'=>$tag['value']
            // ];  
            $tagNew=new Tag();
            $tagNew->listing_id=$listing->id;
            $tagNew->name=$tag['value'];

            $tagNew->save();
            
            $listing->tags()->attach($tagNew->id);   
            
            
        }
        // $tag = Tag::insert($tags);
        return response()->json(['success'=>true,'msg'=>"listing created"],200);
    }





    public function listingByLocation(Request $request)
    {
        // return response()->json(Auth::user(), 200);

        
        $listing=Listing::orderBy('boosted_at','DESC')->orderBy('created_at','DESC')->where('space_location',Auth::user()->location)->paginate(10);
        return ListingResource::collection($listing);
      
    }

    public function listingByTag(Request $request)
    {
        $listing=Listing::whereHas('tags',function($query) use($request){
            $query->where('name',$request->query('tag'));
        })->get();
        return ListingResource::collection($listing);
    }


    public function listingByFLocation(Request $request){
        $listing=Listing::where('space_location',$request->query('location'))->orderBy('boosted_at','DESC')->orderBy('created_at','DESC')->paginate(12);
        return ListingResource::collection($listing);

    }

    public function guestList()
    {
        // return response()->json(Auth::user(), 200);
        $listing=Listing::orderBy('boosted_at','DESC')->orderBy('created_at','DESC')->take(20)->paginate(20);
        return ListingResource::collection($listing);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listingById($id)
    {
        $list=Listing::where('id',$id)->firstOrFail();
        return new ListingResource($list);
    }


    public function uploadFiles(Request $request)
    {
        // $validate=$request->validate([
        //     'file' => 'required|image|mimes:jpg,png,jpeg,svg|max:1048'
        // ]);
        // $_FILES['file']['name']
     
        foreach($request->file('file') as $file) {
            // if ($request->file()) {
                $fileName = 'listing-'.time().'-'.$file->getClientOriginalName(); 
                $path = public_path('uploads/listing/'.$fileName);
          
                Image::make($file)->resize(600,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path); 

                $preview[]=$fileName;
                
        // }
        }
        
        return response()->json(['files'=>json_encode($preview)]);


    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function updateList(Request $request)
    {
        
        $list=Listing::find($request->input('id'));
        if ($list->user_id == Auth::user()->id) {
            $list->update($request->except(['id','rating','created_at']));
            return response()->json(['success'=>$list->user_id],200);
        }else{
            return response()->json(['success'=>false,'msg'=>'You have no permission to update this field'],401);
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
        $userId=Auth::user()->id;
        $post=Listing::findOrFail($id);
        if ($post->user_id == $userId) {
            $post->delete();
           return response()->json(['success'=>true,'msg'=>"listing deleted"],200);
            
        }else {
            return response()->json(['success'=>false,'msg'=>"You have no permission to delete this post"],400);
        }
    }

    public function createView(Request $request)
    {
        $views=new View();

        $views->listing_id=$request->input('id');

        $views->save();

        return response()->json(['success'=>true],200);

    }
}
