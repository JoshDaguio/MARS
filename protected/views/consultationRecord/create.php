<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Consultation</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_form', array('model'=>$model, 'PatientTable'=>$PatientTable, 'DoctorTable'=>$DoctorTable)); ?>
			</div>
		</div>
	</div>
</div>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Consultation</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
	    	 	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>ID</th>
							<th>Patient</th>
							<th>Doctor</th>
                            <th>Subjective</th>
							<th>Objective</th>
                            <th>Assessment</th>
							<th>Plan</th>
							<th>Notes</th>
							<th>Date of Consultation</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listConsultation as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->id ?></td>
									<td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->user->account_id); ?></td>
									<td><?php echo $modelValue->doctorAccount->user->getFullname($modelValue->doctorAccount->user->account_id); ?></td>
                                    <td><?php echo $modelValue->subjective ?></td>
                                    <td><?php echo $modelValue->objective ?></td>
                                    <td><?php echo $modelValue->assessment ?></td>
                                    <td><?php echo $modelValue->plan ?></td>
                                    <td><?php echo $modelValue->notes ?></td>
									<td><?php echo ($modelValue->date_of_consultation !== '' && $modelValue->date_of_consultation !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->date_of_consultation)) :"Not Available";?></td>
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