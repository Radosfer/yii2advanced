<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Garden;
use common\models\HousePrice;

/* @var $this yii\web\View */
/* @var $model app\models\HousePrice */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
//Если ошибки при записи истории
if ($model->getErrors())
{
    echo Html::tag('h1', Html::encode('ОШИБКА ПРИ ЗАПИСИ '), ['class' => '\'btn-lg btn-block btn-danger']);
    echo Html::tag('h1', Html::encode('Таблица базы данных - '.HousePrice::tableName().' '), ['class' => '\'btn-lg btn-block btn-danger']);

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


<div class="house-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'garden_id')->dropdownList(
        Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Выберите Садоводчество']); ?>

    <div class="form-group">
        <?= Html::submitButton('Изменить' , ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
