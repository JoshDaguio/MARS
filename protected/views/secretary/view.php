<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Secretary Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Secretary Account Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Username</th>
							<th>Email Address</th>
                            <th>Position</th>
                            <th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($accounts as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->username; ?></td>
									<td><?php echo $modelValue->email_address; ?></td>
                                    <td><?php echo $modelValue->getAccountType($modelValue->id); ?></td>
                                    <td><?php echo $modelValue->getAccountStatus($modelValue->id); ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Secretary Information</strong></p>
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
							foreach($accounts as $modelValue)
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
		</div>
	</div>
</div>
</div>

