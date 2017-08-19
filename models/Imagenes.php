<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Imagenes extends ActiveRecord
{
    public static function tableName()
    {
        return 'imagenes';
    }
}