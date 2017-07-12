<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\CustomerAmmountHistory;
use common\models\Customer;
use common\models\Garden;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerAmmountHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Денежная история пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-ammount-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            [
                'attribute' => 'customer_id',
                'filter' => Customer::find()->select(['customer_name', 'id'])->indexBy('id')->column(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return ($model->customer_id == 0)? '-' : $model->customerName;
                }
            ],

            [
                'attribute' => 'garden_id',
                'filter' => Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->GardenName;
                }
            ],


            [
                'attribute' => 'operation',
                'filter' => CustomerAmmountHistory::getOperationArray(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->operationName;
                },
            ],

            'admin',
            'operation_money',
            'created_at:datetime',

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
