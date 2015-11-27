<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Registro;
use Image;
use Illuminate\Support\Facades\Session;
use DB;

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

		//$lista = $this->lista();
		// $i=1;
		// $font_path = 'fonts/Roboto-Regular.ttf';
		
		// foreach ($lista as $key => $numero) {

		// 	$jpg_image = imagecreatefromjpeg('boletos/boleto.jpg');
		// 	$black = imagecolorallocate($jpg_image, 0, 0, 0);
		// 	imagettftext($jpg_image, 40, 0, 450, 767, $black, $font_path, $i);
		// 	imagettftext($jpg_image, 40, 0, 880, 767, $black, $font_path, $i);
		// 	imagettftext($jpg_image, 40, 0, 2110, 767, $black, $font_path, $numero);
		// 	imagejpeg($jpg_image, "boletos/boleto".$numero.".jpg");
		// 	imagedestroy($jpg_image);
		// 	$i++;
		// }

		return view('registro')->with('corredores',$corredores);
	}

	public function indexmaster()
	{
		$corredores = Registro::getTotalCorredores();

		// $i=1;
		// $font_path = 'fonts/Roboto-Regular.ttf';
		
		// foreach ($lista as $key => $numero) {

		// 	$jpg_image = imagecreatefromjpeg('boletos/boleto.jpg');
		// 	$black = imagecolorallocate($jpg_image, 0, 0, 0);
		// 	imagettftext($jpg_image, 40, 0, 450, 767, $black, $font_path, $i);
		// 	imagettftext($jpg_image, 40, 0, 880, 767, $black, $font_path, $i);
		// 	imagettftext($jpg_image, 40, 0, 2110, 767, $black, $font_path, $numero);
		// 	imagejpeg($jpg_image, "boletos/boleto".$numero.".jpg");
		// 	imagedestroy($jpg_image);
		// 	$i++;
		// }

		return view('master')->with('corredores',$corredores);
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

		if(array_key_exists('imagen', $datos))
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
		$registro->distancia = 1;
		$registro->folio = $datos['folio'];
		$registro->codigo = $datos['codigo'];

		$lista = $this->lista();
		$correcto = false;
		$clave = array_search($datos['codigo'], $lista);
		if($clave+1==$registro->folio) $correcto = true;

		if($correcto)
		{
			$registro->save();
			return $datos;
		}
		else return 'Algo salió mal';
		
	}

	public function storeSeguir(Request $request)
	{
		$datos = $request->all();

		$registro = Registro::find($datos['mas_distancia']);

		$registroSeguir = new Registro;

		$registroSeguir->tutti = 1;
		$registroSeguir->id_tutti = $registro->id;
		$registroSeguir->folio = $datos['folio-seguir'];
		$registroSeguir->codigo = $datos['codigo-seguir'];

		$registro->distancia = $registro->distancia + 1;

		$lista = $this->lista();
		$correcto = false;
		$clave = array_search($datos['codigo-seguir'], $lista);
		if($clave+1==$registroSeguir->folio) $correcto = true;

		if($correcto)
		{
			$registro->save();
			$registroSeguir->save();
			return $datos;
		}
		else return 'Algo salió mal'.var_dump($clave).var_dump($correcto).var_dump($registroSeguir).var_dump($registro);
		
	}

	public function storeMaster(Request $request)
	{
		$registro = new Registro;

		$datos = $request->all();

		$registro->nombre = $datos['nombre'];
		$registro->imagen = null;

		if(array_key_exists('imagen', $datos))
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

		$registro->distancia = $datos['metros'];
		$registro->save();
		
	}

	public function checkFolio(Request $request) {
		$datos = $request->all();

		$estado = Registro::getCodigoUsado($datos['codigo']);

		if($estado=='USADO')
		{
			return $estado;
		}
		else if($estado=='OK')
		{
			$lista = $this->lista();
			$correcto = false;

			$clave = 0;
			$neddle = $datos['codigo'];
			$clave = array_search($neddle, $lista);
			if($clave!==false)
			{
				if(($clave+1)==$datos['folio']) $correcto = true;

				if($correcto==true)
				{
					return 'OK';
				}
				else return 'NO';
			}
			else return 'CÓDIGO NO VÁLIDO';
		}
		else if($estado=='TUTTI')
		{
			$lista = $this->lista();
			$correcto = false;

			$clave = 0;
			$neddle = $datos['codigo'];
			$clave = array_search($neddle, $lista);
			if($clave!==false)
			{
				if(($clave+1)==$datos['folio']) $correcto = true;

				if($correcto==true)
				{
					return 'OK';
				}
				else return 'NO';
			}
			else return 'CÓDIGO NO VÁLIDO';
		}
		else return 'wot?'.var_dump($estado);
	}

	public function checkMaster(Request $request) {
		$datos = $request->all();

		if($datos['password']=='hola') return 'OK';
		else return 'NO';
	}

	public function lista(){

		$PD = 0;
		$MD = 0;
		$UD = 0;
		$AD = 0;
		$code = array();

		for ($i=0; $i < 7000; $i++){
			$numero = "";
			if($UD < 9){
				$UD++;
			}
			else{
				$UD = 0;
				if($MD < 9){
					$MD++;
				}
				else{
					$MD = 0;
					if($PD < 9){
						$PD++;
					}
					else{
						$PD = 0;
						if($AD < 9){
							$AD++;
						}
					}
				}
			}
			$code[$i] = $this->sorting($this->cryptV($AD, $PD, $MD, $UD));
			//echo "<a target ='_blank' href='persona.php?id=".$AD."".$PD."".$MD."".$UD."&key=".$code[$i]."'>".$AD."".$PD."".$MD."".$UD." - ".$code[$i]."</a><br>";
		}
		/*
		echo "<br><h1>Repeticiones</h1><br>";
		$repeticiones = array_count_values($code);
		$i = 0;
		foreach ($repeticiones as $key => $value) {
			$i++;
			if($value == 1){
				$value = 0;
				echo $i.": ";
			}
			else if($value>1){
				echo "<span>".$i.":</span> ";
			}
			echo $key." - ".$value."<br>";
		}
		*/
		return ($code);
	}

	public function sorting($key){
		$frst = $key[0];
		$lst = substr($key, -1);
		$size = strlen($key)-1;
		$str = "";
		for ($i=0; $i <= $size; $i++) {
			if($i == 0){
				$str.=$lst;
			}
			else if($i == $size){
				$str.=$frst;
			}
			else{
				$str.=$key[$i];
			}
		}
		return $str;
	}

	public function cryptV($AD, $PD, $MD, $UD){
		$OP1 = $PD-2+$UD;
		$OP2 = ($PD + $MD - $UD)*1;
		$OP3 = $MD + $UD;
		$OP4 = $UD+2;
		$OP5 = $AD+7;

		$OP1 += $OP2+$UD;

		$OP1 = $this->validar($OP1, $UD);
		$OP2 = $this->validar($OP2, $UD);
		$OP3 = $this->validar($OP3, $UD);
		$OP4 = $this->validar($OP4, $UD);
		$OP5 = $this->validar($OP5, $UD);

		return $this->replaceABC($OP5).$this->replaceABC($OP1).$this->replaceABC($OP2).$this->replaceABC($OP3).$this->replaceABC($OP4);
	}

	public function validar($n, $UD){
		$l = "";
		if($n < 1){
			$l = "M";
		}
		else if($n > 26){
			$l = "V";
			$UD*=2;
		}
		if($l != ""){
			if($UD == 0){
				$UD = 20;
			}
			$UD = $this->replaceABC($UD);
			return $l.$UD;
		}
		return $n;
	}

	public function replaceABC($n){
		$abc = array(
			1 => "C",
			2 => "J",
			3 => "R",
			4 => "D",
			5 => "A",
			6 => "P",
			7 => "E",
			8 => "W",
			9 => "S",
			10 => "B",
			11 => "N",
			12 => "T",
			13 => "P",
			14 => "G",
			15 => "F",
			16 => "H",
			17 => "V",
			18 => "M",
			19 => "Y",
			20 => "I",
			21 => "K",
			22 => "L",
			23 => "O",
			24 => "U",
			25 => "Q",
			26 => "Z"
		);
		if(is_numeric($n)){
			return $abc[$n];
		}
		return $n;
	}

}