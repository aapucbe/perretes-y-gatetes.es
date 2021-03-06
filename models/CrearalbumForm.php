<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\web\Session;

/**
 * PerfilForm.
 *
 *
 */
class CrearalbumForm extends Model
{
    public $id_mascota;
    public $nombre;
    public $imagen;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Estos campos no necesitan verificacion
            [['id_mascota','nombre'],'required'],
            //imagen_destacada y foto_cabecera deberan ser png o jpg
            [['imagen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre del álbum',
            'imagen' => 'Imagen destacada del álbum'
        ];
    }

}
