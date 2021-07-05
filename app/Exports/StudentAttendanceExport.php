<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class StudentAttendanceExport implements FromQuery,WithHeadings,WithMapping,ShouldAutoSize
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
        $students = [];
        $grade = $this->grade;
        $startDate = $this->startDate;
        $endDate = $this->endDate;

        if ($startDate && $endDate && $grade) {
          $students = Student::query()->with(['attendances' => function($query) use($startDate, $endDate){
            $query->whereDate('created_at', '>=' ,$startDate)
                  ->whereDate('created_at', '<=' ,$endDate);
          }])->where('grade_id', $grade);

        }elseif ($startDate && $endDate) {
          $students = Student::query()->with(['attendances' => function($query) use($startDate, $endDate){
            $query->whereDate('created_at', '>=' ,$startDate)
                  ->whereDate('created_at', '<=' ,$endDate);
          }]);
        }

        return $students;
    }

    public function map($student): array
    {
        return [
            $this->i++,
            $student->nisn,
            $student->name,
            $student->grade->name,
            count($student->attendances->where('absent', null)) != 0 ? count($student->attendances->where('absent', null)) : '0',
            count($student->attendances->where('absent', 'A')) != 0 ? count($student->attendances->where('absent', 'A')) : '0',
            count($student->attendances->where('absent', 'S')) != 0 ? count($student->attendances->where('absent', 'S')) : '0',
            count($student->attendances->where('absent', 'I')) != 0 ? count($student->attendances->where('absent', 'I')) : '0',
            $this->startDate == $this->endDate ? Carbon::parse($this->startDate)->format('d/m/Y') :
            Carbon::parse($this->startDate)->format('d/m/Y').' - '.Carbon::parse($this->endDate)->format('d/m/Y')
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama',
            'Kelas',
            'Masuk',
            'Alfa',
            'Sakit',
            'Izin',
            'Tanggal'
        ];
    }
}
