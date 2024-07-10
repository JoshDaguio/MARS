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
                <img style="max-width: 40px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"/>
            </div>
            <div class="sidebar-brand-text mx-3">M.A.R.S</div>
        </a>

         <!--Divider -->
         <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <?php echo CHtml::link('<i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>', $this->createAbsoluteUrl('site/index'), array('class'=>'nav-link')); ?>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading 1 -->
        <div class="sidebar-heading">
            Doctor Profile Control
        </div>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-user-md"></i><span>My Profile</span></a>', $this->createAbsoluteUrl('account/viewDocProfile/' . Yii::app()->user->id), array('class'=>'nav-link')); ?>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
           Profile Management
        </div>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-hospital"></i><span>Clinics</span></a>', $this->createAbsoluteUrl('clinic/listClinicDoc'), array('class'=>'nav-link')); ?>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-calendar-check"></i><span>Appointments &amp; Queue</span></a>', $this->createAbsoluteUrl('appointment/calendarDoc'), array('class'=>'nav-link')); ?>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-calendar-week"></i><span>Manage Schedule</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseSchedule', 'aria-expanded'=>'true', 'aria-controls'=>'collapseSchedule')); ?>

            <div id="collapseSchedule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Schedule', $this->createAbsoluteUrl('doctorSched/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Schedule', $this->createAbsoluteUrl('doctorSched/listSchedDoc'),  array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-clipboard"></i><span>Manage Secretary</span></a>', $this->createAbsoluteUrl('secretary/create'), array('class'=>'nav-link')); ?>
        </li>
        

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
           Patient Management
        </div>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-user"></i><span>Manage Patients</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePatients', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePatients')); ?>

            <div id="collapsePatients" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Search Patient', $this->createAbsoluteUrl('account/SearchPatient'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Add Patient', $this->createAbsoluteUrl('account/createPatient'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Active Patients', $this->createAbsoluteUrl('account/listActivePatients'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List of Patient', $this->createAbsoluteUrl('account/listPatientDoc'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-stethoscope"></i><span>Consultation Archives</span></a>', $this->createAbsoluteUrl('consultationRecord/listConsultationArchives'), array('class'=>'nav-link')); ?>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-prescription"></i><span>Prescription Archives</span></a>', $this->createAbsoluteUrl('prescription/listPrescriptionArchives'), array('class'=>'nav-link')); ?>
        </li>
        
        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-hospital-user"></i><span>Patient Immunization</span></a>', $this->createAbsoluteUrl('immunizationRecord/listPatientImmunization'), array('class'=>'nav-link')); ?>
        </li>

        <!-- <li class="nav-item">
            <?php //echo CHtml::link('<i class="fas fa-fw fa-file"></i><span>Form Testing</span></a>', $this->createAbsoluteUrl('consultationRecord/createConsultationAndPrescription'), array('class'=>'nav-link')); ?>
        </li> -->

         <!-- Divider -->
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