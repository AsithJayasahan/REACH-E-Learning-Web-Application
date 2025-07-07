<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->validate([
            'course' => 'required|string',
            'completionDate' => 'required|string',
            'duration' => 'required|string',
            'certificateId' => 'required|string',
            'name' => 'required|string'  // Now name comes from the request directly
        ]);

        $pdf = PDF::loadView('certificate', $data);
        return $pdf->download('certificate.pdf');
    }
}
