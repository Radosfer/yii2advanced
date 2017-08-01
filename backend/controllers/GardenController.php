<?php

namespace backend\controllers;

use Yii;
use common\models\Garden;
use common\models\Customer;
use common\models\HousePrice;
use app\models\GardenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
/**
 * GardensController implements the CRUD actions for Gardens model.
 */
class GardenController extends Controller
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
     * Lists all Gardens models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GardenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gardens model.
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
     * Creates a new Gardens model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Garden();
        $model_house_price = new HousePrice ();

        if ($model->load(Yii::$app->request->post()) && $model->save() && $model_house_price->load(Yii::$app->request->post())) {
            $model_house_price->garden_id = $model->id;
            if ($model_house_price->save()){
                return $this->redirect(['index']);
            }
        }
                return $this->render('create', [
                'model' => $model,
                'model_house_price' => $model_house_price,
            ]);
    }

    /**
     * Updates an existing Gardens model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_house_price = new HousePrice ();

        if ($model->load(Yii::$app->request->post()) && $model->save() && $model_house_price->load(Yii::$app->request->post()) && $model_house_price->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_house_price' => $model_house_price,
            ]);
        }
    }

    /**
     * Deletes an existing Gardens model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //Не удаляем а меняем статус
        $garden = $this->findModel($id);
        $garden->status = Garden::STATUS_BLOCKED;
        $garden->save();
        Customer::updateAll(['status' => Customer::STATUS_BLOCKED], ['like', 'garden_id', $id]);

       // $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionUndelete($id)
    {
        $garden = $this->findModel($id);
        $garden->status = Customer::STATUS_ACTIVE;
        $garden->save();
        Customer::updateAll(['status' => Customer::STATUS_ACTIVE], ['like', 'garden_id', $id]);
        // $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    /**
     * Finds the Gardens model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gardens the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Garden::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
