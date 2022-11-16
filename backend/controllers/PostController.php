<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\Post;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Category;
use yii\filters\VerbFilter;
use common\models\PostSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],

                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $name=UploadedFile::getInstance($model,'file_name');
                $image_name = md5($name->baseName).'.'.$name->extension;
                $path='uploads/' . $image_name;
                if($name->saveAs($path))
                {
                    $model->file_name = $image_name;
                    if($model->save())
                    {
                        return $this->redirect(['index']);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $name=UploadedFile::getInstance($model,'file_name');
            $image_name = md5($name->baseName).'.'.$name->extension;
            $path='uploads/' . $image_name;
            if($name->saveAs($path))
            {
                $model->file_name = $image_name;
                if($model->save())
                {
                    return $this->redirect(['index']);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionGetSubCategories($id) {

        $subcategories =Category::find()->where(['parent_id' => $id])->all();

        if (!empty($subcategories)) {
            echo "<option>".'-  Select Sub Category -'."</option>";
            foreach($subcategories as $subcategory) {
                echo "<option value='".$subcategory->id."'>".$subcategory->name_en."</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }


}


