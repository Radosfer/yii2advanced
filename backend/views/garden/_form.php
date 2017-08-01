 <?php

use common\models\Garden;
use common\models\HousePrice;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Garden */
/* @var $form yii\widgets\ActiveForm */

//Создаем массив для выбора Бесплатного периода
$FREE_PERIOD = [];
$nowtime = new DateTime();

$FREE_PERIOD[Yii::$app->formatter->asDate($nowtime)] = 'Нет';

 $nowtime = new DateTime();
$nowtime->add(new DateInterval('P15D'));
$FREE_PERIOD[Yii::$app->formatter->asDate($nowtime)] = '15 Дней';

 $nowtime = new DateTime();
$nowtime->add(new DateInterval('P30D'));
$FREE_PERIOD[Yii::$app->formatter->asDate($nowtime)] = '30 Дней';

 $nowtime = new DateTime();
$nowtime->add(new DateInterval('P45D'));
$FREE_PERIOD[Yii::$app->formatter->asDate($nowtime)] = '45 Дней';

 $nowtime = new DateTime();
$nowtime->add(new DateInterval('P90D'));
$FREE_PERIOD[Yii::$app->formatter->asDate($nowtime)] = '90 Дней';
?>

 <?php
 //Если ошибки при записи истории
 if ($model->getErrors())
 {
     echo Html::tag('h1', Html::encode('ОШИБКА ПРИ ЗАПИСИ '), ['class' => '\'btn-lg btn-block btn-danger']);
     echo Html::tag('h1', Html::encode('Таблица базы данных - '.Garden::tableName().' '), ['class' => '\'btn-lg btn-block btn-danger']);

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


<div class="col-lg-5">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'garden_name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'till_date')->dropdownList($FREE_PERIOD)->label('Пробный период') ?>

    <?= $form->field($model, 'status')->dropdownList([Garden::STATUS_ACTIVE => 'Активно',
        Garden::STATUS_BLOCKED => 'Заблокировано']); ?>

    <?= $form->field($model_house_price, 'price')->textInput(['value' => HousePrice::find()->select('price')->where(['garden_id' => $model->id])->orderBy(['id' => SORT_DESC])->scalar()]) ?>

    <?= $form->field($model_house_price, 'garden_id')->hiddenInput(['value'=>$model->id])->label(false)  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
