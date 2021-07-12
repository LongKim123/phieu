<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use Mail;
use App\Mail\SendMail;
use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\Crypt;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	private $users;
    private $roles;
	function __construct(User $users,Role $roles)
	{
		$this->users=$users;
        $this->roles=$roles;
	}
    public function check_remember(){

       // $firstName = $this->users->find(83)->name;
       // dd($firstName);
      if(Auth()->check()){
         return redirect()->route('users.index');
      }
     return view('contents.login.login');
    }

    public function page_login(){

      $firstName = $this->users->name;

     // return view('contents.login.login');
    }
    public function check_login(Request $request){
     // dd($request->all());
      // dd(Crypt::encrypt($request->password));
      $remember=$request->has('remember_me')?true:false;

       if(Auth::attempt([
        'email'=>$request->email,
        'password'=>$request->password], $remember) )
        {
            //Authentication passed...
            return redirect()->route('users.index');
          
        }
        else{
            $error='Sai tài khoản mật khẩu';
            return view('contents.login.login',compact('error'));
          
        }
    }
    public function index(){

    	$list_user= $this->users->get();
        
    	return view('contents.users.index',compact('list_user'));
    }
    public function create(){
    	return view('contents.users.add');
    }
    public function store(Request $request){
        //dd($request->all());
        $userCreate= $this->users->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if($userCreate){
            $to_name=$request->name;
            $to_mail=$request->email;
            $data = array("name"=>$to_name,"body"=>"Sign Up Succsess");
            Mail::send('contents.sendmail.sendmailstore',$data,function($message) use ($to_name,$to_mail){
            $message->to($to_mail)->subject('Notice of successful registration 
');//send this mail with subject
            $message->from($to_mail,$to_name);//send from this mail
        });
            return redirect()->route('users.index');
        }
        else{
            $message_error='Đã bị lỗi';
            return view('contents.users.add',compact('message_error'));

        }
    }
    public function delete($id){
           $user=$this->users->find($id);
            $delete=$user->delete();
            if($delete){
            $ru=$user->role_user;
            foreach($ru as $item){
                RoleUser::find($item->id)->delete();
            }
              return response()->json([
                'code'=>200,
                'message'=>'success'],200);
           }
           
      
    }
    public function ngu(){
      $user1=User::get();
       //$user=User::find(83);
        // $startTime = microtime(true);
 
        // for ($i = 0; $i < 5; $i++) {
       foreach($user1 as $user1){
        $user = array("email"=>$user1->email,"name"=>$user1->name,"body"=>"Sign Up Succsess");
        SendMailJob::dispatch($user);
       }
       

      //   $endTime = microtime(true);
      //   $timeExecute = $endTime - $startTime;
      // }
         return redirect()->route('users.index');
    }
    public function edit($id){
         $user=$this->users->find($id);
         $user_roles=$user->roles()->get();
          //dd($user_roles);
         $password=$user->password;
         $roles=$this->roles->get();
         return view('contents.users.edit',compact('user','password','roles','user_roles'));
        
    }
    public function update(UserRequest $request ,$id){
           
       try{

            $user=$this->users->find($id);
            if(Hash::check($request->old_password,$user->password)){
               DB::beginTransaction();
             $userinsert=$user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
             ]);
              $user_roles=$this->users->find($id);
              //attach dùng để in hàng loạt bản ghi đè lên cái cũ
              //sync xóa cũ thay mới
              $d=$user_roles->roles()->sync($request->role);
                $log=[
                    'URL'=>$request->url(),
                    'METHOD'=>$request->getMethod(),
                    'BODY'=>$request->all(),
                    'RESPONSE'=>$request->getContent(),
                    'STATUS'=>'SUCCSESS'
                ];
                Log::channel('userUpdate')->info(json_encode($log));
          
            
            DB::commit();
            return redirect()->route('users.index');
            }
            else{
              $user_roles=$user->roles()->get();
              $message_error="Pass không khớp";
              $password=$user->password;
              $roles=$this->roles->get();
                $log=[
                    'URL'=>$request->url(),
                    'METHOD'=>$request->getMethod(),
                    'BODY'=>$request->all(),
                    'RESPONSE'=>$request->getContent(),
                    'STATUS'=>'FAILED
                    '
                ];
                Log::channel('userUpdate')->info(json_encode($log));
              return view('contents.users.edit',compact('user','password','roles','user_roles','message_error'));
            }
           
     }
      catch (Exception $exception) {

            DB::rollBack();

            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());

 

        }
      



    }
     public function logout(){
        Auth::logout();
         return redirect()->route('/');
    }
}
