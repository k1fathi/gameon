<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Photo;
use App\Models\Question;
use App\Models\User;
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

    public function index(Request $request)
    {
        return Question::all();

        return response()->success('common.success');
    }

    public function getQuestion(Request $request)
    {
        $is_answered = true;

        while($is_answered == true)
        {
            $question = Question::inRandomOrder()->first();
            $is_answered = $question->users()->where('user_id',1)->exists();
        }

        return [
            "question" => $question,
            "answer" => $question->answers()->get()
        ];

        return response()->success('common.success');
    }

    public function giveAnswer(Request $request)
    {
        $user = User::find($request->user_id);

        Question::find($request->question_id)->users()->save($user, ['is_correct' => $request->is_correct]);

        return response()->success('common.success');
    }

    public function destroy($id)
    {
        Question::destroy($id);

        return response()->success('common.success');
    }
}
