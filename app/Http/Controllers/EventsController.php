<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Pictures;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    protected 
                $img_dir = 'event_images',
                $route_prefix = 'admin.events.',
                $application_type = 1,
                $img_ext_array  = array('jpeg', 'png', 'jpg'),
                $image_prefix = 'event_',
                $thumbnail_dir = '/thumbnail/'
                ;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $eventsArr = Events::with('dp_pictures')->get();

        return view( $this->route_prefix . 'view' )
                ->with([
                    'eventsArr' => $eventsArr,
                    'img_dir' => $this->img_dir,
                    'thumbnail_dir' => $this->thumbnail_dir,
                    'route_prefix' => $this->route_prefix
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( $this->route_prefix . 'add' )
                ->with([
                    'route_prefix' => $this->route_prefix
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'event_title'       => 'required|max:200',
            'event_description' => 'required',
            'event_date'        => 'required',
            'event_pictures'    => 'required',
            'event_pictures.*'  => 'mimes:jpeg,png,jpg,mp4'
        ]);

        //+++++++++++++++++++++ INSERT INTO EVENTS TABLE :: Start +++++++++++++++++++++//
        $event_slug   = mt_rand(10000,99999) . '-' . str_slug($request->event_title, '-');
        
        $Events = new Events();

        $Events->event_title        = $request->event_title;
        $Events->event_slug         = substr($event_slug, 0, 200);
        $Events->event_description  = $request->event_description;
        $Events->event_date         = $request->event_date;

        $Events->save();
        $Event_ID = $Events->id;
        //+++++++++++++++++++++ INSERT INTO EVENTS TABLE :: End +++++++++++++++++++++//
        
        //+++++++++++++++++++++ VALIDATE & INSERT IMAGES :: Start +++++++++++++++++++++//
        $images     = $request->file('event_pictures');
        
        if( !empty($images) ){
            $images_arr = array();

            $cnt        = 0;

            foreach($images as $image){
                $org_name   = $image->getClientOriginalName();
                
                $file_extn  = $image->getClientOriginalExtension();
                $imageName  = $this->image_prefix . $Event_ID . '_' . uniqid() . '.' . $file_extn;

                $image->move(public_path( $this->img_dir ), $imageName);

                if( in_array($file_extn, $this->img_ext_array) ){
                    //+++++++++++++++++++++ CREATE THUMBNAIL :: Start +++++++++++++++++++++//
                    // open an image file
                    $imgThumb = Image::make($this->img_dir . '/'.$imageName);

                    // resize image instance
                    $imgThumb->resize(200, 200);

                    // insert a watermark
                    //$imgThumb->insert('public/watermark.png');

                    // save image in desired format
                    $imgThumb->save($this->img_dir . $this->thumbnail_dir.$imageName);
                    //+++++++++++++++++++++ CREATE THUMBNAIL :: End +++++++++++++++++++++//
                }

                $is_dp  = ( $cnt == 0 ) ? 1 : 0;

                // Generate Model Array
                $images_arr[] = new Pictures(array(
                        'org_image'         => $org_name,
                        'mod_image'         => $imageName,
                        'file_extn'         => $file_extn,
                        'is_dp'             => $is_dp,
                        'application_type'  => $this->application_type
                    )
                );
                
                $cnt++;
            }

            $Events->pictures()->saveMany($images_arr);
        }
        //+++++++++++++++++++++ VALIDATE & INSERT IMAGES :: Start +++++++++++++++++++++//

        return back()
                ->with('success','Event Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Events::with('pictures')->where('id', $id)->first();

        return view( $this->route_prefix . 'edit', compact('event') )
                ->with([
                    'img_dir' => $this->img_dir,
                    'thumbnail_dir' => $this->thumbnail_dir,
                    'route_prefix' => $this->route_prefix
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'event_title'       => 'required|max:200',
            'event_description' => 'required',
            'event_date'        => 'required'
        ]);

        //+++++++++++++++++++++ UPDATE EVENTS TABLE :: Start +++++++++++++++++++++//
        $event_slug   = mt_rand(10000,99999) . '-' . str_slug($request->event_title, '-');
        
        $Events = new Events();

        $Events->where('id', $id)
                ->update([
                    'event_title' => $request->event_title, 
                    'event_slug' => substr($event_slug, 0, 200), 
                    'event_description' => $request->event_description, 
                    'event_date' => $request->event_date,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
        //+++++++++++++++++++++ UPDATE EVENTS TABLE :: End +++++++++++++++++++++//

        //+++++++++++++++++++++ VALIDATE & INSERT IMAGES :: Start +++++++++++++++++++++//
        $images     = $request->file('event_pictures');

        if( !empty($images) ){
            $images_arr = array();

            foreach($images as $image){
                $org_name   = $image->getClientOriginalName();
                
                $file_extn  = $image->getClientOriginalExtension();
                $imageName  = $this->image_prefix . $id . '_' . uniqid() . '.' . $file_extn;

                $image->move(public_path($this->img_dir), $imageName);

                if( in_array($file_extn, $this->img_ext_array) ){
                    //+++++++++++++++++++++ CREATE THUMBNAIL :: Start +++++++++++++++++++++//
                    // open an image file
                    $imgThumb = Image::make($this->img_dir . '/'.$imageName);

                    // resize image instance
                    $imgThumb->resize(200, 200);

                    // insert a watermark
                    //$imgThumb->insert('public/watermark.png');

                    // save image in desired format
                    $imgThumb->save($this->img_dir . $this->thumbnail_dir.$imageName);
                    //+++++++++++++++++++++ CREATE THUMBNAIL :: End +++++++++++++++++++++//
                }
                
                //+++++++++++++++++++++ INSERT INTO PICTURES TABLE :: Start +++++++++++++++++++++//
                $Pictures = new Pictures();

                $Pictures->org_image        = $org_name;
                $Pictures->mod_image        = $imageName;
                $Pictures->file_extn        = $file_extn;
                $Pictures->is_dp            = '0';
                $Pictures->application_type = $this->application_type;
                $Pictures->application_id   = $id;

                $Pictures->save();
                //+++++++++++++++++++++ INSERT INTO PICTURES TABLE :: End +++++++++++++++++++++//
            }
        }
        //+++++++++++++++++++++ VALIDATE & INSERT IMAGES :: Start +++++++++++++++++++++//

        return back()->with('success', 'Event has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Events = Events::find($id);

        $Events->delete();

        return redirect()
                ->route( $this->route_prefix . 'index')
                ->with('success','Event Deleted Successfully!');
    }

    public function changeStatus(Request $request){
        $event_id        = $request->event_id;
        $event_status    = $request->event_status;

        $db_status  = ( $event_status == 'inactive' ) ? 0 : 1;

        $Events = Events::find($event_id);
        $Events->status = $db_status;
        $Events->update();

        return response()->json(['status'=>'success']);
    }

    public function deletePicture($id){
        $Pictures = Pictures::find($id);

        $mod_image = $Pictures->mod_image;

        //echo $mod_image . '<pre>'; print_r($Pictures); echo '</pre>'; exit;
        
        $Pictures->delete();

        if( ( $Pictures->file_extn != 'mp4' ) && \File::exists(public_path( $this->img_dir . '/' . $mod_image ))){
            \File::delete(public_path( $this->img_dir . '/'. $mod_image));
            \File::delete(public_path($this->img_dir . $this->thumbnail_dir . $mod_image ));
        }

        return redirect()
                ->route( $this->route_prefix . 'edit', $Pictures->application_id)
                ->with('success','Event Picture Deleted Successfully!');
    }

    public function changeEventPictureDP($id){
        $Pictures = new Pictures();
        
        $Pictures_Obj = $Pictures->find($id);
        $application_id = $Pictures_Obj->application_id;

        $Pictures->where('application_id', $application_id)
                ->where('application_type', $this->application_type)
                ->update([
                    'is_dp' => 0,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
        
        $Pictures->where('id', $id)
                ->where('application_id', $application_id)
                ->where('application_type', $this->application_type)
                ->update([
                    'is_dp' => 1,
                    'updated_at' => \Carbon\Carbon::now()
                ]);

        return redirect()
                ->route( $this->route_prefix . 'edit', $Pictures_Obj->application_id)
                ->with('success','Event DP has been changed Successfully!');
    }



}
