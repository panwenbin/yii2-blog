<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace backend\models;


use common\models\Draft;
use Yii;

class DraftForm extends Draft
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['user_id', 'equalToIdentity', 'skipOnEmpty' => true],
        ]);
    }

    public function equalToIdentity($attribute, $model)
    {
        /* @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        if($this->$attribute != $user->id) {
            $this->addError($attribute, '此草稿不属于您');
        }
    }
}