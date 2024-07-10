<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Patient Appointment Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Appointment Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
                            <th>Doctor</th>
							<th>Title</th>
                            <th>Description</th>
							<th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAppointment as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->doctorAccount->user->getFullname($modelValue->doctorAccount->id); ?></td>
									<td><?php echo $modelValue->title; ?></td>
                                    <td><?php echo $modelValue->description; ?></td>
                                    <td><?php echo ($modelValue->appointment_date !== '' && $modelValue->appointment_date !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->appointment_date)) :"Not Available";?></td>
									<td><?php echo $modelValue->appointment_time; ?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id); ?></td>
								</tr>
						<?php		
							}
						?>
					</tbody>
				</table>
			</div>
            <div class="table-responsive">
			 	<p class="note"><strong>Doctor Information</strong></p>
	    	 	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
                            <th>Doctor</th>
                            <th>Specialization</th>
							<th>Clinic</th>
                            <th>Clinic Address</th>
                            <th>Clinic Contact Number</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAppointment as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->doctorAccount->user->getFullname($modelValue->doctorAccount->id); ?></td>
                                    <td><?php echo $modelValue->doctorAccount->user->specialization; ?></td>
									<td><?php echo $modelValue->clinic->clinic ?></td>
                                    <td><?php echo $modelValue->clinic->address ?></td>
                                    <td><?php echo $modelValue->clinic->contact_number ?></td>
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








