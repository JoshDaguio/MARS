<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/moment/min/moment.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css' />



<?php
Yii::app()->clientScript->registerScript('appointmentScript', "
    $('#doctor_id, #clinic_id, #Appointment_appointment_date').change(function () {
        var doctorId = $('#doctor_id').val();
        var clinicId = $('#clinic_id').val();
        var selectedDate = $('#Appointment_appointment_date').val();

        $.ajax({
            type: 'GET',
            url: '" . $this->createUrl('appointment/getTimeSlots') . "',
            data: { doctorId: doctorId, clinicId: clinicId, selectedDate: selectedDate },
            success: function (data) {
                $('#time-slots-container').html(data);

            }
        });
    });


");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'createAppointment-form',
    'enableAjaxValidation'=>false,
)); ?>

<div class="col-sm-4 mb-4 mb-sm-0">
    <div>
        <label for="specialization">Select Specialization:</label>
        <?php echo CHtml::dropDownList('specialization', '', CHtml::listData($specializations, 'specialization', 'specialization'), array(
            'empty' => 'Select Specialization',
            'onchange' => 'loadDoctors(this.value)',
            'class' => 'form-control form-control-user',
        )); ?>
    </div>
</div>

    <div class="col-sm-4 mb-4 mb-sm-0" id="doctor-container" style="display:none;">
        <?php echo $form->labelEx($model, 'doctor_id'); ?>
        <?php echo $form->dropDownList($model, 'doctor_id', array(), array('empty' => 'Select Doctor',  'id' => 'doctor_id', 'class' => 'form-control form-control-user',)); ?>
        <?php echo $form->error($model, 'doctor_id'); ?>
    </div>

    <div class="col-sm-4 mb-4 mb-sm-0" id="clinic-container" style="display:none;">
        <?php echo $form->labelEx($model, 'clinic_id'); ?>
        <?php echo $form->dropDownList($model, 'clinic_id', array(), array('empty' => 'Select Clinic', 'id' => 'clinic_id', 'class' => 'form-control form-control-user',)); ?>
        <?php echo $form->error($model, 'clinic_id'); ?>
    </div>

    <div class="col-sm-4 mb-4 mb-sm-0" id="work-days-label-container" style="display:none;">
    <div id="work-days-label"></div>
    </div>
    


<div class="col-sm-4 mb-4 mb-sm-0">
	<?php
	echo $form->labelEx($model, 'appointment_date');
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model' => $model,
		'attribute' => 'appointment_date',
		'language' => 'en', // Language setting for the date picker
		'options' => array(
			'dateFormat' => 'yy-mm-dd', // Format of the date
			'showButtonPanel' => true,
			'changeYear' => true,
			'changeMonth' => true,
			'showOtherMonths' => true,
		),
		'htmlOptions' => array(
			'class' => 'form-control form-control-user', // Add your desired class for styling
		),
	));
	echo $form->error($model, 'appointment_date');
	?>
</div>



<div class="col-sm-4 mb-4 mb-sm-0" id="time-slots-container">
    <!-- Time slots will be dynamically populated here -->
</div>

<div class="col-sm-4 mb-4 mb-sm-0">
	<?php echo $form->labelEx($model,'title'); ?>
	<?php echo $form->textField($model,'title', array('class'=>'form-control form-control-user')); ?>
	<?php echo $form->error($model,'title'); ?>
</div>

<div class="col-sm-4 mb-4 mb-sm-0">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textField($model,'description', array('class'=>'form-control form-control-user')); ?>
	<?php echo $form->error($model,'description'); ?>
</div>

<!-- ... other form fields ... -->

<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('appointment/calendarPatient'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("createAppointment-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
</div>

<?php $this->endWidget(); ?>

<div id="calendar"></div>

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">
                <!-- Modal content will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>



<script>
     function loadDoctors(specializationId) {
        $.ajax({
            url: '<?php echo $this->createUrl("appointment/getDoctorsBySpecialization"); ?>',
            data: { specializationId: specializationId },
            type: 'GET',
            success: function (data) {
                var doctorDropdown = $('#doctor_id');
                doctorDropdown.html('<option value="">Select Doctor</option>'); // Start with a blank option
                $.each($.parseJSON(data), function (id, fullname) {
                    doctorDropdown.append($('<option>', {
                        value: id,
                        text: fullname
                    }));
                });

                $('#doctor-container').show();
            }
        });
    }
    function loadClinics(doctorId) {
        $.ajax({
            url: '<?php echo $this->createUrl("appointment/getClinicsByDoctor"); ?>',
            data: { doctorId: doctorId },
            type: 'GET',
            success: function (data) {
                var clinicDropdown = $('#clinic_id');
                clinicDropdown.html('<option value="">Select Clinic</option>'); // Start with a blank option
                $.each($.parseJSON(data), function (id, clinic) {
                    clinicDropdown.append($('<option>', {
                        value: id,
                        text: clinic
                    }));
                });

                $('#clinic-container').show();
            }
        });
    }
    
   


    
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            initialView: 'dayGridMonth',
            views: {
                timeGridWeek: {
                    titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
                },
                listWeek: { buttonText: 'list week' },
            },
            eventClick: function(info) {
            const date = moment(info.event.start).format('MMMM DD, YYYY');
            const time = moment(info.event.start).format('h:mm A');
            const text = info.event.extendedProps.text;

            // Build the content for the modal
            const modalContent = `
                <div class="modal-header">
                    <h5 class="modal-title">Event Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Date:</strong> ${date}</p>
                    <p><strong>Time:</strong> ${time}</p>
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
        function updateWorkDaysLabel(doctorId, clinicId) {
            if (clinicId) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->createUrl("appointment/GetWorkDaysByClinic"); ?>',
                    data: { doctorId: doctorId, clinicId: clinicId },
                    success: function (workDays) {
                        $('#work-days-label').text('Work Days: ' + workDays);
                        $('#work-days-label-container').show();
                    }
                });
            } else {
                // If no clinic is selected, hide the "Work Days" label container
                $('#work-days-label-container').hide();
            }
        }
        

        function updateCalendarEvents(doctorId, clinicId) {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->createUrl("appointment/GetDoctorEvents"); ?>',
                data: { doctorId: doctorId, clinicId: clinicId },
                success: function(events) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(events);
                    calendar.render();
                }
            });
        }

        
        $('#doctor_id').change(function() {
            var doctorId = $(this).val();
            updateCalendarEvents(doctorId);
            loadClinics(doctorId);
        });
        
        loadClinics($('#doctor_id').val()); 

        // Update events and clinics when the doctor is changed
       
        $('#clinic_id').change(function() {
            var clinicId = $(this).val();
            var doctorId = $('#doctor_id').val(); // Retrieve the current doctorId
            updateWorkDaysLabel(doctorId, clinicId);
            updateCalendarEvents(doctorId, clinicId);
        });

        
        updateWorkDaysLabel($('#doctor_id').val(), $('#clinic_id').val());
        updateCalendarEvents($('#doctor_id').val(), $('#clinic_id').val());
        
        
    });
    
</script>

