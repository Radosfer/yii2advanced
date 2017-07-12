<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Garden;
/* @var $this yii\web\View */
/* @var $model app\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'street_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'testimony')->textInput() ?>

    <?= $form->field($model, 'start_value')->textInput() ?>

    <?= $form->field($model, 'last_indication')->textInput() ?>

    <?= $form->field($model, 'spent')->textInput() ?>

    <?= $form->field($model, 'garden_id')->dropdownList(
        Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Выберите Садоводчество']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
