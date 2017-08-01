<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Garden;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HousePriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цена оплаты объекта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-price-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'garden_id',
                'filter' => Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
                'format' => 'text',
                'value' => function ($model, $key, $index, $column) {
                    return $model->GardenName;
                }
            ],

            'price',
            'created_at:datetime',

        ],
    ]); ?>
</div>
