<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Garden;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дома';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create House', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'street_id',
           // 'group_id',
            'title',
            'fio',
            'phone',
            // 'money',
            // 'testimony',
            // 'start_value',
            // 'last_indication',
            // 'spent',
            [
                'attribute' => 'garden_id',
                'filter' => Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->GardenName;
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
