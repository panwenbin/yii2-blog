<?php

namespace backend\controllers;

use backend\models\Post;
use backend\models\PostUpdateForm;
use common\models\Draft;
use common\models\PostSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /* @var $query \common\models\PostQuery */
        $query = $dataProvider->query;
        $query->notArchive();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $draft_id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreate($draft_id = null)
    {
        $model = new Post();
        $model->scenario = 'create';

        if ($draft_id && $draft = $this->findDraft($draft_id)) {
            $model->title = $draft->title;
            $model->content = $draft->content;
            if ($draft->tags) {
                $model->setTagNames(explode(',', $draft->tags));
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 审核日志
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function actionAudit($id)
    {
        /* @var $user \common\models\User */
        $user = Yii::$app->getUser()->getIdentity();
        if ($user->isAdmin() == false) {
            throw new ForbiddenHttpException('只有管理员可以审核日志', 403);
        }
        $model = $this->findModel($id);
        $model->status = Post::STATUS_已审核;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', '已审核日志：' . $model->title);
        } else {
            Yii::$app->session->setFlash('error', '审核日志失败：' . $model->title);
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param null $draft_id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $draft_id = null)
    {
        $model = $this->findModel($id);
        $updatePost = new PostUpdateForm($model);

        if ($draft_id && $draft = $this->findDraft($draft_id)) {
            $model->title = $draft->title;
            $model->content = $draft->content;
            if ($draft->tags) {
                $model->setTagNames(explode(',', $draft->tags));
            }
        }

        if ($updatePost->load(Yii::$app->request->post(), 'Post') && $updatePost->save()) {
            return $this->redirect(['view', 'id' => $updatePost->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('日志未找到');
        }
    }

    /**
     * @param $id
     * @return Draft|null
     * @throws NotFoundHttpException
     */
    protected function findDraft($id)
    {
        if (($model = Draft::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('草稿未找到');
        }
    }
}
