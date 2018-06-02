
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use common\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = ['label'=> $this->title,'url' => ['post/index']];
$this->params['breadcrumbs'][] = ['label' => $model->title];

?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="post">
                <div class="title">
                    <h2><a href="<?=$model->url; ?>"><?= Html::encode($model->title); ?></a></h2>
                </div>
                <div class="author">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"><em><?=date('Y-m-d H:i:s',$model->create_time); ?></em>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"><em><?=Html::encode($model->author->nickname); ?></em></span>
                </div>
                <br>
                <div class="content">
                    <?= \yii\helpers\HtmlPurifier::process($model->content);?>
                </div>

                <br>
                <div class="nav">
                    <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                    <?= Html::a("评论({$model->commentCount})",$model->url.'#comment')?>
                    &nbsp;最后修改于<?= date('y-m-d H:i:s',$model->update_time);?>
                </div>

                <div id="comments">
                    <?php if($added){?>
                        <div class="alert alert-warning alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span> </button>
                            <h4>谢谢你的回复，我们会尽快审核后发布出来</h4>
                            <?= nl2br($commentModel->content);?>
                            <br>
                            <span class="glyphicon glyphicon-time" aria-hidden="true"><em><?= date('y-m-d H:i:s',$model->create_time);?>&nbsp;&nbsp;&nbsp;&nbsp;</em></span>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"><em><?= Html::encode($model->author->nickname);?></em></span>
                        </div>
                    <?php }?>
                    <?php if($model->commentCount>=1):?>
                    <h5><?= $model->commentCount.'条评论'?></h5>
                    <?= $this->render('_comment',[
                            'post'=>$model,
                            'comments'=>$model->activeComments,
                        ]);?>
                    <?php endif;?>

                    <h5>发表评论</h5>
                    <?php
                    $postComment = new Comment();
                    echo $this->render('_guestform',[
                            'id'=>$model->id,
                        'postModel'=>$postComment,
                    ]);
                    ?>
                </div>
            </div>
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