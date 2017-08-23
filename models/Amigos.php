<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Amigos extends ActiveRecord
{
    public static function tableName()
    {
        return 'amigos';
    }
}