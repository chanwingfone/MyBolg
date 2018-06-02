<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

        ['attribute' => 'id',
        'contentOptions' => ['width' =>'30px',],],
        ['attribute' => 'content',
        'label' => '内容',
        'value' => 'beginning',
//        'value' => function($model){
//        $tmpStr = strip_tags($model->content);
//        $tmpStrLen = mb_strlen($tmpStr);
//
//        return mb_substr($tmpStr,0,20,'utf-8').($tmpStrLen>20 ? '...' : '');
//        }
        ],
            ['attribute' => 'user.username',
                'label' => '作者',
                'value' => 'user.username',
                'contentOptions' => ['width' =>'50px']],
        ['attribute' => 'status',
        'value' => 'status0.name',
        'filter' => \common\models\Commentstatus::find()
        ->select(['name','id'])
        ->orderBy('position')
        ->indexBy('id')
        ->column(),
            'contentOptions' => function($model){
        return ($model->status == 1) ? ['class'=>'bg-danger','width' => '30px'] : ['width' => '30px'];
            },
            ],
            ['attribute' => 'create_time',
                'format' => ['date','php:m-d H:i']],
//            'create_time:datetime',


            //'email:email',
            //'url:url',
            'post.title',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}{approve}',
                'buttons' => [
                        'approve' => function($url,$model,$key){
                            $options = [
                                'title' => Yii::t('yii','审核'),
                                'aria-label'=> Yii::t('yii','审核'),
                                'data-confirm' => Yii::t('yii','你确定要审阅此评论吗？'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ];
                            return Html::a(' <span class="glyphicon glyphicon-check"></span>',$url,$options);
                        }
                ],],
        ],
    ]); ?>
</div>
