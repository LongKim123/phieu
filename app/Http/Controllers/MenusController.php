<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\SessionUser;
use App\Component\Recusive;
use Illuminate\Support\Str;

class MenusController extends Controller
{

	public function checkToken($token){
		$checkTokenIsValid=SessionUser::where('token',$token)->first();
       return $checkTokenIsValid;
	}
    public function index(Request $request){
    	$token=$request->header('token');
    	$check=$this->checkToken($token);
        if(!empty($check)){
    	$list_menu=Menu::all();
	    	return response()->json([
	    		'code'=>201,
	    		'data'=>$list_menu
	    	],201);
    	}
    	else{
    		return response()->json([
	    		'code'=>404,
	    		'data'=>'error'
	    	],404);

    	}

    }
     public function delete(Request $request){
    	$token=$request->header('token');
    	$check=$this->checkToken($token);
        if(!empty($check)){
    	$list_menu=Menu::find($request->id)->delete();
	    	return response()->json([
	    		'code'=>200,
	    		'data'=>'xoa thanh cong'
	    	],200);
    	}
    	else{
    		return response()->json([
	    		'code'=>404,
	    		'data'=>'error'
	    	],404);

    	}

    }
    public function store(Request $request){
        $token=$request->header('token');
        $check=$this->checkToken($token);
        if(!empty($check)){
            $menuCreate= Menu::create([
            'name'=>$request->namemenu,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->namemenu,'-')
        ]);
            return response()->json([
                'code'=>200,
                'data'=>'them thanh cong'
            ],200);
        }
        else{
            return response()->json([
                'code'=>404,
                'data'=>'error'
            ],404);

        }

    }
    public function recusive(){
         $first="<option>Chon danh muc cha</option>";
        // $last=" </select>";
        $htmlOption=$first.$this->getCate($parentId='')    ;
        return response()->json([
                'code'=>200,
                'data'=> $htmlOption
            ],200);

    }
    public function recusive_edit(Request $request){
        $menu=Menu::find($request->id);
         $first="<option>Chon danh muc cha</option>";
         $optionSelect=$first.$this->getCate($parentId=$menu->parent_id);
       
        // $last=" </select>";
        //$htmlOption=$this->getCate($parentId='')    ;
        return response()->json([
                'code'=>200,
                'data'=>   $optionSelect,
                'name'=>$menu->name

            ],200);
    }
     public function getCate($parentId){
        $data= Menu::all();
        $recusive=new Recusive($data);
        
        $htmlOption= $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function edit(Request $request){
         $token=$request->header('token');
        $check=$this->checkToken($token);
        if(!empty($check)){
            $menuUpdate= Menu::find($request->id)->update([
            'name'=>$request->namemenu,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->namemenu,'-')
        ]);
            return response()->json([
                'code'=>200,
                'data'=>'them thanh cong'
            ],200);
        }
        else{
            return response()->json([
                'code'=>404,
                'data'=>'error'
            ],404);

        }
    }
}
