<?php

namespace App\Http\Controllers;

use App\Contact;
use Carbon\Carbon;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use DB;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;


//use Illuminate\Support\Carbon;
//use Validator;

class ContactsController extends Controller
{
  protected $gmap;

    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
    }
   public function index()
   {


   	$Recent_data = DB::table('contacts')->where('status',0)->latest()->limit(10)->get();

   	$contact_data = DB::table('contacts')->where('status',0)->latest()->get();
   	
   	return view ('contacts.index',compact('Recent_data','contact_data'));
   }

   public function edit_contact($contactID)
   {
   		$edit_data = DB::table('contacts')->find($contactID);
     // dd($edit_data);
   		return view ('contacts.edit',compact('edit_data'));
   }

   public function view_contact($cID)
   {
     $edit_data = DB::table('contacts')->find($cID);
        //dd('Hii');
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

   public function map_view_page()
{
  Mapper::map(0, 0,
        [
            'zoom' => 20,
            'draggable' => true,
            'marker' => true,
            'center' => false,
            'markers' => ['title' => 'sgs!', 'animation' => 'DROP'],
            
        ]);

$markers = [
    ['lat' => 17.385044,  'lng' => 78.486671],
    ['lat' => 22.572646, 'lng' => 88.363895],
    ['lat' => 51.507351, 'lng' => -0.127758],
    ['lat' => 38.907192, 'lng' => -77.036871]
];

foreach ($markers as $marker) {
    Mapper::marker($marker['lat'], $marker['lng']);
}

//Mapper::location('Sheffield')->map(['zoom' => 18, 'center' => true, 'eventAfterLoad' => 'onMapLoad(maps[0].map);']);

    return view('map');
}



public function geomap()
{
  return view('gmap');
}

public function google_map()
{

        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;

        /******** End Controls ********/

        $config = array();
        $config['map_height'] = "50%";
        $config['map_width'] = "50%";
        

$config['center'] = 'auto';
$config['onboundschanged'] = 'if (!centreGot) {
  var mapCentre = map.getCenter();

  marker_0.setOptions({
    position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 


  });
}
centreGot = true;
';
       
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        
       $config['placesAutocompleteOnChange'] = '

            var placelat = event.latLng.lat();
            var placelng = event.latLng.lng();
            $("#placelat").val(placelat);
            $("#placelng").val(placelng);       
         ';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['position'] = 'center';
        $marker['draggable'] = true;
        $marker['animation'] = 'DROP';
        //$marker['icon_size'] = '50,50';
        $marker['icon'] = url('/').'/uploads/ddd/map_marker2.png';
        
        /*$marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';*/
        $this->gmap->add_marker($marker);
        

        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']

        return view('google_map', ['map' => $map]);
}


      public function ajax_find_place(Request $request)
      {
        $PlaceName = $request->input('PlaceName');
        $placelat = $request->input('placelat');
        $placelng = $request->input('placelng');

       // dd($PlaceName);
        $config = array();
        $config['center'] = $PlaceName;
        $config['zoom'] = '14';
       $config['places'] = TRUE;
        $config['placesLocation'] = "$placelat, $placelng";
       $config['placesRadius'] = 5000; 
        
      

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
       $marker = array();

        $marker['position'] = $PlaceName;
        $marker['draggable'] = true;
        $marker['animation'] = 'DROP';
        //$marker['icon_size'] = '50,50';
        $marker['icon'] = url('/').'/uploads/ddd/map_marker2.png';
        
        /*$marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';*/

        $this->gmap->add_marker($marker);

        $circle = array();
        $circle['center'] = $PlaceName;
        $circle['radius'] = '5000';
         $this->gmap->add_circle($circle);





        //DB::table('users')->whereBetween('votes', [1, 100])->get();
        

        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']

       
        
        return view('google_map_ajax', ['map' =>$map]);
      }



      public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        return $user->token;
    }

}
