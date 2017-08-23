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
class BuscarmascotasForm extends Model
{
    public $nombre;
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
            'hogar' => '¿Donde quieres buscar mascotas?'
        ];
    }

}
