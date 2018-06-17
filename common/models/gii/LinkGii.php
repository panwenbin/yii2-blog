<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%link}}".
 *
 * @property int $id
 * @property string $name 站点名称
 * @property string $url 站点网址
 * @property int $created_at 添加时间
 */
class LinkGii extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['created_at'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '站点名称',
            'url' => '站点网址',
            'created_at' => '添加时间',
        ];
    }
}
