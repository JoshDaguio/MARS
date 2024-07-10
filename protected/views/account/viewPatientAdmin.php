<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Patient Account Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
                            <th>Username</th>
							<th>Email Address</th>
                            <th>Account Type</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                            <th>Update Account</th>
							<th>Change Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->username; ?></td>
									<td><?php echo $modelValue->email_address; ?></td>
                                    <td><?php echo $modelValue->getAccountType($modelValue->id); ?></td>
                                    <td><?php echo $modelValue->getAccountStatus($modelValue->id); ?></td>
                                    <td><?php echo $modelValue->date_created; ?></td>
                                    <td><?php echo $modelValue->date_updated; ?></td>
                                    <?php 
                                        echo "<td class='text-center'>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('account/updatePatient/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
                                        echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('account/changeStatus/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
                                    ?>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Patient Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Fullname</th>
							<th>Date of Birth</th>
							<th>Gender</th>
                            <th>Address</th>
                            <th>School</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->user->getFullname($modelValue->user->account_id); ?></td>
									<td><?php echo ($modelValue->user->dob !== '' && $modelValue->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->user->dob)) :"Not Available";?></td>
									<td><?php echo $modelValue->user->getGender($modelValue->user->account_id); ?></td>
									<td><?php echo $modelValue->user->address; ?></td>
									<td><?php echo $modelValue->user->school; ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Patient Parental Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Name of Father</th>
							<th>Father Date of Birth</th>
							<th>Contact Number of Father</th>
							<th>Name of Mother</th>
							<th>Mother Date of Birth</th>
							<th>Contact Number of Mother</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->user->name_of_father; ?></td>
									<td><?php echo ($modelValue->user->father_dob !== null && $modelValue->user->father_dob !== '' && $modelValue->user->father_dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->user->father_dob)) :"";?></td>
									<td><?php echo $modelValue->user->father_contact_number; ?></td>
									<td><?php echo $modelValue->user->name_of_mother; ?></td>
									<td><?php echo ($modelValue->user->mother_dob !== null && $modelValue->user->mother_dob !== '' && $modelValue->user->mother_dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->user->mother_dob)) :"";?></td>
									<td><?php echo $modelValue->user->mother_contact_number; ?></td>
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
<?php foreach($account as $modelValue){
	if($modelValue->birthHistory == null){

	}else { ?>
	<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Birth History</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Birth History</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Blood Type</th>
							<th>Term</th>
							<th>Type of Delivery</th>
							<th>Birth Weight</th>
							<th>Birth Length</th>
							<th>Head Circumference</th>
							<th>Chest Circumference</th>
							<th>Abdominal Circumference</th>
	                    </tr>
	                </thead>
	                <tbody>
								<tr>
									<td><?php echo $modelValue->birthHistory->BloodType($modelValue->id); ?></td>
									<td><?php echo $modelValue->birthHistory->Term($modelValue->id) ?></td>
									<td><?php echo $modelValue->birthHistory->ToD($modelValue->id); ?></td>
									<td><?php echo $modelValue->birthHistory->birth_weight; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_length; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_head_circumference; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_chest_circumference; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_abdominal_circumference; ?></td>
								</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<?php }?>

<?php }  ?>			



<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Immunization Records</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Immumization Records</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Immunization</th>
							<th>Description</th>
                            <th>Remarks</th>
							<th>Immunization Date</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
							<?php foreach ($modelValue->immunizationRecords as $immunization): ?>
								<tr>
                                    	<td><?php echo $immunization->immunization->immunization; ?></td>
										<td><?php echo $immunization->immunization->description; ?></td>
										<td><?php echo $immunization->remarks ?></td>
										<td><?php echo ($immunization->date !== '' && $immunization->date !== '0000-00-00') ? date('M d, Y', strtotime($immunization->date)) :"Not Available";?></td>
								</tr>
							<?php endforeach; ?>
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

<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Consultation Records</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Consultation History</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
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
							foreach($account as $modelValue)
							{
						?>
							<?php foreach ($modelValue->consultationRecords1 as $consultationRecord): ?>
								<tr>
    									<td><?php echo $consultationRecord->doctorAccount->user->getFullname($consultationRecord->doctorAccount->user->account_id); ?></td>
                                    	<td><?php echo $consultationRecord->subjective; ?></td>
                                    	<td><?php echo $consultationRecord->objective; ?></td>
                                    	<td><?php echo $consultationRecord->assessment; ?></td>
                                    	<td><?php echo $consultationRecord->plan; ?></td>
                                    	<td><?php echo $consultationRecord->notes; ?></td>
										<td><?php echo ($consultationRecord->date_of_consultation !== '' && $consultationRecord->date_of_consultation !== '0000-00-00') ? date('M d, Y', strtotime($consultationRecord->date_of_consultation)) :"Not Available";?></td>
								</tr>
							<?php endforeach; ?>
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


<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Prescription Records</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Prescription History</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Doctor</th>
                            <th>Prescription</th>
                            <th>Date of Prescription</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
							<?php foreach ($modelValue->prescriptions1 as $prescription): ?>
								<tr>
    									<td><?php echo $prescription->doctorAccount->user->getFullname($prescription->doctorAccount->user->account_id); ?></td>
                                    	<td><?php echo $prescription->prescription; ?></td>
										<td><?php echo ($prescription->date_of_prescription !== '' && $prescription->date_of_prescription !== '0000-00-00') ? date('M d, Y', strtotime($prescription->date_of_prescription)) :"Not Available";?></td>
								</tr>
							<?php endforeach; ?>
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




