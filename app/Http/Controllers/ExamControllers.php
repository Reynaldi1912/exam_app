<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ExamControllers extends Controller
{
    public function index_GET(Request $request){
        $user_id = Auth::user()->id;
        $exam = DB::SELECT(
                "SELECT
                    e.*,
                    ae.user_id,
                    COUNT(eu.id) AS total_user,
                    CONCAT('[', GROUP_CONCAT(
                        DISTINCT JSON_OBJECT(
                            'id', u.id,
                            'username', u.username,
                            'email', u.email,
                            'status' , CASE WHEN eu.id THEN true ELSE false END 
                        )
                        ORDER BY u.id
                    ), ']') AS users
                FROM exams AS e
                LEFT JOIN app_exam AS ae ON e.app_exam_id = ae.id
                LEFT JOIN users AS u ON ae.id = u.exam_app AND u.role = 'user'
                LEFT JOIN exam_users AS eu ON u.id = eu.user_id AND eu.status = 1
                WHERE ae.user_id = $user_id
                GROUP BY e.id, ae.user_id"
        );

        // echo json_encode($exam);die();
        return view('exams.index',['exam'=>$exam]);
    }

    public function create_GET(Request $request){
        $data = DB::table('app_exam')->where('user_id',Auth::user()->id)->get()[0];
        return view('exams.create',['exam_app'=>$data]);
    }
    public function edit_GET(Request $request , $id){
        $user_id = Auth::user()->id;
        $exam = DB::SELECT(
            "SELECT
                e.*,
                ae.user_id,
                DATE(e.start_at) AS date_start_at,
		        TIME(e.start_at) AS time_start_at
            FROM exams AS e LEFT JOIN app_exam AS ae ON e.app_exam_id = ae.id
            WHERE ae.user_id= $user_id AND e.id = $id"
        );
        
        return view('exams.edit',['exam_app'=>$exam[0]]);
    }

    public function create_POST(Request $request){
        $data = DB::table('app_exam')->where('user_id',Auth::user()->id)->get()[0];
        $count = DB::table('exams')->where('app_exam_id',$data->id)->get();
        if($data->max_exam >  sizeof($count)){
            DB::table('exams')->insert([
                'name'=> $request->name,
                'description' => $request->description,
                'app_exam_id' => $request->exam_app,
                'duration' => $request->duration,
                'start_at' => $request->date_start.' '.$request->time
            ]);
        }else{
            return back()->with('danger','your capacity exam not avaliable');
        }
        return back()->with('success','add exam successfully');
    }
    public function edit_POST(Request $request){
        DB::table('exams')->where('id',$request->id)->update([
            'name'=> $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_at' => $request->date_start.' '.$request->time
        ]);
        return back()->with('success','edit exam successfully');;
    }

    public function delete_GET($id){
        
        DB::table('exams')->where('id',$id)->delete();
        return back()->with('success','delete exam successfully');;
    }
    public function change_exam_user_POST(Request $request) {
        try {
            $id = $request->id;
            $user_id = $request->user_id;
            $status = $request->status;
    
            // Memastikan menggunakan query builder dengan benar
            $check = DB::table('exam_users')
                        ->where('exam_id', $id)
                        ->where('user_id', $user_id)
                        ->first();
    
            if ($check != NULL) {
                DB::table('exam_users')
                    ->where('exam_id', $id)
                    ->where('user_id', $user_id)
                    ->update([
                        'status' => $status,
                        'updated_at' => now()
                    ]);
                return response()->json(['message' => 'Status updated successfully'], 200);
            } else {
                DB::table('exam_users')->insert([
                    'exam_id' => $id,
                    'user_id' => $user_id,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                return response()->json(['message' => 'User added successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}    
