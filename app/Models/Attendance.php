<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(){
      return $this->belongsTo(Student::class);
    }

    public function status(){
      $status = $this->absent;
      if (!$status) {
        $status = "Masuk";
      }elseif($status == 'A'){
        $status = "Alfa";
      }elseif($status == 'I'){
        $status = "Izin";
      }elseif ($status == 'S') {
        $status = "Sakit";
      }
      return $status;
    }

    public function timeAttendanceIn(){
      $time = $this->in ? Carbon::parse($this->in)->format('H:i') : "-";
      return $time;
    }

    public function timeAttendanceOut(){
      $time = $this->out ? Carbon::parse($this->out)->format('H:i') : "-";
      return $time;
    }

    public function delayIn(){
      $time = $this->delay_in ? Carbon::parse($this->delay_in)->format('H:i') : "-";
      return $time;
    }

    public function delayOut(){
      $time = $this->delay_out ? Carbon::parse($this->delay_out)->format('H:i') : "-";
      return $time;
    }
}
