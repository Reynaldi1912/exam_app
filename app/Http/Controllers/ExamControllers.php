<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Exception;
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

    public function runningExam_GET(Request $request ,$exam_id, $num){
        $user_id = Auth::user()->id;
        $exam_id = $exam_id;
        $checkuser = DB::select("SELECT * FROM exam_users WHERE user_id = $user_id AND status = 1 AND exam_id = $exam_id");
        if(!$checkuser){
            return back();
        }
        $exam = DB::SELECT("SELECT * , DATE(start_at) AS start_date, TIME(start_at) AS start_time FROM exams WHERE id = $exam_id")[0];
        $question = DB::SELECT(
                    "SELECT *
                        FROM (
                            SELECT 
                                RANK() OVER (ORDER BY id) AS `rank`,
                                questions.*
                            FROM 
                                questions
                        ) AS RankedQuestions
                        WHERE `rank` = $num;

                    ");

        $question_id = $question[0]->id;

        if (in_array($question[0]->question_type_id, [1, 2, 4])) {
            $answer = DB::SELECT(
                "SELECT * FROM (
                SELECT 
                        aq.id,
                        aq.question_id,
                        aq.question_type,
                        aq.answer,
                        aq.file,
                        aq.parent_answer_id,
                        CASE WHEN ua.id IS NOT NULL THEN 1 ELSE 0 END AS key_user,
                        ua.text AS key_text
                    FROM 
                        answer_question AS aq 
                        LEFT JOIN user_answers AS ua ON aq.question_id = ua.question_id AND aq.id = ua.user_answer_id AND ua.user_id = $user_id
                    WHERE 
                        aq.question_id = $question_id 
                        AND aq.parent_answer_id IS NULL

                    UNION ALL

                    SELECT 
                        NULL as id,
                        aq.question_id,
                        4 AS question_type,
                        NULL As answer,
                        NULL AS file,
                        NULL AS parent_answer_id,
                        0 AS key_user,
                        aq.text AS key_text
                    FROM 
                        user_answers AS aq 
                    WHERE 
                        aq.question_id = $question_id
                        AND aq.user_id = $user_id
                ) AS my_data"
            );

        }else if($question[0]->question_type_id == 3){
            $answer = DB::SELECT(
                " SELECT 
                        aq.id,
                        aq.question_id,
                        aq.question_type,
                        aq.answer,
                        aq.file,
                        aq.parent_answer_id,
                        CASE WHEN ua.id IS NOT NULL THEN 1 ELSE 0 END AS key_user,
                        ua.text AS key_text
                    FROM 
                        answer_question AS aq 
                        LEFT JOIN user_answers AS ua ON aq.question_id = ua.question_id AND aq.id = ua.user_answer_id
                    WHERE 
                        aq.question_id = $question_id 
                        AND aq.parent_answer_id IS NULL"
            );
        }


        $checkMatching = DB::SELECT("SELECT COUNT(*) AS total FROM matching_answers WHERE question_id = $question_id AND user_id = $user_id");
        if($checkMatching[0]->total == 0){
            $target = DB::SELECT(
                "SELECT 
                        aq.id,
                        aq.question_id,
                        aq.question_type,
                        aq.answer,
                        aq.file,
                        aq.parent_answer_id,
                        CASE WHEN ua.id IS NOT NULL THEN 1 ELSE 0 END AS key_user,
                        ua.text AS key_text
                    FROM 
                        answer_question AS aq 
                        LEFT JOIN user_answers AS ua ON aq.question_id = ua.question_id AND aq.id = ua.user_answer_id
                    WHERE
                        aq.question_id = $question_id 
                        AND aq.parent_answer_id IS NOT NULL ORDER BY RAND()"
            );
        }else{
            $target = DB::SELECT(
                "SELECT
                    ma.target_answer_id AS id,
                    ma.question_id ,
                    3 AS question_type,
                    aq.answer ,
                    aq.file,
                    ma.answer_id AS parent_answer_id, 
                    0 AS key_user,
                    NULL AS key_text
                FROM matching_answers AS ma LEFT JOIN answer_question AS aq ON ma.question_id = aq.question_id AND ma.target_answer_id = aq.id
                WHERE ma.user_id = $user_id AND ma.question_id = $question_id  ORDER BY answer_id ASC"
            );
        }

        // return $answer;
        $jml_soal = DB::SELECT("SELECT COUNT(*) AS jml_soal FROM questions WHERE exam_id = $exam_id")[0];
        return view('exam_users.index',['question'=>$question[0]  ,'answers'=>$answer, 'num'=>$num , 'jml_soal'=>$jml_soal ,'exam'=>$exam , 'target'=>$target]);
    }

    public function save_answer_POST(Request $request, $page) {
        $choose_option = $request->choose_option ;
        $index_option = $request->index_option ;
        $question_id = $request->question_id ?? null;
        $answer_text = $request->answer_text ?? null;

        $target_answer = $request->target ?? [];
    
        $user_id = Auth::user()->id;
    
        $option = array();
        DB::beginTransaction();
        try {
            if((is_array($choose_option) && sizeof($index_option) > 0) || ($choose_option != null && sizeof($index_option) > 0) || $answer_text){
                DB::table('user_answers')->where('user_id', $user_id)->where('question_id', $question_id)->delete();
                DB::table('matching_answers')->where('user_id', $user_id)->where('question_id', $question_id)->delete();
            }
    
            // return (is_array($choose_option) && sizeof($index_option) > 0) == true ? 'true' : 'false';
            if ((is_array($choose_option) && sizeof($index_option) > 0) || ($choose_option != null && sizeof($index_option) > 0)) {
                if (is_array($choose_option)) {
                    // For checkboxes
                    foreach ($index_option as $index => $id) {
                        if (in_array($index, $choose_option)) {
                            $option[] = $id;
                        }
                    }
                } else {
                    // For radio buttons
                    foreach ($index_option as $index => $id) {
                        if ($index == $choose_option) {
                            $option[] = $id;
                            break;
                        }
                    }
                }
    
                // Insert new answers
                for ($i = 0; $i < sizeof($option); $i++) {
                    DB::table('user_answers')->insert([
                        'user_id' => $user_id,
                        'question_id' => $question_id,
                        'user_answer_id' => $option[$i],
                    ]);
                }
            } else if ($answer_text) {
                // Handle text answers
                DB::table('user_answers')->insert([
                    'user_id' => $user_id,
                    'question_id' => $question_id,
                    'text' => $answer_text
                ]);
            }else if(sizeof($target_answer) > 0){
                // Handle matching answers
                DB::table('matching_answers')->where('user_id', $user_id)->where('question_id', $question_id)->delete();

                for ($i=0; $i < sizeof($target_answer) ; $i++) { 
                    DB::table('matching_answers')->insert([
                        'question_id' => $question_id,
                        'user_id' => $user_id,
                        'answer_id' => $index_option[$i],
                        'target_answer_id' => $target_answer[$i]
                    ]);
                }
            }

    
            $result['message'] = 'Data has been saved';
            $result['status'] = true;
            DB::commit();
        } catch (Exception $e) {
            $result['message'] = 'Data not saved';
            $result['status'] = false;
            DB::rollback();
        }
    
        return $result;
    }

    public function waiting_room_GET(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $data = DB::select("
            SELECT 
                eu.*, 
                e.name, 
                e.description, 
                e.duration, 
                e.start_at AS start_at_exam,
                CASE 
                    WHEN DATE(e.start_at) = CURRENT_DATE THEN
                        CASE 
                            WHEN TIME(NOW()) BETWEEN TIME(e.start_at) AND TIME(DATE_ADD(e.start_at, INTERVAL e.duration MINUTE)) THEN 'RUNNING'
                            WHEN TIME(NOW()) > TIME(DATE_ADD(e.start_at, INTERVAL e.duration MINUTE)) THEN 'EXPIRED'
                            ELSE 'NOT READY'
                        END
                    WHEN DATE(e.start_at) > CURRENT_DATE THEN 'NOT READY'
                    ELSE 'EXPIRED'
                END AS status_exam
            FROM 
                exam_users AS eu
            LEFT JOIN 
                exams AS e ON eu.exam_id = e.id
            WHERE 
                eu.status = 1
            AND 
                eu.user_id = $user_id
        ");
    
        return view('exam_users.room', ['data' => $data]);
    }
    
}
