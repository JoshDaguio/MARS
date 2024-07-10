<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Doctors</h6>
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
							<th>ID</th>
							<th>Fullname</th>
							<th>Specialization</th>
							<th>Lic. #</th>
							<th>PTR</th>
							<th>S2</th>
							<th>Maxicare</th>
							<th>Email Address</th>
							<th>Status</th>
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
									<td><?php echo $modelValue->id ?></td>
									<td><?php echo $modelValue->user->getFullname($modelValue->id); ?></td>
									<td><?php echo $modelValue->user->specialization; ?></td>
									<td><?php echo $modelValue->user->license_number; ?></td>
									<td><?php echo $modelValue->user->ptr_number; ?></td>
									<td><?php echo $modelValue->user->s2_number; ?></td>
									<td><?php echo $modelValue->user->maxicare_number; ?></td>
									<td><?php echo $modelValue->email_address; ?></td>
									<td><?php echo $modelValue->getAccountStatus($modelValue->id); ?></td>
									<?php 
									echo "<td>" . CHtml::link('<i class="fas fa-info-circle"></i>', array('account/viewAccount', 'id' => $modelValue->id), array('class' => 'btn btn-info btn-circle btn-sm')) . "</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('account/updateDoctor/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('account/changeStatusDoc/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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
