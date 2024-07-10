
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prescription-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
        'class'=>'model',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="col-sm-4 mb-4 mb-sm-0">
		<?php echo $form->labelEx($model,'prescription'); ?>
		<?php echo $form->textArea($model,'prescription',array('rows'=>6, 'cols'=>50, 'class'=>'form-control form-control-user')); ?>
		<?php echo $form->error($model,'prescription'); ?>
	</div>

	<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
		<?php if(Yii::app()->user->name == 'doctor') {?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('prescription/listPrescriptionArchives'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel update?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("prescription-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		<?php } elseif (Yii::app()->user->name == 'secretary') {?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('prescription/listPrescriptionArchivesSec'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel update?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("prescription-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		<?php } elseif (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin') {?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('prescription/listPrescription'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel update?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("prescription-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		<?php } ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->