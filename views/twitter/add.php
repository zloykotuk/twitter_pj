<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to('add')]
        );?>
<?= $form->field($model, 'id')->textInput(['readonly' => true]) ?>

<?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => 'elonmusk']) ?>

<?= $form->field($model, 'secret') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<script>
    var str = "";
    for ( ; str.length < 32; str += Math.random().toString( 36 ).substr( 2 ) );

    var el = document.getElementById("twitteraddform-id");
    el.value = str.substr( 0, 32 );
</script>
