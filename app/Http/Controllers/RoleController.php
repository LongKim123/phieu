<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Log;
use DB;
class RoleController extends Controller
{
	private $roles;

	function __construct(Role $roles)
	{
		$this->roles=$roles;
	}
    public function index(){
    	$list_role=$this->roles->get();
    	return view('contents.roles.index',compact('list_role'));
    }
    public function create(){

    	return view('contents.roles.add');
    }
    public function store(Request $request){

    	 $roleCreate= $this->roles->create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
           
        ]);
        if($roleCreate){
             return redirect()->route('roles.index');
        }
        else{
            $message_error='Đã bị lỗi';
            return view('contents.roles.add',compact('message_error'));

        }
    }
    public function delete($id){
    	try{
       		$role=$this->roles->find($id);
       		$delete_role=$role->delete();
           //	
       		
	          
	        $ru=$role->role_user;
	        foreach($ru as $item){
                RoleUser::find($item->id)->delete();
            }
    		  return response()->json([
    			'code'=>200,
    			'message'=>'success',
    			'ngu',$ru],200);

       		}
       		catch(Exception $exception){
    		Log::error('Message'.$exception->getMessage().'Line'.$exception->getLine());
    		return response()->json([
    			'code'=>200,
    			'message'=>'fail'],200);
    	}
          
          
      
    }
}
