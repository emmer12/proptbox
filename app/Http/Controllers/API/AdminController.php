<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Listing;
use App\User;
use App\Requests;
use App\Http\Resources\Listing as ListingResource;
use App\Http\Resources\Requests as RequestsResource;
use App\Http\Resources\User as UserResources;

class AdminController extends Controller
{
    public function getUsers()
    {
        $users=User::orderBy('created_at','DESC')->paginate(20);
        return UserResources::collection($users);
    }


    public function getListings()
    {
        $listing=Listing::orderBy('created_at','DESC')->paginate(20);
        return ListingResource::collection($listing);
    }


    public function getRequests()
    {
        $requests=Requests::orderBy('created_at','DESC')->paginate(20);
        return RequestsResource::collection($requests);
    }


    public function getBoosted()
    {
        $boosted=Listing::where('boosted',true)->orderBy('created_at','DESC')->paginate(10);
        return ListingResource::collection($boosted);
    }
    

    public function destroyUser($id,User $user)
    {
          $u=$user::find($id);
          $u->delete();
          return response()->json(['success'=>true],200);
    }

    public function destroyRequest($id,Requests $request)
    {
        $r=$request::find($id);
        $r->delete();
        return response()->json(['success'=>true],200);
    }
    
}
