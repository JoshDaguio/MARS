<?php

class ClinicController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ListClinicDoc', 'ViewClinicDoctor'),
				'users'=>array('doctor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'listClinic', 'changeStatus', 'AssignClinic', 'ListClinicAssignment', 'ChangeStatusClinicAssignment', 'UpdateClinicAssignment', 'ViewClinicAssignment'),
				'users'=>array('super admin','admin'),
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
		$clinic = Clinic::model()->findAll(array(
			'condition' => 'id=:id',
			'params' => array(
				':id' => $id,
			),
		));

        $this->render('view',array(
            'clinic'=>$clinic,
			
        ));
	}

	public function actionViewClinicAssignment($id)
	{
		$clinic = Clinic::model()->findAll(array(
			'condition' => 'id=:id',
			'params' => array(
				':id' => $id,
			),
		));

        $this->render('viewClinicAssignment',array(
            'clinic'=>$clinic,
        ));
	}

	public function actionViewClinicDoctor($id)
	{
		$clinic = Clinic::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

        $this->render('viewClinicDoc',array(
            'clinic'=>$clinic,
			
        ));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
    {
		$listClinic= Clinic::model()->findAll();
        $model= new Clinic;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Clinic']))
        {
            $model->attributes=$_POST['Clinic'];
			$model->status_id= 1;
            if($model->save())
                $this->redirect(array('listClinic'));
        }

        $this->render('create',array(
            'model'=>$model,
			'listClinic'=>$listClinic,
        ));
    }

	public function actionChangeStatus($id)
    {
        $model = Clinic::model()->findByPk($id); 

        if ($model !== null) {
            Clinic::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin'){
            	$this->redirect(array('listClinic')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	public function actionChangeStatusClinicAssignment($id)
    {
        $model = ClinicAssignment::model()->findByPk($id); 

        if ($model !== null) {
            ClinicAssignment::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin'){
            	$this->redirect(array('listClinicAssignment')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	public function actionListClinic()
    {
        $listClinic= Clinic::model()->findAll();

        $this->render('listClinic',array(
            'listClinic'=>$listClinic,
			
        ));
    }
	public function actionListClinicAssignment()
    {
        $listClinicAssignment= ClinicAssignment::model()->findAll();

        $this->render('listClinicAssignment',array(
            'listClinicAssignment'=>$listClinicAssignment,
			
        ));
    }
	public function actionListClinicDoc()
    {
		$id = Yii::app()->user->id;

		$listOfClinicDoc = ClinicAssignment::model()->findAll(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

        $this->render('listClinicDoc',array(
            'listOfClinicDoc'=>$listOfClinicDoc,
			
        ));
    }

	public function actionAssignClinic()
	{
		$model=new ClinicAssignment;
		$listClinicAssignment= ClinicAssignment::model()->findAll();
		$model->setScenario('createAssignment');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClinicAssignment']))
		{
			$model->attributes=$_POST['ClinicAssignment'];
			$model->status_id= 1;
			if($model->save())
				$this->redirect('ListClinicAssignment');
		}

		$this->render('clinicAssignment',array(
			'model'=>$model,
			'listClinicAssignment'=>$listClinicAssignment
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

		if(isset($_POST['Clinic']))
		{
			$model->attributes=$_POST['Clinic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateClinicAssignment($id)
	{
		$model = ClinicAssignment::model()->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->setScenario('createAssignment');
		if(isset($_POST['ClinicAssignment']))
		{
			
			$model->attributes=$_POST['ClinicAssignment'];
			if($model->save())
				$this->redirect(array('viewClinicAssignment','id'=>$model->clinic_id));
		}

		$this->render('updateClinicAssignment',array(
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
		$dataProvider=new CActiveDataProvider('Clinic');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	

	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Clinic('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Clinic']))
			$model->attributes=$_GET['Clinic'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public static function getTotalClinics()
    {
        return self::model()->count();
    }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Clinic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Clinic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Clinic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='clinic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
