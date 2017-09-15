<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Posts extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }
}