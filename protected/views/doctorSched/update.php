<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	            <h6 class="m-0 font-weight-bold text-primary">Update Doctor Schedule</h6>
	        </div>
	        <div class="card-body">
			<?php
/* @var $this DoctorSchedController */
/* @var $model DoctorSched */
/* @var $form CActiveForm */
$id = Yii::app()->user->id;
$doctor = Secretary::model()->find(array(
    'condition'=>'secretary_id=:id',
    'params'=>array(
        ':id'=>$id,
    ),
));
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Include jQuery TimePicker from CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-sched-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


    <div class="col-sm-4 mb-4 mb-sm-0">
		<?php echo $form->labelEx($model,'working_days'); ?>
		<?php echo $form->textField($model,'working_days',array('size'=>50,'maxlength'=>50, 'class'=>'form-control form-control-user')); ?>
		<?php echo $form->error($model,'working_days'); ?>
	</div>

    <div class="col-sm-4 mb-4 mb-sm-0">
    <?php echo $form->labelEx($model, 'start_time'); ?>
    <?php $this->widget('application.extensions.timepicker.EJuiDateTimePicker', array(
    'model' => $model,
    'attribute' => 'start_time',
    'options' => array(
        'ampm' => true,
        'timeOnly' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-control form-control-user', 
    ),
	)); ?>
    <?php echo $form->error($model, 'start_time'); ?>
    </div>

    <div class="col-sm-4 mb-4 mb-sm-0">
    <?php echo $form->labelEx($model, 'end_time'); ?>
    <?php $this->widget('application.extensions.timepicker.EJuiDateTimePicker', array(
    'model' => $model,
    'attribute' => 'end_time',
    'options' => array(
        'ampm' => true,
        'timeOnly' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-control form-control-user', 
    ),
    )); ?>
    <?php echo $form->error($model, 'end_time'); ?>

    
</div>
<?php if (Yii::app()->user->name == 'doctor'){ ?>
    <div class="col-sm-4 mb-4 mb-sm-0">
    <?php echo $form->labelEx($model, 'clinic_assignment'); ?>
    <?php echo $form->dropDownList(
        $model,
        'clinic_assignment',
        CHtml::listData(ClinicAssignment::model()->findAll(array(
			'condition'=>'account_id=:account_id AND status_id = 1',
			'params'=>array(
				':account_id'=>$id,
			),
		)), 'id', function($model) {
            return $model->clinic->clinic;
        }), 
        array('empty' => 'Select Clinic', 'class'=>'form-control form-control-user')
    ); ?>
    <?php echo $form->error($model, 'clinic_assignment'); ?>
</div>
<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('doctorSched/create'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("doctor-sched-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>
<?php } elseif (Yii::app()->user->name == 'secretary'){ ?>

    <div class="col-sm-4 mb-4 mb-sm-0">
    <?php echo $form->labelEx($model, 'clinic_assignment'); ?>
    <?php echo $form->dropDownList(
        $model,
        'clinic_assignment',
        CHtml::listData(ClinicAssignment::model()->findAll(array(
			'condition'=>'account_id=:account_id AND status_id = 1',
			'params'=>array(
				':account_id'=>$doctor->doctor_id,
			),
		)), 'id', function($model) {
            return $model->clinic->clinic;
        }), 
        array('empty' => 'Select Clinic', 'class'=>'form-control form-control-user')
    ); ?>
    <?php echo $form->error($model, 'clinic_assignment'); ?>
</div>

<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('doctorSched/createSecretary'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("doctor-sched-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>
<?php }?>

<?php
// Register the script to initialize the time picker after the document is ready
$cs = Yii::app()->getClientScript();
$cs->registerScript('initTimePicker', "
    $(document).ready(function() {
        $('timepicker').timepicker({
            timeFormat: 'hh:mm:ss',
            // Add more options as needed
        });
    });
");
?>



<?php $this->endWidget(); ?>

			</div>
		</div>
		<br/>
	</div>
</div>
</div>


