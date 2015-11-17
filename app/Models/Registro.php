<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
	protected $table = 'registros';
	protected $fillable = ['nombre','apellidos','email','imagen','grupo','tutti','id_tutti'];
	public $timestamps = true;
}