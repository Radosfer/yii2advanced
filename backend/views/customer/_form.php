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

        <?php if ($model->isNewRecord()) { ?>

        <?= $form->field($model, 'password')->passwordInput(); } else {?>

        <?=  $form->field($model, 'password')->passwordInput()->hiddenInput(['value'=>''])->label(false); }?>

        <?= $form->field($model, 'garden_id')->dropdownList(
            Garden::find()->select(['garden_name', 'id'])->indexBy('id')->column(),
            ['prompt'=>'Выберите Организацию']);?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord() ? 'Зарегистрировать' : 'Изменить', ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <!-- Button trigger modal -->
        <div class="form-group">
            <?= !$model->isNewRecord() ? Html::submitButton( 'Изменить пароль', ['class' => 'btn btn-success', 'data-toggle' => "modal", 'data-target' => "#myModal", 'id' => 'modalpassword']): '' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Введите пароль из не менее 6-и символов</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo Html::textInput('password','',['class'=>'form-control','id'=>'input-password']); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary" id="okpassword"">Сохранить изменения</button>
                    </div>
                </div>
            </div>
            </form>
        </div>



    </div>
</div>

<?php $this->registerJs(
    "$('#modalpassword').on('click',function(event){
        $('#input-password').val('');
        });
        $('#myModal').on('shown.bs.modal',function(event){
        $('#input-password').focus();
        });      
        $('#myModal form').on('submit',function(event){
        let str = $('#input-password').val();
        if (str.length>5) { 
        $('#customerupdate-password').val(str);
        $('#myModal').modal('hide');
        }
        return false;
        });

    ",\yii\web\View::POS_READY);
/*        if (str.trim() !== ''){
            $(this).dialog( \"close\" );
           window.location.href = '".Url::to(['/orders/order/set'])."?id='+id+'&field=status&value=9&tracknometr='+str;
        } else {
            $('#trackometr-error-'+id).text('Значение трекнометра не должно быть пустым');
        }
*/

?>