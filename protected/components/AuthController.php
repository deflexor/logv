<?php

class AuthController extends CController
{
    public function beforeAction($action)
    {
        $token = Yii::app()->request->getParam('token');

        if (!$token || !JwtHelper::validateToken($token)) {
            throw new CHttpException(401, 'Unauthorized');
        }

        return parent::beforeAction($action);
    }
}