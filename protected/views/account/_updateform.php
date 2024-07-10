<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
        'class'=>'user',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($account,$user)); ?>
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($account,'username'); ?>
			<?php echo $form->textField($account,'username',array('size'=>60,'maxlength'=>128, 'class'=>'form-control form-control-user')); ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($account,'email_address'); ?>
			<?php echo $form->textField($account,'email_address',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>

		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'qualifier'); ?>
			<?php echo $form->textField($user,'qualifier',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>

		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'lastname'); ?>
			<?php echo $form->textField($user,'lastname',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'firstname'); ?>
			<?php echo $form->textField($user,'firstname',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>

		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'middlename'); ?>
			<?php echo $form->textField($user,'middlename',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>

		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'dob'); ?><br />
			<?php //echo $form->textField($model,'dob',array('size'=>60,'maxlength'=>128));
				$form->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $user,		
				//'attribute' => 'DOB',
				'name' => 'User[dob]',
				'value' => ($user->dob!=''&&$user->dob!='0000-00-00')?date('F d,Y', strtotime($user->dob)):null,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=> 'MM dd,yy',
					'changeMonth'=>'true',
					'changeYear'=>'true',
					'yearRange'=>(date('Y')-80).':'.(date('Y')-18),
				),
				'htmlOptions'=>array(
					'class'=>'form-control form-control-user',
					//'tabindex'=>'15',
				),
				));
			?> 
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'gender'); ?>
			<?php echo $form->DropdownList($user, 'gender', array('' => 'Please select one', '1' => 'Male', '2' => 'Female'), array('class' => 'form-control form-control-user', 'value' => '')); ?>
		</div>

		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'specialization'); ?>
			<?php echo $form->DropdownList($user, 'specialization', array('' => 'Please select one', 'Anesthesia' => 'Anesthesia', 'Dermatology' => 'Dermatology', 'Emergency Medicine' => 'Emergency Medicine', 'Family Medicine / General Medicine' => 'Family Medicine / General Medicine', 'General Surgery' => 'General Surgery', 'Internal Medicine' => 'Internal Medicine', 'Neurology' => 'Neurology', 'Nuclear Medicine' => 'Nuclear Medicine', 'Obstetrics and Gynecology' => 'Obstetrics and Gynecology', 'Occupational Medicine' => 'Occupational Medicine', 'Opthalmology' => 'Opthalmology', 'Orthopedics' => 'Orthopedics', 'Otorhinolaryngology' => 'Otorhinolaryngology', 'Pathology' => 'Pathology', 'Pediatrics' => 'Pediatrics', 'Physical and Rehabilitation Medicine' => 'Physical and Rehabilitation Medicine', 'Psychiatry' => 'Psychiatry', 'Radiology' => 'Radiology', 'Multiple Specialization' => 'Multiple Specialization', 'Others' => 'Others'), array('class' => 'form-control form-control-user', 'value' => $user->specialization)); ?>
		</div>

		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'ptr_number'); ?>
			<?php echo $form->textField($user,'ptr_number',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'license_number'); ?>
			<?php echo $form->textField($user,'license_number',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'license_expiration'); ?><br />
			<?php
				$form->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $user,		
				//'attribute' => 'DOB',
				'name' => 'User[license_expiration]',
				'value' => ($user->license_expiration!=''&&$user->license_expiration!='0000-00-00')?date('F d,Y', strtotime($user->license_expiration)):null,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=> 'MM dd,yy',
					'changeMonth'=>'true',
					'changeYear'=>'true',
					'minDate' => 'dateToday',
					'yearRange'=>date('Y').':'.(date('Y')+10),
				),
				'htmlOptions'=>array(
					'class'=>'form-control form-control-user',
					//'tabindex'=>'15',
				),
				));
			?> 
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'maxicare_number'); ?>
			<?php echo $form->textField($user,'maxicare_number',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'s2_number'); ?>
			<?php echo $form->textField($user,'s2_number',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'s2_expiration'); ?><br />
			<?php
				$form->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $user,		
				//'attribute' => 'DOB',
				'name' => 'User[s2_expiration]',
				'value' => ($user->s2_expiration!=''&&$user->s2_expiration!='0000-00-00')?date('F d,Y', strtotime($user->s2_expiration)):null,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=> 'MM dd,yy',
					'changeMonth'=>'true',
					'changeYear'=>'true',
					'minDate' => 'dateToday',
					'yearRange'=>date('Y').':'.(date('Y')+10),
				),
				'htmlOptions'=>array(
					'class'=>'form-control form-control-user',
					//'tabindex'=>'15',
				),
				));
			?> 
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($user,'address'); ?>
			<?php echo $form->textField($user,'address',array('size'=>60,'maxlength'=>255, 'class'=>'form-control form-control-user')); ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('account/listDoctor'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Update</span>', 'javascript:document.getElementById("account-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->