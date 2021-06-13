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

    public function idcard()
    {
        // $pdf = PDF::loadView('idcard');
        // return $pdf->download('test.pdf');

        return view('idcard');
    }

    public function idcard2()
    {
        $qrcode = base64_encode(QrCode::size(200)->eyeColor(0, 255, 69, 0, 30, 144, 255)->generate('Lorem Ipsum Dolor!'));
        $pdf = PDF::loadView('idcard-2', [
            'qrcode' => $qrcode
        ]);
        return $pdf->download('test.pdf');
        // return view('idcard-2');
    }

    public function idcard3()
    {
        $qrcode = base64_encode(QrCode::size(240)->eyeColor(0, 255, 69, 0, 30, 144, 255)->generate('Lorem Ipsum Dolor!'));
        $pdf = PDF::loadView('idcard-3', [
            'qrcode' => $qrcode
        ]);
        return $pdf->download('test.pdf');
        // return view('idcard-3');
    }

    public function index()
    {
        $qrcode = base64_encode(QrCode::size(200)->generate('ROYGAY!'));

        return view('test-qrcode', [
            'qrcode' => $qrcode
        ]);
    }
}
