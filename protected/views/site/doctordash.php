<!-- CSS -->
<style>
    .custom-header-style {
        background-color: #EEEEEE; /* Change to your desired color */
        color: #000000; /* Change to your desired text color */
    }

    .custom-body {
        background-color: #FAFAFA;
        /* Adjust the width as needed */
        width: 100%; /* You can change this value to a specific width or use other CSS properties to control the width */
    }

    .card {
  position: relative;
  animation: slideIn 1.3s ease-out;
  animation-fill-mode: forwards;
  opacity: 0;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-100%);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>
<!-- Queries -->
<?php
    $account = Account::model()->findByPk(Yii::app()->user->id);
    $specialization = $account->user->specialization;

    $account = Account::model()->findByPk(Yii::app()->user->id);
    $gender = $account->user->gender;
    
    $count = ConsultationRecord::model()->count(array(
        'condition' => 'doctor_account_id=:id',
        'params' => array(':id' => Yii::app()->user->id)
    
    ));
?>

<!-- Include Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Doctor Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    

<!-- Doctor Profile Card -->
<div class="col-xl-5 col-lg-6 mb-4">
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Doctor Profile</h6>
        </div>
        <div class="card-body text-center" style="height: 650px;">
            <?php if ($gender === 1) { ?>
                <img class="img-profile rounded-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/male-icon.png" style="width: 50%; height: auto;">
            <?php } else { ?>
                <img class="img-profile rounded-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/female-icon.png" style="width: 50%; height: auto;">
            <?php } ?>

            <p>
                <span class="m-0 font-weight-bold text-primary" style="font-size: 32px; color: blue;">Welcome, Doctor </span>
                <span style="font-size: 28px; color: black;"><?php echo User::model()->getFullname(Yii::app()->user->id); ?>!</span>
            </p>

            <hr class="my-3" style="border-width: 3px; border-color: #f0f0f0;">

            <!-- Specialization Card -->
            <h5 class="m-0 font-weight-bold text-primary"> <i class="fas fa-fw fa-user-md"></i> Your Specialization:</h5>
            <div class="card mb-3" style="max-width: 25rem; margin: 0 auto;">
                <div class="card-body">
                    <p class="card-text" style="font-size: 17px; color: #555;"><?php echo $specialization; ?></p>
                </div>
            </div>

            <hr class="my-3" style="border-width: 3px; border-color: #f0f0f0;">

            <!-- Total Patients Card -->
            <h5 class="m-0 font-weight-bold text-primary"> <i class="fas fa-fw fa-bed"></i> Total Patients You Consulted:</h5>
            <div class="card mb-3" style="max-width: 5rem; margin: auto;">
                <div class="card-body">
                    <p class="card-text" style="font-size: 17px; color: #555;"><?php echo $count; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Patient History Table -->
<div class="col-xl-7 col-lg-3 mb-4">
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Your Recent Patients History</h6>
        </div>
        <div class="card-body" style="height: 650px; overflow-x: auto;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Patient Name</th>
                            <th scope="col" class="text-center">Consultation Date</th>
                            <!-- Add more table headers based on your data model -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch recent patient entries based on date_of_consultation
                        $recentConsultations = ConsultationRecord::model()->findAll(array(
                            'order' => 'date_of_consultation DESC',
                            'condition' => 'doctor_account_id=:id AND status_id = 1',
                            'params' => array(':id' => Yii::app()->user->id),
                        ));

                        // Iterate through the recent consultations and display patient information
                        foreach ($recentConsultations as $consultation) {
                            $patientAccount = Account::model()->find($consultation->patient_account_id);
                            $patientName = $patientAccount->user->getFullname($consultation->patient_account_id);
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $patientName; ?></td>
                                <td class="text-center"><?php echo ($consultation->date_of_consultation !== '' && $consultation->date_of_consultation !== '0000-00-00') ? date('M d, Y', strtotime($consultation->date_of_consultation)) :"Not Available";?></td>                                <!-- Add more table cells based on your data model -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Patient Activity Card -->
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-5 mt-n5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Your Patients Activity</h6>
        </div>
        <div class="card-body" style="height: 650px; max-width: auto;">
            <canvas id="wavelengthChart" style="width: 100%; height: 100%;"></canvas>
            <?php
            // Assuming $patientCounts is an array that contains patient counts for each doctor
            if (isset($patientCounts[Yii::app()->user->id])) {
                $monthlyCounts = $patientCounts[Yii::app()->user->id];

                // Prepare data for the wavelength chart
                $chartLabels = [];
                $chartData = [];

                // Iterate through the monthly counts for the current doctor
                foreach ($monthlyCounts as $month => $count) {
                    // Format the month to display only the month portion
                    $formattedMonth = date('F', strtotime($month));

                    $chartLabels[] = $formattedMonth;

                    // Check if $count is an array
                    if (is_array($count)) {
                        // Handle the array appropriately (for simplicity, sum the values)
                        $chartData[] = array_sum($count);
                    } else {
                        // $count is a single value
                        $chartData[] = $count;
                    }
                }

                // Output the prepared data for the chart
                echo "<script>";
                echo "var ctx = document.getElementById('wavelengthChart').getContext('2d');";
                echo "var data = {";
                echo "labels: " . json_encode($chartLabels) . ",";
                echo "datasets: [{";
                echo "label: 'Patients',";
                echo "borderColor: 'green',";
                echo "backgroundColor: 'green',";
                echo "pointRadius: 6,";
                echo "pointStyle: 'circle',";
                echo "fill: false,";
                echo "data: " . json_encode($chartData);
                echo "}]};";
                echo "var options = {";
                echo "responsive: true,";
                echo "maintainAspectRatio: false,";
                echo "scales: {";
                echo "x: [{";
                echo "scaleLabel: {";
                echo "display: true,";
                echo "labelString: 'Months'";
                echo "}}],";
                echo "y: [{";
                echo "scaleLabel: {";
                echo "display: true,";
                echo "labelString: 'Numbers'";
                echo "},";
                echo "ticks: {";
                echo "beginAtZero: false,";
                echo "stepSize: 5,";
                echo "suggestedMin: 5,";
                echo "suggestedMax: 25";
                echo "}}]";
                echo "},";
                echo "plugins: {";
                echo "tooltip: {";
                echo "callbacks: {";
                echo "label: function(context) {";
                echo "return 'Value: ' + context.parsed.y;";
                echo "}}}}};";
                echo "var myLineChart = new Chart(ctx, {type: 'line', data: data, options: options});";
                echo "</script>";
            }
            ?>
        </div>
    </div>
</div>