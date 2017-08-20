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
class SubirimagenForm extends Model
{
    public $imagen;
    public $id_mascota;
    public $id_album;    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Estos campos no necesitan verificacion
            [['id_mascota','id_album'],'required'],
            //imagen y foto_cabecera deberan ser png o jpg
            [['imagen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload_imagen($id)
    {

        if ($this->validate()) {
            if($this->id_album == 0){
                $this->imagen->saveAs(Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$this->id_mascota.'/imagenes/'.$id.'-'.$this->imagen->name);
                return true;
            }else {
                $this->imagen->saveAs(Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$this->id_mascota.'/albumes/album-'.$this->id_album.'/'.$id.'-'.$this->imagen->name);
                return true;
            }

        } else {
            return false;
        }
    }

}
