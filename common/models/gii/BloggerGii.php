<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%blogger}}".
 *
 * @property int $id
 * @property string $name 博客名称
 * @property string $index_url 列表网址
 * @property string $post_regexp 文章地址匹配规则
 * @property string $title_regexp 标题匹配规则
 * @property string $content_regexp 内容匹配规则
 */
class BloggerGii extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blogger}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'index_url'], 'required'],
            [['name', 'index_url', 'post_regexp', 'title_regexp', 'content_regexp'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '博客名称',
            'index_url' => '列表网址',
            'post_regexp' => '文章地址匹配规则',
            'title_regexp' => '标题匹配规则',
            'content_regexp' => '内容匹配规则',
        ];
    }
}
