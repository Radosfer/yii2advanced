<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use common\models\Garden;
use common\models\customer;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GardensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Садоводчества';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardens-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Зарегистрировать новое садоводчество', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form = ActiveForm::begin(); ?>

   <?php // $form->field($dataProvider, 'pagination')->dropdownList([10=>'10', 20=>'20', 30=>'40', 40=>'100', 50=> 'Все']); ?>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                'attribute' => 'garden_name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    /** @var Customer $model */
                    return Html::a(Html::encode($model->garden_name), ['view', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'status',
                'filter' => Garden::getStatusesArray(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->StatusName;
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'till_date:datetime',
            [
            'attribute' => 'money',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                $value = $model->money;
                switch ($value) {
                    case $value>0:
                        $class = 'success';
                        break;
                    case $value<0:
                    default: $class = 'danger';
                        break;
                };
                $html = Html::tag('span', Html::encode($model->money), ['class' => 'label label-' . $class]);
                return $value === null ? $column->grid->emptyCell : $html;
            }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
            //    'header'=>'Действия',
             //   'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}',
    'buttons' =>[
    'delete' => function ($url,$model)
    {

    if ($model->status)
    {
        if ($model->customers)
        { $confirm = ' Будет установлен статус "ЗАБЛОКИРОВАН"  ' . $model->getCustomers()->count() . '  пользователям при изменении статуса садоводчества  ' . $model->garden_name . '  на "ЗАБЛОКИРОВАНО"' .
            ', уверены что хотите установить статус "ЗАБЛОКИРОВАН" ?'; }
        else
        { $confirm = ' Пользователей данного садоводчества нет, уверены что хотите установить статус "ЗАБЛОКИРОВАН" ?'; }

        return Html::a('<span class="glyphicon glyphicon-minus"></span>', ['delete', 'id' => $model->id],
            [
                'class' => 'delete-link',
                'title' => 'Заблокировать садоводчество',
                'data' => [
                'confirm' => $confirm,
                'method' => 'post',
                ],
            ]);
    }
    else {

        if ($model->customers)
        { $confirm = ' Будет установлен статус "АКТИВЕН"  ' . $model->getCustomers()->count() . '  пользователям при изменении статуса садоводчества  ' . $model->garden_name . '  на "АКТИВЕН"' .
            ', уверены что хотите установить статус "АКТИВЕН" ?'; }
        else
        { $confirm = ' Пользователей данного садоводчества нет, уверены что хотите установить статус "АКТИВЕН" ?'; }

        return Html::a('<span class="glyphicon glyphicon-plus"></span>', ['undelete', 'id' => $model->id],
            [
            'class' => 'delete-link',
            'title' => 'Разблокировать садоводчество',
            'data' => [
                'confirm' => $confirm,
                'method' => 'post',
            ],
            ]);
        }
    }
            ]
                ],
                        ],
    ]); ?>
</div>
