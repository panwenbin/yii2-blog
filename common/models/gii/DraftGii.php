<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%draft}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $post_id 日志ID
 * @property string $title 标题
 * @property string $tags 标签
 * @property string $content 草稿内容
 * @property int $updated_at 修改时间
 */
class DraftGii extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%draft}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'content'], 'required'],
            [['user_id', 'post_id', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title', 'tags'], 'string', 'max' => 255],
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
            'post_id' => '日志ID',
            'title' => '标题',
            'tags' => '标签',
            'content' => '草稿内容',
            'updated_at' => '修改时间',
        ];
    }
}
