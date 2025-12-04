<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

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

    public function show(Request $request)
    {
        try {
            //code...

        $request->validate([
            'search' => 'string',
            'filters' => 'array'
        ]);

        return response()->json([
            "success" => true,
            "data" => Alumni::where('nama', 'nim', $request->input('search'))
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
