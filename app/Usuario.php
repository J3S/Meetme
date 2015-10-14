<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'usuario', 'clave', 'correo', 'fnacimiento', 'sexo', 'profesion', 'extrainfo', 'edad'];

    /*avoid these columns created_at and updated_at*/
    public $timestamps = false;

    public static function existeUsuario($usuario){
        $user = Usuario::where('usuario', $usuario)->first();
        if(isset($user))
            return 1;
        return -1;
    }

    public static function crearUsuario($usuario_Objeto){
        $usuario = new Usuario;
        $usuario->nombre = $usuario_Objeto->input_name;
        $usuario->usuario = $usuario_Objeto->input_username;
        $usuario->clave = $usuario_Objeto->input_password;
        $usuario->correo = $usuario_Objeto->input_email;
        $time = strtotime($usuario_Objeto->input_dbirth);
        $date_birth = date('Y-m-d', $time);
        $ybirth = date("Y", $time);
        $usuario->fnacimiento = $date_birth;
        $usuario->sexo = $usuario_Objeto->sexOption;
        $usuario->profesion = $usuario_Objeto->input_occupation;
        $usuario->extrainfo = $usuario_Objeto->input_addinfo;
        $usuario->edad = date("Y") - $ybirth;
        $usuario->save();
    }

    public static function usuarioPasswordCorrecto($usuario, $password){
        $user = Usuario::where('usuario', $usuario)
                       ->where('clave', $password)
                       ->first();
        if(isset($user))
            return 1;
        return -1;
    }
}
