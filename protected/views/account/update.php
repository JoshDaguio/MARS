<div class = "row">
	<div class="col-xl-8 col-lg-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	            <h6 class="m-0 font-weight-bold text-primary">Update Doctor Account</h6>
	        </div>
	        <div class="card-body">
				<?php echo $this->renderPartial('_updateform', array('account' => $account, 'user' => $user)); ?>
			</div>
		</div>
		<br/>
	</div>
	<div class="col-xl-4 col-lg-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Specializations Tally</h6>
            </div>
            <div class="card-body">
  				<?php 
  					$specialization = $user->getSpecializationTally(10);
  					foreach($specialization as $key=>$value)
  					{
  				?>
		                <h4 class="small font-weight-bold"><?php echo $key; ?> <span class="float-right"><?php echo $value."%"; ?></span></h4>
		                <div class="progress mb-4">
		                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $value; ?>%"
		                        aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
		                </div>
		        <?php
		        	}
		        ?>
            </div>
		</div>
	</div>
</div>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Doctors</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
	    	 	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	    	 		<thead>
	                    <tr>
							<th>Fullname</th>
							<th>Specialization</th>
							<th>Lic. #</th>
							<th>PTR</th>
							<th>S2</th>
							<th>Maxicare</th>
							<th>Subscription</th>
							<th>V</th>
							<th>E</th>
							<th>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAccounts as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->user->getFullname($modelValue->id); ?></td>
									<td><?php echo $modelValue->user->specialization; ?></td>
									<td><?php echo $modelValue->user->license_number; ?></td>
									<td><?php echo $modelValue->user->ptr_number; ?></td>
									<td><?php echo $modelValue->user->s2_number; ?></td>
									<td><?php echo $modelValue->user->maxicare_number; ?></td>
									<td><?php echo ($modelValue->expiration_date!=''&&$modelValue->expiration_date!='0000-00-00')?date('M d,Y', strtotime($modelValue->expiration_date)):"Unlimited"; ?></td>
									<?php 
									echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('account/viewDoctor/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('account/updateDoctor/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('account/deleteDoctor/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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
