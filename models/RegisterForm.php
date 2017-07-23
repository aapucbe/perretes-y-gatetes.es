<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $nombre;
    public $apellidos;
    public $email;
    public $password;
    public $repeat_password;

    private $_user = false;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // nombre, email, password and repeat_password are required
            [['nombre','apellidos', 'email','password','repeat_password'], 'required'],
            // email must be an email
            ['email','email'],
            // comprobar que no existe un email ya registrado
            ['email','validateEmail'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['repeat_password', 'validatePassword'],
        ];
    }

    /**
     * Validates that password is equals than the repeat_password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if(!($this->password === $this->repeat_password)){
            $this->addError($attribute, 'Las contraseñas no coinciden');
        }
    }

    /**
     * Comprobamos que no existe un usuario con ese email ya registrado
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        $user = $this->getUser();

        if($user){
            $this->addError($attribute, 'Ya existe un usuario registrado con ese email');
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuarios::findByEmail($this->email);
        }

        return $this->_user;
    }

    /**
    * Registra un nuevo usuario en la BD
    * Guardamos la contraseña cifrado con un salt
    * Creamos las carpetas necesarias para guardar las imagenes del usuario
    */
    public function registrar(){

            /**
             * Guardado de los datos del usuario
             */
            $usuario = new Usuarios();
            $usuario->nombre = $this->nombre;
            $usuario->apellidos = $this->apellidos;
            $usuario->email = $this->email;
            $usuario->password = crypt($this->password, Yii::$app->params['salt']);

            /**
             * Guardamos las imagenes de cabecera y perfil por defecto
             */
            $usuario->foto_perfil = "perfil-default.png";
            $usuario->foto_cabecera = "jumbotron-default.png";

            /**
             * Guardamos los datos
             */
            $usuario->save();

            /**
             * Creacion de las carpetas necesarias para las imagenes
             */
            $dir = Yii::$app->params['urlBaseImg'].'/usuarios/usuario-'.$usuario->id;
            mkdir($dir, 0777, true);
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
            'repeat_password' => 'Repite la contraseña',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

}