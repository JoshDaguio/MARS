<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */

?>
<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update Prescription</h6>
		    </div>
		    <div class="card-body">

<?php $this->renderPartial('_formUpdate', array('model'=>$model)); ?>
</div>
		</div>
	</div>
</div>