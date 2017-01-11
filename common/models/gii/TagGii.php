<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property integer $id
 * @property string $name
 */
class TagGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tag名称',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TagQuery(get_called_class());
    }
}
