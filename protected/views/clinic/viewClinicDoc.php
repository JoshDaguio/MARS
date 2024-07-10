<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Clinic Information</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 	<p class="note"><strong>Clinic Information</strong></p>
	    	 	<table class="table table-bordered" width="100%" cellspacing="0">
				 <thead>
	                    <tr>
							<th>Clinic</th>
							<th>Address</th>
                            <th>Contact Number</th>
                            <th>Status</th>
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

