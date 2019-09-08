<?php

namespace app\controllers;
use app\models\EntryForm;
use app\models\TwitterForm;
use app\models\TwitterFeedForm;
use app\models\User;
use app\models\Username;
use Yii;
use yii\helpers\Json;

class TwitterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTestadd()
    {
        $model = new TwitterAddForm();

        return $this->render('add', ['model' => $model]);

    }

    public function actionAdd()
    {
        //return md5(uniqid(mt_rand(), true));

        $model = new TwitterForm();
        $model->id = Yii::$app->request->get('id');
        $model->username = Yii::$app->request->get('username');
        $model->secret = Yii::$app->request->get('secret');
        if($model->validate()){
            if(sha1($model->id.$model->username) == $model->secret){
                $tmp =  Username::findOne(['username' => $model->username]);
                if($tmp==null) {
                    $username = new Username();
                    $username->username = $model->username;
                    $username->save();
                    return "";
                } else{
                    return "{\"error\": \"internal error\"}";
                }

            } else {
                return "{\"error\": \"access denied\"}";
            }
        }else{
            return " {\"error\": \"missing parameter\"} ";
        }

    }

    public function actionFeed()
    {
        $model = new TwitterFeedForm();
        $model->id = Yii::$app->request->get('id');
        $model->secret = Yii::$app->request->get('secret');
        if($model->validate()){
            if(sha1($model->id) == $model->secret){
                Json::encode();
                return "";
            } else {
                return "{\"error\": \"access denied\"}";
            }
        }else{
            return " {\"error\": \"missing parameter\"} ";
        }
    }

    public function actionRemove()
    {
        $model = new TwitterForm();
        $model->id = Yii::$app->request->get('id');
        $model->username = Yii::$app->request->get('username');
        $model->secret = Yii::$app->request->get('secret');
        if($model->validate()){
            if(sha1($model->id.$model->username) == $model->secret){
                $tmp =  Username::findOne(['username' => $model->username]);
                if($tmp!=null) {
                    Username::deleteAll(['username' => $model->username]);
                    return "";
                } else{
                    return "{\"error\": \"internal error\"}";
                }
            } else {
                return "{\"error\": \"access denied\"}";
            }
        }else{
            return " {\"error\": \"missing parameter\"} ";
        }
    }
}
