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

class TagCloudWidget extends Widget
{
    public  $tags;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();

        $tagString = '';
        $fontStyle = array('6'=>'danger',
            '5'=>'info',
            '4'=>'waring',
            '3'=>'primary',
            '2'=>'success',
            );

        foreach ($this->tags as $tag=>$weight) {
            $tagString.='<a href="'.\Yii::$app->homeUrl."?r=post/index&PostSearch[tags]="
            .$tag.'">'
            .'<h'.$weight.'style="display:inline-block;"><span class="label label-'
            .$fontStyle[$weight].'">'.$tag.'</span></h'.$weight.'></a> ';
           }

           return $tagString;
    }
}