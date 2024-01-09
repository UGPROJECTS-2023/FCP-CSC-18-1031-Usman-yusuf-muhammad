<?php

namespace ProjectManagement\Http\Controllers\General;

use Illuminate\Http\Request;
use ProjectManagement\Http\Controllers\Controller;
use ProjectManagement\Models\ContactUs;
use ProjectManagement\Models\Gallery;
use ProjectManagement\Models\Slide;

class IndexController extends Controller
{
    public function homepage(Slide $slide)
    {
        return view('general.index')
            ->with('slides',$slide->getSlides())
            ->with('title','Home|Page');
    }
    public function about(){
        return view('general.about')
            ->with('title','About|Us');
    }
    public function contact(){
        return view('general.contact')
            ->with('title','Contact_us|page');
    }
    public function edit(){
        return view('general.edit',['heading'=>'Edit'])
            ->with('title','edit');
        
    }
    public function createContact(Request $request){
        $this->validate($request,[
            'name'=>'required|present',
            'email'=>'required|present|email',
            'message'=>'required|present',
        ]);
        if(ContactUs::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'),
        ])){
            return back()->with('success',GeneralController::alertMaker('Successful','Message Have Been Sent'));
        }else{
            return back()->with('failure',GeneralController::alertMaker('Error!','Something Went Wrong'));

        }
    }
    public function gallery(Gallery $gallery){
        $galleryObj=$gallery->getGallery()->latest()->paginate(50);
        return view('general.gallery',[
            'title'=>'Gallery',
            'pictures'=>$galleryObj
        ]);
    }

}
