<style>
    /* Add hover effect to sidebar links */
    #accordionSidebar .nav-item:not(.non-hoverable):hover {
        background-color: #c73c41; /* Adjust the background color as needed */
        border-radius: 15px; /* Add border-radius */
        margin: 0 10px;
        border-bottom: 2px solid #fff; /* Add bottom border for main items */
        /* Adjust the padding for left and right margin */
    }

    /* Add hover effect to sidebar links when collapsed */
    #accordionSidebar .nav-item:not(.non-hoverable):hover .nav-link {
        color: #fff !important; /* Adjust the text color as needed */
    }

    /* Add hover effect with bottom border to all sublist items in the collapsed state */
    #accordionSidebar .nav-item:not(.non-hoverable) .collapse-inner .collapse-item:hover .nav-link {
        color: #000 !important; /* Adjust the text color to black */
        background-color: transparent !important; /* Remove the gray background */
        padding: 8px 10px; /* Adjust the padding for all dropdown items */
        position: relative; /* Add relative positioning */
        
    }

    /* Add bottom border for all sublist items when hovering */
    #accordionSidebar .nav-item:not(.non-hoverable) .collapse-inner .collapse-item:hover::after {
        content: "";
        display: block;
        width: 100%;
        height: 2px;
        background-color: #c73c41; /* Border color */
        
        position: absolute;
        bottom: 0;
        left: 0;
    }

    /* Add hover effect to sidebar headings */
    #accordionSidebar .sidebar-heading:not(.non-hoverable):hover {
        background-color: #c73c41; /* Adjust the background color as needed */
        border-radius: 12px; /* Add border-radius */
        /* Adjust the padding for left and right margin */
    }

    #accordionSidebar {
        width: 300px !important;
    }

    /* Your existing styles */
</style>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
    
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php $this->createAbsoluteUrl('site/index') ?>">
            <div class="sidebar-brand-icon">
                <img style="max-width: 70px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"/>
            </div>
            <div class="sidebar-brand-text mx-3">M.A.R.S</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
        	<?php echo CHtml::link('<i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>', $this->createAbsoluteUrl('site/index'), array('class'=>'nav-link')); ?>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading 1 -->
        <div class="sidebar-heading">
           Super Admin Profile Control
        </div>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-user"></i><span>My Profile</span></a>', $this->createAbsoluteUrl('account/viewSAProfile/' . Yii::app()->user->id), array('class'=>'nav-link')); ?>
        </li>

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
           Super Admin Controls
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-user-md"></i><span>Manage Doctors</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseDoctors', 'aria-expanded'=>'true', 'aria-controls'=>'collapseDoctors')); ?>

            <div id="collapseDoctors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Doctor', $this->createAbsoluteUrl('account/createDoctor'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Doctors', $this->createAbsoluteUrl('account/listDoctor'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-hospital"></i><span>Manage Clinics</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseClinics', 'aria-expanded'=>'true', 'aria-controls'=>'collapseClinics')); ?>

            <div id="collapseClinics" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Clinic', $this->createAbsoluteUrl('clinic/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Clinics', $this->createAbsoluteUrl('clinic/listClinic'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Assign Clinic', $this->createAbsoluteUrl('clinic/AssignClinic'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List of Clinic Assignment', $this->createAbsoluteUrl('clinic/ListClinicAssignment'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-calendar-week"></i><span>Manage Schedule</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseSchedule', 'aria-expanded'=>'true', 'aria-controls'=>'collapseSchedule')); ?>

            <div id="collapseSchedule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Schedule', $this->createAbsoluteUrl('doctorSched/CreateAdmin'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List of Schedule', $this->createAbsoluteUrl('doctorSched/listSched'),  array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-clipboard"></i><span>Manage Secretary</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseSecretary', 'aria-expanded'=>'true', 'aria-controls'=>'collapseSecretary')); ?>

            <div id="collapseSecretary" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Secretary', $this->createAbsoluteUrl('account/createSecretary'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Secretary', $this->createAbsoluteUrl('account/listSecretary'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-bed"></i><span>Manage Patients</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePatients', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePatients')); ?>

            <div id="collapsePatients" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Patient', $this->createAbsoluteUrl('account/createPatientAdmin'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Patients', $this->createAbsoluteUrl('account/listPatient'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-stethoscope"></i></i><span>Manage Consultation</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseConsultation', 'aria-expanded'=>'true', 'aria-controls'=>'collapseConsultation')); ?>

            <div id="collapseConsultation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Consultation', $this->createAbsoluteUrl('consultationRecord/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Consultation', $this->createAbsoluteUrl('consultationRecord/listConsultation'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-prescription"></i><span>Manage Prescriptions</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePrescriptions', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePrescriptions')); ?>

            <div id="collapsePrescriptions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Prescription', $this->createAbsoluteUrl('prescription/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Prescriptions', $this->createAbsoluteUrl('prescription/listPrescription'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>
        
        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-calendar-check"></i><span>Manage Appointment</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseAppointment', 'aria-expanded'=>'true', 'aria-controls'=>'collapseAppointment')); ?>

            <div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Appointment', $this->createAbsoluteUrl('Appointment/createAdmin'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Doctor Appointments', $this->createAbsoluteUrl('Appointment/calendarAdminDoc'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Patient Appointments', $this->createAbsoluteUrl('Appointment/calendarAdminPatient'), array('class'=>'collapse-item')); ?>
                    
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-syringe"></i><span>Manage Immunization</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseImmunization', 'aria-expanded'=>'true', 'aria-controls'=>'collapseImmunization')); ?>

            <div id="collapseImmunization" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Immunization', $this->createAbsoluteUrl('Immunization/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List of Immunization', $this->createAbsoluteUrl('Immunization/ListImmunization'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Assign Immunization', $this->createAbsoluteUrl('ImmunizationRecord/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List of Patient Immunization', $this->createAbsoluteUrl('ImmunizationRecord/ListImmunizationRecord'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>
        
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
           Account Settings
        </div>

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span></a>', $this->createAbsoluteUrl('site/logout'), array('class'=>'nav-link')); ?>
        </li>
    </ul>
    <!-- End of Sidebar --> 