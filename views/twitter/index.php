<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<h1>Twitter</h1>

<a href="<?=Url::to('twitter/add') ?>"><button class="btn btn-primary btn-lg">Add</button></a>

<a href="<?=Url::to('twitter/feed') ?>"><button class="btn btn-primary btn-lg">Feed</button></a>
<a href="<?=Url::to('twitter/remove') ?>"><button class="btn btn-primary btn-lg">Remove</button></a>
