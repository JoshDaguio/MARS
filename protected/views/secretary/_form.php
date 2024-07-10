<?php
/* @var $this SecretaryController */
/* @var $model Secretary */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'secretary-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4 mb-4 mb-sm-0">
    <?php echo $form->labelEx($model, 'secretary_id'); ?>
    <?php echo $form->dropDownList(
        $model,
        'secretary_id',
        CHtml::listData(Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id AND id NOT IN (
                SELECT secretary_id FROM tbl_secretary WHERE status_id=1
            )' ,
			'params'=>array(
				':account_type_id'=>5,
			),
		)), 'id', function($account) {
			return $account->user->getFullname($account->id);
		}), // Assuming Doctor model has 'name' attribute
        array('empty' => 'Select Secretary', 'class'=>'form-control form-control-user')
    ); ?>
    <?php echo $form->error($model, 'secretary_id'); ?>
</div>


<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('site/index'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("secretary-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->