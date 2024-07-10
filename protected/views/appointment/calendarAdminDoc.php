<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css' />
<script src='https://cdn.jsdelivr.net/npm/moment/min/moment.min.js'></script>

<script>
    function loadClinics(doctorId) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->createUrl("appointment/getClinicsByDoctorAdmin"); ?>',
            data: { doctorId: doctorId },
            success: function (clinics) {
            console.log(clinics);
            var clinicsData = JSON.parse(clinics);

            // Clear existing options before adding new ones
            $('#clinic_id').empty();

            // Append new options
            $.each(clinicsData, function (value, text) {
                $('#clinic_id').append($('<option>', {
                    value: value,
                    text: text
                }));
            });

            // Trigger change event after loading clinics to update the calendar
            $('#clinic_id').change();
            }
            });
    }
    document.addEventListener('DOMContentLoaded', function () {
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
                const patientName = info.event.extendedProps.patientName;
                const title = info.event.extendedProps.label;
                const desc = info.event.extendedProps.desc;
            // Build the content for the modal
                const modalContent = `
                <div class="modal-header">
                    <h5 class="modal-title">Event Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Patient:</strong> ${patientName}</p>
                    <p><strong>Date:</strong> ${date}</p>
                    <p><strong>Time:</strong> ${time}</p>
                    <p><strong>Title:</strong> ${title}</p>
                    <p><strong>Description:</strong> ${desc}</p>
                </div>
            `; const modal = new bootstrap.Modal(document.getElementById('eventModal'), {
                backdrop: 'static',
                keyboard: false
            });

            // Set the content and show the modal
            document.getElementById('modalContent').innerHTML = modalContent;
            modal.show();
        },
            
        });


        function updateCalendarEvents(doctorId, clinicId) {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->createUrl("appointment/GetDoctorEventsAdmin"); ?>',
                data: { doctorId: doctorId, clinicId: clinicId },
                success: function(events) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(events);
                    calendar.render();
                }
            });
        }

        

        // Initial update based on the default selected doctor and clinic
        updateCalendarEvents($('#Appointment_doctor_id').val(), $('#clinic_id').val());

        // Update clinics when the doctor is changed
        $('#Appointment_doctor_id').change(function() {
            var doctorId = $(this).val();
            loadClinics(doctorId);
        });

        // Update events when the clinic is changed
        $('#clinic_id').change(function() {
            var clinicId = $(this).val();
            var doctorId = $('#Appointment_doctor_id').val();
            updateCalendarEvents(doctorId, clinicId);
        });

        calendar.render();
    });
</script>

<div class = "row">
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Doctor Appointment</h6>
        </div>
        <div class="card-body">
             <div class="table-responsive">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <label for="Appointment_doctor_id">Doctor</label>
                    <?php
                        echo CHtml::dropDownList(
                            'Appointment_doctor_id',
                            '',
                        CHtml::listData(Account::model()->with('user')->findAll(array(
                            'condition' => 'account_type_id=:account_type_id',
                            'params' => array(
                            ':account_type_id' => 3,
                            ),
                        )), 'id', function($account) {
                    return $account->user->getFullname($account->id);
                        }),
                     array('empty' => 'Select Doctor', 'id' => 'Appointment_doctor_id', 'class' => 'form-control form-control-user')
                        );
                    ?>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <label for="clinic_id">Clinic</label>
                        <?php echo CHtml::dropDownList(
                            'clinic_id', 
                            '', 
                            array(), 
                            array('empty' => 'Select Clinic', 'id' => 'clinic_id', 'class' => 'form-control form-control-user')
                        ); ?>
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
            </div>
        </div>
    </div>
</div>



<div class="col-xl-12 col-lg-12">
    <?php echo $this->renderPartial('DocAppointmentTable', array('model' => $model)); ?>
</div>