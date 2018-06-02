<?php
/**
 * Created by PhpStorm.
 * User: chenyongfeng1
 * Date: 2018/5/24
 * Time: 11:30
 */

namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class RctReplyWidget extends Widget
{
    public  $recentComment;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();

        $commentString = '';

        foreach ($this->recentComment as $comment)
        {
            $commentString.='<div class="post">'.
                '<div class="title">'.
                '<p stytle="color:#777777;font-style:italic;">'.
                nl2br($comment->content).'</p>'.
                '<p style="font-size:8pt;color:blue">《<a href=" '.
                $comment->post->url.'">'.Html::encode($comment->post->title).'</a>》</p>';

        }
        return $commentString;
    }
}