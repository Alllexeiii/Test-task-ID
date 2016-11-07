<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\UrlLink;
use app\models\UrlForm;
use app\logic\Parser;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
        ];
    }

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

    public function actionIndex()
    {
		$model = new UrlLink();
		$form = new UrlForm();
		$parser = new Parser();
		if (Yii::$app->request->post()) { 
			$date = Yii::$app->request->post("UrlForm");
			$links = $parser->getAllLink($date["url"]);
			$model->saveData($links, $date["url"]);
		}
		$query = UrlLink::find();
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count()]);
		$listLink = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['id' => SORT_ASK])->all();
		return $this->render('index', [
            'modelForm' => $form,
            'links' => $listLink,
			'pages' => $pages,
        ]);
    }
}
