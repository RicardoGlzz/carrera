<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Registro;

class ApplicationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$tops = Registro::orderBy('distancia', 'DESC')
		->take(5)
		->get();

		$lugar = ['Primer','Segundo','Tercer','Cuarto','Quinto'];
		$i = 0;
		$distancia_total = 0;

		foreach ($tops as $key => $top) {
			$top->lugar = $lugar[$i];
			$i++;
		}

		$corredores = Registro::orderBy('distancia', 'DESC')
		->orderBy('created_at', 'DESC')
		->get();

		foreach ($corredores as $key => $corredor) {
			$distancia_total =  $distancia_total + $corredor->distancia;
		}

		return view('index')
		->with('tops',$tops)
		->with('corredores',$corredores)
		->with('distancia_total',$distancia_total);
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
