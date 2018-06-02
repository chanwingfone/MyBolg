<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Comment */

//$this->title = '新增评论';
//$this->params['breadcrumbs'][] = ['label' => '评论管理', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-form">

    <?php $form = ActiveForm::begin([
        'action'=>['post/detail','id'=>$id,'#'=>'comments'],
        'method'=>'post',
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($postModel,'content')->textarea(['rows'=>4]);?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

