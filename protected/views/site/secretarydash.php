<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary Dashboard</title>
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .content {
            flex: 1;
        }

        .margin-bottom-15 {
            margin-bottom: -45px;
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
</head>
<body>
   <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Secretary Dashboard</h1>    
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Secretary Card -->
        <div class="col-xl-12 margin-bottom-15" style="width: 100%; max-width: 1800px; padding-bottom: 20px;">
            <div class="card shadow mb-5" style="height: auto;">
                <div class="card-body">
                    <h3 style="color: rgba(74, 144, 226, 1); font-weight: bold;">Welcome Back Secretary, <span style="color: #808080;"><?php echo User::model()->getFullname(Yii::app()->user->id); ?>!</span></h3>
                    <img src="/MARS/images/ManageDoc.png" alt="Secretary Image" class="img-fluid custom-image">
                </div>
            </div>
        </div>

        <!-- Manage Your Doctors Card -->
        <div class="col-xl-6 mb-4 manage-doctors-card margin-bottom-20">
            <div class="card mb-5" style="height: 446px;">
                <div class="card-body" style="position: relative;">
                    <h3 class="h3" style="color: rgba(74, 144, 226, 1); font-weight: bold;">Manage your doctor</h3>
                    <h6 class="h6" style="color: rgba(74, 144, 226, 1); font-weight: bold;">Need to adjust schedules?</h6>
                    <!-- Box with fluid width and height, vertical gradient background, and padded corners -->
                    <div style="width: 100%; height: 83%; background: linear-gradient(to bottom, #556ffa, #b37d86); padding: 15px; border-radius: 15px; position: relative;">
                        <!-- Content inside the box goes here -->
                        <p style="color: #87ceeb; font-size: 3em; font-weight: bold; line-height: 1.2; position: absolute; top: 20px; left: 20px;">
                            Seek the best Doctors here at <br> <span style="color: #fff;">M.A.R.S</span>
                        </p>
                        <!-- Image at the center vertically and far right horizontally with fluid width -->
                        <img src="/MARS/images/logo.png" alt="Logo" style="position: absolute; top: 50%; right: 0; transform: translate(0, -50%); width: 35%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor's Schedule Card -->
        <div class="col-lg-6 mb-4 doctor-card">
            <div class="card mb-5">
                <div class="card-body" style="max-height: 446px; overflow-y: auto;">
                    <h3 class="h" style="color: rgba(74, 144, 226, 1); font-weight: bold;">Doctor's Appointments</h3>
                    <?php if (empty($listOfAppointmentSecretary)){ ?>
                        <?php echo $this->renderPartial('calendar'); ?>
                    <?php } else { 
                        echo $this->renderPartial('calendar', array('listOfAppointmentSecretary' => $listOfAppointmentSecretary));
                    }?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
