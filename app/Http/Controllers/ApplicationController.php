<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Registro;
use Image;

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

		$tops = Registro::getTop();

		$corredores = Registro::getCorredores();

		$filename = 'img/nuevoboleto.jpg';
		$img = Image::make('img/boleto.jpg');

		$img->text('HOLA45', 210, 175, function($font) {
			$font->file('fonts/bang whack pow.ttf');
			$font->size(13);
			$font->color('#000000');
			$font->align('center');
			$font->valign('top');
		});

		$img->text('HOLA45', 120, 175, function($font) {
			$font->file('fonts/bang whack pow.ttf');
			$font->size(13);
			$font->color('#000000');
			$font->align('center');
			$font->valign('top');
		});		
		$img->save($filename);

		return view('index')->with(compact('corredores','tops','distancia_total','filename'));
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
		//
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
