<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Immunization Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Patient Immunzation</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Patient</th>
                            <th>Immunization</th>
                            <th>Description</th>
                            <th>Status</th>
							<th>E</th>
							<th>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($immunizations as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->account->user->getFullname($modelValue->account->id); ?></td>
                                    <td><?php echo $modelValue->immunization; ?></td>
									<td><?php echo $modelValue->description; ?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id)?></td>
									<?php 
		                            echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('immunization/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('immunization/delete/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
		                            ?>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
			 	<p class="note"><strong>Patients with Immunization</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
                            <th>Patient</th>
							<th>Immunization</th>
							<th>Immunization Date</th>
							<th>Remarks</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($immunizations as $modelValue)
							{
						?>
							<?php foreach ($modelValue->immunizationRecords as $immunization): ?>
								<tr>
                                        <td><?php echo $immunization->account->user->getFullname($immunization->account->id); ?></td>
                                    	<td><?php echo $immunization->immunization->immunization; ?></td>
										<td><?php echo ($immunization->date !== '' && $immunization->date !== '0000-00-00') ? date('M d, Y', strtotime($immunization->date)) :"Not Available";?></td>
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

			

