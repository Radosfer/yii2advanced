<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HousePrice */

$this->title = 'Изменить оплату за дом';
$this->params['breadcrumbs'][] = ['label' => 'Цена оплаты дома', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
