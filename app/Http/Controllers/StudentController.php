<?php

namespace App\Http\Controllers;


use App\Models\Personaldatastudent;

use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Registration;
use App\Models\Excuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function tryy()
    {


       echo "aaaaaajgf[oikjb[og[jho[h[uj";
    }
    public function delete(Personaldatastudent $personaldatastudent)
    {
        $personaldatastudent->delete();


    }

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
            $name = "https://forms.office.com/r/n01PLpWM8c";
        else if ($study_type == "دبلومة الدراسات العليا")
            $name = "https://forms.office.com/r/Vgt3zxRqAp";
        else if ($study_type == "الماجستير في العلوم")
            $name = "https://forms.office.com/r/5Ntw5TX1FK";
        else if ($study_type == "تمهيدي الماجستير")
            $name = "https://forms.office.com/r/ZxrrNeak0p";

        // $name = "https://forms.gle/xQgRdk2Ra89d6foPA";

        Mail::to($user->email)->send(new StudentMail($user_id, $user_name, $name));
        echo "send to " . $user->arabicName . " " . "Done!";


        return response()->json([
            $student
        ], 201);
    }

    public function getStudent($id)
    {
        if (Personaldatastudent::where('idS', $id)->exists()) {
            $student = Personaldatastudent::where('idS', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }


    public function updateStudent(Request $request, $id)
    {
        if (Personaldatastudent::where('idS', $id)->exists()) {
            $student = Personaldatastudent::find($id);
            $student->image = is_null($request->image) ? $student->image : $request->image;
            $student->englishName = is_null($request->englishName) ? $student->englishName : $request->englishName;
            $student->arabicName = is_null($request->arabicName) ? $student->arabicName : $request->arabicName;
            $student->birthdateSource = is_null($request->birthdateSource) ? $student->birthdateSource : $request->birthdateSource;
            $student->birthdate = is_null($request->birthdate) ? $student->birthdate : $request->birthdate;
            $student->jobArabic = is_null($request->jobArabic) ? $student->jobArabic : $request->jobArabic;
            $student->jobEnglish = is_null($request->jobEnglish) ? $student->jobEnglish : $request->jobEnglish;
            $student->jobAdd = is_null($request->jobAdd) ? $student->jobAdd : $request->jobAdd;
            $student->Add = is_null($request->Add) ? $student->Add : $request->Add;
            $student->religion = is_null($request->religion) ? $student->religion : $request->religion;
            $student->nationality = is_null($request->nationality) ? $student->nationality : $request->nationality;
            $student->email = is_null($request->email) ? $student->email : $request->email;
            $student->mobile = is_null($request->mobile) ? $student->mobile : $request->mobile;
            $student->nationalityId = is_null($request->nationalityId) ? $student->nationalityId : $request->nationalityId;
            $student->gender = is_null($request->gender) ? $student->gender : $request->gender;
            $student->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 201);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
    public function getallstudent()
    {
       // return "x";
        return  Personaldatastudent::whereDate('created_at', '<=', Carbon::now()->subMonth())->whereNull('nationality')->get();;
    // return Personaldatastudent::all();
    }
   /* public function insert(Request $request)
    {
        $student = new  Personaldatastudent();
        $student->image =  $request->image;
        $student->englishName =  $request->englishName;
        $student->arabicName = $request->arabicName;
        $student->birthdateSource =  $request->birthdateSource;
        $student->birthdate =  $request->birthdate;
        $student->jobArabic =  $request->jobArabic;
        $student->jobEnglish =  $request->jobEnglish;
        $student->jobAdd = $request->jobAdd;
        $student->Add =  $request->Add;
        $student->religion = $request->religion;
        $student->nationality =  $request->nationality;
        $student->email =  $request->email;
        $student->mobile =  $request->mobile;
        $student->nationalityId =  $request->nationalityId;
        $student->gender =  $request->gender;
        $student->save();
    }*/
}
