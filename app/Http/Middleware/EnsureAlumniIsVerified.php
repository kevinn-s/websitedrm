<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Enums\AppError;
use App\Enums\Status;
class EnsureAlumniIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth('api')->user()){
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::UNAUTHORIZED_ACCESS->value,
                ]
            ], 401);
        } else if(!auth('api')->user()->status->isVerified){
             return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::USER_NOT_VERIFIED->value,
                ]
            ], 403);
        }
        return $next($request);
    }
}
