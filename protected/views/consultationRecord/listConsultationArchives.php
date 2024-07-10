<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Consultation Archives</h6>
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
                            <th>Patient</th>
                            <th>Subjective</th>
                            <th>Objective</th>
                            <th>Assessment</th>
                            <th>Plan</th>
                            <th>Notes</th>
                            <th>Date of Consultation</th>
							<th>Status</th>
							<th>V</th>
							<th>E</th>
							<th>D</th>
							
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfConsultationArchives as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->user->account_id); ?></td>
                                    <td><?php echo $modelValue->subjective ?></td>
                                    <td><?php echo $modelValue->objective ?></td>
                                    <td><?php echo $modelValue->assessment ?></td>
                                    <td><?php echo $modelValue->plan ?></td>
                                    <td><?php echo $modelValue->notes ?></td>
									<td><?php echo ($modelValue->date_of_consultation !== '' && $modelValue->date_of_consultation !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->date_of_consultation)) :"Not Available";?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id); ?></td>
									<?php 
									echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('consultationRecord/view/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('consultationRecord/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('consultationRecord/ChangeStatus/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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