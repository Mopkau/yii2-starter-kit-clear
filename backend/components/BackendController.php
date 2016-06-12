<?php
	namespace backend\components;
	/**
	 * Created by PhpStorm.
	 * User: filipp
	 * Date: 12.06.16
	 * Time: 8:32 PM
	 */
	use yii\db\ActiveQuery;
	use yii\web\Controller;
	use Exception;
	use Yii;
	class BackendController extends Controller{
		public $labelMany = 'Переопредели меня';
		public $labelOne = 'Переопредели меня';
		/**
		 * Lists all KeyStorageItem models.
		 * @return mixed
		 */
		public function actionIndex()
		{

			$searchModel = new $this->modelClass();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->sort = [
				'defaultOrder'=>['id'=>SORT_DESC]
			];
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'labels'=>$this-getModelCrudLabels()
			]);
		}

		/**
		 * Creates a new KeyStorageItem model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate()
		{
			$model = new $this->modelClass();

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['index']);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}

		/**
		 * Updates an existing KeyStorageItem model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id
		 * @return mixed
		 */
		public function actionUpdate($id)
		{
			$model = $this->findModel($id);

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['index']);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}

		public function actionView($id)
		{
			$model = $this->findModel($id);

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['index']);
			} else {
				return $this->render('view', [
					'model' => $model,
				]);
			}
		}

		/**
		 * Deletes an existing KeyStorageItem model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 * @param integer $id
		 * @return mixed
		 */
		public function actionDelete($id)
		{
			$this->findModel($id)->delete();

			return $this->redirect(['index']);
		}
		/**
		 * Finds the KeyStorageItem model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param integer $id
		 * @return item the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			$query = new ActiveQuery($this->modelClass);
			if (($model = $query->andWhere(['id'=>$id])->one()) !== null) {
				return $model;
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
		}

		/**
		 * Return class of the model
		 *
		 * @throws Exception
		 * @return string
		 */
		public function getModelClass()
		{
			throw new Exception('Добавь в контроллер getModelClass с классом модели!!!');
		}

		/**
		 * Return class of the model
		 *
		 * @throws Exception
		 * @return string
		 */
		public function getModelSearchClass()
		{
			throw new Exception('Добавь в контроллер getModelClass с классом модели!!!');
		}
	}