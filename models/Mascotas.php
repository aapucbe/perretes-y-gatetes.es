<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Mascotas extends ActiveRecord
{
    public static function tableName()
    {
        return 'mascotas';
    }
}