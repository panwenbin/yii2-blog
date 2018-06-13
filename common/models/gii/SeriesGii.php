<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%series}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $title 标题
 * @property string $preface 序言
 * @property int $updated_at 更新时间
 */
class SeriesGii extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%series}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'updated_at'], 'integer'],
            [['preface'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'title' => '标题',
            'preface' => '序言',
            'updated_at' => '更新时间',
        ];
    }
}
