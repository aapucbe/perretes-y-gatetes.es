<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Peticiones extends ActiveRecord
{
    public static function tableName()
    {
        return 'peticiones';
    }
}