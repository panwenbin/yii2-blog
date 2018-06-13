<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%post_series_relation}}".
 *
 * @property int $id
 * @property string $post_title 日志标题
 * @property int $series_id 系列ID
 * @property int $order 顺序
 */
class PostSeriesRelationGii extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_series_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_title'], 'required'],
            [['series_id', 'order'], 'integer'],
            [['post_title'], 'string', 'max' => 255],
            [['post_title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_title' => '日志标题',
            'series_id' => '系列ID',
            'order' => '顺序',
        ];
    }
}
