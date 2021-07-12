<?php

namespace App\Http\Controllers;
use App\User;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ApiRegisterController extends Controller
{
    public function register(Request $request){
    	$userCreate= User::create([
    		'name'=>$request->username,
    		'email'=>$request->email,
    		'password'=>bcrypt($request->password)
    	]);
    	return response()->json([
    		'code'=>201,
    		'data'=>$userCreate
    	],201);
    }
    public function list_user(Request $request){
        $token=$request->header('token');
        $checkTokenIsValid=SessionUser::where('token',$token)->first();
         if(!empty($checkTokenIsValid)){
            $list_user=User::all();
                return response()->json([
                    'code'=>200,
                    'data'=>$list_user
                ],201);
         }
         else{
              return response()->json([
                    'code'=>202,
                    'data'=>'không có headers'
                ],202);

         }
    	
    }
    public function login(Request $request){
        //B1 xac thuc
        $dataCheckLogin=[
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(auth()->attempt($dataCheckLogin)){
            $checkTokenExit=SessionUser::where('user_id',auth()->id())->first();
            if(empty($checkTokenExit)){
                 $userSession =SessionUser::create([
                'token'=>Str::random(40),
                'refresh_token'=>Str::random(40),
                'token_expired'=>date('Y-m-d H:i:s', strtotime('+30 day')),
                'refresh_token_expired' => date('Y-m-d H:i:s', strtotime('+360 day')),
                'user_id'=>auth()->id()

                ]);
            }
            else{
                $userSession=$checkTokenExit;
            }
            return response()->json([
            'code'=>200,
            'data'=>$userSession
        ],200);

           
        }
        else{
              return response()->json([
            'code'=>404,
            'data'=>"Bị sai tài khoản mật khẩu"
        ],404);

        }
     
      

    }
    public function refresh_token(Request $request){
        $token=$request->header('token');
        $checkTokenIsValid=SessionUser::where('token',$token)->first();
        if(!empty($checkTokenIsValid)){
            if($checkTokenIsValid->token_expired < time()){
                $checkTokenIsValid->update([
                    'token'=>Str::random(40),
                    'refresh_token'=>Str::random(40),
                    'token_expired'=>date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expired' => date('Y-m-d H:i:s', strtotime('+360 day')),
                   
                ]);
            }
        }
        $dataSesion=SessionUser::find($checkTokenIsValid->id);
          return response()->json([
            'code'=>200,
            'data'=>$dataSesion
        ],200);
    }
    public function delete_token(Request $request){
        $token=$request->header('token');
        $checkTokenIsValid=SessionUser::where('token',$token)->first();
        if(!empty($checkTokenIsValid)){
            $checkTokenIsValid->delete();
            return response()->json([
            'code'=>200,
            'data'=>'Xoa thanh cong'
        ],200);
        }
        else{
            return response()->json([
            'code'=>404,
            'data'=>'Xoa khong thanh cong'
        ],404);
        }
       
          

    }

}
