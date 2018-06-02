<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = "权限管理";
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => \common\models\Adminuser::findIdentity($id)->username, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = '权限修改';
?>

<div class="adminuser-privilege-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>


    <?= Html::checkboxList('newPri',$AuthAssignmentArray,$allPrivilegeArray)?>

    <div class="form-group">
        <?= Html::submitButton('修改', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>





