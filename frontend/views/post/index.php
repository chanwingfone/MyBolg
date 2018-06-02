<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <?= ListView::widget([
                    'id'=>'postList',
                'dataProvider'=>$dataProvider,
                'itemView'=>'_listItem',
                'layout'=>'{items}{pager}',
                'pager'=>[
                        'maxButtonCount'=>10,
                    'nextPageLabel'=>Yii::t('app','下一页'),
                    'prevPageLabel'=>Yii::t('app','上一页'),
                ]
            ])?>
        </div>
        <div class="col-md-3">
            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search">查找文章</span>
                    </li>
                    <li class="list-group-item">
                        <form class="form-inline" action="index.php?r=post/index" id="w0" method="get">
                            <div class="form-group">
                                <input type="text" name="PostSearch[title]" class="form-control" id="w0input" placeholder="按标题" >

                            </div>
                            <button class="btn btn-default" type="submit">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="tagcloudbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-tags">标签云</span>
                    </li>
                    <li class="list-group-item">
                        <?=\frontend\components\TagCloudWidget::widget(['tags'=>$tags]) ?>
                    </li>
                </ul>
            </div>

            <div class="commentbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-comment">最新回复</span>
                    </li>
                    <li class="list-group-item">
                        <?=\frontend\components\RctReplyWidget::widget(['recentComment'=>$recentComment]) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>