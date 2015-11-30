<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Registro;
use Image;
use DB;

class ApplicationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$distancia_total = Registro::getDistanciaTotal();

		if(is_object($distancia_total)) $distancia_total = '0';

		$tops = Registro::getTop();

		$corredores = Registro::getCorredores()->paginate(20);
		
		foreach ($corredores as $key => $corredor) {
			if($corredor->imagen) {
				$corredor->orientacion = self::imageOrientation($corredor->imagen);
			}
			else {
				$corredor->orientacion = null;
			}
		}

		if(Request::ajax())
		{
			return  Response::json($corredores);
		}
		else
		{
			return view('index')->with(compact('corredores','tops','distancia_total','filename'));
		}
		
	}

	public function casa()
	{
		return view('casa');
	}
	
	public function imageOrientation($imagen) {
			list($width, $height) = getimagesize('imagenes/'.$imagen);
			if ($width > $height) {
				$orientation = 'img_horizontal';
			} else {
				$orientation = 'img_vertical';
			}
		return $orientation;
	}
}