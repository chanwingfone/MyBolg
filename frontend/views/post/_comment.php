<?php
/**
 * Created by PhpStorm.
 * User: chenyongfeng1
 * Date: 2018/5/25
 * Time: 10:27
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php foreach ($comments as $comment):?>
<div class="comment">
    <div class="row">
        <div class="col-md-12">
            <div class="comment-detail">
                <span class="glyphicon glyphicon-user"></span>
                <em><?= Html::encode($comment->user->username);?>&nbsp;&nbsp;</em>
                <span class="glyphicon glyphicon-time" aria-hidden="true"><em><?=date('Y-m-d H:i:s',$comment->create_time); ?></em>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <br>
                <?= nl2br($comment->content);?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
