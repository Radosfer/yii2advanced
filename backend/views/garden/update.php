<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Garden */

$this->title = 'Изменение Садоводчества: ' . $model->garden_name;
$this->params['breadcrumbs'][] = ['label' => 'Садоводчества', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->garden_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="gardens-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
