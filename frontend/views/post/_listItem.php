<?php
/**
 * Created by PhpStorm.
 * User: chenyongfeng1
 * Date: 2018/5/24
 * Time: 9:42
 */

use yii\helpers\Html;


?>
<div class="post">
    <div class="title">
        <h2><a href="<?=$model->url ?>"><?= Html::encode($model->title);?></a> </h2>

        <div class="author">
            <span class="glyphicon glyphicon-time" aria-hidden="true"><em><?=date('Y-m-d H:i:s',$model->create_time); ?></em>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="glyphicon glyphicon-user" aria-hidden="true"><em><?=Html::encode($model->author->nickname); ?></em></span>
        </div>
    </div>
    <div class="content">
        <?=$model->beginning ?>

        <br>
        <div class="nav">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <?= implode(',',$model->tagLinks);?>
        </div>

        <br>
        <?=Html::a("评论({$model->commentCount})",$model->url.'#commnets') ?> | 最后修改时间：<?=Html::encode(date('Y-m-d H:i:s',$model->update_time)); ?>
    </div>


</div>