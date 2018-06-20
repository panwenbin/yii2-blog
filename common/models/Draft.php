<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\DraftGii;
use yii\behaviors\TimestampBehavior;

/**
 * 草稿
 * @package common\models
 */
class Draft extends DraftGii
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
            ]
        ];
    }

    /**
     * @inheritdoc
     * @return DraftQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DraftQuery(get_called_class());
    }

    /**
     * 是否重大改变
     * @return bool
     */
    public function isBigChange()
    {
        $lenChanged = abs(strlen($this->content) - strlen($this->getOldAttribute('content')));
        if ($lenChanged > 100) {
            return true;
        }
        return false;
    }

    /**
     * 关联User
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}