<?php

class DoctorSchedController extends Controller
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
				'actions'=>array('create','update', 'ListSchedDoc', 'ChangeStatus',),
				'users'=>array('doctor'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('createSecretary','update', 'listSchedSec', 'ChangeStatus'),
				'users'=>array('secretary'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'createAdmin','update','listSched','ChangeStatus', 'updateAdmin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$id = Yii::app()->user->id;

		$list = DoctorSched::model()->findAll(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));
		$model=new DoctorSched;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DoctorSched']))
		{
			
			$model->attributes=$_POST['DoctorSched'];
			$model->account_id= $id;
			$model->status_id = 1;
			$model->start_time = $this->convertToNonAMPMFormat($model->start_time);
        	$model->end_time = $this->convertToNonAMPMFormat($model->end_time);
			if($model->save())
				$this->redirect(array('listSchedDoc'));
		}

		$this->render('create',array(
			'model'=>$model,
			'list'=>$list,
		));
	}
	public function actionCreateSecretary()
	{
		$id = Yii::app()->user->id;
		$listOfDoctor = Secretary::model()->find(array(
			'condition'=>'secretary_id=:id and status_id=1',
			'params'=>array(
				':id'=>$id,
			),
		));

		if (!empty($listOfDoctor)) {
		$list = DoctorSched::model()->findAll(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$listOfDoctor->doctor_id,
			),
		));
		
		$model=new DoctorSched;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DoctorSched']))
		{
			
			$model->attributes=$_POST['DoctorSched'];

			$model->account_id= $listOfDoctor->doctor_id;
			$model->status_id = 1;
			$model->start_time = $this->convertToNonAMPMFormat($model->start_time);
        	$model->end_time = $this->convertToNonAMPMFormat($model->end_time);

			if($model->validate()){
			if($model->save()){
				$this->redirect(array('listSchedSec'));
			}}
		}

			$this->render('create',array(
				'model'=>$model,
				'list'=>$list,
			));
			} else {
				// Render the error view
				$this->render('//site/error', array('message' => 'No records found, Please be assigned to a doctor'));
			}

		
	}

	public function actionCreateAdmin()
	{
		$listOfSched = DoctorSched::model()->findAll();

		$model=new DoctorSched;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DoctorSched']))
		{
			
			$model->attributes=$_POST['DoctorSched'];
			$model->status_id = 1;
			$model->start_time = $this->convertToNonAMPMFormat($model->start_time);
        	$model->end_time = $this->convertToNonAMPMFormat($model->end_time);
			if($model->save())
				$this->redirect(array('listSched'));
		}

		$this->render('createAdmin',array(
			'model'=>$model,
			'listOfSched' => $listOfSched,
		));
	}

	private function convertToNonAMPMFormat($time)
	{
		// Convert time with AM/PM format to 'H:i:s' format
		$dateTime = DateTime::createFromFormat('h:i A', $time);
		return $dateTime ? $dateTime->format('H:i:s') : null;
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

		if(isset($_POST['DoctorSched']))
		{
			$model->attributes=$_POST['DoctorSched'];
			$model->start_time = $this->convertToNonAMPMFormat($model->start_time);
        	$model->end_time = $this->convertToNonAMPMFormat($model->end_time);
			if($model->save()){
				if(Yii::app()->user->name == 'doctor'){
					$this->redirect(array('listSchedDoc'));
				} elseif (Yii::app()->user->name == 'secretary'){
					$this->redirect(array('listSchedSec'));
				} 
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionUpdateAdmin($id)
	{
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DoctorSched']))
		{
			$model->attributes=$_POST['DoctorSched'];
			$model->start_time = $this->convertToNonAMPMFormat($model->start_time);
        	$model->end_time = $this->convertToNonAMPMFormat($model->end_time);
			if($model->save())
				$this->redirect(array('listSched'));
		}

		$this->render('updateAdmin',array(
			'model'=>$model,
		));
	}
	public function actionListSched()
	{
		$listOfSched = DoctorSched::model()->findAll();

		$this->render('listSched',array(
			'listOfSched'=>$listOfSched,
		));
	}
	public function actionListSchedSec()
	{
		$id = Yii::app()->user->id;
		$listOfdoctor = Secretary::model()->find(array(
			'condition'=>'secretary_id=:id and status_id=1',
			'params'=>array(
				':id'=>$id,
			),
		));
		if(!empty($listOfdoctor)){
		$listOfSched = DoctorSched::model()->findAll(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$listOfdoctor->doctor_id,
			),
		));

		$this->render('listSchedSec',array(
			'listOfSched'=>$listOfSched,
		));

		} else {
				// Render the error view
				$this->render('//site/error', array('message' => 'No records found, Please be assigned to a doctor'));
		}
	}
	public function actionListSchedDoc()
	{
		$id = Yii::app()->user->id;
		$listOfSched = DoctorSched::model()->findAll(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('listSchedSec',array(
			'listOfSched'=>$listOfSched,
		));
	}
	public function actionChangeStatus($id)
    {
        $model = DoctorSched::model()->findByPk($id); 

        if ($model !== null) {
			DoctorSched::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin') {
				$this->redirect(array('listSched'));
			};
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
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
		$dataProvider=new CActiveDataProvider('DoctorSched');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DoctorSched('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DoctorSched']))
			$model->attributes=$_GET['DoctorSched'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DoctorSched the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DoctorSched::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DoctorSched $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-sched-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
