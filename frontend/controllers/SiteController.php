<?php

namespace frontend\controllers;

use common\components\DiffRendererHtmlInline;
use common\models\LoginForm;
use common\models\Post;
use common\models\PostSearch;
use common\models\PostSeriesRelation;
use common\models\Series;
use common\models\Tag;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index'],
                'lastModified' => function ($action, $params) {
                    $id = Yii::$app->getRequest()->get('id');
                    $title = Yii::$app->getRequest()->get('title');
                    $post = Post::findPostByIdOrTitle($id, $title);
                    return $post->updated_at;
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @param null $id
     * @param null $title
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex($id = null, $title = null)
    {
        $post = Post::findPostByIdOrTitle($id, $title);
        $relatedPostIds = $post->getRelatedPostTagRelations()
            ->select('post_id')
            ->andWhere(['not', ['post_id' => $post->id]])
            ->groupBy('post_id')
            ->orderBy('count(post_id) desc')
            ->column();
        $relatedPosts = Post::find()
            ->andWhere(new Expression('FIND_IN_SET(id, :ids)', [':ids' => join(',', $relatedPostIds)]))
            ->select('title, created_at')->notArchive()->limit(10)->all();
        $postSeriesRelation = PostSeriesRelation::findOne(['post_title' => $post->title]);
        $series = $postSeriesRelation ? $postSeriesRelation->series : null;

        return $this->render('index', [
            'id' => $id,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'series' => $series,
        ]);
    }

    /**
     * @param $condition
     * @return Tag|null
     * @throws NotFoundHttpException
     */
    protected function findTagThrow($condition)
    {
        $tag = Tag::findOne($condition);
        if (is_null($tag)) {
            throw new NotFoundHttpException('标签未找到');
        }
        return $tag;
    }

    /**
     * @param $tag
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTag($tag)
    {
        $tag = $this->findTagThrow(['name' => $tag]);

        return $this->render('tag', [
            'tag' => $tag,
        ]);
    }

    /**
     * @param $title
     * @return Series|null
     * @throws NotFoundHttpException
     */
    protected function findSeriesThrow($title)
    {
        $series = Series::findOne(['title' => $title]);
        if (is_null($series)) {
            throw new NotFoundHttpException('系列未找到');
        }
        return $series;
    }

    /**
     * @param $title
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSeries($title)
    {
        $series = $this->findSeriesThrow(['title' => $title]);

        return $this->render('series', [
            'series' => $series,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', '感谢您联系我，我会尽快回复您。');
            } else {
                Yii::$app->session->setFlash('error', '发送邮件时发生错误！');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $aboutMd = Post::find()->andWhere(['title' => 'about'])->orderBy('created_at DESC')->one();

        return $this->render('about', [
            'aboutMd' => $aboutMd,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionSignup()
    {
        if (ArrayHelper::getValue(Yii::$app->params, 'signupDisabled')) {
            throw new ForbiddenHttpException('注册通道暂时关闭！如有需要，请联系博主。', 403);
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionSearch($s)
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search([]);
        /* @var $query \common\models\PostQuery */
        $query = $dataProvider->query;
        $query->andWhere(['or', ['like', 'title', $s], ['like', 'content', $s]])->notArchive()->orderRecent();

        return $this->render('search', [
            's' => $s,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * 查看日志的markdown文本差异
     * 在模态框中加载
     * @param $id1
     * @param $id2
     * @return string
     */
    public function actionDiff($id1, $id2)
    {
        $posts = Post::findAll(['id' => [$id1, $id2]]);
        if (count($posts) != 2) {
            $diffRender = false;
        } else {
            $lines1 = explode("\n", $posts[0]->content);
            $lines2 = explode("\n", $posts[1]->content);
            array_walk($lines1, function (&$line) {
                $line = trim($line);
            });
            array_walk($lines2, function (&$line) {
                $line = trim($line);
            });
            $diff = new \Diff($lines1, $lines2);
            $renderer = new DiffRendererHtmlInline;
            $diffRender = $diff->Render($renderer);
        }

        return $this->renderPartial('diff', ['diff' => $diffRender]);
    }
}
