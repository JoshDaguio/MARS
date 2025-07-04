<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update Doctor Account</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_updateDocProfile', array('account' => $account, 'user' => $user, 'id' => $id)); ?>
			</div>
		</div>
	</div>
</div>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Doctor Profile</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
	    	 	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	    	 		<thead>
	                    <tr>
							<th>Fullname</th>
                            <th>Email Address</th>
                            <th>Gender</th>
                            <th>Status</th>
							<th>DOB</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAccounts as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->user->getFullname($modelValue->id); ?></td>
									<td><?php echo $modelValue->email_address; ?></td>
									<td><?php echo $modelValue->user->getGender($modelValue->id); ?></td>
                                    <td><?php echo $modelValue->getAccountStatus($modelValue->id); ?></td>
									<td><?php echo $modelValue->user->dob; ?></td>
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