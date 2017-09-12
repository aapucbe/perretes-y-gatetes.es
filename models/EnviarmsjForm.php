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
class EnviarmsjForm extends Model
{
    public $amigos;
    public $asunto;
    public $mensaje;
    public $id_mascota;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Campo obligatorio
            [['amigos','asunto','mensaje','id_mascota'],'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'amigos' => 'Seleccionar amigo'
        ];
    }

}
