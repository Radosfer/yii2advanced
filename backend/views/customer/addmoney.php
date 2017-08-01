<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CustomerAmmountHistory;


/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
<h1>Пополнение счета пользователя <?= Html::encode($model->customer_name) ?></h1>
<p>Пожалуйста введите необходимую сумму денег: </p>


<?php
    //Если ошибки при записи истории
    if ($model->customerAmmountHistory->getErrors())
    {
    echo Html::tag('h1', Html::encode('ОШИБКА ПРИ ЗАПИСИ '), ['class' => '\'btn-lg btn-block btn-danger']);
    echo Html::tag('h1', Html::encode('Таблица базы данных - '.CustomerAmmountHistory::tableName().' '), ['class' => '\'btn-lg btn-block btn-danger']);

       echo Html::beginTag("ul");
        foreach ($model->customerAmmountHistory->getErrors() as $key=>$error)
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

        <?= $form->field($model, 'money')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>


