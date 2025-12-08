<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Alumni;

class AlumniController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show(Request $request, Builder $builder = Alumni::query())
    {
        try {
        $request->validate([
            'search' => 'nullable|string',
            'filters' => 'nullable|array',
            'filters.*' => 'string'
        ]);

        return response()->json([
            "success" => true,
            "data" => (function() use ($request, $builder) {
                /** @var \Illuminate\Database\Eloquent\Builder $builder */
                $builder->whereLike('name', trim($request->input('nama')))
                        ->orWhereLike('');

            })()
        ], 200);

        } catch (\Throwable $th) {
            if ($th instanceof \Illuminate\Database\QueryException) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => 'DATABASE_ERROR',
                        'message' => $th
                    ]
                ], 500);
            } else if ($th) {

            } else {

            }
        }
    }
}
