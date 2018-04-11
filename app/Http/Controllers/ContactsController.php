<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contact;
use Illuminate\Support\Facades\Storage;
//use Validator;

class ContactsController extends Controller
{
   public function index()
   {


   	$Recent_data = DB::table('contacts')->limit(10)->get();

   	$contact_data = DB::table('contacts')->latest()->get();
   	
   	return view ('contacts.index',compact('Recent_data','contact_data'));
   }

   public function edit_contact($contactID)
   {
   		$edit_data = DB::table('contacts')->find($contactID);
   		return view ('contacts.edit',compact('edit_data'));
   }

   public function view_contact($cID)
   {
      $edit_data = DB::table('contacts')->find($cID);
         return view ('contacts.view_contact',compact('edit_data'));
   }

   public function update_contact(Request $request)
   {
   		
   		$this->validate($request,[
    'name' => 'required',
    'email' => 'required|email',
    'mobile' => 'required|numeric',
    'ProfileImg' => 'mimes:jpeg,jpg,png,gif|required|max:100000'
]);
   		$name = $request->input('name');
   		$email = $request->input('email');
   		$mobile = $request->input('mobile');
   		$contactID = $request->input('ContactID');

         $profile_img = $request->file('ProfileImg');
         $profile_pic_name = $profile_img->getClientOriginalName();
         $profile_pic_ext = $profile_img->getClientOriginalExtension();
         $profile_pic_size = $profile_img->getSize();
         $profile_pic_mime_type = $profile_img->getMimeType();

         $destinationPath = public_path().'/uploads/';
      $profile_img->move($destinationPath,$profile_img->getClientOriginalName());

   		$added = date("Y-m-d H:i:s");
   		$updateArray = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'updated_at'=>$added,'profile_pic'=>$profile_pic_name];
   		DB::table('contacts')->where('id',$contactID)->update($updateArray);

   		return redirect('/');

   		//return $request->input('name');

   }


   public function add_contact(Request $request)
   {
         
         $this->validate($request,[
    'name' => 'required',
    'email' => 'required|email',
    'mobile' => 'required|numeric|size:17',
    'ProfileImg' => 'mimes:jpeg,jpg,png,gif|required|max:100000'
]);
         $name = $request->input('name');
         $email = $request->input('email');
         $mobile = $request->input('mobile');
         $contactID = $request->input('ContactID');

         $profile_img = $request->file('ProfileImg');
         $profile_pic_name = $profile_img->getClientOriginalName();
         $profile_pic_ext = $profile_img->getClientOriginalExtension();
         $profile_pic_size = $profile_img->getSize();
         $profile_pic_mime_type = $profile_img->getMimeType();

         $destinationPath = public_path().'/uploads/';
      $profile_img->move($destinationPath,$profile_img->getClientOriginalName());

         $added = date("Y-m-d H:i:s");
         $updateArray = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'updated_at'=>$added,'profile_pic'=>$profile_pic_name,'created_at'=>$added];
         DB::table('contacts')->insert($updateArray);

         //return redirect('/');

         //return $request->input('name');

   }


}
