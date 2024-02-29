<?php

namespace app\controllers;

use Yii;
use yii\web\Response;

class ProductController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'active' => ['GET'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    /**
     * Нужна проверка безопасности и возврат ошибок
     * @param int $categoryId
     */
    public function actionActive(int $categoryId): array
    {
        $cache = Yii::$app->cache;
        $key = "active_product_{$categoryId}";
        $products = $cache->get($key);
        return $products === false ? [] : $products;
    }

}
