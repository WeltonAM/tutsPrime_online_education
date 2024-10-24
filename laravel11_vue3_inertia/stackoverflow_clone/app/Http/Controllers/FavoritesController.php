<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favorites()->attach(Auth::id());

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }

        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(Auth::id());

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }

        return back();
    }
}
