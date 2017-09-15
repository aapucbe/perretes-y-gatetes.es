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
class CrearpostForm extends Model
{
    public $id_mascota;
    public $imagen;
    public $contenido;    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Estos campos no necesitan verificacion
            [['id_mascota','contenido'],'required'],
            //imagen y foto_cabecera deberan ser png o jpg
            [['imagen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload_imagen()    
    {
        $this->imagen->saveAs(Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$this->id_mascota.'/posts/'.$this->imagen->name);
    }

}
