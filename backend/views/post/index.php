<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                 'contentOptions' => ['width'=>'30px'],
            ],
            'title',
            ['attribute' => 'authorName',
                'label' => '作者',
                'contentOptions' => ['width'=>'50px'],
                'value' => 'author.nickname',
],
//            'content:ntext',
//            'tags:ntext',
            [
                'attribute' => 'status',
                'value' => 'status0.name',
                'filter' => \common\models\Poststatus::find()
                ->select(['name','id'])
                ->orderBy('position')
                ->indexBy('id')
                ->column(),
            ],
            'status',
            //'create_time:datetime',
//            'update_time:datetime',
            [
                'attribute' => 'update_time',
                'format' => ['date','php:y-m-d H:i:s'],
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
