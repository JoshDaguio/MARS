<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Patient Account Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Username</th>
							<th>Email Address</th>
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
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Patient Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
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
									<td><?php echo $modelValue->user->dob; ?></td>
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
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
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
									<td><?php echo $modelValue->user->father_dob; ?></td>
									<td><?php echo $modelValue->user->father_contact_number; ?></td>
									<td><?php echo $modelValue->user->name_of_mother; ?></td>
									<td><?php echo $modelValue->user->mother_dob; ?></td>
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


<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Birth History</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Birth History</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
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
						<?php 
							foreach($account as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->birthHistory->blood_type; ?></td>
									<td><?php echo $modelValue->birthHistory->term; ?></td>
									<td><?php echo $modelValue->birthHistory->type_of_delivery; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_weight; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_length; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_head_circumference; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_chest_circumference; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_abdominal_circumference; ?></td>
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

<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Immunization Records</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Immumization Records</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Immunization</th>
                            <th>Immunization Date</th>
                            <th>Remarks</th>
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
                                    	<td><?php echo $immunization->date ?></td>
                                    	<td><?php echo $immunization->remarks ?></td>
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


