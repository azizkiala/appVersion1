<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Cour;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_questions()
    {
        try {
            $questions = Question::limit(10)->get();
            return response()->json($questions, 200);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_questions(Request $request)
    {
        try {
            $file = $request->validate([
                'content' => 'required', 'string',
                'type' => 'required', 'string',
            ]);
            $question = new Question();
            $question->content = $file['content'];
            $question->type = $file['type'];
            return $question->save();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show_questions(int $id)
    {
        $getQuestion = Question::where('id', $id)->get();
        return response()->json($getQuestion, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_questions(int $id)
    {
        return DB::table('questions')->where('id', $id)->delete();
    }
}
