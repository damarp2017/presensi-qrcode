<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->except(['attendance']);
    }

    public function index(){
        $config = Config::first();
        return view('admin.config.index', [
          'config' => $config
        ]);
    }
}
