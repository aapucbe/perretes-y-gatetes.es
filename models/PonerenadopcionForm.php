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
class PonerenadopcionForm extends Model
{
    public $id_mascota;
    public $nombre;
    public $animal; 
    public $raza; 
    public $sexo; 
    public $edad;
    public $provincia;
    public $poblacion;
    public $imagenes;     

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Estos campos no necesitan verificacion
            [['id_mascota','nombre','animal','raza','sexo','edad','provincia','poblacion'],'required'],
            //imagenes deberan ser png o jpg
            ['imagenes', 'file', 
               'skipOnEmpty' => false,
               'uploadRequired' => 'No has seleccionado ninguna imágen', //Error
               'maxSize' => 10024*1024*1, //10 MB
               'tooBig' => 'El tamaño máximo permitido es 10MB', //Error
               'extensions' => 'jpg, png',
               'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
               'maxFiles' => 3,
               'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
               ],
        ];
    }

}
