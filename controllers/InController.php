<?php

namespace app\controllers;

use Yii;
use app\models\Account;

class InController extends \yii\web\Controller
{

	
    public function actionIndex()
    {
        return $this->render('index');
    }

}
