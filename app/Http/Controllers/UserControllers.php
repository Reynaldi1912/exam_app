<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class UserControllers extends Controller
{
    public function index_GET(){
        $data = DB::table('users')->where('role','user')->get();
        return view('user.index',['user'=>$data]);
    }
    public function create_GET(){
        $data = DB::table('app_exam')->where('user_id',Auth::user()->id)->get()[0];
        return view('user.create' ,['exam_app'=>$data]);
    }
    public function edit_GET($id){
        $data = DB::table('users')->where('id',$id)->get()[0];
        $exam_app = DB::table('app_exam')->where('user_id',Auth::user()->id)->get()[0];
        return view('user.edit' ,['data' => $data , 'exam_app' => $exam_app]);
    }
    public function create_POST(Request $request){
        DB::table('users')->insert([
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'user',
            'password' => md5($request->password),
            'exam_app' => $request->exam_app,
        ]);
        return back()->with('success','add user successfully');;
    }

    public function edit_POST(Request $request){
        DB::table('users')->where('id',$request->id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => md5($request->password),
            'exam_app' => $request->exam_app,
        ]);
        return back()->with('success','edit user successfully');;
    }
    public function delete_GET($id){
        DB::table('users')->where('id',$id)->delete();
        return back()->with('success','delete user successfully');;
    }
}
