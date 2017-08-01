<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model app\models\Gardens */

$this->title = $model->garden_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardens-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if (Customer::findOne(['garden_id' => $model->id]))
            {
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => ' Будут удалены  '.$model->getCustomers()->count().'  пользователя при удалении организации '.$model->garden_name.
                    ', уверены что хотите удалить его ?',
                'method' => 'post',
                ],
            ]);
            }
        else {
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => ' Пользователей данной организации нет, уверены что хотите удалить его ?',
                    'method' => 'post',
                ],
            ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'garden_name',
            'created_at:datetime',
            'updated_at:datetime',
            'till_date',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => $model->StatusName,
            ],
            'money',
        ],
    ]) ?>

</div>
