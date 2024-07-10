<?php
/* @var $this SecretaryController */
/* @var $model Secretary */
?>


<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Choose Secretary</h6>
		    </div>
		    <div class="card-body">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>
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
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
	    	 		<thead>
	                    <tr>
                            <th>Fullname</th>
							<th>dob</th>
                            <th>address</th>
                            <th>gender</th>
							<th class="text-center">V</th>
							<th class="text-center">D</th>
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
									<td><?php echo $modelValue->secretary->user->dob; ?></td>
									<td><?php echo $modelValue->secretary->user->address; ?></td>
									<td><?php echo $modelValue->secretary->user->getGender($modelValue->secretary->id); ?></td>
									<?php 
										echo "<td class='text-center'>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('secretary/view/'.$modelValue->secretary->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
										echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('secretary/ChangeStatus/'.$modelValue->id), array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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

