<?php

namespace app\behaviors;

use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class AccessFilter extends \yii\base\ActionFilter
{
    public $_enabledActions;

    /**
     * @throws NotFoundHttpException if the page not found.
     * @throws ForbiddenHttpException if the user is not has permission to this route.
     */
    public function beforeAction($action)
    {
        if ($action->id == 'captcha') {
            return true;
        }

        if (\Yii::$app->user->isGuest) {
            $this->denyAccess();
        }

        if(!empty($this->_enabledActions) && !in_array($action->id, $this->_enabledActions))
        {
            $this->get404();
        }

        return true;
    }

    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, a 403 HTTP exception will be thrown.
     *
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess()
    {
        if (\Yii::$app->user->getIsGuest()) {
            \Yii::$app->user->loginRequired();
            \Yii::$app->end();
        } else {
            $this->get403();
        }
    }

    /**
     * @throws ForbiddenHttpException if not allowed to perform this action
     */
    protected function get403()
    {
        throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
    }

    /**
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function get404()
    {
        throw new NotFoundHttpException(\Yii::t('yii','Page not found.'));
    }





}