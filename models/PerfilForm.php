<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * PerfilForm.
 *
 *
 */
class PerfilForm extends Model
{
    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $descripcion;
    public $foto_perfil;
    public $foto_cabecera;
    public $password_actual;
    public $password_nueva;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email must be email
            ['email','email'],
            // id, nombre, apellidos y descripcion no necesitan verificacion
            [['id','nombre','apellidos','descripcion','password_nueva'],'default'],
            // la contraseña actual debe ser obligatoria
            ['password_actual','required'],
            ['password_actual', 'validatePassword'],
            //foto_perfil y foto_cabecera deberan ser png o jpg
            [['foto_perfil'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['foto_cabecera'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload_perfil()
    {
        if ($this->validate()) {
            $this->foto_perfil->saveAs(Yii::$app->params['urlBaseImg'].'usuarios/usuario-'.Yii::$app->user->identity->id.'/foto_perfil.' . $this->foto_perfil->extension);
            return true;
        } else {
            return false;
        }
    }

    public function upload_cabecera()
    {
        if ($this->validate()) {
            $this->foto_cabecera->saveAs(Yii::$app->params['urlBaseImg'].'usuarios/usuario-'.Yii::$app->user->identity->id.'/foto_cabecera.' . $this->foto_cabecera->extension);
            return true;
        } else {
            return false;
        }
    }

    public function validatePassword($attribute, $params)
    {
        if(!(crypt($this->password_actual, Yii::$app->params['salt']) === Yii::$app->user->identity->password)){
            $this->addError($attribute, 'La contraseña introducida no es tu contraseña actual');
        }
    }

}
