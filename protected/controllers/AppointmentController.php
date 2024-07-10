<?php

class AppointmentController extends Controller
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
				'actions'=>array('create','CalendarPatient', 'EventsPatient', 'GetTimeSlots', 'GetEvents', 'GetDoctorEvents', 'ChangeStatus', 
				'getDoctorsBySpecialization', 'GetClinicsByDoctor', 'GetWorkDaysByClinic', 'ViewAppointmentPatient', 'ViewAppointment'),
				'users'=>array('patient'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'CalendarSecretary', 'EventsDoc', 'CalendarDoc', 'GetTimeSlots', 'GetEvents', 'GetDoctorEvents', 'ChangeStatus'),
				'users'=>array('secretary'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'CalendarDoc', 'EventsDoc', 'GetTimeSlots', 'GetEvents', 'GetDoctorEvents', 'ChangeStatus'),
				'users'=>array('doctor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'CalendarDoc', 'EventsDoc', 'GetTimeSlots','GetEvents', 'GetDoctorEvents','GetPatientEvents', 
				'ChangeStatus', 'CreateAdmin', 'CalendarAdminDoc', 'CalendarAdminPatient', 'ChangeStatusAdminDoc', 'ChangeStatusAdminPatient', 'GetDoctorsBySpecialization',
				'GetClinicsByDoctor', 'GetDoctorEventsAdmin', 'GetClinicsByDoctorAdmin', 'getWorkDaysByClinic', 'GetWorkDaysByClinicAdmin', 'ListAppointmentTable', 'ViewAppointment'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionViewAppointment($id)
	{
		$appointment = Appointment::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('viewAppointment', array(
			'appointment'=>$appointment,));
	}
	

	public function actionViewAppointmentPatient($id)
	{
		$listOfAppointment = Appointment::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		
		// Render the calendar view and pass the data.
		$this->render('viewAppointmentPatient', array(
			'listOfAppointment'=>$listOfAppointment,));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionCreate()
	{

		$specializations = User::model()->findAll(array(
			'condition' => 'specialization IS NOT NULL',
		));
		$id = Yii::app()->user->id;
		$model = new Appointment;
		$model->setScenario('createAppointment');
		if (isset($_POST['Appointment']))
		{
			$model->attributes = $_POST['Appointment'];
			$account = User::model()->findbyPk(array($model->doctor_id));
			$model->doctor_id = $account->account_id;
			$model->patient_id = $id;
			$model->status_id = 1;
			// Add any additional validation or logic as needed

			if (isset($_POST['Appointment']['time_slot'])) {
				$model->appointment_time = $_POST['Appointment']['time_slot'];
			}
	
			if ($model->save()) {
				$this->redirect('calendarPatient');
			} else {
				// Handle validation errors
				$model->getErrors();
			}
		}

		$this->render('create', array(
			'model' => $model,
			'specializations' => $specializations,
		));
	}

	public function actionGetClinicsByDoctor($doctorId)
	{
		$account = User::model()->findByAttributes(array('id' => $doctorId));
   		$clinics = ClinicAssignment::model()->findAllByAttributes(array('account_id' => $account->account_id));

    $data = array();
    foreach ($clinics as $clinic) {
        $data[$clinic->clinic_id] = $clinic->clinic->clinic;  // Adjust these properties based on your Clinic model
    }

    echo CJSON::encode($data);
    Yii::app()->end();
	}

	public function actionGetClinicsByDoctorAdmin($doctorId)
	{
   		$clinics = ClinicAssignment::model()->findAllByAttributes(array('account_id' => $doctorId));

    $data = array();
    foreach ($clinics as $clinic) {
        $data[$clinic->clinic_id] = $clinic->clinic->clinic;  // Adjust these properties based on your Clinic model
    }

    echo CJSON::encode($data);
    Yii::app()->end();
	}

	public function actionGetDoctorsBySpecialization($specializationId)
	{
		$doctors = User::model()->findAllByAttributes(array('specialization' => $specializationId));

		$data = array();
		foreach ($doctors as $doctor) {
			$data[$doctor->id] = $doctor->getFullname($doctor->account_id);
		}

		echo CJSON::encode($data);
		Yii::app()->end();
	}

	public function actionListAppointmentTable()
	{
		$model = Appointment::model()->findAll();

		// Render the calendar view and pass the data.
		$this->render('listAppointmentTable', array(
			'model'=>$model,));
	}

	public function actionCreateAdmin()
	{
		$specializations = User::model()->findAll(array(
			'condition' => 'specialization IS NOT NULL',
		));
		
		$model = new Appointment;
		$model->setScenario('createAppointment');
		if (isset($_POST['Appointment']))
		{
			
			$model->attributes = $_POST['Appointment'];
			$account = User::model()->findbyPk(array($model->doctor_id));
			$model->doctor_id = $account->account_id;
			$model->status_id = 1;
			// Add any additional validation or logic as needed

			if (isset($_POST['Appointment']['time_slot'])) {

				

				$model->appointment_time = $_POST['Appointment']['time_slot'];
			}
	
			if ($model->save()) {
				$this->redirect(array('appointment/listAppointmentTable'));
			} else {
				// Handle validation errors
				$model->getErrors();
			}
		}

		$this->render('createAdmin', array(
			'model' => $model,
			'specializations' => $specializations,
		));
	}

	public function actionGetTimeSlots($doctorId, $clinicId, $selectedDate) {

        $account = User::model()->findByAttributes(array('id' => $doctorId));
        $sched = DoctorSched::model()->with('clinicAssignment')->findAll(array(
            'condition' => 't.account_id=:account_id AND clinicAssignment.clinic_id = :clinic_id',
            'params' => array(
                ':account_id' => $account->account_id,
                ':clinic_id' => $clinicId
            ),
        ));

        $timeSlots = array();

        // Loop through each schedule
        foreach ($sched as $time) {
            $start_datetime = DateTime::createFromFormat('H:i:s', $time->start_time);
            $end_datetime = DateTime::createFromFormat('H:i:s', $time->end_time);

            // Define the interval duration (2 hours in this case)
            $interval_duration = new DateInterval('PT2H');

            // Initialize the current time to the start time
            $current_datetime = clone $start_datetime;

            // Loop through the time range for each schedule
            while ($current_datetime <= $end_datetime) {
                // Format the current time as 'h:i A' (e.g., '09:00 AM')
                $formatted_time = $current_datetime->format('h:i A');

                // Add the formatted time to the array
                $timeSlots[] = $formatted_time;

                // Move to the next time slot
                $current_datetime->add($interval_duration);

                // Check if the current time has reached or exceeded midnight
                if ($current_datetime >= $end_datetime) {
                    break; // Exit the loop when reaching or exceeding midnight
                }
            }
        }

        // Render a partial view with the time slots
        $this->renderPartial('timeslots', array('timeSlots' => $timeSlots));
    }
	public function actionCalendarAdminDoc()
	{
		$model = Appointment::model()->findAll();

		// Render the calendar view and pass the data.
		$this->render('calendarAdminDoc', array(
			'model'=>$model,));
	}
	public function actionCalendarAdminPatient()
	{
		$model = Appointment::model()->findAll();

		// Render the calendar view and pass the data.
		$this->render('calendarAdminPatient', array(
			'model'=>$model,));
	}
	public function actionCalendarDoc()
	{
		$id = Yii::app()->user->id;
		$listOfAppointment = Appointment::model()->findAll(array(
			'condition'=>'doctor_id=:id AND status_id = 1',
			'params'=>array(
				':id'=>$id,
			),
		));

		// Render the calendar view and pass the data.
		$this->render('calendarDoc', array(
			'listOfAppointment'=>$listOfAppointment,));
	}
	public function actionCalendarSecretary()
	{
		$id = Yii::app()->user->id;
		$listOfDoctor = Secretary::model()->findAll(array(
			'condition'=>'secretary_id=:id and status_id=1',
			'params'=>array(
				':id'=>$id,
			),
		));
		if (!empty($listOfDoctor)) {
		foreach($listOfDoctor as $doctor) {
		$listOfAppointment = Appointment::model()->findAll(array(
			'condition'=>'doctor_id=:id AND status_id = 1',
			'params'=>array(
				':id'=>$doctor->doctor_id,
			),
		));
		}
		// Render the calendar view and pass the data.
		$this->render('calendarDoc', array(
			'listOfAppointment'=>$listOfAppointment,));

		}else {
				// Render the error view
				$this->render('//site/error', array('message' => 'No records found, Please be assigned to a doctor'));
			}
	}
	public function actionCalendarPatient()
	{
		$id = Yii::app()->user->id;
		$listOfAppointment = Appointment::model()->findAll(array(
			'condition'=>'patient_id=:id AND status_id = 1',
			'params'=>array(
				':id'=>$id,
			),
		));
		// Render the calendar view and pass the data.
		$this->render('calendarPatient', array(
			'listOfAppointment'=>$listOfAppointment,));
	}

	public function actionEventsDoc()
	{
		if(Yii::app()->user->name == 'doctor'){
		$id = Yii::app()->user->id;
		$events = Appointment::model()->findAll(array(
			'condition'=>'doctor_id=:doctor_id AND status_id = 1',
			'params'=>array(
				':doctor_id'=>$id,
			),
		));
		} elseif(Yii::app()->user->name == 'secretary'){
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
		};
	};
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
				'desc' => $event->description
				// Add other event properties.
			];
		}
		header('Content-Type: application/json');
        echo CJSON::encode($appointments);
        Yii::app()->end();
	}

	public function actionGetDoctorEvents($doctorId, $clinicId )
	{
		// Fetch and format events for the selected doctor
		$account = User::model()->findByPk($doctorId);
		$events = Appointment::model()->findAll(array(
			'condition'=>'doctor_id=:doctor_id AND clinic_id =:clinic_id AND status_id = 1',
			'params'=>array(
				':doctor_id'=>$account->account_id,
				':clinic_id'=>$clinicId,
			),
		));
		$appointments = [];
		foreach ($events as $event) {
			// Combine date and time into a single datetime string
			$datetime = $event->appointment_date . 'T' . $event->appointment_time;
	
			$appointments[] = [
				'label' => $event->title,
				'title' => 'reserved', 
				'start' => $datetime,
				'patientName' => $event->patientAccount->user->getFullname($event->patientAccount->id),
				'desc' => $event->description,
 				// Additional text for the event
				// Add other event properties.
			];
		}
		// ... Retrieve events from your database or other source based on the doctorId ...
		header('Content-Type: application/json');
		echo CJSON::encode($appointments);
		Yii::app()->end();
	}

	public function actionGetWorkDaysByClinic($doctorId, $clinicId)
{
	
	$account = User::model()->findByPk($doctorId);

		$events = DoctorSched::model()->with('clinicAssignment')->find(array(
		'condition' => 't.account_id=:account_id AND t.status_id = 1 AND clinicAssignment.clinic_id=:clinic_id',
		'params' => array(
			':account_id' => $account->account_id,
			':clinic_id' => $clinicId,
		),
		));
        if ($events !== null) {
            $workDays = $events->working_days;
            echo CJSON::encode($workDays);
        } else {
            echo CJSON::encode('No Schedule');
        }

    	Yii::app()->end();
	}
	public function actionGetWorkDaysByClinicAdmin($doctorId, $clinicId)
	{
		$account = User::model()->findByPk($doctorId);
		$events = DoctorSched::model()->with('clinicAssignment')->find(array(
		'condition' => 't.account_id=:account_id AND t.status_id = 1 AND clinicAssignment.clinic_id=:clinic_id',
		'params' => array(
			':account_id' => $account->account_id,
			':clinic_id' => $clinicId,
		),
		));
        if ($events !== null) {
            $workDays = $events->working_days;
            echo CJSON::encode($workDays);
        } else {
            echo CJSON::encode('No Schedule');
        }

    	Yii::app()->end();
	}
	public function actionGetDoctorEventsAdmin($doctorId, $clinicId )
	{
		// Fetch and format events for the selected doctor
		$events = Appointment::model()->findAll(array(
			'condition'=>'doctor_id=:doctor_id AND clinic_id =:clinic_id AND status_id = 1',
			'params'=>array(
				':doctor_id'=>$doctorId,
				':clinic_id'=>$clinicId,
			),
		));
		$appointments = [];
		foreach ($events as $event) {
			// Combine date and time into a single datetime string
			$datetime = $event->appointment_date . 'T' . $event->appointment_time;
	
			$appointments[] = [
				'label' => $event->title,
				'title' => 'reserved', 
				'start' => $datetime,
				'patientName' => $event->patientAccount->user->getFullname($event->patientAccount->id),
				'desc' => $event->description,
 				// Additional text for the event
				// Add other event properties.
			];
		}
		// ... Retrieve events from your database or other source based on the doctorId ...
		header('Content-Type: application/json');
		echo CJSON::encode($appointments);
		Yii::app()->end();
	}
	public function actionGetPatientEvents($patientId)
	{
		// Fetch and format events for the selected doctor
		$events = Appointment::model()->findAll(array(
			'condition'=>'patient_id=:patient_id AND status_id = 1',
			'params'=>array(
				':patient_id'=>$patientId,
			),
		));
		$appointments = [];
		foreach ($events as $event) {
			// Combine date and time into a single datetime string
			$datetime = $event->appointment_date . 'T' . $event->appointment_time;
	
			$appointments[] = [
				'label' => $event->title,
				'title' => 'reserved', 
				'start' => $datetime,
				'doctorName' => $event->doctorAccount->user->getFullname($event->doctorAccount->id),
				'desc' => $event->description,
 				// Additional text for the event
				// Add other event properties.
			];
		}
		// ... Retrieve events from your database or other source based on the doctorId ...
		header('Content-Type: application/json');
		echo CJSON::encode($appointments);
		Yii::app()->end();
	}
	
	public function actionChangeStatus($id)
    {
        $model = Appointment::model()->findByPk($id); 

        if ($model !== null) {
            Appointment::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'doctor'){
            	$this->redirect(array('calendarDoc')); // Redirect to the view page, adjust as needed
			} elseif(Yii::app()->user->name =='patient') {
				$this->redirect(array('calendarPatient'));
			} elseif(Yii::app()->user->name =='secretary') {
				$this->redirect(array('calendarSecretary'));
			}
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	public function actionChangeStatusAdminDoc($id)
    {
        $model = Appointment::model()->findByPk($id); 

        if ($model !== null) {
            Appointment::model()->updateByPk($id, array('status_id' => 2));
            
			$this->redirect(array('calendarAdminDoc')); 

        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	public function actionChangeStatusAdminPatient($id)
    {
        $model = Appointment::model()->findByPk($id); 

        if ($model !== null) {
            Appointment::model()->updateByPk($id, array('status_id' => 2));
            
			$this->redirect(array('calendarAdminPatient')); 

        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$appointment = Appointment::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Appointment']))
		{
			$model->attributes=$_POST['Appointment'];
			if($model->save()){
				$this->redirect(array('appointment/calendarPatient'));
			}
		}


		$this->render('update',array(
			'model'=>$model,
			'appointment'=>$appointment,
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
		$dataProvider=new CActiveDataProvider('Appointment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Appointment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Appointment']))
			$model->attributes=$_GET['Appointment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Appointment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Appointment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Appointment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='appointment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
