<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Garden */

$this->title = 'Зарегистрировать новое садоводчество';
$this->params['breadcrumbs'][] = ['label' => 'Садоводчества', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
