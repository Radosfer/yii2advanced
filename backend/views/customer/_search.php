<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_name') ?>

    <?= //$form->field($model, 'auth_key') ?>

    <?= //$form->field($model, 'password_hash') ?>

    <?= //$form->field($model, 'password_reset_token') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php  echo $form->field($model, 'status') ?>

    <?php  echo $form->field($model, 'created_at') ?>

    <?php  echo $form->field($model, 'updated_at') ?>

    <?php  echo $form->field($model, 'money') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
