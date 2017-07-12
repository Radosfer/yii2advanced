<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Garden;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<p>Пожалуйста введите данные пользователя:</p>

<?php
//Если ошибки при записи истории
if ($model->getErrors())
{
    echo Html::tag('h1', Html::encode('ОШИБКА ПРИ ЗАПИСИ '), ['class' => '\'btn-lg btn-block btn-danger']);
    echo Html::tag('h1', Html::encode('Таблица базы данных - '.Customer::tableName().' '), ['class' => '\'btn-lg btn-block btn-danger']);

    echo Html::beginTag("ul");
    foreach ($model->getErrors() as $key=>$error)
    {
        echo Html::tag("li",Html::encode("Поле - $key"));
        foreach ($error as $key_er=>$error_er)
        {
            echo Html::tag("p",Html::encode(" Ошибка №$key_er - $error_er"));
        }
    }
    echo Html::endTag("ul");
}
?>


<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'update-customer-form']); ?>

        <?= $form->field($model, 'customer_name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'garden_id')->dropdownList(
            Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
            ['prompt'=>'Выберите Садоводчество']);?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord() ? 'Зарегистрировать' : 'Изменить', ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>


