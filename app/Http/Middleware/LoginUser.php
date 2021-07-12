<?php

namespace App\Http\Middleware;
 use Illuminate\Http\Request ;
use \App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use App\Role;
use Closure;

class LoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$checkuser)
    {
        //dd($checkuser);
       // dd(Role::first()->role_user);
    
        if($request->isMethod('post')){
             $validated = $request->validate([ 
            'email'=>'required',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', //
         ]);
             
                $log=[
                    'URL'=>$request->url(),
                    'METHOD'=>$request->getMethod(),
                    'BODY'=>$request->all(),
                    'RESPONSE'=>$request->getContent()
                ];
                Log::channel('userLogin')->info(json_encode($log));
             
            
        }
         return $next($request);
        
       
       
    }
}
