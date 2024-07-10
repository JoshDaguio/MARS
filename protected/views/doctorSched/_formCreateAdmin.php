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

<div class="form-group row">
    <div class="col-sm-4 mb-4 mb-sm-0">
        <?php echo $form->labelEx($model, 'Doctor'); ?>
        <?php
        echo $form->dropDownList(
            $model,
            'account_id',
            CHtml::listData(Account::model()->with('user')->findAll(array(
                'condition' => 'account_type_id=:account_type_id',
                'params' => array(
                    ':account_type_id' => 3,
                ),
            )), 'id', function ($account) {
                return $account->user->getFullname($account->id);
            }),
            array(
                'empty' => 'Select Doctor',
                'class' => 'form-control form-control-user',
                'id' => 'doctorDropdown', 
                'onchange' => 'loadClinics(this.value);',
            )
        );
        ?>
        <?php echo $form->error($model, 'account_id'); ?>
    </div>
    <div class="col-sm-4 mb-4 mb-sm-0">
        <?php echo $form->labelEx($model,'working_days'); ?>
        <?php echo $form->textField($model,'working_days',array('size'=>50,'maxlength'=>50, 'class'=>'form-control form-control-user')); ?>
        <?php echo $form->error($model,'working_days'); ?>
    </div>
</div>

<div class="form-group row">
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
    'class'=>'form-control form-control-user'
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
    'class'=>'form-control form-control-user'
),
)); ?>
<?php echo $form->error($model, 'end_time'); ?>
</div>


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

</div>

<div class="form-group row" id="clinic-container">
    <div class="col-sm-4 mb-4 mb-sm-0">
        <?php echo $form->labelEx($model, 'clinic_assignment'); ?>
        <?php
        echo $form->dropDownList(
            $model,
            'clinic_assignment',
            array(),
            array('empty' => 'Select Clinic', 'class' => 'form-control form-control-user', 'id' => 'clinic_id')
        );
        ?>
        <?php echo $form->error($model, 'clinic_assignment'); ?>
    </div>
</div>

<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('site/index'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("doctor-sched-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
<script>
    function loadClinics(doctorId) {
        $.ajax({
            url: '<?php echo $this->createUrl("appointment/getClinicsByDoctorAdmin"); ?>',
            data: { doctorId: doctorId },
            type: 'GET',
            success: function (data) {
                var clinicDropdown = $('#clinic_id');
                clinicDropdown.html('<option value="">Select Clinic</option>'); // Start with a blank option
                $.each($.parseJSON(data), function (id, clinic) {
                    clinicDropdown.append($('<option>', {
                        value: id,
                        text: clinic
                    }));
                });

                $('#clinic-container').show();
            }
        });
    }
</script>