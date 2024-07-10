<?php
/* @var $this SecretaryController */
/* @var $model Secretary */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clinic-assignment-form',
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
        <?php echo $form->labelEx($model, 'account_id'); ?>
            <?php echo $form->dropDownList(
                $model,
                'account_id',
                CHtml::listData(Account::model()->findAll(array(
			        'condition'=>'account_type_id=:account_type_id' ,
			        'params'=>array(
				        ':account_type_id'=>3,
			        ),
		        )), 'id', function($account) {
			        return $account->user->getFullname($account->id);
		        }), // Assuming Doctor model has 'name' attribute
                array('empty' => 'Select Doctor', 'class'=>'form-control form-control-user')
            ); ?>
        </div>
        <div class="col-sm-4 mb-4 mb-sm-0">
            <?php echo $form->labelEx($model, 'clinic_id'); ?>
            <?php echo $form->dropDownList(
                $model,
                'clinic_id',
                CHtml::listData(Clinic::model()->findAll(array(
			        'condition'=>'status_id=:status_id' ,
			        'params'=>array(
				        ':status_id'=>1,
			        ),
		        )), 'id', 'clinic'), // Assuming Doctor model has 'name' attribute
                array('empty' => 'Select Clinic', 'class'=>'form-control form-control-user')
            ); ?>
        </div>
    </div>

<div class="form-group row">
    <div class="col-sm-12" style="text-align:right">
        <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('clinic/ListClinicAssignment'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
        <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("clinic-assignment-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

