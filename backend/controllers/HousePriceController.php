<?php

namespace backend\controllers;

use Yii;
use common\models\HousePrice;
use app\models\HousePriceSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 *  HousePriceController implements the CRUD actions for HousePrice model.
 */
class HousePriceController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all HousePrice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HousePriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new HousePrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HousePrice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


}
