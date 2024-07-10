<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css' />
    <script src='https://cdn.jsdelivr.net/npm/moment/min/moment.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek,listDay'
                },
                initialView: 'dayGridMonth',
                views: {
                    timeGridWeek: { // customize options for the timeGridWeek view
                        titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
                        // Add more customization options if needed
                    },
                    listWeek: { buttonText: 'list week' }, // customize the button text for listWeek view
                },
                events: './EventsDoc',
                eventClick: function(info) {
                    const date = moment(info.event.start).format('MMMM DD, YYYY');
                    const time = moment(info.event.start).format('h:mm A');
                    const patientName = info.event.extendedProps.patientName;
                    // Build the content for the modal
                    const modalContent = `
                        <div class="modal-header">
                            <h5 class="modal-title">Event Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Event:</strong> ${info.event.title}</p>
                            <p><strong>Description</strong> ${info.event.extendedProps.desc}</p>
                            <p><strong>Date:</strong> ${date}</p>
                            <p><strong>Time:</strong> ${time}</p>
                            <p><strong>Patient:</strong> ${patientName}</p>
                        </div>
                    `;

                    // Create a Bootstrap Modal
                    const modal = new bootstrap.Modal(document.getElementById('eventModal'), {
                        backdrop: 'static',
                        keyboard: false
                });

            // Set the content and show the modal
                document.getElementById('modalContent').innerHTML = modalContent;
                modal.show();
             },

                
            });
            calendar.render();
        });
    </script>
</head>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Appointment</h6>
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
							<th>Title</th>
                            <th>Description</th>
                            <th>Clinic</th>
							<th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
							<th class='text-center'>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAppointment as $modelValue)
							{
						?>
								<tr>
                                    <td><?php echo $modelValue->patientAccount->user->getFullname($modelValue->patientAccount->id); ?></td>
									<td><?php echo $modelValue->title; ?></td>
                                    <td><?php echo $modelValue->description; ?></td>
                                    <td><?php echo $modelValue->clinic->clinic; ?></td>
                                    <td><?php echo ($modelValue->appointment_date !== '' && $modelValue->appointment_date !== '0000-00-00') ? date('M d, Y', strtotime($modelValue->appointment_date)) :"Not Available";?></td>
									<td><?php echo $modelValue->appointment_time; ?></td>
									<td><?php echo $modelValue->getStatus($modelValue->id); ?></td>
									<?php 
                                    echo "<td class='text-center'>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('appointment/ChangeStatus/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to remove this appointment?")'))."</td>";
		                           
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
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">Appointment Calendar</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
             <body>
                <div id='calendar'></div>

                <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <!-- Modal content will be dynamically inserted here -->
                </div>
            </div>
        </div>
            </div>
            </body>
			    
			</div>
		</div>
	</div>
</div>
</html>
