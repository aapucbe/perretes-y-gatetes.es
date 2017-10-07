<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Imagenesadopcion extends ActiveRecord
{
    public static function tableName()
    {
        return 'imagenes_adopcion';
    }
}