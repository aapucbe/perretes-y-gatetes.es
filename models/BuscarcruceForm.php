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
class BuscarcruceForm extends Model
{
    public $animal;
    public $raza;
    public $sexo;
    public $hogar;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Campo obligatorio
            [['animal'],'default'],
            // Estos campos no necesitan verificacion
            [['animal','sexo','raza','hogar'],'default'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'hogar' => '¿Donde quieres buscar mascotas?',
            'raza' => '¿Con que raza quieres cruzarte?'
        ];
    }

}
