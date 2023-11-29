<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FetchApiController extends Controller
{
    public function fetchApi(){
        $msg = '';
        DB::beginTransaction();
        try{
            $response = Http::get('https://quizapi.io/api/v1/questions',[
                'apiKey' => '6TMy5yAzc5yN5g36HWauWIRWDvsP7q4tYTo7Yll6',
                'limit' => 10
            ]);
            // $questions = json_decode($response->body());
           
            $questions = $response->object();
            foreach($questions as $q){
                $question = new Question();
                $question->question = $q->question;
                $question->answer_a = $q->answers->answer_a;
                $question->answer_b = $q->answers->answer_b;
                $question->answer_c = $q->answers->answer_c;
                $question->answer_d = $q->answers->answer_d;
                $question->save();

            }
            DB::commit();
            return 'Successfull';
        }   catch(\Throwable $th){
            $msg = $th->getMessage();
            DB::rollBack();
            return $msg;
        }
    }


    public function smartChurch(){
        $response = Http::withToken(env('SMARTCHURCH_KEY'))->get('http://smartchurch.com.ng/api/admin/income-title');
        $results = $response->object();
        $items = collect($results->data);
        $chunks = $items->chunk(2);
        foreach($chunks as $item){
            foreach($item as $r){
                $member = new Member();
                $member->name = $r->name;
                $member->phone = $r->church_id;
                $member->save();
            }
            // DB::table('users')->insert($item->toArray());
            // Member::insert($item->toArray());
        }
        // foreach($results->data as $r){
        //         $member = new Member();
        //         $member->name = $r->name;
        //         $member->phone = $r->church_id;
        //         $member->save();
        // }
        return 'successful';
    }

 
}
