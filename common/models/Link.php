<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\LinkGii;
use yii\behaviors\TimestampBehavior;

/**
 * 友情链接
 * @package common\models
 */
class Link extends LinkGii
{
    /**
     * 缓存的友情链接
     * @return array
     * @throws \Throwable
     */
    public static function cachedLinks()
    {
        return self::getDb()->cache(function ($db) {
            return self::find()->select('name, url')->asArray()->all();
        });
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }
}