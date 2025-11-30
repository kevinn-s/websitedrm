<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

use App\Models\Alumni;
use App\Models\KaryaIlmiah;
class ProfileController extends Controller
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
                'nama' => 'required|string|max:255',
                // 'email' => [
                //     'required',
                //     'email',
                //     'max:255',
                //     Rule::unique('users')->ignore($request->user()->id),
                // ],
                'telepon' => 'nullable|string|max:20',
                'nama_perusahaan' => 'nullable|string|max:255',
                'posisi' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:100',
                'provinsi' => 'nullable|string|max:100'
            ],
            [
                'instagram' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9._]+$/',
                'linkedin' => 'nullable|string|max:100|regex:/^[a-zA-Z0-9\-._]+$/',
                'twitter' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9_]+$/',
                'facebook' => 'nullable|string|max:100',
            ],
            [
                'karya_ilmiah' => 'nullable|array',
                'karya_ilmiah.*.judul' => 'required_with:karya_ilmiah|string|max:255',
                'karya_ilmiah.*.jenis' => 'required_with:karya_ilmiah|string|max:100',
                'karya_ilmiah.*.tahun' => 'required_with:karya_ilmiah|digits:4|integer|min:1900|max:' . date('Y'),
                'karya_ilmiah.*.tautan' => 'nullable|url|max:500',
            ]
        ));
        $request->user()->update(
            [
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'telepon' => $request->input('telepon'),
                'nama_perusahaan' => $request->input('nama_perusahaan'),
                'posisi' => $request->input('posisi'),
                'kota' => $request->input('kota'),
                'provinsi' => $request->input('provinsi'),
                'instagram' => $request->input('instagram'),
                'linkedin' => $request->input('linkedin'),
                'twitter' => $request->input('twitter'),
                'facebook' => $request->input('facebook'),
            ]
        );
        if (is_array($request->input('karya_ilmiah'))) {
            array_map(function ($karyaIlmiah) use (&$request) {
                KaryaIlmiah::updateOrCreate(array_merge([
                    'alumni_id' => $request->user()->id
                ], (function () use (&$karyaIlmiah) {
                    if (!empty($karyaIlmiah['id'])) {
                        return ['id' => $karyaIlmiah['id']]; }return [];
                })()), [
                    'alumni_id' => $request->user()->id,
                    'judul' => $karyaIlmiah['judul'],
                    'jenis' => $karyaIlmiah['jenis'],
                    'tahun_publikasi' => (int) $karyaIlmiah['tahun'],
                    'tautan' => $karyaIlmiah['tautan'] ?? null,
                ]);
            }, $request->input('karya_ilmiah', []));
        } else {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => 'VALIDATION_ERROR',
                    'message' => 'Please check your input.',
                ]
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'user' => $request->user(),
        ]);
    }
}
