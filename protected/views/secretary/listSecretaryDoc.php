<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Secretary</h6>
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
	    	 	<table class="table table-bordered"  width="100%" cellspacing="0">
	    	 		<thead>
	                    <tr>
                            <th>Fullname</th>
							<th>Date of Birth</th>
                            <th>Address</th>
                            <th>Gender</th>
							<th>V</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAccounts as $modelValue)
							{
						?>
								<tr>
								<tr>
									<td><?php echo $modelValue->secretary->user->getFullname($modelValue->secretary->id); ?></td>
									<td><?php echo ($modelValue->secretary->user->dob !== '' && $modelValue->secretary->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->secretary->user->dob)) :"Not Available";?></td>
									<td><?php echo $modelValue->secretary->user->address; ?></td>
									<td><?php echo $modelValue->secretary->user->getGender($modelValue->secretary->id); ?></td>
									<?php 
									echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('secretary/view/'.$modelValue->secretary->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
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
