<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grupo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion'];

    /*avoid these columns created_at and updated_at*/
    public $timestamps = false;

    public static function existeGrupo($ngrupo){
        $group = Grupo::where('nombre', $ngrupo)->first();
        if(isset($group))
            return 1;
        return -1;
    }

    public static function crearGrupo($req){
        $grupo = new Grupo;
        $grupo->nombre = $req->nombre_grupo;
        $grupo->descripcion = $req->grupo_descripcion;
        $grupo->save();
    }


}
