<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWhiteboardOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $whiteboard = $request->route('whiteboard');

        if ($whiteboard->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to access this whiteboard.');
        }

        return $next($request);
    }
}
