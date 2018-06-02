<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
    //利用command返回数组

    //利用ActiveRecord返回的对象构建下拉数组
//    $obj = \common\models\Poststatus::find()->all();
//    $allstatus = \yii\helpers\ArrayHelper::map($obj,'id','name');


    //利用Query构建下拉数组[1=>'状态',...]
    $allstatus = (new \yii\db\Query())
    ->select(['name','id'])
    ->from('poststatus')
//    ->orderBy('id')
        ->indexBy('id')
        ->column();

//    var_dump($allstatus);
//    exit(0);


    ?>
    <?=$form->field($model,'status')->dropDownList($allstatus,['prompt'=>'请选择状态']) ?>


    <?= $form->field($model, 'author_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
