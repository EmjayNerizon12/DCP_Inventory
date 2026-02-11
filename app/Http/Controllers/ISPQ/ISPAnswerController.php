<?php

namespace App\Http\Controllers\ISPQ;

use App\Http\Controllers\Controller;

use App\Models\ISPQ\ISPAnswer;
use App\Models\ISPQ\ISPChoice;
use App\Models\ISPQ\ISPQuestion;
use App\Services\ISPQ\QuestionChoiceService;
use App\Services\ISPQ\PostAnswer;
use App\Services\ISPQ\PostAnswerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ISPAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuestionChoiceService $questionChoiceService)
    {
        $isp_question = $questionChoiceService->get();
        $answers = ISPAnswer::where('school_id', Auth::guard('school')->user()->pk_school_id)->with(['choice.question'])->get();

        return view('SchoolSide.ISPQ.index', compact('isp_question', 'answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostAnswerService $postAnswer, Request $request)
    {
        $school_id = Auth::guard('school')->user()->pk_school_id;
        $question_list  = ISPQuestion::all();

        $totalSuccess = 0;
        $totalQuestion = count($question_list);
        foreach ($question_list as $question) {
            $post = $postAnswer->post($request, $school_id, $question);
            if ($post) {
                $totalSuccess++;
            }
        }
        if ($totalSuccess == $totalQuestion) {
            return response()->json([
                'success' => true,
                'message' => 'Your answers have been submitted successfully.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'There was an error submitting your answers. Please try again.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ISPAnswer $iSPAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ISPAnswer $iSPAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        return redirect()->back()->with('success', 'This feature is under development.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $school_id)
    {
        ISPAnswer::where('school_id', $school_id)->delete();
        return redirect()->back()->with('success', 'Answers deleted successfully.');
    }
}
