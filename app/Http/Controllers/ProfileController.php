<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Alumni;
use App\Models\publication;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    //
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'name' => $user->name,
            'nim' => $user->nim,
            'email' => $user->email,
            'status' => $user->status,
            'bib' => $user->bib,
            'phone' => $user->phone,
            'instagram' => $user->instagram,
            'linkedin' => $user->linkedin,
            'x' => $user->x,
            'facebook' => $user->facebook,
            'profession' => $user->profession?->profession,
            'company' => $user->profession?->company,
            'city' => $user->profession?->city,
            'province' => $user->profession?->province,
            'image' => Storage::url($user->image)
        ], 200);
    }
    public function show_publication(Request $request){
        $user = $request->user();
        $publications = [];
        foreach ($user->publications as $key => $publication) {
            array_push($publications, $publication);
        }
        return response()->json($publications);
    }
    public function update_publication(Request $request){
        $user = $request->user();
        try {
            $request->validate(   [
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
                ]);
            DB::transaction(function () use ($request, $user) {
                if (is_array($request->input('publications'))) {
                    if (!empty($request->input('publications'))) {
                        foreach ($request->input('publications') as $publication) {
                            Publication::updateOrCreate(array_merge([
                                'alumni_id' => $user->id
                            ], (function () use (&$publication) {
                                if (!empty($publication['id'])) {
                                    return ['id' => $publication['id']]; }return [];
                            })()), [
                                'title' => $publication['title'],
                                'type' => $publication['type'],
                                'year' => (int) $publication['year'],
                                'url' => $publication['url'] ?? null,
                            ]);
                        }
                    }
                }
            });
            return response()->json([
                'success' => true,
                'message' => 'Publication updated successfully.',
                'user' => $request->user()->publications,
            ]);
        } catch (\Throwable $th) {
             return response()->json([
            'success' => false,
            'message' => 'Profile update failed.',
            'user' => $request->user()->publications,
        ], 402);
        }
    }
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
                'image' => 'required|string'
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
                'x' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9_]+$/',
                'facebook' => 'nullable|string|max:100',
            ]
        ));

        try {
            DB::transaction(function () use ($request) {
                $user = $request->user();
                $user->update(
                    [
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'instagram' => $request->input('instagram'),
                        'linkedin' => $request->input('linkedin'),
                        'x' => $request->input('x'),
                        'facebook' => $request->input('facebook'),
                        'image' => (function() use ($request, &$user) {
                            if($request->input('image')){
                                if (preg_match('/^data:image\/(\w+);base64,/', $request->input('image'), $type)) {
                                    $data = substr($request->input('image'), offset: strpos($request->input('image'), ',') + 1);
                                    $type = strtolower($type[1]);
                                } else {
                                    $data = $request->input('image');
                                    $type = 'png';
                                }
                                if(strlen($data) / 1024 > 5128){
                                    throw new Exception('File too large');
                                }
                                Storage::disk('public')->put('profile_image/' . $user->slug . '.' . $type, base64_decode($data));
                                return $user->slug . '.' . $type;
                            } return null;
                        })()
                    ]
                );
            });
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'user' => $request->user(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Profile update failed.',
                'user' => $request->user(),
            ], 402);
        }
    }

}

