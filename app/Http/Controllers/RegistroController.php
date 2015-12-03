<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Registro;
use Image;
use Mail;
use Illuminate\Support\Facades\Session;

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
		$datos = $request->all();

		$estado = Registro::getCodigoUsado($datos['codigo']);

		if($estado=='USADO') {
			return 'Ocurrió un problema';
		}

		else if($estado=='OK') {

			$registro = new Registro;

			$registro->folio = $datos['folio'];
			$registro->codigo = $datos['codigo'];
		}

		else if($estado=='TUTTI') {

			$registro = Registro::where('codigo', '=', $datos['codigo'])->first();

			$registro->tutti = null;
		}

			$registro->nombre = $datos['nombre'];
			$registro->apellidos = $datos['apellidos'];
			$registro->email = $datos['email'];
			$registro->tipo = $datos['tipo'];
			$registro->distancia = 1;
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

			$lista = $this->lista();
			$correcto = false;
			$clave = array_search($datos['codigo'], $lista);
			if($clave!==false)
			{
				if($clave+1==$registro->folio) $correcto = true;

				if($correcto) {
					$registro->save();

					Mail::send('emails.email', ['user' => $registro], function ($m) use ($registro) {
								$m->from('12kchocho@virtua.rocks', '12kChocho');
								$m->to($registro->email, $registro->nombre)->subject('Registro exitoso de boleto 12kChocho 2015');
							});
					return $datos;
				}
				else return 'Algo salió mal';
			}

	}

	public function storeSeguir(Request $request)
	{
		$datos = $request->all();

		$estado = Registro::getCodigoUsado($datos['codigo-seguir']);

		if($estado=='USADO') {
			return 'Ocurrió un problema';
		}

		else if($estado=='OK') {

			$registroSeguir = new Registro;

			$registroSeguir->folio = $datos['folio-seguir'];
			$registroSeguir->codigo = $datos['codigo-seguir'];
		}

		else if($estado=='TUTTI') {

			$registroSeguir = Registro::where('codigo', '=', $datos['codigo-seguir'])->first();
			
		}

		$registro = Registro::find($datos['mas_distancia']);
		$registro->distancia = $registro->distancia + 1;
		$registroSeguir->id_tutti = $registro->id;
		$registroSeguir->tutti = 1;

		$lista = $this->lista();
		$correcto = false;
		$clave = array_search($datos['codigo-seguir'], $lista);
		if($clave!==false)
		{
			if($clave+1==$registroSeguir->folio) $correcto = true;

			if($correcto) {
				$registro->save();
				$registroSeguir->save();
				
				return $datos;
			}
			else return 'Algo salió mal';
		}
		
	}

	public function storeMaster(Request $request)
	{
		$registro = new Registro;

		$datos = $request->all();

		if($datos['password']!='hola') return 'Ocurrió un problema';

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

	public function storeSeguirMaster(Request $request)
	{
		$datos = $request->all();

		$registro = Registro::find($datos['id']);

		if($datos['password']!='hola') return 'Contraseña incorrecta';

		$registro->distancia = $registro->distancia + $datos['metros'];

		$registro->save();
		return 'OK';
		
	}

	public function storeBoleto(Request $request)
	{
		$datos = $request->all();

		$estado = Registro::getCodigoUsado($datos['codigo']);
		if($datos['codigo']=='')
		{
			$foliousado = Registro::select()->where('folio','=',$datos['folio'])->first();
			if($foliousado) $estado = 'USADO';
			else $estado = 'OK';
		}
		if($datos['password']!='hola') return 'Contraseña incorrecta';

		if($estado=='USADO'||$estado=='TUTTI') {
			return 'Código o folio ya utilizado';
		}

		else if($estado=='OK') {

			$registro = new Registro;

			$registro->folio = $datos['folio'];
			$registro->codigo = $datos['codigo'];
			$registro->tutti=1;

			$lista = $this->lista();
			$correcto = false;

			if($datos['codigo']=='')
			{
				$registro->codigo = $lista[($registro->folio)-1];
			}

			$clave = array_search($registro->codigo, $lista);
			if($clave!==false)
			{
				if($clave+1==$registro->folio) $correcto = true;

				if($correcto) {
					$registro->save();
					return 'OK';
				}
				else return 'Algo salió mal';
			}
			else return var_dump($clave);

		}

	}

	public function checkFolio(Request $request) {
		$datos = $request->all();

		$estado = Registro::getCodigoUsado($datos['codigo']);

		if($estado=='USADO') {
			return $estado;
		}

		else if($estado=='OK'||$estado=='TUTTI') {
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

	public function virtual(Request $request){

		$datos = $request->all();
		Mail::send('emails.boletos', ['datos' => $datos], function ($m) use ($datos) {
					$m->from('12kchocho@virtua.rocks', '12kChocho');
					$m->to('casadgo@hotmail.com', '12Kchocho')
					->cc('chaveztic@gmail.com', 'Alejandro Chávez')
					->cc('tao@virtua.mx', 'Tao Rivera')
					->cc('ricardo@virtua.mx', 'Ricardo González')
					->subject('Solicitud de boletos');
				});

		return redirect('')->with('message', 'Tu solicitud de boletos ha sido enviada');
	}

	public function corredores(Request $request) {
		$pagina = $request->input('page');

		$count = Registro::select()
		->whereNull('tutti')
		->count();
		$skip = 5+(5*($pagina-1));
		$limit = 5;

		$corredores = Registro::select()
		->whereNull('tutti')
		->skip($skip)
		->take($limit)
		->orderBy('distancia', 'DESC')
		->orderBy('created_at', 'DESC')
		->get();

		foreach ($corredores as $key => $corredor) {
			if($corredor->imagen) {
				$corredor->orientacion = $this->imageOrientation($corredor->imagen);
			}
			else {
				$corredor->imagen = 'http://test.12kchocho.org.mx/img/avatarchocho.png';
				$corredor->orientacion = null;
			}
		}
		return $corredores->toJson();;
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