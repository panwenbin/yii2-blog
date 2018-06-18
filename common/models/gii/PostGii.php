<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $title 标题
 * @property string $content 内容
 * @property int $created_at 发布时间
 * @property int $updated_at 修改时间
 * @property int $archive_of_id 是哪篇的存档
 * @property int $status 状态
 */
class PostGii extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at', 'archive_of_id', 'status'], 'integer'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'content' => '内容',
            'created_at' => '发布时间',
            'updated_at' => '修改时间',
            'archive_of_id' => '是哪篇的存档',
            'status' => '状态',
        ];
    }
}
