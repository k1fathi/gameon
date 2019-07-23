<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $question = Question::create($request->all());

        foreach ($request->answers as $answer)
        {
            $question->answers()->save(new Answer($answer));
        }

        return response()->success('common.success');
    }

    /*
     *
     *
     * */

    public function destroy($id)
    {
        Question::destroy($id);

        return response()->success('common.success');
    }
}
