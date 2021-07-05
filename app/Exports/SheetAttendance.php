<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\AttendanceExport;
use App\Exports\StudentAttendanceExport;
use Carbon\Carbon;

class SheetAttendance implements WithMultipleSheets
{
    use Exportable;

    private $startDate;
    private $endDate;
    private $grade;

      public function __construct($startDate, $endDate, $grade)
      {
        $this->startDate = Carbon::parse($startDate)->format('Y-m-d');
        $this->endDate = Carbon::parse($endDate)->format('Y-m-d');
        $this->grade = $grade;
     }

     public function sheets(): array
     {
        $sheets = [];
      
        $sheets = [
          'Data Absen 1' => (new AttendanceExport)->parameters($this->startDate, $this->endDate, $this->grade),
          'Data Absen 2' => (new StudentAttendanceExport)->parameters($this->startDate, $this->endDate, $this->grade),
        ];

        return $sheets;
    }
}
