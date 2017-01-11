<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%post_tag_relation}}".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $tag_id
 */
class PostTagRelationGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_tag_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => '日志ID',
            'tag_id' => 'TagID',
        ];
    }
}
