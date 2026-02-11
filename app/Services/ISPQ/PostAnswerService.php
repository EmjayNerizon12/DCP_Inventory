<?php

namespace App\Services\ISPQ;

use App\Models\ISPQ\ISPAnswer;
use App\Models\ISPQ\ISPChoice;
use App\Models\ISPQ\ISPQuestion;
use Exception;
use Illuminate\Http\Request;

class PostAnswerService
{
    public function post(Request $request, int $school_id, ISPQuestion $question)
    {
        try {

            if ($question->question_type == 'text') {
                ISPAnswer::create([
                    'school_id' => $school_id,
                    'question_id' => $question->id,
                    'choice_id' => null,
                    'other_value' => null,
                    'text_value' => $request->answer[$question->id],
                    'numeric_value' => null,
                ]);
            }
            if ($question->question_type == 'number') {
                ISPAnswer::create([
                    'school_id' => $school_id,
                    'question_id' => $question->id,
                    'choice_id' => null,
                    'other_value' => null,
                    'text_value' => null,
                    'numeric_value' => (int)$request->answer[$question->id],
                ]);
            }
            if ($question->question_type == 'multiple') {
                foreach ($request->answer[$question->id] as $choice_id) {
                    if (ISPChoice::find($choice_id)->choice_text !== 'Others') {
                        ISPAnswer::create([
                            'school_id' => $school_id,
                            'choice_id' => $choice_id,
                            'question_id' => $question->id,
                            'other_value' => null,
                            'text_value' => null,
                            'numeric_value' => null,
                        ]);
                    }
                    if (isset($request->other[$question->id][$choice_id])) {
                        ISPAnswer::create([
                            'school_id' => $school_id,
                            'choice_id' => $choice_id,
                            'question_id' => $question->id,
                            'other_value' => $request->other[$question->id][$choice_id],
                            'text_value' => null,
                            'numeric_value' => null,
                        ]);
                    }
                }
                if (isset($request->other_value[$question->id])) {
                    ISPAnswer::create([
                        'school_id' => $school_id,
                        'choice_id' => null,
                        'question_id' => $question->id,
                        'other_value' => $request->other_value[$question->id],
                        'text_value' => null,
                        'numeric_value' => null,
                    ]);
                }
            }
            if ($question->question_type == 'single') {
                ISPAnswer::create([
                    'school_id' => $school_id,
                    'choice_id' => $request->answer[$question->id],
                    'question_id' => $question->id,
                    'other_value' => null,
                    'text_value' => null,
                    'numeric_value' => null,
                ]);
            }
            if ($question->question_type == 'boolean') {
                ISPAnswer::create([
                    'question_id' => $question->id,
                    'school_id' => $school_id,
                    'choice_id' => $request->answer[$question->id],
                    'other_value' => null,
                    'text_value' => null,
                    'numeric_value' => null,
                ]);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
