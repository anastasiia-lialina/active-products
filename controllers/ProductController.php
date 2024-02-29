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
        Yii::$app->set('response', [
            'class' => Response::class,
            'format' => 'json',
        ]);

        return parent::beforeAction($action);
    }

    /**
     * Нужна проверка безопасности и возврат ошибок
     * @param int $categoryId
     * @return mixed
     */
    public function actionActive(int $categoryId)
    {
        $cache = Yii::$app->cache;
        $key = "active_product_{$categoryId}";
        $products = $cache->get($key);
        return $products === false ? [] : $products;
    }

}
