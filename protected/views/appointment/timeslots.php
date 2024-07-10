<?php if (!empty($timeSlots)): ?>
    <label for="Appointment_time_slot">Select Time Slot:</label>
    <?php echo CHtml::dropDownList('Appointment[time_slot]', null, array_combine($timeSlots, $timeSlots), array('class'=>'form-control form-control-user')); ?>
<?php else: ?>
    <p>No available Schedule for the selected date and doctor.</p>
<?php endif; ?>