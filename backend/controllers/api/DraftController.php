<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace backend\controllers\api;


use common\models\Draft;
use Yii;
use yii\filters\AccessControl;
use yii\rest\Controller;

class DraftController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * 自动保存草稿
     * @param null $id
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function actionAuto($id = null)
    {
        /* @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        if ($id) {
            $draft = Draft::findOne($id);
        }
        if (empty($draft)) {
            $draft = new Draft();
        }

        $data = Yii::$app->request->post() + ['user_id' => $user->id];

        if ($draft->load($data, '') && $draft->validate()) {
            if ($draft->isBigChange()) {
                $draft->id = null;
                $draft->setIsNewRecord(true);
            }
            if ($draft->save()) {
                return [
                    'code' => 200,
                    'id' => $draft->id,
                    'time' => Yii::$app->formatter->asDatetime($draft->updated_at),
                ];
            }
        }

        $errors = $draft->getFirstErrors();
        if ($errors) {
            return [
                'code' => 400,
                'message' => current($errors)[0],
            ];
        }
    }
}