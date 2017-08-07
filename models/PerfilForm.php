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
    public $fecha_nacimiento;
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
            // Estos campos no necesitan verificacion
            [['id','nombre','apellidos','descripcion','password_nueva','fecha_nacimiento'],'default'],
            // Validar fecha_nacimiento como dd/mm/yyyy
             ['fecha_nacimiento', 'match', 'pattern' => "/^(\d{1,2})-(\d{1,2})-(\d{4})$/", 'message' => 'Formato dd-mm-aaaa'],
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

    /**
     * Returns the attribute labels.
     *
     * See Model class for more details
     *  
     * @return array attribute labels (name => label).
     */
    public function attributeLabels()
    {
        return [
            'fecha_nacimiento' => 'Fecha de nacimiento (dd-mm-aaaa)',
        ];
    }

}
