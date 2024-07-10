<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css' />
    <script src='https://cdn.jsdelivr.net/npm/moment/min/moment.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('patientcalendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'title',
                    center: '',
                    right: 'prev,next today'
                },
                initialView: 'dayGridMonth',
                views: {
                    timeGridWeek: { // customize options for the timeGridWeek view
                        titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
                        // Add more customization options if needed
                    },
                    listWeek: { buttonText: 'list week' }, // customize the button text for listWeek view
                },
                events: '<?php echo $this->createUrl("site/EventsPatient"); ?>',
                eventClick: function(info) {
                    const date = moment(info.event.start).format('MMMM DD, YYYY');
                    const time = moment(info.event.start).format('h:mm A');
                    const doctorName = info.event.extendedProps.doctorName;
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
                            <p><strong>Doctor:</strong> ${doctorName}</p>
                        </div>
                    `;

                    // Create a Bootstrap Modal
                    const modal = new bootstrap.Modal(document.getElementById('eventModal'), {
                        backdrop: 'static',
                        keyboard: true
                    });

            // Set the content and show the modal
                    document.getElementById('modalContent').innerHTML = modalContent;
                    modal.show();
                },
            });
            calendar.render();
        });
    </script>
   <style>
    
     #patientcalendar {
            height: 600px;
            margin-top: 20px;
            border-radius:10px;
            /* Additional styles as needed */
        
    }
</style>
</head>

<body>
    <div id='patientcalendar'></div>

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


</html>