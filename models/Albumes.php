<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Albumes extends ActiveRecord
{
    public static function tableName()
    {
        return 'albumes';
    }
}