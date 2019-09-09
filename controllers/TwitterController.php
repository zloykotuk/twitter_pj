<?php

namespace app\controllers;
use Abraham\TwitterOAuth\TwitterOAuth;
use Exception;
use app\models\TwitterForm;
use app\models\TwitterFeedForm;
use app\models\Username;
use app\models\Uuid;
use Yii;

class TwitterController extends \yii\web\Controller
{

    private $consumerkey = "0CKr3L3XJwAnCwos7PQPt1uaM";
    private $consumersecret = "p7jOyoTkFqR1Zy2Jt1mvtnZ7nmzoxymUPC6gIO8J5CAMCrU2mq";
    private $accesstoken = "781429852104785921-VMMdIzzoNPrDpAbBcIp1CK4hWQUFLH5";
    private $accesstokensecret = "EjYYmtrKb06wjEqi2ERQKHm1lDrTiGgtmrgZ1PAZVNsqG";

    public function actionIndex()
    {
        return array("app" => "Hello World :)");
    }

    public function actionAdd()
    {
        $model = new TwitterForm();
        if( Yii::$app->request->get('id') != null && Yii::$app->request->get('username') != null && Yii::$app->request->get('secret') != null){
            $model->id = Yii::$app->request->get('id');
            $model->username = Yii::$app->request->get('username');
            $model->secret = Yii::$app->request->get('secret');
            if($model->validate() && (Uuid::findOne(['key' => $model->id]) == null)){
                $uuid = new Uuid(['key' => $model->id]);
                $uuid->save();
                //return sha1($model->id.$model->username);
                if(sha1($model->id.$model->username) == $model->secret){
                    $tmp =  Username::findOne(['username' => $model->username]);
                    if($tmp==null) {
                        $username = new Username();
                        $username->username = $model->username;
                        $username->save();
                        Yii::$app->response->content = '';
                        return;
                    } else{
                        Yii::$app->response->statusCode = 500;
                        return array('error' => 'internal error');
                    }
                } else {
                    Yii::$app->response->statusCode = 401;
                    return array('error' => 'access denied');
                }
            }else {
                Yii::$app->response->statusCode = 500;
                return array('error' => 'internal error');
            }
        } else {
            Yii::$app->response->statusCode = 400;
            return array('error' => 'missing parameter');
        }

    }

    public function actionFeed()
    {
        $model = new TwitterFeedForm();
        $model->id = Yii::$app->request->get('id');
        $model->secret = Yii::$app->request->get('secret');
        if($model->validate() && (Uuid::findOne(['key' => $model->id]) == null)){
            $uuid = new Uuid(['key' => $model->id]);
            $uuid->save();
            if(sha1($model->id) == $model->secret){
                try {
                    $data = array();
                    foreach (Username::find()->all() as $customer) {
                        $connection = new TwitterOAuth($this->consumerkey, $this->consumersecret, $this->accesstoken, $this->accesstokensecret);
                        $tweets = $connection->get("statuses/user_timeline", ['screen_name' => $customer->username, 'count' => 1]);
                        $tags = array();
                        if ($customer->username == null) {
                            array_push($data, array('user' => $customer->username, 'tweet' => '', 'hashtag' => $tags));
                        } else {
                            $array = json_decode(json_encode($tweets[0]), true);
                            if ($array['entities']['hashtags'] != null) {
                                foreach ($array['entities']['hashtags'] as $tag) {
                                    array_push($tags, $tag["text"]);
                                }
                            }
                            array_push($data, array('user' => $customer->username, 'tweet' => $array['text'], 'hashtag' => $tags));
                        }
                    }
                    Yii::$app->response->data = (array('feed' => $data));
                    return;
                } catch (Exception $e){
                    Yii::$app->response->statusCode = 500;
                    return array('error' => 'internal error');
                }
            } else {
                Yii::$app->response->statusCode = 401;
                return array('error' => 'access denied');
            }
        } else {
            Yii::$app->response->statusCode = 400;
            return array('error' => 'missing parameter');
        }
    }

    public function actionRemove()
    {
        $model = new TwitterForm();
        $model->id = Yii::$app->request->get('id');
        $model->username = Yii::$app->request->get('username');
        $model->secret = Yii::$app->request->get('secret');
        if($model->validate() && (Uuid::findOne(['key' => $model->id]) == null)){
            $uuid = new Uuid(['key' => $model->id]);
            $uuid->save();
            if(sha1($model->id.$model->username) == $model->secret){
                $tmp =  Username::findOne(['username' => $model->username]);
                if($tmp!=null) {
                    Username::deleteAll(['username' => $model->username]);
                    Yii::$app->response->content = '';
                    return;
                } else{
                    Yii::$app->response->statusCode = 500;
                    return array('error' => 'internal error');
                }
            } else {
                Yii::$app->response->statusCode = 401;
                return array('error' => 'access denied');
            }
        }else{
            Yii::$app->response->statusCode = 400;
            return array('error' => 'missing parameter');
        }
    }
}
