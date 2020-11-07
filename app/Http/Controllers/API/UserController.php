<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\NewChat;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\ChatsResouces;
use App\Notifications\chatNotification;
use App\Notifications\OTPNotification;
use Illuminate\Support\Facades\Cache;
use Auth;
use Image;
use App\Chat;
use App\Messages;
use App\Listing;
use App\Payments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Str;
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
           'email' => ['email', 'max:255', 'unique:users,email,'.Auth::user()->id],
           'phoneNo'=>['min:11']

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
        $user = Auth::user();
        $token = $user->createToken('proptbox-v1')->accessToken;
        return response()->json(['success' => true,"access_token"=>$token], 200);

    }

    public function changePass(Request $request)
    {
        $validate=$request->validate([
            'password' => 'required|confirmed|min:6',
            'oldPassword'=>'required'
        ]);
        
        $user=Auth::user();

        $isPass=Hash::check($request->input('oldPassword'),$user->password);

        if ($isPass) {
            $user->password = Hash::make($request->input('oldPassword'));
    
            $user->setRememberToken(Str::random(60));
    
            $user->save();

            return response()->json(['success'=>'Updated'],200);
            
        }
        else {
            return response()->json(['success'=>false,'msg'=>'Password supplied not match with the old password'],400);
        }



    }



    public function uploadFile(Request $request)
    {
        $validate=$request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
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




    
    public function uploadVFile(Request $request)
    {
        $validate=$request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ]);
        if ($request->file()) {

                $fileName = 'id'.time().'.'.$request->file->extension();  
                $path = public_path('uploads/ids/'.$fileName);
                $file=$request->file;

                Image::make($file)->resize(300,160, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path); 

                return response()->json(['success'=>'Uploaded','filename'=>$fileName,'field'=>$request->input('field')],200);
        }
    }

    public function getUserById(Request $request) {
        $user=User::findOrFail($request->query('id'));

         if ($user->id_verified_at && $user->phone_verified_at && $user->email_verified_at) {
            $user->verified=true;
        }else{
            $user->verified=false;
        }
        return new UserResource($user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function createChat(Request $request)
    {
        $chat = new Chat();

        $user=User::find($request->input('to'));
        

        $chat->from=Auth::user()->id;
        $chat->to=$request->input('to');
        $chat->on=$request->input('on');

        $chat->save();

        $msg = new Messages();

        $msg->msg=$request->input('msg');
        $msg->chat_id=$chat->id;
        $msg->user_id=Auth::user()->id;



        $msg->save();

        broadcast(new NewChat($msg));

        $user->notify(new chatNotification($chat->to));

        return response()->json(['success'=>true,'chats'=>$chat],200);

    }



    public function sendChat(Request $request)
    {
        $msg = new Messages();

        $user=User::find($request->input('to'));


        $msg->msg=$request->input('msg');
        $msg->chat_id=$request->input('chat_id');
        $msg->user_id=Auth::user()->id;
        $msg->save();
        
        broadcast(new NewChat($msg));

        $user->notify(new chatNotification($user->id));

        return response()->json(['success'=>true,'msg'=>$msg],200);
    }

    public function getChat(Request $request)
    {
        $chats=Chat::where('to',Auth::user()->id)->orWhere('from',Auth::user()->id)->get();
        return ChatsResouces::collection($chats);
    }


    public function getChatMessages(Request $request)
    {
         $chats=Chat::find($request->query('id'))->messages()->get();
         return response()->json(['success'=>true,'chats'=>$chats],200);
    }

    public function checkChat(Request $request)
    {
        $chats=Chat::where('to',$request->query('to'))->where('from',Auth::user()->id)->first();
        return response()->json(['success'=>true,'chats'=>$chats],200);
    }


    public function markChat()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success'=>true],200);
    }

    public function verifyPayment(Request $request)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$request->query('reference'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_live_0001af7b009a202a78532535bbb406f737cbd3f7",
            "Cache-Control: no-cache",
          ),
         ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
          $payment=new Payments();

          $payment->listing_id=$request->query('listing');
          $payment->reference=$request->query('reference');
          $payment->amount=$request->query('amount');
          $payment->type='boost';
          
          if ($request->query('amount')==700) {
              $days=7;
          }elseif ($request->query('amount')==1000) {
              $days=14;
          }elseif ($request->query('amount')==3000) {
              $days=31;
          }
          $now=Carbon::now();
          $expire=$now->addDays($days);

          $payment->expired_at=$expire;

          $payment->save();

          $listing=Listing::find($payment->listing_id);
          $listing->update([
            'boosted'=>true,
            'boosted_at'=>$payment->created_at,
            'expired_at'=>$payment->expired_at,
            'rating'=>2
        ]);

          return response()->json(['success'=>true],200);
        }
    }

   
    public function otpSend()
    {
        
        Auth::user()->otpVerify();

        return response()->json(['success'=>true,'saved'=>Cache::get('OTP')],200);

    
    }
    public function verifyOTP(Request $request)
    {
        $otp=$request->input('otp');
        if (Cache::get('OTP') == $otp) {
          Auth::user()->update([
              'phone_verified_at'=>now()
          ]);
          Cache::delete('OTP');
          return response()->json(['success'=>true,'saved'=>Cache::get('OTP')],200);
        }else{
            return response()->json(['success'=>false,'msg'=>"Invalid or wrong OTP {$otp}"],400); 
        }
    }
  
}
