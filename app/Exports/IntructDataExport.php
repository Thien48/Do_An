<?php

namespace App\Exports;

use App\Models\Instruct;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IntructDataExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Instruct::with(['student.user', 'topic.proposal.lecturer.user'])->get();
    }

    public function headings(): array
    {
        return [
            'STT',
            'Mssv',
            'Tên',
            'Lớp',
            'Số điện thoại',
            'Email',
            'Đề tài',
            'Giảng viên hướng dẫn'
        ];
    }

    public function map($instruct): array
    {
       
        static $rowNumber = 0;
        $rowNumber++;
        
        // $student = $instruct->student;
        // $studentUser = $student ? $student->user : null;
        // $topic = $instruct->topic;
        // $proposal = $topic ? $topic->proposal : null;
        // $lecturer = $proposal ? $proposal->lecturer : null;
        // $lecturerUser = $lecturer ? $lecturer->user : null;

        // return [
        //     $rowNumber,
        //     $student ? $student->mssv : '',
        //     $student ? $student->name : '',
        //     $student ? $student->class : '',
        //     $student ? $student->telephone : '',
        //     $studentUser ? $studentUser->email : '',
        //     $lecturerUser ? $lecturerUser->name : ''
        // ];
        return [
            $rowNumber,
            $instruct->student->mssv,
            $instruct->student->name,
            $instruct->student->class,
            $instruct->student->telephone,
            $instruct->student->user->email,
            strip_tags($instruct->topic->proposal->name_proposal),
            $instruct->topic->proposal->lecturer->name
        ];
    }
}
