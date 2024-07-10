<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Prescription History</h6>
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
							<th>Doctor</th>
							<th>Specialization</th>
                            <th>Consultation Plan</th>
							<th>Prescription</th>
                            <th>Prescription Date</th>
							<th>V</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfPrescriptionHistory as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->doctorAccount->user->getFullname($modelValue->doctorAccount->user->account_id); ?></td>
									<td><?php echo $modelValue->doctorAccount->user->specialization; ?></td>
                                    <td><?php echo $modelValue->consultation->plan; ?></td>
									<td><?php echo $modelValue->prescription ?></td>
									<td><?php echo ($modelValue->date_of_prescription !== '' && $modelValue->date_of_prescription !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->date_of_prescription)) :"Not Available";?></td>
									<?php 
										echo "<td class='text-center'>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('prescription/viewPatient/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
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