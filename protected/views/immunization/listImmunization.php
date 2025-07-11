<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Immunization</h6>
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
							<th>Immunization</th>
                            <th>Description</th>
                            <th>Status</th>
							<th class='text-center'>V</th>
							<th class='text-center'>E</th>
							<th class='text-center'>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($list as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->id ?></td>
									<td><?php echo $modelValue->immunization ?></td>
									<td><?php echo $modelValue->description ?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id)?></td>
									<?php 
									echo "<td class='text-center'>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('immunization/viewImmunization/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
		                            echo "<td class='text-center'>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('immunization/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('immunization/delete/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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