<?php

class SiteController extends Controller
{
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
			array('allow',
				'actions'=>array('login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'logout', 'EventsDocSec', 'EventsPatient'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users

				'users'=>array('*'),

			),
		);
	}

	public function actionPieChart()
	{
    // Fetch data from the database based on account type IDs
    
    // Pass the data to the view
	}

	private function getAccountTypeLabel($accountTypeId)
	{
		// Implement your logic to get the label based on account type ID
		// For example, fetch from the database or use a predefined mapping
		// This is a placeholder, you should replace it with your actual logic
		$labelMap = [
			1 => 'Super Admin',
			2 => 'Admin',
			3 => 'Doctor',
			4 => 'Patient',
			5 => 'Secretary',
		];

		return isset($labelMap[$accountTypeId]) ? $labelMap[$accountTypeId] : "Unknown Label";
	}


	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{	
		$id = Yii::app()->user->id;
		$listOfAppointment = Appointment::model()->findAll(array(
			'condition'=>'patient_id=:id AND status_id = 1',
			'params'=>array(
				':id'=>$id,
			),
		));
		// Check if the user is logged in
		if (Yii::app()->user->isGuest) {
			$this->redirect(array('/site/login'));
		}
		
		
	
		// Get the user's account type
		$accountType = Yii::app()->user->getState('account_type_id');
	
		// Set the default view
		$view ='index';
			// Render the appropriate dashboard view based on the account type
			switch ($accountType) {
				case 1:
					$view = 'superadmindash';
					break;
		
				case 2:
					$view = 'admin';
					break;
		
				case 3:
					$view = 'doctordash';
					break;

				case 4:
					$view ='patientdash';
					break;
					
				case 5:
					$view ='secretarydash';
					break;
	
			// Add more cases for other account types as needed
	
			default:
				// You can leave this as the default view or customize it
				break;
		}
	
		// Fetch necessary data for the view (modify as needed)
		$data = [];
		$accountTypeIds = [1, 2, 3, 4, 5];

		$patientCounts = ConsultationRecord::countPatientsByDoctorPerMonth();

	
		foreach ($accountTypeIds as $accountTypeId) {
			$count = Account::model()->countByAttributes(['account_type_id' => $accountTypeId]);
			$label = $this->getAccountTypeLabel($accountTypeId);
	
			$data[$label] = $count;
		}

		$id = Yii::app()->user->id;
        $listOfDoctor = Secretary::model()->findAll(array(
            'condition'=>'secretary_id=:id',
            'params'=>array(
                ':id'=>$id,
            ),
        ));
        foreach($listOfDoctor as $doctor) {
        $listOfAppointmentSecretary = Appointment::model()->findAll(array(
            'condition'=>'doctor_id=:id AND status_id = 1',
            'params'=>array(
                ':id'=>$doctor->doctor_id,
            ),
        ));
        }
	
		$this->layout = '//layouts/main';

		if ($accountType == 5 AND !empty($listOfAppointmentSecretary)){
			$this->render($view, array(
				'user' => new User(), // Modify as needed
				'data' => $data,
				'patientCounts' => $patientCounts,
				'listOfAppointmentSecretary' => $listOfAppointmentSecretary
			));
			} elseif ($accountType == 5 && empty($listOfAppointmentSecretary)) {
				$this->render($view, array(
					'user' => new User(), // Modify as needed
					'data' => $data,
					'patientCounts' => $patientCounts,
				));
			}
			 else {
				$this->render($view, array(
					'user' => new User(), // Modify as needed
					'data' => $data,
					'patientCounts' => $patientCounts,
					'listOfAppointment' => $listOfAppointment
				));
			}
	}

	public function actionEventsDocSec()
    {

            $id = Yii::app()->user->id;
            $listOfDoctor = Secretary::model()->findAll(array(
            'condition'=>'secretary_id=:id',
            'params'=>array(
                ':id'=>$id,
            ),
            ));
            foreach($listOfDoctor as $doctor){
                $events = Appointment::model()->findAll(array(
                    'condition'=>'doctor_id=:doctor_id AND status_id = 1',
                    'params'=>array(
                        ':doctor_id'=>$doctor->doctor_id,
                    ),
                ));
            }


        // Prepare the data for FullCalendar.
        $appointments = [];
        foreach ($events as $event) {
            $datetime = $event->appointment_date . 'T' . $event->appointment_time;
            $appointments[] = [
                'title' => $event->title,
                'start' => $datetime,
                'desc' => $event->description,
                'patientName' => $event->patientAccount->user->getFullname($event->patientAccount->id),
                // Add other event properties.
            ];
        }
        header('Content-Type: application/json');
        echo CJSON::encode($appointments);
        Yii::app()->end();
    } 

	public function actionEventsPatient()
	{
		$id = Yii::app()->user->id;
		$events = Appointment::model()->findAll(array(
			'condition'=>'patient_id=:patient_id AND status_id = 1',
			'params'=>array(
				':patient_id'=>$id,
			),
		));

		// Prepare the data for FullCalendar.
		$appointments = [];
		foreach ($events as $event) {
			$datetime = $event->appointment_date . 'T' . $event->appointment_time;
			$appointments[] = [
				'title' => $event->title,
				'start' => $datetime,
				'desc' => $event->description,
				'doctorName' => $event->doctorAccount->user->getFullname($event->doctorAccount->id)
				// Add other event properties.
			];
		}
		header('Content-Type: application/json');
        echo CJSON::encode($appointments);
        Yii::app()->end();
	}

	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/register';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}