<?php

namespace ProjectManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function PHPSTORM_META\type;
use ProjectManagement\Http\Controllers\Controller;
use ProjectManagement\Http\Controllers\General\GeneralController;
use ProjectManagement\Models\Admin;
use ProjectManagement\Models\Allocation;
use ProjectManagement\Models\ContactUs;
use ProjectManagement\Models\Gallery;
use ProjectManagement\Models\LecturerLog;
use ProjectManagement\Models\NSPL;
use ProjectManagement\Models\Projects;
use ProjectManagement\Models\Slide;
use ProjectManagement\Models\StudentLog;
use ProjectManagement\Models\User;

class AdminAuth extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:admin");
    }
    public function dashboard()
    {
        return view('admin.pages.panel')
            ->with('heading','Dashboard')
            ->with('title','Admin | Dashboard');
    }
    public function getSlide()
    {
        if(auth('admin')->user()->privilege==1){
            return view('admin.forms.slide')
                ->with('heading','Upload Slide Images')
                ->with('title','Upload | Slide');
        }else{
            return back();
        }

    }
    public function createSlide(Request $request){
        $this->validate($request,[
            'picture'=>'required|present|mimes:gpg,jpeg,png',
            'caption'=>'nullable'
        ]);
        $picture=GeneralController::UploadFile($request->file('picture'),[],"slideImages");
        if(Slide::create([
            'picture'=>$picture,
            'caption'=>$request->input('caption'),
        ])){
            LecturerLog::create([
                'user_id'=>auth('admin')->user()->id,
                'action'=>"Added a Slide Image",
                'type'=>1
            ]);
            return back()->with('success',GeneralController::alertMaker('Successful','Slide Image Have Been Uploaded'));
        }

    }
    public function slideRecord(Slide $slide){
        if(auth('admin')->user()->privilege==1){
            $slideObj=$slide->getSlides();
            return view('admin.pages.slideRecord',[
                'heading'=>'Slide Images Record',
                'title'=>'Slide | Records',
                'slides'=>$slideObj,
            ]);
        }else{
            return back();
        }

    }
    public function deleteSlide($id){
        $slideObj=Slide::find($id);
        $slideObj->delete();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Deleted a Slide Image",
            'type'=>1
        ]);
        return back()->with('success',GeneralController::alertMaker('Successful','Slide Image Have Been Deleted'));

    }
    public  function allocate(Allocation $allocation,Projects $projects){
        if(auth('admin')->user()->privilege==1){
            $projectObj=$projects->getAllProjects()->where('student_id','!=',null)->where('status',2)->paginate('10');
            $adminObj=new Admin();
            $allocationObj=$adminObj->allLecturer();
            return view('Admin.forms.allocation')
                ->with('allocations',$allocation->getAllocations())
                ->with('heading','Allocate Students to Supervisors')
                ->with('projects',$projectObj)
                ->with('allocation',$allocationObj->get())
                ->with('title','allocate');
        }else{
            return back();
        }

    }
    public function createAllocation(Allocation $allocation,Request $request,NSPL $NSPL,Admin $admin,User $user){
        $this->validate($request,[
            'number_of_students'=>'required|present|min:1'
        ]);
        $admins=$admin->getAll();
        $users=$user->student()->get();
        if(!is_null($admins) && $users->count()>0){
            $numberOfStudentsObj=$NSPL->getNumberOfStudents()->first();
            if(is_null($request->input('number_of_students'))){
                $numberOfStudents = $numberOfStudentsObj->number;
            }else{
                $numberOfStudents=$request->input('number_of_students');
            }
            if(is_null($numberOfStudentsObj)){
                NSPL::create([
                    'number'=>$request->input('number_of_students')
                ]);
            }else{
                $numberOfStudentsObj->update([
                    'number'=>$numberOfStudents,
                ]);
            }
            $allocation->StudentToLecturer();
//            ->delay(Carbon::now()->addSeconds(90));;
            LecturerLog::create([
                'user_id'=>auth('admin')->user()->id,
                'action'=>"Allocated Students to their Supervisors",
                'type'=>1
            ]);
            return redirect()->route('allocated')->with('success',GeneralController::alertMaker('Successful','Student have been allocated their supervisors'));
        }else{
            return back()->with('failure',GeneralController::alertMaker('Error!','Students and supervisors need to be populated to the database'));

        }

    }

    public function getAllocatedStudents(Allocation $allocation){
        if(auth('admin')->user()->privilege==1){
            $adminObj=new Admin();
            $allocationObj=$adminObj->allLecturer();
            return view('Admin.pages.allocatedStudents')
                ->with('allocations',$allocation->getAllocations())
                ->with('heading','Allocated Students')
                ->with('allocation',$allocationObj->get())
                ->with('title','allocate');
        }else{
            return back();
        }

    }

    public function deleteLecturer($delete)
    {
        $userObj = Admin::where('id', $delete)->first();
        $userObj->delete();
        $allocation = Allocation::where('lecturer_id', $delete)->first();
        if($allocation !=null) {
            $allocation->delete();
        }
        $logObj=LecturerLog::where('user_id',$delete)->get();
        foreach ($logObj as $log){
            $log->delete();
        }
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Deleted a Lecture",
            'type'=>1
        ]);
        return back()->with('success',GeneralController::alertMaker('successful','lecturer have been deleted '));
    }
    public function deleteStudent($delete){
        $userObj=User::where('id',$delete)->first();
        $userObj->delete();
        $allocation=Allocation::where('student_id',$delete)->first();
        $allocation->delete();
        $logObj=StudentLog::where('user_id',$delete)->get();
        foreach ($logObj as $log){
            $log->delete();
        }
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Deleted a Student",
            'type'=>1
        ]);

        return back()->with('success',GeneralController::alertMaker('successful','student have been deleted'));
    }


    public function getProfile(Admin $admin){
        $admin=$admin->getSuperAdmin();
        return view('Admin.forms.profile')
            ->with('title','Profile Update')
            ->with('heading','Profile Update ')
            ->with('admin',$admin->first());
    }
    public function adminProfileUpdate(Request $request){
        $this->validate($request,[
            'phone'=>['nullable','present','numeric',
                function($attribute, $value, $fail)
                {
                    if (strlen($value) < 11) {
                        $fail("The number can not be less than 11 digits");
                    } elseif (strlen($value) > 11) {
                        $fail("The number can not be greater than 11 digits");
                    }
                }
            ],
//            'oldPassword' => ['required','present',function($attribute,$value,$fail){
//                if(!password_verify($value,auth()->guard('admin')->user()->password)){
//                    $fail("The $attribute Does Not Match");
//                }
//            }],
            'password' => 'nullable|present|max:50|min:6|confirmed',
            'password_confirmation'=> 'nullable|present|same:password',
            'email' => 'nullable|present|max:70|email',
            'picture'=>'nullable|present|mimes:jpeg,jp,png',
            'officeNo'=>'nullable|present',
        ]);
        if(is_null($request->input('password'))){
            $password = auth()->guard('admin')->user()->password;
        }else{
            $password=bcrypt($request->input('password'));
        }

        if(is_null($request->input('officeNo'))){
            $officeNo = auth()->guard('admin')->user()->officeNo;
        }else{
            $officeNo=$request->input('officeNo');
        }

        if($request->input('phone')==null){
            $phoneNumber = auth()->guard('admin')->user()->phone;
        }else {
            $phoneNumber = $request->input('phone');
        }
        if($request->file('picture')==null){
            $profilePic = auth()->guard('admin')->user()->picture;
        }else{
            $profilePic = GeneralController::UploadFile($request->file('picture'),['jpg','jpeg','png','gif'],'profileImages');
        }

        auth()->guard('admin')->user()->update([
            'email'=>$request->input('email'),
            'password'=>$password,
            'phone'=>$phoneNumber,
            'office'=>$officeNo,
            'picture'=>$profilePic
        ]);
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Updated their Profile",
            'type'=>1
        ]);
        return redirect()->back()->with('success',GeneralController::alertMaker('Successful','Profile Have Been Updated'));
    }

    public function studentsLog(StudentLog $studentLog){
        if(auth('admin')->user()->privilege==1){
            return view('Admin.pages.sLog')
                ->with('title','Students | Activities | Log')
                ->with('heading','Students Activities Log')
                ->with('users',$studentLog->getStudentsLog());
        }else{
            return back();
        }

    }
    public function lecturersLog(LecturerLog $lecturerLog){
        if(auth('admin')->user()->privilege==1){
            return view('Admin.pages.aLog')
                ->with('title','Lecturers | Activities | Log')
                ->with('heading','Lecturers Activities Log')
                ->with('users',$lecturerLog->getLecturersLog());
        }else{
            return back();
        }

    }

    public function verifyStudent($id){
        $userObj=User::find($id);
        $userObj->verify=1;
        $userObj->update();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Verified a Student with regNo: ".$userObj->regNo,
            'type'=>1
        ]);
        return redirect()->back()->with('success',GeneralController::alertMaker('Successful','Student Have Been Verified'));

    }
    public function verifyLecturer($id){
        $userObj=Admin::find($id);
        $userObj->verify=1;
        $userObj->update();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Verified a Lecturer with StaffId: ".$userObj->StaffId,
            'type'=>1
        ]);
        return redirect()->back()->with('success',GeneralController::alertMaker('Successful','Lecturer Have Been Verified'));
    }

    public function myStudents(){
        $user=auth('admin')->user()->id;
        $getAllocation=Allocation::where('lecturer_id',$user)->get();
        return view('admin.pages.myst')
            ->with('allocations',$getAllocation)
            ->with('heading','My Students')
            ->with('title','My Students');
    }


    public function showLecturer(Admin $admin){
        return view('Admin.pages.lecturers')
            ->with('lecturers',$admin->allLecturers())
            ->with('heading','Lecturers Record')

            ->with('title','lecturers');
    }
    public function showStudent(User $user){
        return view('Admin.pages.students')
            ->with('users',$user->allStudents())
            ->with('heading','Students Record')
            ->with('title','students');
    }

    public function project()
    {
        return view('admin.forms.projects')
            ->with('heading','Add Project Topics')
            ->with('title','Add New Project Topics');
    }
    public function createProject(Request $request)
    {
        $this->validate($request,[
            'project_title'=>'required|present',
            'project_description'=>'nullable',
            'project_file'=>'nullable|required_if:project_category,1|mimes:pdf,doc,docx',
            'project_type'=>'required|present',
        ]);
        if(is_null($request->file('project_file'))){
            $file=null;
        }else {
            $file = GeneralController::UploadFile($request->file('project_file'), [], "projectFiles");
        }
        if(Projects::create([
            'lecturer_id'=>auth('admin')->user()->id,
            'project_file'=>$file,
            'type'=>$request->input('project_type'),
            'title'=>$request->input('project_title'),
            'description'=>$request->input('project_description'),
        ])){
            LecturerLog::create([
                'user_id'=>auth('admin')->user()->id,
                'action'=>"Added a Project Topic",
                'type'=>2
            ]);
            return back()
                ->with('success',GeneralController::alertMaker('Successful','New Project Topic Have Been Added'));
        }

    }
    public function allProjects(Projects $projects){
        return view('admin.pages.allProjects')
            ->with('heading','All Uploaded Projects')
            ->with('projects',$projects->getAllProjects()->get())
            ->with('title','All Projects');
    }
    public function myProjects(Projects $projects){
        return view('admin.pages.myProjects')
            ->with('projects',$projects->myProject()->get())
            ->with('heading','My Uploaded Projects Topics')
            ->with('title','My Projects | Topics');
    }
    public function deleteProject($id){
        $projectObj=Projects::find($id);
        if(is_null($projectObj->student_id)){
            $projectObj->delete();
        }else{
            if(!is_null($projectObj->student_id) && $projectObj->status==2){
                $allocationObj=Allocation::where('student_id',$id)->first();
                $allocationObj->delete();
            }
        }
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Delete a Project Topic",
            'type'=>2
        ]);
        return back()->with('success',GeneralController::alertMaker('Successful','Project Topic Have Been Deleted'));

    }
    public function updateProject($id,Request $request){
        $this->validate($request,[
            'project_title'=>'required|present',
            'description'=>'nullable',
            'project_file'=>'nullable|required_if:project_category,1|mimes:pdf,doc,docx',
            'project_type'=>'required|present',
        ]);
        $projectObj=Projects::find($id);
        if(is_null($request->file('project_file'))){
            $file=null;
        }else {
            $file = GeneralController::UploadFile($request->file('project_file'), [], "projectFiles");
        }
        $projectObj->title=$request->input('project_title');
        $projectObj->type=$request->input('project_type');
        $projectObj->description=$request->input('description');
        $projectObj->project_file=$file;
        $projectObj->update();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Updated a Project Topic",
            'type'=>2
        ]);
        return back()->with('success',GeneralController::alertMaker('Successful','Project Topic Have Been Updated'));
    }
    public function acceptRequest($id){
        $projectObj=Projects::find($id);
        $projectObj->status=2;
        $projectObj->update();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Accepted a student Request for Supervision",
            'type'=>2
        ]);
        return back()
            ->with('success',GeneralController::alertMaker('Successful','Accepted Student Request'));
    }
    public function rejectRequest($id){
        $projectObj=Projects::find($id);
        $projectObj->status=3;
        $projectObj->update();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Rejected a student Request for Supervision",
            'type'=>2
        ]);
        return back()
            ->with('success',GeneralController::alertMaker('Successful','Rejected Student Request'));
    }


    public function approveAndAllocate($id){
        $projectObj=Projects::find($id);
        $projectObj->status=3;
        $projectObj->update();
        if(!Allocation::where('student_id',$projectObj->student_id)->exists()){
            Allocation::create([
                'lecturer_id'=>$projectObj->lecturer_id,
                'student_id'=>$projectObj->student_id,
            ]);
        }else{
            return back()->with('failure',GeneralController::alertMaker('successful','Student is already allocated to a supervisor'));
        }
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Approved Student/Lecturer working together",
            'type'=>1
        ]);
        return back()
            ->with('success',GeneralController::alertMaker('Successful','Rejected Student/Lecturer working together'));
    }
    public function rejectAllocation($id){
        $projectObj=Projects::find($id);
        $projectObj->status=4;
        $projectObj->update();

        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Rejected Student/Lecturer working together",
            'type'=>1
        ]);
        return back()
            ->with('success',GeneralController::alertMaker('Successful','Rejected Student/Lecturer working together'));
    }

    public function messages(ContactUs $contactUs){
        return view('admin.pages.messages')
            ->with('messages',$contactUs->getContactAll())
            ->with('heading','Recent Messages')
            ->with('title','Messages');
    }
    public function allMessages(ContactUs $contactUs){
        return view('admin.pages.allMessages')
            ->with('messages',$contactUs->getAll())
            ->with('heading','All Messages')
            ->with('title','All|Messages');
    }
    public function attendToMessage($attended){
        $contactObj=ContactUs::where('id',$attended)->first();
        $contactObj->update([
            'status'=>0
        ]);
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Attended to a Message",
            'type'=>1
        ]);
        return back()->with('success',GeneralController::alertMaker('Successful','Message Have Read'));
    }

    public function showGallery(Gallery $gallery){
        $galleryObj=$gallery->getGallery()->latest()->paginate(10);
        return view('admin.forms.gallery',[
            'title'=>"Gallery",
            'images'=>$galleryObj,
            'heading'=>"Add Image to Gallery",
        ]);
    }
    public function createGallery(Request $request){
        $this->validate($request,[
            'picture'=>'required|present|mimes:jpg,jpeg,png',
            'label'=>'required|present',
        ]);
        $image_file=GeneralController::UploadFile($request->file('picture'),[],"galleryImages");
        $galleryObj= new Gallery();
        $galleryObj->picture=$image_file;
        $galleryObj->label=$request->input('label');
        $galleryObj->save();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Added Image to the Gallery",
            'type'=>1
        ]);
        return back()->with('success',GeneralController::alertMaker('Successful','Image Have Added to Gallery'));

    }
    public function deleteImage($id){
        Gallery::find($id)->delete();
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Deleted Image form the Gallery",
            'type'=>1
        ]);
        return back()->with('success',GeneralController::alertMaker('Successful','Image Have Been Deleted'));
    }
}
