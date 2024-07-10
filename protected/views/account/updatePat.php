<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Update Patient Account</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_updatePat', array('account' => $account, 'user' => $user, 'birthhistory' => $birthhistory)); ?>
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
							<th>dob</th>
                            <th>address</th>
                            <th>Name of Father</th>
                            <th>Name of Mother</th>
                            <th>gender</th>
							<th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAccounts as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->user->getFullname($modelValue->user->account_id); ?></td>
									<td><?php echo $modelValue->user->dob; ?></td>
									<td><?php echo $modelValue->user->address; ?></td>
									<td><?php echo $modelValue->user->name_of_father; ?></td>
									<td><?php echo $modelValue->user->name_of_mother; ?></td>
									<td><?php echo $modelValue->user->getGender($modelValue->user->account_id); ?></td>
									<td><?php echo $modelValue->getAccountStatus($modelValue->id)?></td>
								
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
