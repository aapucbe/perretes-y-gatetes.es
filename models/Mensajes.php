<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Mensajes extends ActiveRecord
{
    public static function tableName()
    {
        return 'mensajes';
    }
}