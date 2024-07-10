<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'consultationRecord-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
        'class'=>'model',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($consultationRecord,$prescription)); ?>

	
	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($consultationRecord,'subjective'); ?>
			<?php echo $form->textField($consultationRecord,'subjective', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($consultationRecord,'subjective'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($consultationRecord,'objective'); ?>
			<?php echo $form->textField($consultationRecord,'objective', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($consultationRecord,'objective'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($consultationRecord,'assessment'); ?>
			<?php echo $form->textField($consultationRecord,'assessment', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($consultationRecord,'assessment'); ?>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($consultationRecord,'plan'); ?>
			<?php echo $form->textField($consultationRecord,'plan', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($consultationRecord,'plan'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($consultationRecord,'notes'); ?>
			<?php echo $form->textField($consultationRecord,'notes', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($consultationRecord,'notes'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($consultationRecord, 'date_of_consultation'); ?>
			<?php
			$form->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $consultationRecord,
				'attribute' => 'date_of_consultation',
				'name' => 'ConsultationRecord[date_of_consultation]',
				'value' => ($consultationRecord->date_of_consultation != '' && $consultationRecord->date_of_consultation != '0000-00-00') ?
					date('yy-mm-dd', strtotime($consultationRecord->date_of_consultation)) : null,
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'changeMonth' => 'true',
					'changeYear' => 'true',
					'minDate' => 'dateToday',
					'yearRange' => date('Y') . ':' . (date('Y') + 10),
				),
				'htmlOptions' => array(
					'class' => 'form-control form-control-user',
				),
			));
			?>
		</div>
	</div>

    <div class="form-group row">
        <div class="col-sm-12">
            <!-- Checkbox to Add Prescription -->
            <label>
                <input type="checkbox" id="addPrescriptionCheckbox"> Add Prescription
            </label>
        </div>
    </div>

    <div id="prescriptionForm" style='display:none;'>
		<div class="form-group row">
			<div class="col-sm-4 mb-4 mb-sm-0">
				<?php echo $form->labelEx($prescription,'prescription'); ?>
				<?php echo $form->textArea($prescription,'prescription',array('rows'=>6, 'cols'=>50, 'class'=>'form-control form-control-user')); ?>
				<?php echo $form->error($prescription,'prescription'); ?>
			</div>
			<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($prescription, 'date_of_prescription'); ?>
			<?php
			$form->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $prescription,
				'attribute' => 'date_of_prescription', // Add this line to specify the attribute
				'name' => 'Prescription[date_of_prescription]',
				'value' => ($prescription->date_of_prescription != '' && $prescription->date_of_prescription != '0000-00-00') ?
					date('yy-mm-dd', strtotime($prescription->date_of_prescription)) : null, // Set value in the format 'yy-mm-dd'
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'changeMonth' => 'true',
					'changeYear' => 'true',
					'minDate' => 'dateToday',
					'yearRange' => date('Y') . ':' . (date('Y') + 10),
				),
				'htmlOptions' => array(
					'class' => 'form-control form-control-user',
				),
			));
			?>
		</div>
		</div>

	</div>

	<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('account/listPatientDoc'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating this consultation?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("consultationRecord-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
    $('#addPrescriptionCheckbox').on('change', function() {
        if ($(this).is(':checked')) {
            $('#prescriptionForm').show();
        } else {
            $('#prescriptionForm').hide();
        }
    });

    // Trigger the change event to initially hide/show the prescription form based on checkbox state
    $('#addPrescriptionCheckbox').trigger('change');
});
</script>