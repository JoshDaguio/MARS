<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Active Patients</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
	    	 	<?php if(Yii::app()->user->hasFlash('success')):?>
			    <div class="border-bottom-success ">
			        <?php echo Yii::app()->user->getFlash('success'); ?>
			    </div>
			    <?php endif; ?>
			    <?php if(Yii::app()->user->hasFlash('error')):?>
			        <div class="border-bottom-danger ">
			            <?php echo Yii::app()->user->getFlash('error'); ?>
			        </div>
			    <?php endif; ?>
	    	 	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Fullname</th>
							<th>Date of Birth</th>
                            <th>Address</th>
                            <th>Name of Father</th>
                            <th>Name of Mother</th>
                            <th>Gender</th>
							<th class="text-center">V</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAccounts as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->user->account_id); ?></td>
									<td><?php echo ($modelValue->patientAccount->user->dob !== '' && $modelValue->patientAccount->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->patientAccount->user->dob)) :"Not Available";?></td>
									<td><?php echo $modelValue->patientAccount->user->address; ?></td>
									<td><?php echo $modelValue->patientAccount->user->name_of_father; ?></td>
									<td><?php echo $modelValue->patientAccount->user->name_of_mother; ?></td>
									<td><?php echo $modelValue->patientAccount->user->getGender($modelValue->patientAccount->user->account_id); ?></td>
									<?php 
									echo "<td class='text-center'>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('account/viewAccountForDoctor/'.$modelValue->patientAccount->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
		            
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