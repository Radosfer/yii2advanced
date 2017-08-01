<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Garden */

$this->title = 'Зарегистрировать новую организацию';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_house_price' => $model_house_price,
    ]) ?>

</div>
