<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Alumni;

use App\Enums\AppError;

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

    public function a(Request $request){
        return response()->json(['status' => 'success']);
    }

    public function index(Request $request)
    {
        $builder = Alumni::query();
        try {
            $request->validate([
                'search' => 'nullable|string',
                'filters' => 'nullable|array',
                'filters.*' => 'string'
            ]);

            return response()->json([
                "success" => true,
                "data" => (function () use ($request, $builder) {
                    /** @var \Illuminate\Database\Eloquent\Builder $builder */
                    $builder->whereLike('name', trim($request->input('name')))
                        ->orWhereLike('bib', $request->input('bib'));
                })()
            ], 200);

        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Database\QueryException) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => 'INTERNAL_SERVER_ERROR'
                    ]
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'error' => [
                'type' => 'INTERNAL_SERVER_ERROR'
            ]
        ], 500);
    }
}
