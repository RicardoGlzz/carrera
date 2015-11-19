<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Registro;
use Image;

class RegistroController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$corredores = Registro::getTotalCorredores();

		return view('registro')->with('corredores',$corredores);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$registro = new Registro;

		$datos = $request->all();

		$registro->nombre = $datos['nombre'];
		$registro->apellidos = $datos['apellidos'];
		$registro->email = $datos['email'];
		$registro->imagen = null;

		if($datos['imagen'])
		{
			$imagen = $datos['imagen'];
			$ramdom = md5(uniqid(rand(), true));
			$nombreImagen = $ramdom.'.'.$imagen->getClientOriginalExtension();
			$imagen->move('imagenes',$nombreImagen);
			$registro->imagen=$nombreImagen;

			$image = Image::make(sprintf('imagenes/%s', $nombreImagen));
			$image->resize(400, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$image->save();
		}

		$registro->tipo = $datos['tipo'];
		$registro->folio = $datos['folio'];
		$registro->codigo = $datos['codigo'];
		$registro->save();

		return $datos;
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
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
