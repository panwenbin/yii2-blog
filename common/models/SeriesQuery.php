<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use Yii;
use yii\base\Event;
use yii\db\ActiveQuery;

class SeriesQuery extends ActiveQuery
{
    public function own()
    {
        /* @var $user \common\models\User */
        $user = Yii::$app->getUser()->getIdentity();
        if ($user && $user->isAdmin() == false) {
            $this->andWhere(['user_id' => $user->id]);
        }
        return $this;
    }

    public static function limitToOwnPosts()
    {
        Event::on(static::className(), SeriesQuery::EVENT_INIT, function ($event) {
            /* @var $postQuery PostQuery */
            $postQuery = $event->sender;
            $postQuery->own();
        });
    }
}