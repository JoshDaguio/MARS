
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'createAppointment-form',
    'enableAjaxValidation'=>false,
)); ?>

<div class="form-group row">
	<div class="col-sm-4 mb-4 mb-sm-0">
	    <?php echo $form->labelEx($model,'Title'); ?>
	    <?php echo $form->textField($model,'title', array('class'=>'form-control form-control-user')); ?>
	    <?php echo $form->error($model,'title'); ?>
    </div>

	<div class="col-sm-4 mb-4 mb-sm-0">
	    <?php echo $form->labelEx($model,'description'); ?>
	    <?php echo $form->textField($model,'description', array('class'=>'form-control form-control-user')); ?>
	    <?php echo $form->error($model,'description'); ?>
    </div>
</div>
    
<!-- ... other form fields ... -->

<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php if(Yii::app()->user->name == 'patient'){ ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('appointment/calendarPatient'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("createAppointment-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
			<?php } else { 
					echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('site/index'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); 
					echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("createAppointment-form").submit();', array('class'=>'btn btn-success btn-icon-split')); 

			}?>
		</div>
	</div>

<?php $this->endWidget(); ?>

