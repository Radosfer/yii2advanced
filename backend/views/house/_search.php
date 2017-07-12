<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'street_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'fio') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'testimony') ?>

    <?php // echo $form->field($model, 'start_value') ?>

    <?php // echo $form->field($model, 'last_indication') ?>

    <?php // echo $form->field($model, 'spent') ?>

    <?php // echo $form->field($model, 'garden_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
