<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Garden;
use common\models\Customer;
use yii\web\NotFoundHttpException;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Зарегистрировать нового пользователя', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Денежная история пользователей', ['customer-ammount-history/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
    /*       //Подсветка строки
            'rowOptions' => function ($model, $key, $index, $grid) {
            !$model->status ? $class = 'label-default' : $class = 'label-danger';
            return ['class' => $class];
        },
    */
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       //     'id',
            [
                'attribute' => 'customer_name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    /** @var Customer $model */
                    return Html::a(Html::encode($model->customer_name), ['view', 'id' => $model->id]);
                }
            ],
         //   'auth_key',
         //   'password_hash',
         //   'password_reset_token',
            'email:email',
        //    'status',
            [
                'attribute' => 'status',
                'filter' => Customer::getStatusesArray(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->StatusName;
                },
            ],

            [
                'attribute' => 'garden_id',
                'filter' => Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->GardenName;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
            'attribute' => 'money',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column)
            {
                $value = $model->GardenMoney;
                switch ($value) {
                    case $value>0:
                        $class = 'success';
                        break;
                    case $value<0:
                    default: $class = 'danger';
                        break;
                                };
                $html = Html::tag('span', Html::encode($value), ['class' => 'label label-' . $class]);
                return $value === null ? $column->grid->emptyCell : $html;
            }
            ],

            [
                'label' => 'Пополнение',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        '+',
                        ['addmoney', 'id' => $model->id],
                        [
                            'title' => 'Пополнить',
                        ]
                    );
                }
            ],

            [
             'class' => 'yii\grid\ActionColumn',
             'header'=>'Действия',
             //'headerOptions' => ['width' => '80'],
             'buttons' => [
                           'delete' => function ($url,$model)
                           {
                                   if ($model->status)
                                   {
                                       return Html::a('<span class="glyphicon glyphicon-minus"></span>', ['delete', 'id' => $model->id],
                                           [
                                               'class' => 'delete-link',
                                               'title' => 'Заблокировать пользователя',
                                               'data' => [
                                                   'confirm' => 'Заблокировать пользователя',
                                                   'method' => 'post',
                                               ],
                                           ]);
                                   }
                                   else {
                                       return Html::a('<span class="glyphicon glyphicon-plus"></span>', ['undelete', 'id' => $model->id],
                                           [
                                               'class' => 'delete-link',
                                               'title' => 'Разблокировать садоводчество',
                                               'data' => [
                                                   'confirm' => 'Разблокировать пользователя',
                                                   'method' => 'post',
                                               ],
                                           ]);
                                        }
                           },
                          ],
            ],
        ],
    ]); ?>
</div>
