<?php
namespace app\controllers;

use app\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex() {
        $query = Tasks::find();
        $query->where(['status' => 'new']);
        $tasks = $query->all();
        return $this->render('index', ['tasks' => $tasks]);
    }

}
