<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '评论管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除此项评论吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
//            'status',
            ['attribute' => 'status',
            'value' => $model->status0->name,],
//            'create_time:datetime',
            ['attribute' => 'create_time',
            'format' => ['date','php:y-m-d H:i:s'],],
//            'userid',
            ['attribute' => 'userid',
            'value' => $model->user->username,],
            'email:email',
            'url:url',
//            'post_id',
            ['attribute' => 'post_id',
                'value' => $model->post->title,],
        ],
    ]) ?>

</div>
