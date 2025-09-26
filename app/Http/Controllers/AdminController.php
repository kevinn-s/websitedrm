<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use App\Models\OfficialAlumni;
use App\Models\Status;
class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin/dashboard');
    }

    public function alumni()
    {
        return view('admin/alumni');
    }

    public function alumniOfficial()
    {
        return view('admin/official-alumni');
    }

    // public function verifyAlumni(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required'
    //     ]);

    //     if (
    //         Alumni::find($request->id)->status === Status::VERIFIED ||
    //         Alumni::find($request->id)->status === Status::REJECTED
    //     ){

    //     }

    // }
    public function importAlumni(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx|max:5120'
        ]);

        $file = $request->file('file');

        $worksheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath())->getActiveSheet();

        $headers = [];

        if (
            !(function () use ($worksheet, &$headers) {
                $dhs = array_map('strtolower', [
                    'graduation batch',
                    'binusian id',
                    'student id 1',
                    'student name',
                    'legitimation date'
                ]);
                return (function () use ($dhs, $worksheet, &$headers) {
                    $headers = array_intersect(
                        array_map(
                            'strtolower',
                            array_map('trim', $worksheet->rangeToArray('A2:' . $worksheet->getHighestColumn() . '2')[0])
                        ),
                        $dhs
                    );
                    return count($headers);
                })() === count($dhs);
            })()
        ) {
            $headers = [];
            return response()->json([
                'message' => "header tabel tidak sesuai dengan yang diperlukan"
            ], 404);
        }
    
        try {
            DB::transaction(function () use ($worksheet, $headers) {
                foreach ($worksheet->getRowIterator(3) as $row) {
                    $rowIndex = $row->getRowIndex();

                    $officialAlumni = [];

                    foreach ($headers as $columnIndex => $excelHeader) {
                        $modelAttribute = str_replace(' ', '_', $excelHeader);
            
                        $officialAlumni[$modelAttribute] = $worksheet->getCell(Coordinate::stringFromColumnIndex($columnIndex + 1) . $rowIndex)->getValue();
                    }

                    OfficialAlumni::updateOrCreate(
                        [
                            'graduation_batch' => $officialAlumni['graduation_batch'],
                            'binusian_id' => $officialAlumni['binusian_id'],
                            'student_id_1' => $officialAlumni['student_id_1'],
                            'student_name' => $officialAlumni['student_name'],
                            'legitimation_date' => $officialAlumni['legitimation_date'],
                        ],
                        $officialAlumni);
                }
            });

        } catch (\Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred during import. Please check your file = ' . $e->getMessage()
            ], 403);
        }


        return response()->json([
            'message' => 'Alumni data imported successfully.'
        ], 200);
    }

}