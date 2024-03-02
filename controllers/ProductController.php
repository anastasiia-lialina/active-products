<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class ProductController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

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
        $products = $cache->set($key, [1,2,3]);
        $products = $cache->get($key);
        return $products === false ? [] : $products;
    }

}
