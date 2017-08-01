<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Измените текст формы "Контакты"</p>

    <div class="row">
        <div>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'contact')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'full'
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
