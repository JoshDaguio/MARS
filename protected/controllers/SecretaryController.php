<?php

class SecretaryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'ListSecretaryDoc', 'ChangeStatus'),
				'users'=>array('doctor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin', 'super admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$accounts = Account::model()->findAll(array(
			'condition' => 'id=:id',
			'params' => array(
				':id' => $id,
			),
		));

		$this->render('view',array(
			'accounts'=>$accounts,
		));
	}

	public function actionChangeStatus($id)
    {
        $model = Secretary::model()->findByPk($id); 

        if ($model !== null) {
            Secretary::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'doctor'){
            	$this->redirect(array('create')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$id = Yii::app()->user->id;
		$listOfAccounts = Secretary::model()->findAll(array(
            'condition'=>'doctor_id=:doctor_id AND status_id= 1',
            'params'=>array(
				':doctor_id' => $id,
            ),
        ));
		$model=new Secretary;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Secretary']))
		{
			$model->attributes=$_POST['Secretary'];
			$model->doctor_id = $id;
			$model->status_id = 1;
			if($model->save())
				$this->redirect(array('ListSecretaryDoc'));
		}

		$this->render('create',array(
			'model'=>$model,
			'listOfAccounts'=>$listOfAccounts,
		));
	}

	public function actionListSecretaryDoc()
    {
		$id = Yii::app()->user->id;
        $listOfAccounts = Secretary::model()->findAll(array(
            'condition'=>'doctor_id=:doctor_id',
            'params'=>array(
				':doctor_id' => $id,
            ),
        ));

        $this->render('listSecretaryDoc',array(
            'listOfAccounts'=>$listOfAccounts,
        ));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Secretary']))
		{
			$model->attributes=$_POST['Secretary'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Secretary');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Secretary('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Secretary']))
			$model->attributes=$_GET['Secretary'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Secretary the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Secretary::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Secretary $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='secretary-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
