<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Consultation Information</h6>
	    </div>
	    <div class="card-body">
			<div class="table-responsive">
			 	<p class="note"><strong>Patient Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Patient</th>
							<th>Date of Birth</th>
							<th>Gender</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($consultationInfo as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->user->account_id); ?></td>
									<td><?php echo ($modelValue->patientAccount->user->dob !== '' && $modelValue->patientAccount->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->patientAccount->user->dob)) :"Not Available";?></td>
									<td><?php echo $modelValue->patientAccount->user->getGender($modelValue->patientAccount->user->account_id); ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Consultation Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Subjective</th>
                            <th>Objective</th>
                            <th>Assessment</th>
                            <th>Plan</th>
                            <th>Notes</th>
                            <th>Date of Consultation</th>
							<th>Status</th>
							<th class='text-center'>E</th>
							<th class='text-center'>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($consultationInfo as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->subjective ?></td>
                                    <td><?php echo $modelValue->objective ?></td>
                                    <td><?php echo $modelValue->assessment ?></td>
                                    <td><?php echo $modelValue->plan ?></td>
                                    <td><?php echo $modelValue->notes ?></td>
									<td><?php echo ($modelValue->date_of_consultation !== '' && $modelValue->date_of_consultation !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->date_of_consultation)) :"Not Available";?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id) ?></td>
									<?php 
		                            echo "<td class='text-center'>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('consultationRecord/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('consultationRecord/changeStatus/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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

