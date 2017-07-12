<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->customer_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этого пользователя, операция необратима ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_name',
        //    'auth_key',
         //   'password_hash',
          //  'password_reset_token',
            'email:email',
          //  'status',
            'created_at:datetime',
            'updated_at:datetime',
            [
            'attribute' => 'garden_id',
            'format' => 'text',
            'value' => $model->GardenName,
            ],
            [
                'attribute' => 'money',
                'format' => 'text',
                'value' => $model->GardenMoney,
            ],

        ],
    ]) ?>

</div>
