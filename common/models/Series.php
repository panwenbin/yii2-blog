<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\SeriesGii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * 系列
 * @property User $user
 * @property PostSeriesRelation[] $postSeriesRelations
 * @property string $postTitlesString
 * @package common\models
 */
class Series extends SeriesGii
{
    /**
     * @var string 用于接收日志标题列表，给包含的日志排序
     */
    protected $postTitlesString;

    public function getPostTitlesString()
    {
        if (empty($this->postTitlesString)) {
            $this->postTitlesString = join(',', ArrayHelper::getColumn($this->postSeriesRelations, 'post_title'));
        }
        return $this->postTitlesString;
    }

    public function setPostTitlesString($postTitlesString)
    {
        $this->postTitlesString = $postTitlesString;
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
            ],
        ];
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['postTitlesString', 'string'],
        ]);
    }

    /**
     * 关联User
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * 关联PostSeriesRelation
     * @return \yii\db\ActiveQuery
     */
    public function getPostSeriesRelations()
    {
        return $this->hasMany(PostSeriesRelation::className(), ['series_id' => 'id'])->orderBy('order');
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        /**
         * 处理PostSeriesRelation
         */
        if ($this->postTitlesString) {
            $postTitles = explode(',', $this->postTitlesString);
            $postSeriesRelations = PostSeriesRelation::findAll(['post_title' => $postTitles]);
            $titleOrder = array_flip($postTitles);
            foreach ($postSeriesRelations as $postSeriesRelation) {
                $postSeriesRelation->order = ArrayHelper::getValue($titleOrder, $postSeriesRelation->post_title, 0);
                $postSeriesRelation->save();
            }
        }
    }
}