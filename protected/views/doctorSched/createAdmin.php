<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Doctor Schedule</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_formCreateAdmin', array('model'=>$model)); ?>
		</div>
	</div>
</div>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Schedules</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
	    	 	<?php if(Yii::app()->user->hasFlash('success')):?>
			    <div class="border-bottom-success ">
			        <?php echo Yii::app()->user->getFlash('success'); ?>
			    </div>
			    <?php endif; ?>
			    <?php if(Yii::app()->user->hasFlash('error')):?>
			        <div class="border-bottom-danger ">
			            <?php echo Yii::app()->user->getFlash('error'); ?>
			        </div>
			    <?php endif; ?>
	    	 	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>ID</th>
							<th>Doctor</th>
							<th>Working Days</th>
                            <th>Start Time</th>
                            <th>End Time</th>
							<th>Clinic</th>
                            <th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfSched as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->id ?></td>
									<td><?php echo $modelValue->account->user->getFullname($modelValue->account->id); ?></td>
									<td><?php echo $modelValue->working_days; ?></td>
									<td><?php echo $modelValue->start_time; ?></td>
									<td><?php echo $modelValue->end_time ?></td>
									<td><?php echo $modelValue->clinicAssignment->clinic->clinic ?></td>
                                    <td><?php echo $modelValue->getStatus($modelValue->id) ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>