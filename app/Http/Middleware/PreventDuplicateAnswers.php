<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateAnswers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $selectedAnswers = $request->session()->get('selectedAnswers', []);

        foreach ($selectedAnswers as $questionId => $selectedAnswer) {
            // Check if the question has already been answered in this session
            if (in_array($questionId, $selectedAnswers)) {
                // Do not increment attempts and completions
                return redirect()->back()->with('message', 'Ovo pitanje je već odgovoreno.');
            }
        }

        return $next($request);
    }
}
