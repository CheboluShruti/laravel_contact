<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contact;
//use App\Mail\Welcome;
///use Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Support\Carbon;
//use Validator;

class ContactsController extends Controller
{
   public function index()
   {


   	$Recent_data = DB::table('contacts')->where('status',0)->latest()->limit(10)->get();

   	$contact_data = DB::table('contacts')->where('status',0)->latest()->get();
   	
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
    'ProfileImg' => 'mimes:jpeg,jpg,png,gif|max:100000'
]);
   		$name = $request->input('name');
   		$email = $request->input('email');
   		$mobile = $request->input('mobile');
   		$contactID = $request->input('ContactID');
        $added = date("Y-m-d H:i:s");
         $profile_img = $request->file('ProfileImg');
         if($profile_img!='')
         {
               $profile_pic_name = $profile_img->getClientOriginalName();
         $profile_pic_ext = $profile_img->getClientOriginalExtension();
         $profile_pic_size = $profile_img->getSize();
         $profile_pic_mime_type = $profile_img->getMimeType();

         $destinationPath = public_path().'/uploads/';
      $profile_img->move($destinationPath,$profile_img->getClientOriginalName());
      $updateArray = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'updated_at'=>$added,'profile_pic'=>$profile_pic_name,'status'=>0];
         }
         else
         {
           $profile_pic_name ='';
           $updateArray = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'updated_at'=>$added];
         }
      

   	
   		
   		DB::table('contacts')->where('id',$contactID)->update($updateArray);

   		return redirect('/');

   		//return $request->input('name');

   }


   public function add_contact(Request $request)
   {
         
         $this->validate($request,[
    'name' => 'required',
    'email' => 'required|email',
    'mobile' => 'required|numeric',
    'ProfileImg' => 'mimes:jpeg,jpg,png,gif|max:100000'
]);
         $name = $request->input('name');
         $email = $request->input('email');
         $mobile = $request->input('mobile');
         $contactID = $request->input('ContactID');

         $profile_img = $request->file('ProfileImg');
         if($profile_img!='')
         {
         $profile_pic_name = $profile_img->getClientOriginalName();
         $profile_pic_ext = $profile_img->getClientOriginalExtension();
         $profile_pic_size = $profile_img->getSize();
         $profile_pic_mime_type = $profile_img->getMimeType();

         $destinationPath = public_path().'/uploads/';
      $profile_img->move($destinationPath,$profile_img->getClientOriginalName());
         }
         else
         {
           $profile_pic_name ='';
         }

         $added = date("Y-m-d H:i:s");
         $updateArray = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'updated_at'=>$added,'profile_pic'=>$profile_pic_name,'created_at'=>$added,'status'=>0];
         DB::table('contacts')->insert($updateArray);

         return redirect('/');

         //return $request->input('name');

   }

   public function send_contact_email(Request $request)
   {
      $this->validate($request,[
            'emailAddress' => 'required|email',
            'subject' => 'required',
            'Emailmessage' => 'required'
        ]);
         $mailsubject = $request->input('subject');
         $emailAddress = $request->input('emailAddress');
         $Emailmessage = $request->input('Emailmessage');
          $added = date("Y-m-d H:i:s");
          $date = date("Y-m-d");
         // $moreUsers = "shruti@healthigo.com";
         // $emailDetails = request(['Emailmessage','subject']);
         //  Mail::to($email)->send(new Welcome($emailDetails));
         $updateArray = ['subject'=>$mailsubject,'email_body'=>$Emailmessage,'to_email'=>$emailAddress,'added'=>$added,'date'=>$date];
         DB::table('email_db')->insert($updateArray);
         Mail::send('emails.welcome', ['subject' => $mailsubject, 'Emailmessage' => $Emailmessage], function ($message) use($mailsubject,$emailAddress,$Emailmessage)
        {

            $message->from('healthigo@test.com', 'Shruti');

            $message->to($emailAddress);
            $message->subject($mailsubject);

        });


        return redirect('/');

   }

   public function delete_contact(Request $request)
   {
    $deleteID = $request->input('deleteID');

    if($deleteID=='')
    {
      return "Please select atleast one contaact to delete";
    }
    else
    {
      $explodeDeleteID = explode(',',$deleteID);
      for ($i=0; $i <count($explodeDeleteID) ; $i++) { 
       

      $contact_details =  DB::table('contacts')->where('id',$explodeDeleteID[$i])->get();
      $updateArray = ['status'=>1];
        DB::table('contacts')->where('id',$explodeDeleteID[$i])->update($updateArray);
      }
    }
   }


}
