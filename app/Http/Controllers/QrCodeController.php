<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Response;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function download(Student $student)
    {

        // Generate QR code content
        $qrCodeContent = $student->lastname . ' ' . $student->firstname . ', ' . $student->middlename . ', ' . $student->student_id;

        // Generate QR code image
        $qrCode = QrCode::format('png')->size(200)->generate($qrCodeContent);

        // Return the image as a downloadable response
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="qr_code.png"',
        ];

        return new Response($qrCode, 200, $headers);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
