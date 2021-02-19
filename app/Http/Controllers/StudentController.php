<?php

namespace App\Http\Controllers;

use App\Models\Personaldatastudent;

use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /*public function try($id)
    {


       $student=
    }*/

    public function addStudentData(Request $request)
    {

        $student = new Personaldatastudent();
        $student->arabicName = $request->arabicName;
        $student->email = $request->email;
        $study_type = $request->study_type;
        $student->save();
        $user = DB::table('personaldatastudents')->orderBy('idS', 'desc')->first();
        $user_id = $user->idS;
        $user_name = $user->arabicName;

        $name = " ";
        if ($study_type == "دكتوراه الفلسفة في العلوم")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUMURFUTNSTk5UVlJPOEg5MDNIMEhVU0o1Wi4u";
        else if ($study_type == "دبلومة الدراسات العليا")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUMDhCQ0ZOWk5CNjNEMEFQNDg2WEo0WjZEQi4u";
        else if ($study_type == "الماجستير في العلوم")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUNDNQT0tHNUVFNlJLVDJHMVU4NFo5SjFERi4u";
        else if ($study_type == "تمهيدي الماجستير")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUMDhCQ0ZOWk5CNjNEMEFQNDg2WEo0WjZEQi4u";

        // $name = "https://forms.gle/xQgRdk2Ra89d6foPA";

        Mail::to($user->email)->send(new StudentMail($user_id, $user_name, $name));
        echo "send to " . $user->englishName . " " . "Done!";


        return response()->json([
            $student
        ], 201);
    }
}
