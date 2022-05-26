<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use View;
use App\Mail\CallbackRequested;
use App\Actions;

class FrontendController extends Controller
{
	/**
	 * Returns Services view
	 *
	 * @param $request->id If present returns one service, else return main screen
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/	
	public function services(Request $request){
		if (isset($request->id)) {
			$service = \App\Services::find($request->id);
			if ($request->layout == 'minimal')
				return view('partials.service',['service' => $service]);
			return view('service',['service' => $service]);
		}
		return view('main');
	}

	/**
	 * Returns Doctors view
	 *
	 * @param $request->id If present returns one doctor view, else return main screen
	 * @param $request->layout If 'minimal' returns without layout
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/	
	public function doctors(Request $request) {
		if (isset($request->id)) {
			$doctor = \App\Doctors::find($request->id);
			if ($request->layout == 'minimal')
				return view('partials.doctor',['doctor' => $doctor]);
			return view('doctor',['doctor' => $doctor]);

		}
		return view('doctors');
	}

	public function actions(Request $request){
		$photos = Actions::where('published', true)->get();
		return view('actions', ['photos' => $photos]);
	}

	/**
	 * Returns Contacts view
	 *	 
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/	
	public function contacts() {
		return view('contacts');
	}

	/**
	 * Returns Prices view
	 *	 
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/	
	public function prices() {
		return view('pricelist.main');
	}

	/**
	 * Returns Service or Doctor partial for main screen
	 *
	 * @param $request->method Must be services or doctors
	 * @param $request->id 
	 *
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/	
	public function refresh(Request $request){
		$class = '\App\\'.ucwords($request->method);
		$data = $class::find($request->id);
		return response(view('partials.templates.main_'.rtrim($request->method,'s'), [rtrim($request->method,'s') => $data])->render(), 200);
	}
	/**
	 * Returns Service or Doctor partial for main screen
	 *
	 * @param $request->method Must be services or doctors
	 * @param $request->id 
	 *
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/	
	public function create(Request $request){
		$class = '\App\\'.ucwords($request->method);
		$data = new $class;
		$data->save();
		return redirect()->route('services');
	}

	/**
	 * General update function, handles POST and GET methods
	 *
	 * @param $request->method Private function to call
	 * @param $request 
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
	public function update(Request $request) {
		return $this->{$request->method}($request);
	}

	/**
	 *  Returns pricelist partial for selected service
	 *	
	 *	 @param $request->id выбранной услуги
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/
	private function updatePrices(Request $request) {
		logger($request->all());
		return view('partials.prices', ['id' => $request->id]);
	}
	
	// Переделать!!!! Сохраняет, но мне не нравится как
	private function updatePricesPost(Request $request) {
		$target = explode('.',$request->target);
		$class = '\App\\'.ucwords($target[0]);
		$ids = $class::where('services_id',$request->id)->pluck('services2_id')->toArray();
		logger($ids);
		foreach ($request->services2_id as $value){
			if (($key = array_search($value, $ids)) !== false) {
			    unset($ids[$key]);
			} else {
				$data = new \App\ServicesPivot;
				$data->services_id = $request->id;
				$data->services2_id = $value;
				$data->save();
			}
		}
		foreach ($ids as $id){
			$data = \App\ServicesPivot::where('services2_id', $id);
			$data->delete();
		}
	}
	public function updates(Request $request){
		$target = explode('.',$request->target);
		$class = '\App\\'.ucwords($target[0]);
		$result = $class::find($request->id);
		$result->{$target[1]} = $request->data;
		$result->save();
		return response($request->data, 200);
	}


	/**
	 * Callback form handler
	 *
	 * @param Request $request Should have name, phone and version;
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
	public function callback(Request $request) {
		$validator = \Validator::make($request->all(),[
        	'phone' => 'required',
        	'name' => 'required'
	    ],[
	    	'phone' => __('messages.phone.error'),
	    	'name' => __('messages.name.error'),
	    ]);
	    if ($validator->fails()) {
	    	$request->flash();
	    	return response(view('partials.templates.callback-'.$request->version)->withInput($request->all())->withErrors($validator)->render(), 422);      		
	    } 
    	
    	Mail::to('info@smpd.lv')->send(new CallbackRequested($request));
    	return response(view('partials.templates.callback-'.$request->version.'-success')->render(), 200);      		
	}

	/**
	 * Callback form reload
	 *
	 * @param Request $request Should have ver mobile or desktop
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
	public function callbackReload(Request $request){
		logger($request->all());
		if ($request->ver == 'desktop') return view('partials.templates.callback-desktop');
		return view('partials.templates.callback-mobile');
	}

	/**
	 * Updates services or doctors on main screen
	 * 
	 * @param $request->target Must be 'doctors.order' or 'services.order'
	 * @param $request->{$target[0]} -> Variable from jQuery UI Sortable (is created based on element's id)
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
 	 **/
	private function updateOrder(Request $request){
		$target = explode('.',$request->target);
		$class = '\App\\'.ucwords($target[0]);
		// В данном случае делаем в цикле, так как сложно обновить все списком
		// подумать может можно
		foreach ($request->{$target[0]} as $key => $value){
			$data = $class::find($value);
			$data->{$target[1]} = $key;
			$data->save();
		}
	}

	/**
	 * Loads image upload template
	 * 
	 * @return view
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
	private function uploadImage(){
		return response(view('partials.templates.upload')->render(), 200);
	}

	/**
	 * Saves image to database
	 * 
	 * @param $request->target Must be 'doctors.image' or 'services.image'
	 * @param $request->data Raw image data
	 * @param $request->id Service or Doctor id
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
	private function  uploadImagePost(Request $request){
		// Handles data
		$target = explode('.',$request->target);
		$class = '\App\\'.ucwords($target[0]);
		$object = $class::find($request->id);

		// Handles image
		$image = \Gumlet\ImageResize::createFromString(base64_decode($request->data));
		$image->quality_jpg = 50;

		// Saving image
		$object->image = (string) $image;
		$object->save();
	}

	/**
	 * Saves services order in pricelist
	 * 
	 * @param $request->class 
	 * @param $request->target Must be order
	 * @param $request->id Parent service id
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
 	private function servicesPivotSorting(Request $request){
		$class ='\App\\'.$request->class;
		foreach ($class::where('services_id', $request->id)->get() as $key => $data){
			$data->{$request->target} = $request->{$request->target}[$key] ;
			$data->save();
		}
	}

	/**
	 * Toggles service or doctor on main screen 
	 * 
	 * @param $request->class  Must be services or doctors
	 * @param $request->id Doctor's or Service's id
	 *
	 * @author Oleg Pashkovsky
	 *
	 * @since 1.0
	 *
	 **/
	private function publishToggle(Request $request){
		$class ='\App\\'.$request->class;
		$data = $class::find($request->id);
		$data->published = !$data->published;
		$data->save();
	}
}
