<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\ISPQ\ISPAnswer;
use App\Models\ISPQ\ISPQuestion;
use App\Services\ISPQ\QuestionChoiceService;
use Illuminate\Http\Request;

class ISPReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ispQuestions()
    {
        $questions = ISPQuestion::with('choices')->get();
        return response()->json([
            'success' => true,
            'data' => $questions
        ]);
    }
    public function index(int $schoolId)
    {
        $isp_question = ISPQuestion::with('choices', 'choices.answers', 'answers')->get();
        $answers = ISPAnswer::where('school_id', $schoolId)->with(['choice.question'])->get();
        $isAnswered = $answers->count() > 0;

        $data = [
            'questions' => $isp_question,
            'isAnswered' => $isAnswered
        ];
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
    public function destroy(string $schoolId)
    {
        ISPAnswer::where('school_id', $schoolId)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Answers cleared successfully'
        ]);
    }
}
