<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

use App\Models\Alumni;
use App\Models\publication;
class ProfileController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    //
    public function show(Request $request)
    {
        return response()->json($request->user(), 200);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $request->validate(array_merge(
            [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($request->user()->id),
                ],
                'phone' => 'nullable|string|max:20',
            ],
            [
                'company' => 'nullable|string|max:255',
                'profession' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'province' => 'nullable|string|max:100'
            ],
            [
                'instagram' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9._]+$/',
                'linkedin' => 'nullable|string|max:100|regex:/^[a-zA-Z0-9\-._]+$/',
                'twitter' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9_]+$/',
                'facebook' => 'nullable|string|max:100',
            ],
            [
                'publications' => 'nullable|array',
                'publications.*.title' => 'required_with:publications|string|max:255',
                'publications.*.type' => 'required_with:publications|string|max:100',
                'publications.*.year' => [
                    'required_with:publications',
                    'digits:4',
                    'integer',
                    'min:1900',
                    'max:' . date('Y'),
                ],
                'publications.*.url' => 'nullable|url|max:500',
            ]
        ));
        $request->user()->update(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'instagram' => $request->input('instagram'),
                'linkedin' => $request->input('linkedin'),
                'twitter' => $request->input('twitter'),
                'facebook' => $request->input('facebook'),
            ]
        );
        if (is_array($request->input('publications'))) {
            if (!empty($request->input('publications'))) {
                foreach($request->input('publications') as $publication){
                    Publication::updateOrCreate(array_merge([
                        'alumni_id' => $request->user()->id
                    ], (function () use (&$publication) {
                        if (!empty($publication['id'])) {
                            return ['id' => $publication['id']]; } return [];
                    })()), [
                        'title' => $publication['title'],
                        'type' => $publication['type'],
                        'year' => (int) $publication['year'],
                        'url' => $publication['url'] ?? null,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'user' => $request->user(),
        ]);
    }
}
