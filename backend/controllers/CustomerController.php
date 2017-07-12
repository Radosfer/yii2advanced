<?php

namespace backend\controllers;

use app\models\CustomerUpdate;
use app\models\CustomerAddMoney;
use Yii;
use common\models\Customer;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $customer = new Customer();
        $model = new CustomerUpdate($customer);

        if ($model->load(Yii::$app->request->post())&& $model->update()) {
            return $this->redirect(['view', 'id' => $customer->getId()]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $customer = $this->findModel($id);
        $model = new CustomerUpdate($customer);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddmoney($id)
    {

        $customer = $this->findModel($id);
        $model = new CustomerAddMoney($customer);

        if ($model->load(Yii::$app->request->post()) && $model->addmoney()) {
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('addmoney', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
     //   $this->findModel($id)->delete();
        $customer = $this->findModel($id);
        $customer->status = Customer::STATUS_BLOCKED;
        $customer->save();
        return $this->redirect(['index']);
    }

    public function actionUndelete($id)
    {
        //   $this->findModel($id)->delete();
        $customer = $this->findModel($id);
        $customer->status = Customer::STATUS_ACTIVE;
        $customer->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
