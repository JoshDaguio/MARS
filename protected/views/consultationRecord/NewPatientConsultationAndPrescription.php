<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Information</h6>
	    </div>
	    <div class="card-body">
			<div class="table-responsive">
			 	<p class="note"><strong>Patient Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Fullname</th>
							<th>Date of Birth</th>
							<th>Gender</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($NewPatient as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->user->getFullname($modelValue->user->account_id); ?></td>
									<td><?php echo ($modelValue->user->dob !== '' && $modelValue->user->dob !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->user->dob)) :"Not Available";?></td>
									<td><?php echo $modelValue->user->getGender($modelValue->user->account_id); ?></td>
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
<?php foreach($NewPatient as $modelValue){
	if($modelValue->birthHistory == null){

	}else { ?>
	<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Birth History</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Birth History</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Blood Type</th>
							<th>Term</th>
							<th>Type of Delivery</th>
							<th>Birth Weight</th>
							<th>Birth Length</th>
							<th>Head Circumference</th>
							<th>Chest Circumference</th>
							<th>Abdominal Circumference</th>
	                    </tr>
	                </thead>
	                <tbody>
								<tr>
									<td><?php echo $modelValue->birthHistory->BloodType($modelValue->id); ?></td>
									<td><?php echo $modelValue->birthHistory->Term($modelValue->id) ?></td>
									<td><?php echo $modelValue->birthHistory->ToD($modelValue->id); ?></td>
									<td><?php echo $modelValue->birthHistory->birth_weight; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_length; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_head_circumference; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_chest_circumference; ?></td>
									<td><?php echo $modelValue->birthHistory->birth_abdominal_circumference; ?></td>
								</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<?php }?>

<?php }  ?>			


<div class = "row">
	<div class="col-xl-12 col-lg-12">

		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Create Patient Consultation</h6>
		    </div>
		    <div class="card-body">
				<?php echo $this->renderPartial('_formConsultationAndPrescription', array('consultationRecord' => $consultationRecord, 'prescription' => $prescription, 'PatientTable'=>$PatientTable, 'DoctorTable'=>$DoctorTable)); ?>
			</div>
		</div>
	</div>
</div>
