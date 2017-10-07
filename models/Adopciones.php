<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Adopciones extends ActiveRecord
{
    public static function tableName()
    {
        return 'adopciones';
    }
}