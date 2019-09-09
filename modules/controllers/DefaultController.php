<?php

namespace app\modules\controllers;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends CommonController
{
    public $layout = 'layout';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
