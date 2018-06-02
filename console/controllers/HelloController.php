<?php
/**
 * Created by PhpStorm.
 * User: chenyongfeng1
 * Date: 2018/5/27
 * Time: 15:03
 */

namespace console\controllers;
use yii\base\Model;
use yii\console\Controller;
use common\models\Post;

class HelloController extends Controller
{
    public $rev;

    public function options($actionID)
    {
        return array_merge(parent::options($actionID),['rev']);

    }
    public function optionAliases()
    {
       return ['r'=>'rev'];
    }

    public function actionIndex()
    {
        if($this->rev==1){
           echo(strrev('Hello world'));

        }else{
            echo "Hello world";
        }
    }

    public function actionList()
    {
        $posts = Post::find()->all();

        foreach($posts as $post)
        {
            echo $post['id'].'-'.$post['title'];
        }
    }
}