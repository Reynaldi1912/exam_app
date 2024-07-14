<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FunctionControllers extends Controller
{
    public function calculate_multiple($user_id, $exam_id)
    {

        $poin_benar = 4;
        $query = "WITH total_soal AS (
                SELECT COUNT(*) AS total FROM questions WHERE question_type_id = 2 AND exam_id = $exam_id
            ),
            scoring AS (
                SELECT 
                    aq.question_id,
                    q.question,
                    COALESCE($poin_benar / NULLIF(SUM(CASE WHEN aq.is_true = 1 THEN 1 ELSE 0 END), 0),0) AS scoring_option_plus,
                    COALESCE($poin_benar / NULLIF(SUM(CASE WHEN aq.is_true = 0 THEN 1 ELSE 0 END), 0),0) AS scoring_option_minus,
                    SUM(CASE WHEN aq.is_true = 1 THEN 1 ELSE 0 END) AS total_option_benar,
                    SUM(CASE WHEN aq.is_true = 0 THEN 1 ELSE 0 END) AS total_option_salah
                FROM 
                    answer_question AS aq
                LEFT JOIN 
                    questions AS q ON aq.question_id = q.id
                WHERE 
                    q.question_type_id = 2
                GROUP BY 
                    aq.question_id, q.question
            ),

            exam_scores AS (
                SELECT 
                    q.id AS question_id,
                    q.question_type_id,
                    ua.user_id,
                    q.question,
                    -- (SUM(CASE WHEN aq.is_true = 1 THEN 1 ELSE 0 END) * s.scoring_option_plus) AS total_benar_option,
                    -- (SUM(CASE WHEN aq.is_true = 0 THEN 1 ELSE 0 END) * s.scoring_option_minus) AS total_salah_option,
                    GREATEST(
                        (SUM(CASE WHEN aq.is_true = 1 THEN 1 ELSE 0 END) * s.scoring_option_plus) - 
                        (SUM(CASE WHEN aq.is_true = 0 THEN 1 ELSE 0 END) * s.scoring_option_minus),
                        0
                    ) AS final_score
                FROM 
                    user_answers AS ua
                LEFT JOIN 
                    answer_question AS aq ON ua.user_answer_id = aq.id
                LEFT JOIN 
                    scoring AS s ON aq.question_id = s.question_id
                LEFT JOIN 
                    questions AS q ON aq.question_id = q.id
                WHERE 
                    q.question_type_id = 2 
                    AND ua.user_id = $user_id
                GROUP BY 
                    q.id, ua.user_id, s.scoring_option_plus, s.scoring_option_minus
            ),

            unanswered_questions AS (
                SELECT 
                    id AS question_id,
                    question_type_id,
                    $user_id AS user_id,
                    question,
                    -- 0 AS total_benar_option,
                    -- 0 AS total_salah_option,
                    0 AS final_score
                FROM 
                    questions 
                WHERE 
                    question_type_id = 2
                    AND exam_id = $exam_id
                    AND id NOT IN (SELECT question_id FROM user_answers WHERE user_id = $user_id)
            )

            SELECT * FROM exam_scores
            UNION ALL
            SELECT * FROM unanswered_questions
            ORDER BY user_id, question_id;";

// echo "<pre>";
// echo $query;die();
        $data = DB::select($query);

        return $data;
    }

    public function calculate_single($user_id, $exam_id)
    {

        $poin_benar = 2;
        $poin_salah = -1;

        $query = "WITH total_soal AS (
            SELECT COUNT(*) AS total FROM questions WHERE exam_id = 4 AND question_type_id = 1
        ),
        user_scores AS (
            SELECT 
                        aq.question_id,
                ua.user_id,
                        q.question,
                        q.question_type_id,
                        COUNT(*) AS total_benar,
                SUM(CASE 
                    WHEN aq.is_true = 1 THEN $poin_benar
                    WHEN aq.is_true = 0 THEN $poin_salah
                    ELSE 0
                END) AS score
            FROM user_answers AS ua 
            LEFT JOIN answer_question AS aq ON ua.question_id = aq.question_id AND ua.user_answer_id = aq.id
            LEFT JOIN questions AS q ON aq.question_id = q.id
            WHERE q.exam_id = $exam_id  AND q.question_type_id = 1
                AND ua.user_id = $user_id
            GROUP BY ua.user_id ,ua.question_id
        )
        SELECT 
            us.question_id,
            us.question_type_id,
            us.user_id,
            us.question,
            us.score AS final_score
        FROM user_scores AS us
        CROSS JOIN total_soal AS ts

        UNION ALL

        SELECT 
                id AS question_id,
                question_type_id,
                $user_id AS user_id,
                question,
                -- 0 AS total_benar_option,
                -- 0 AS total_salah_option,
                $poin_salah AS final_score
        FROM 
                questions
        WHERE 
                question_type_id = 1
                AND exam_id = $exam_id
                AND id NOT IN (SELECT question_id FROM user_answers WHERE user_id = $user_id)
            ";

        $data = DB::select($query);

        return $data;
    }
    public function calculate_matching($user_id, $exam_id)
    {
        $poin_benar = 2;

        $query = "WITH total_option AS (
                    SELECT 
                        q.id AS question_id,
                        COUNT(*) AS total_option 
                    FROM 
                        answer_question AS aq 
                        LEFT JOIN questions AS q ON aq.question_id = q.id 
                    WHERE 
                        aq.question_type = 3 
                        AND aq.parent_answer_id IS NULL 
                        AND q.exam_id = $exam_id
                    GROUP BY 
                        q.id
                ),
                answered_question AS (
                    SELECT 
                        aq1.question_id, 
                        aq1.question_type AS question_type_id,
                        $user_id AS user_id, 
                        q.question,
                        COUNT(*) AS total_benar,
                        (($poin_benar / MAX(tot.total_option)) * COUNT(*)) AS final_score
                    FROM 
                        answer_question AS aq1 
                        LEFT JOIN answer_question AS aq2 ON aq1.id = aq2.parent_answer_id
                        LEFT JOIN questions AS q ON aq1.question_id = q.id
                        LEFT JOIN matching_answers AS ma ON aq1.id = ma.answer_id AND aq2.id = ma.target_answer_id 
                        LEFT JOIN total_option AS tot ON aq1.question_id = tot.question_id
                    WHERE 
                        aq1.parent_answer_id IS NULL 
                        AND aq1.question_type = 3
                        AND q.exam_id = $exam_id
                        AND ma.user_id = $user_id
                    GROUP BY 
                        aq1.question_id
                ),
                unanswered_question AS (
                    SELECT 
                        q.id AS question_iid,
                        q.question_type_id,
                        $user_id AS user_id,
                        q.question,
                        0 AS total_benar,
                        0 AS final_score
                    FROM 
                        questions AS q
                    WHERE 
                        q.question_type_id = 3
                        AND q.exam_id = $exam_id
                        AND q.id NOT IN (SELECT question_id FROM answered_question)
                )

                SELECT * FROM answered_question
                UNION ALL
                SELECT * FROM unanswered_question
            ";

        $data = DB::select($query);
        return $data;
    }

    public function join_calculate($user_id, $exam_id)
    {
        $multiple = $this->calculate_multiple($user_id, $exam_id);
        $single = $this->calculate_single($user_id, $exam_id);
        $matching = $this->calculate_matching($user_id, $exam_id);
        
        $multiple = json_decode(json_encode($multiple), true);
        $single = json_decode(json_encode($single), true);
        $matching = json_decode(json_encode($matching), true);
        
        $mergedResults = array_merge($multiple, $single, $matching);
        
        usort($mergedResults, function($a, $b) {
            return $a['question_id'] <=> $b['question_id'];
        });
        
        return $mergedResults;
    }
    
    
    
    
}
