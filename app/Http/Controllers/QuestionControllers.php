<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Exception;

class QuestionControllers extends Controller
{
    public function create_GET(Request $request , $id){
        return view('exam_question.create' , ['exam_id' => $id]);
    }
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

        return view('exam_question.index' , ['exam'=>$exam]);
    }
    public function insert_POST(Request $request){
        $answerType = $request->answerType;
        $question = $request->content;
        $option = $request->option;
        $exam_id = $request->exam_id;

        $correctAnswer = $request->correct_answers;
        $index = $request->index;

        $statement = $request->statement;
        $match_text = $request->match_text;

        $match_images = $request->file('match_image');

        $typeSoalId = 0;
        switch ($answerType) {
            case 'pilgan':
                $typeSoalId = 1;
                break;
            
            case 'pilgan_com':
                $typeSoalId = 2;
                break;
            
            case 'menjodohkan':
                $typeSoalId = 3;
                break;
            
            case 'uraian':
                $typeSoalId = 4;
                break;
            default:
                $typeSoalId = 0;
                break;
        }

        DB::beginTransaction();
        
        try{
            DB::table('questions')->insert([
                'question' => $question,
                'question_type_id' => $typeSoalId,
                'exam_id' => $exam_id
            ]);

            if($answerType === 'pilgan' || $answerType === 'pilgan_com'){
            
            }else if($answerType === 'menjodohkan'){
    
            }else if($answerType === 'uraian'){
    
            }


            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            echo $e;
            die();
        }

        return back();

    }
}
