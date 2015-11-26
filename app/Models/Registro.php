<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Registro extends Model
{
	protected $table = 'registros';
	protected $fillable = ['nombre','apellidos','email','imagen','grupo','tutti','id_tutti'];
	public $timestamps = true;

	public function scopeGetTop($query){

		$tops = DB::table('registros')
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

		return $tops;
	}

	public function scopeGetCorredores($query){

		$count = DB::table('registros')->count();
		$skip = 5;
		$limit = $count - $skip;

		$corredores = DB::table('registros')->skip($skip)
		->take($limit)
		->orderBy('distancia', 'DESC')
		->orderBy('created_at', 'DESC')
		->get();

		foreach ($corredores as $key => $corredor) {
			if($corredor->imagen) {
				$corredor->orientacion = self::imageOrientation($corredor->imagen);
			}
			else {
				$corredor->orientacion = null;
			}
		}

		return $corredores;
	}

	public function scopeGetTotalCorredores($query){

		$corredores = DB::table('registros')
		->orderBy('apellidos', 'ASC')
		->orderBy('nombre', 'ASC')
		->get();

		return $corredores;
	}

	public function scopeGetDistanciaTotal($query) {

		$corredores = DB::table('registros')->get();
		$distancia_total = 0;

		foreach ($corredores as $key => $corredor) {
			$distancia_total = $distancia_total + $corredor->distancia;
		}

		return $distancia_total;
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

	public function scopeGetCodigoUsado($query,$codigo) {

		$repetido = DB::table('registros')->where('codigo','=',$codigo)->get();

		if($repetido) return 'NO';
		else return 'OK';
	}
}