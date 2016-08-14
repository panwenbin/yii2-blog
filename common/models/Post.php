<?php
/**
 * @author: Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\PostGii;
use yii\behaviors\TimestampBehavior;

class Post extends PostGii
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}