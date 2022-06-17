<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Models\Camera;
	use App\Models\User;
	
	use Auth;
	class CameraController extends Controller
	{
		public function index()
		{
			
			return view('cameras.camera');
		}
		
		
		
		
		public function edit_image($id)
		{
			$image= Image::find($id);
			return view('fileupload.edit',compact('image'));
			
		}
		
		
		
		public function store(Request $request)
		{  
		   
		  $post= New Camera;
		  
		$img = $request->image;
    $folderPath = "public/images/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
  
			
			
			$post->picture = $fileName;
			$post->title = $request->title;
			$post->user_id =Auth::user()->id;
			$post->save();
			$request->session()->flash('message', 'File Uploaded Succesfully');
			return redirect('/image/index');
			
		}
		public function update_image(Request $request,$id)
		{  
		
			$post= Image::find($id);
			if ($files = $request->image) {
				
				$img = time().'.'.$files->getClientOriginalExtension(); 
				$request->image->move(public_path('images'), $img);
				
				$image = $img;
				
			}        
			
			else {
				$image =$post->image;
				
			}
			$post->image = $image;
			$post->user_id =Auth::user()->id;
			$post->save();
			$request->session()->flash('message', 'File Update Succesfully');
			return redirect('/image/index');
			
		}
		
		
		// CAMERA TAKE PHOTO
		public function take_photo()
		{
			
			return view('cameras.camera');
			
		}
		
			public function show_photo_user_wise($id)
		{
			$photos = Camera::where('user_id','=',$id)->get();
			return view('cameras.show_photo',compact('photos'));
			
		}
		
		public function deletes(Request $request,$id)
		{
			$post= Image::find($id);
			// echo $post;exit;
			$post->delete();
			$request->session()->flash('message', 'File Delete Succesfully');
			return redirect('/image/index');
		}
	}
