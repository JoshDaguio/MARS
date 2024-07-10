<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Consultation Information</h6>
	    </div>
	    <div class="card-body">
            <div class="table-responsive">
			 	<p class="note"><strong>Doctor Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Doctor</th>
                            <th>Specialization</th>
							<th>Date of Birth</th>
							<th>Gender</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($prescriptionInfo as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->doctorAccount->user->getFullname($modelValue->doctorAccount->user->account_id); ?></td>
									<td><?php echo $modelValue->doctorAccount->user->specialization; ?></td>
                                    <td><?php echo ($modelValue->doctorAccount->user->dob !== '' && $modelValue->doctorAccount->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->doctorAccount->user->dob)) :"Not Available";?></td>
                                    <td><?php echo $modelValue->doctorAccount->user->getGender($modelValue->doctorAccount->user->account_id); ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
            <div class="table-responsive">
			 	<p class="note"><strong>Prescription Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Prescription</th>
                            <th>Date of Prescription</th>
                            <th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($prescriptionInfo as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->prescription ?></td>
									<td><?php echo ($modelValue->date_of_prescription !== '' && $modelValue->date_of_prescription !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->date_of_prescription)) :"Not Available";?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id) ?></td>
								</tr>
						<?php		
							}
						?>		
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Consultation Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Subjective</th>
                            <th>Objective</th>
                            <th>Assessment</th>
                            <th>Plan</th>
                            <th>Notes</th>
                            <th>Date of Consultation</th>
							<th>Status</th>
							<th>V</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($prescriptionInfo as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->consultation->subjective ?></td>
                                    <td><?php echo $modelValue->consultation->objective ?></td>
                                    <td><?php echo $modelValue->consultation->assessment ?></td>
                                    <td><?php echo $modelValue->consultation->plan ?></td>
                                    <td><?php echo $modelValue->consultation->notes ?></td>
									<td><?php echo ($modelValue->consultation->date_of_consultation !== '' && $modelValue->consultation->date_of_consultation !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->consultation->date_of_consultation)) :"Not Available";?></td>
									<td><?php echo $modelValue->consultation->getStatus($modelValue->consultation->id) ?></td>
									<?php 
										echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('consultationRecord/viewPatient/'.$modelValue->consultation->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
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

