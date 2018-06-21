<?php

namespace backend\controllers;

use common\helpers\UrlHelper;
use common\models\Blogger;
use common\models\BloggerSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BloggerController implements the CRUD actions for Blogger model.
 */
class BloggerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blogger models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BloggerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blogger model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * 抓取列表
     * @param $id
     * @return string|NotFoundHttpException
     * @throws NotFoundHttpException
     */
    public function actionFetchIndex($id)
    {
        $blogger = $this->findModel($id);
        $html = file_get_contents($blogger->index_url);
        $posts = [];
        if (preg_match_all($blogger->post_regexp, $html, $matches)) {
            if (!isset($matches['url'])) {
                $matches['url'] = $matches[1];
            }
            if (!isset($matches['title'])) {
                $matches['title'] = isset($matches[2]) ? $matches[2] : $matches[1];
            }
            $count = count($matches[0]);
            for ($i = 0; $i < $count; $i++) {
                $posts[] = [
                    'url' => $matches['url'][$i],
                    'title' => $matches['title'][$i],
                ];
            }
        } else {
            return new NotFoundHttpException('未匹配到日志地址');
        }

        return $this->render('fetch-index', [
            'blogger' => $blogger,
            'posts' => $posts,
        ]);
    }

    /**
     * 抓取日志
     * @param $id
     * @param $url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionFetchPost($id, $url)
    {
        $blogger = $this->findModel($id);
        $postUrl = UrlHelper::urlAbsolutely($url, $blogger->index_url);
        $contentPrefix = "> 转载自：{$blogger->name}，[原文地址：{$postUrl}]({$postUrl})  \r\n\r\n";
        $post = file_get_contents($postUrl);
        $title = preg_match($blogger->title_regexp, $post, $match) ? $match[1] : '';
        $content = preg_match($blogger->content_regexp, $post, $match) ? $match[1] : '';
        $content = $contentPrefix . html_entity_decode(trim(strip_tags($content)));

        return $this->render('fetch-post', [
            'blogger' => $blogger,
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     * Creates a new Blogger model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blogger();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Blogger model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Blogger model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blogger model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blogger the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blogger::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
