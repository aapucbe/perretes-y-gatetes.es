<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CrearmascotaForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CrearmascotaForm extends Model
{
    public $nombre;
    public $animal;
    public $raza;
    public $sexo;
    public $fecha_nacimiento;
    public $hogar;
    public $id_usuario;
    public $email_usuario;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        	[['nombre','animal','raza','sexo'],'required'],
        	[['hogar','id_usuario','email_usuario','fecha_nacimiento'],'default'],
        	// Validar fecha_nacimiento como dd/mm/yyyy
            ['fecha_nacimiento', 'match', 'pattern' => "/^(\d{1,2})-(\d{1,2})-(\d{4})$/", 'message' => 'Formato dd-mm-aaaa'],
        ];
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
            'hogar' => '¿Donde vives?'
        ];
    }
}
