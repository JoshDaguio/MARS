<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Clinic Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Clinic Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Clinic</th>
							<th>Address</th>
                            <th>Contact Number</th>
                            <th>Status</th>
							<th>Update</th>
							<th>Change Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($clinic as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->clinic; ?></td>
									<td><?php echo $modelValue->address; ?></td>
                                    <td><?php echo $modelValue->contact_number; ?></td>
                                    <td><?php echo $modelValue->getStatus($modelValue->id) ?></td>
                                    <?php
                                    echo "<td class='text-center'>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('clinic/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('clinic/changeStatus/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
                                    ?>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Assigned Doctors</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Doctor</th>
							<th>Specialization</th>
							<th>Status</th>
							<th>View Doctor</th>

	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($clinic as $modelValue)
							{
						?>
							<?php foreach ($modelValue->clinicAssignments as $assignment): ?>
								<tr>
									<td><?php echo $assignment->account->user->getFullname($assignment->account->id) ?></td>
									<td><?php echo $assignment->account->user->specialization; ?></td>
                                    <td><?php echo $assignment->getStatus($assignment->id) ?></td>
									<?php 
										echo "<td class='text-center'>" . CHtml::link('<i class="fas fa-info-circle"></i>', array('account/viewAccount', 'id' => $assignment->account_id), array('class' => 'btn btn-info btn-circle btn-sm')) . "</td>";
									?>
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

