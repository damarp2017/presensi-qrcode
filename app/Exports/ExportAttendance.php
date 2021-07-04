<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ExportAttendance implements FromQuery,WithHeadings,WithMapping,ShouldAutoSize
{

    use Exportable;

    private $i = 1;

    public function parameters($startDate, $endDate, $grade){
      $this->startDate = Carbon::parse($startDate)->format('Y-m-d');
      $this->endDate = Carbon::parse($endDate)->format('Y-m-d');
      $this->grade = $grade;

      return $this;
    }

    public function query()
    {
        $attendances = [];
        $grade = $this->grade;

        if ($this->startDate && $this->endDate && $this->grade) {
          $attendances = Attendance::query()->whereDate('created_at', '>=' ,$this->startDate)
                              ->whereDate('created_at', '<=' ,$this->endDate)
                              ->whereHas('student', function($query) use($grade){
                                $query->where('grade_id', $grade);
                              });

        }elseif ($this->startDate && $this->endDate) {
          $attendances = Attendance::query()->whereDate('created_at', '>=' ,$this->startDate)
                               ->whereDate('created_at', '<=' ,$this->endDate);
        }

        return $attendances;
    }

    public function map($attendance): array
    {
        return [
            $this->i++,
            $attendance->student->nisn,
            $attendance->student->name,
            $attendance->student->grade->name,
            $attendance->status(),
            $attendance->created_at->format('d-m-Y'),
            $attendance->timeAttendanceIn(),
            $attendance->timeAttendanceOut(),
            $attendance->delayIn(),
            $attendance->delayOut(),
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama',
            'Kelas',
            'Status',
            'Tanggal',
            'Absen Berangkat',
            'Absen Pulang',
            'Terlambat Berangkat',
            'Terlambat Pulang'
        ];
    }
}
