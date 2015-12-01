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

		$tops = Registro::select()
		->whereNull('tutti')
		->orderBy('distancia', 'DESC')
		->take(5)->get();

		$lugar = ['Primer','Segundo','Tercer','Cuarto','Quinto'];
		$i = 0;

		foreach ($tops as $key => $top) {
			if($top->imagen) {
				$top->orientacion = self::imageOrientation($top->imagen);
			}
			else {
				$top->orientacion = null;
			}
			$top->lugar = $lugar[$i];
			$i++;
		}

		$count = Registro::select()
		->whereNull('tutti')
		->count();
		$skip = 5;
		$limit = $count - $skip;

		$corredores = Registro::select()
		->whereNull('tutti')
		->skip($skip)
		->take($limit)
		->orderBy('distancia', 'DESC')
		->orderBy('created_at', 'DESC')
		->paginate(4);

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