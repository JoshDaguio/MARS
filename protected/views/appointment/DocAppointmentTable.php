<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Appointment</h6>
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
                            <th>Patient</th>
							<th>Doctor</th>
							<th>Title</th>
							<th>Description</th>
							<th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
							<th>E</th>
							<th>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($model as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->id ?></td>
									<td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->id); ?></td>
                                    <td><?php echo $modelValue->doctorAccount->user->getFullname($modelValue->doctorAccount->id); ?></td>
									<td><?php echo $modelValue->title; ?></td>
									<td><?php echo $modelValue->description; ?></td>
									<td><?php echo ($modelValue->appointment_date !== '' && $modelValue->appointment_date !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->appointment_date)) :"Not Available";?></td>
									<td><?php echo $modelValue->appointment_time; ?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id); ?></td>
									<?php 
		                            echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('appointment/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
                                    echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('appointment/ChangeStatusAdminDoc/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to remove this appointment?")'))."</td>";
		                            ?>
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