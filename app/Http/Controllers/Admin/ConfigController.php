<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
        $config = Config::first();
        return view('admin.config.index', [
          'config' => $config
        ]);
    }

    public function update(Request $request){
      $request->validate([
          'in_begin' => 'required',
          'in_over' => 'required',
          'out_begin' => 'required',
          'out_over' => 'required',
      ]);

      $config = Config::first();
      if ($config) {
        $config->in_begin = $request->in_begin;
        $config->in_over = $request->in_over;
        $config->out_begin = $request->out_begin;
        $config->out_over = $request->out_over;
        $config->update();
      }else {
        $config = new Config();
        $config->in_begin = $request->in_begin;
        $config->in_over = $request->in_over;
        $config->out_begin = $request->out_begin;
        $config->out_over = $request->out_over;
        $config->save();
      }

      return redirect()->route('admin.config.index')
          ->with(["success" => "Konfigurasi absensi berhasil di ubah"]);
    }
}
