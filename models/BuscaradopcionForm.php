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
class BuscaradopcionForm extends Model
{
    public $animal;
    public $raza;
    public $sexo;
    public $provincia;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Campo obligatorio
            [['animal'],'default'],
            // Estos campos no necesitan verificacion
            [['animal','sexo','raza','provincia'],'default'],
        ];
    }
    
}
