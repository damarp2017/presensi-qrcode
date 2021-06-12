<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestController extends Controller
{
    public function test()
    {
        // dd(QrCode::size(200)->generate('Make me into a QrCode!'));
        $qrcode = base64_encode(QrCode::size(200)->generate('ROYGAY!'));
        $pdf = PDF::loadView('test-qrcode', [
            'qrcode' => $qrcode
        ]);
        return $pdf->download('test.pdf');
    }

    public function index()
    {
        $qrcode = base64_encode(QrCode::size(200)->generate('ROYGAY!'));

        return view('test-qrcode', [
            'qrcode' => $qrcode
        ]);
    }
}
