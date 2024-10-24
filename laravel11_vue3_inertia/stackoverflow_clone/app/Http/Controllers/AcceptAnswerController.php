<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AcceptAnswerController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Answer $answer)
    {
        $this->authorize('accept', $answer);

        $answer->question->acceptBestAnswer($answer);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => "You have accepted this answer as best answer"
            ]);
        }

        return back();
    }
}

