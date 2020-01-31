<?php

namespace app\modules\api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\ContentNegotiator;
use yii\rest\OptionsAction;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use app\models\Book;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `v1` module
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'charset' => 'UTF-8',
            ],
        ];
        return $behaviors;
    }

    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::className(),
            ],
        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function actionList()
    {
        return new ActiveDataProvider([
            'query' => Book::find()->with('authors'),
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public function actionView($id)
    {
        try {
            Yii::$app->getResponse()->setStatusCode(200);
            return [
                'success' => true,
                'data' => $this->findBook($id),
            ];
        } catch (NotFoundHttpException $exc) {
            Yii::$app->response->setStatusCode(404);
            return [
                'success' => false,
                'errors' => "Book not found!",
            ];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function actionUpdate($id)
    {
        $book = $this->findBook($id);
        $book->validate();
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return [
                'success' => true,
                'message' => "Book was successfully updated",
            ];
        }
        return [
            'success' => false,
            'message' => $book->errors,
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function actionDelete($id) {
        $book = $this->findBook($id);
        if ($book->delete()) {
            return [
                'success' => true,
                'message' => "Book was successfully deleted",
            ];
        }
        return [
            'success' => false,
            'message' => $book->errors,
        ];
    }

    /**
     * @param $id
     * @return array|Book|null
     * @throws NotFoundHttpException
     */
    protected function findBook($id)
    {
        if (($model = Book::find()->where(['id' => $id])->with('authors')->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Page not found.');
    }
}
