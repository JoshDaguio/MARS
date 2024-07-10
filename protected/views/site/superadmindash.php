<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include Animate.css from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Additional style to slow down the animation */
        

       
        @keyframes cardAnimation {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* Apply the animation to the card element */
        .card-animation {
            animation: cardAnimation 1s ease-out; /* Adjust duration and timing function as needed */
        }

        .card.border-left-info {
            animation: cardAnimation 1s ease-out; /* Adjust duration and timing function as needed */
        }

        
        .left-to-right-animation {
        animation: fadeInLeft 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
       
    </style>
</head>
<body>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Super Admin Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Total Clinic Card -->
    <?php $totalClinics = Clinic::getTotalClinics(); ?>
    <div class="col-xl-3 col-md-6 mb-4 animate__animated animate__fadeIn">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Clinics</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalClinics; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Prescription Card -->
    <?php $totalPrescriptions = Prescription::getTotalPrescriptions(); ?>
    <div class="col-xl-3 col-md-6 mb-4 animate__animated animate__fadeIn">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Prescriptions</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPrescriptions; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-prescription-bottle-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Consultation Card -->
    <?php $totalConsultations = ConsultationRecord::getTotalConsultations(); ?>
    <div class="col-xl-3 col-md-6 mb-4 animate__animated animate__fadeIn">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Consultations</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalConsultations; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Appointment Card -->
    <?php $totalAppointments = Appointment::getTotalAppointments(); ?>
    <div class="col-xl-3 col-md-6 mb-4 animate__animated animate__fadeIn">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Appointments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAppointments; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5 left-to-right-animation card-animation">
        <div class="card shadow mb-5" style="height: 600px;">
            <!-- Card Header -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Population Chart</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php echo $this->renderPartial('pieChart', array('data' => $data)); ?>
            </div>
        </div>
    </div>

    <!-- Specialization Card -->
    <div class="col-xl-4 col-lg-5 left-to-right-animation card-animation">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Specializations Tally</h6>
            </div>
            <div class="card-body" style="max-height: 546px; overflow-y: auto;">
                <?php 
                    $specialization = $user->getSpecializationTally();
                    foreach($specialization as $key=>$value)
                    {
                ?>
                        <h4 style="font-size: 16px"><?php echo $key; ?> <span class="float-right"><?php echo $value."%"; ?></span></h4>
                        <div class="progress mb-5">
                            <div 
                            class="progress-bar bg-success" role="progressbar" style="width: <?php echo $value; ?>%"
                            aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Demographic Bar Chart Card -->
    <?php
        list($totalAdults, $totalChildren) = User::getTotalAdultsAndChildren();
        $adultsPercentage = ($totalAdults / ($totalAdults + $totalChildren)) * 100;
        $childrenPercentage = ($totalChildren / ($totalAdults + $totalChildren)) * 100;
    ?>
    <div class="col-xl-4 col-lg-5 left-to-right-animation card-animation">
        <div class="card shadow mb-5" style="height: 600.50px;">
            <!-- Card Header -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 18px;">Demographic Distribution: Adults vs. Children</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- Canvas for Chart.js -->
                <canvas id="columnChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- JavaScript to initialize Chart.js and create the column chart -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('columnChart').getContext('2d');
            var columnChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Adults', 'Children'],
                    datasets: [{
                        label: 'Percentage',
                        data: [<?= $adultsPercentage ?>, <?= $childrenPercentage ?>, '', '100'],
                        backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>