<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Patient Account</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_formPatientDoc', array('account' => $account, 'user' => $user, 'birthhistory' => $birthhistory)); ?>
			</div>
		</div>
	</div>
</div>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Patients</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Fullname</th>
							<th>Date of Birth</th>
							<th>Gender</th>
                            <th>Address</th>
                            <th>Email Address</th>
							<th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfPatient as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->id); ?></td>
									<td><?php echo ($modelValue->patientAccount->user->dob !== '' && $modelValue->patientAccount->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->patientAccount->user->dob)) :"Not Available";?></td>
									<td><?php echo $modelValue->patientAccount->user->getGender($modelValue->patientAccount->id); ?></td>
									<td><?php echo $modelValue->patientAccount->user->address; ?></td>
									<td><?php echo $modelValue->patientAccount->email_address; ?></td>
									<td><?php echo $modelValue->patientAccount->getAccountStatus($modelValue->patientAccount->id) ?></td>	

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
