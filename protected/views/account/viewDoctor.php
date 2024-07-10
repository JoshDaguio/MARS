<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Doctor Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Doctor Account Information</strong></p>
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
                                    echo "<td class='text-center'>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('account/updateDoctor/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('account/changeStatusDoc/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
                                    ?>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Doctor Personal Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Fullname</th>
							<th>Date of Birth</th>
							<th>Gender</th>
                            <th>Address</th>
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
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
            <div class="table-responsive">
			 	<p class="note"><strong>Doctor Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Specialization</th>
							<th>PTR Number</th>
							<th>License Number</th>
                            <th>License Expiration</th>
                            <th>S2 Number</th>
                            <th>S2 Expiration</th>
                            <th>Maxicare Number</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->user->specialization; ?></td>
                                    <td><?php echo $modelValue->user->ptr_number; ?></td>
                                    <td><?php echo $modelValue->user->license_number; ?></td>
									<td><?php echo ($modelValue->user->license_expiration !== '' && $modelValue->user->license_expiration !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->user->license_expiration)) :"Not Available";?></td>
                                    <td><?php echo $modelValue->user->s2_number; ?></td>
                                    <td><?php echo $modelValue->user->s2_expiration; ?></td>
                                    <td><?php echo $modelValue->user->maxicare_number; ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
            </div>
			<div class="table-responsive">
			 	<p class="note"><strong>Clinic Assignment & Schedule</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Clinics Assigned</th>
							<th>Working Days</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($account as $modelValue)
							{
						?>
							<?php foreach ($modelValue->DoctorSchedules as $doctorSchedule): ?>
								<tr>		
									<td><?php echo $doctorSchedule->clinicAssignment->clinic->clinic ?></td>
									<td><?php echo $doctorSchedule->working_days; ?></td>
									<td><?php echo $doctorSchedule->start_time; ?></td>
									<td><?php echo $doctorSchedule->end_time ?></td>
                                    <td><?php echo $doctorSchedule->getStatus($doctorSchedule->id) ?></td>
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

