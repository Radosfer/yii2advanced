<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Garden */

$this->title = 'Изменение организации:  ' . $model->garden_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение организации: ' . $model->garden_name;
?>
<div class="gardens-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_house_price' => $model_house_price,
    ]) ?>

</div>
