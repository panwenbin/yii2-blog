<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace backend\models;


class Post extends \common\models\Post
{
    public $makeOldAsArchive;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['makeOldAsArchive'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'makeOldAsArchive' => '作为新版发布，把旧版存档',
        ]);
    }

    public function beforeValidate()
    {
        $this->title = str_replace('/', '', $this->title);
        return parent::beforeValidate();
    }
}