<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .left-container,
        .right-container {
            display: flex;
            flex-wrap: wrap;
            margin: 0;
        }

        .right-container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            max-width: 500px;
            height:652px;
            justify-content: center;
        }

        .mb-4{
            margin-bottom: 0 !important;
        }
        

        .banner-container {
            height: 100%;
            width:100%;
            max-width:900px;
            
            
        }

        .banner-image img {
            width: 100%;
            height: auto;
        }

        .profile-container.profile-card {
            width: 100%;
            transform: translateX(0);
            animation: none;
            opacity: 1;
            max-width: 900px;
           
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 2px solid lightblue;
            border-radius: 10px 10px 0 0;
            height:auto;
            
            
        }

        .info-container {
            width: 100%;
            border-radius: 10px;
            overflow:hidden;
            box-shadow: 0px 2px 4px 0px rgba(74, 144, 226, 0.5);
            height:100%;
        }

        .first-container {
            border-bottom: 1px solid gray;
            margin-top: 30px;
        }

        .second-container {
            border-bottom: 1px solid gray;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 50px;
        }

        .third-container {
            display: flex;
            flex: 30%;
            margin-top: -50px;
        }

        .fourth-container {
            display: flex;
            flex: 40%;
            margin-top: -50px;
        }

        .fifth-container {
            display: flex;
        }

        .rounded-circle-img {
            width: 15%;
            height: auto;
        }

        .strong-text-one {
            font-size: 1.1rem;
            color: red;
            display: block;
        }

        .strong-text-two {
            margin-top: 15px;
            font-size: 1.1rem;
            color: red;
            display: block;
        }

        .strong-text-three {
            margin-top: 15px;
            font-size: 1.1rem;
            color: red;
            display: block;
        }

        p {
            margin-left: 8px;
        }

        .banner-container {
            height: 100%;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            border-radius: 15px;
            max-height:300px;
            
        }
        @media screen and (max-width: 1440px) and (max-height: 900px) {
        .banner-container {
            max-height: 240px;
        }
    }

        .purple-text {
            font-size: 2rem;
            color: purple;
        }

        .user {
            font-size: 2rem;
            color: gray;
        }

        .banner-text {
            padding: 10px;
            width: 100%;
            max-width: 100%;
            height: 100%;
            
            flex-direction: column; /* Add this to make the text and "How are you feeling?" stack vertically */
        }

        .concern-text {
            color: gray;
            font-size: 1.35rem;
            margin: 0;
        }

        

        .banner-image {
            width: 100%;
            margin-top: 5px;
            display: flex;
            justify-content: center;
            overflow: hidden;
            margin-top:5px;
        }

        .banner-image img {
            opacity: 1;
            
            width: 100%;
            height: auto;
            
        }

        .content-container {
    flex: 1;
    max-height: none; /* Remove the max-height constraint */
    height: 100%;
    width:100%;
    max-width:100%; /* Add overflow-y: auto for vertical scrolling if needed */
   
}

        .profile-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            width: 100%;
            
            
            
        }

        @keyframes slideInProfileCard {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .profile-container.profile-card {
        box-shadow: none;
        bottom: 0;
        transform: translateX(100%);
        opacity: 0;
        animation: slideInProfileCard 1s forwards ease-out;

        height: 100%;
        max-height: 430px;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
    }

        .left-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    margin-right: 20px;
    
}

.fc-container {
    flex: 1;
    border-radius: 10px;
    box-shadow: 0px 2px 4px 0px rgba(74, 144, 226, 0.5);
    margin-bottom: 20px;
    margin-left: 20px;
}

        .m-0 {
            height: 100%;
            max-height: 50px;
            width: 100%;
        }

        .left-right-container {
            display: flex;
            height: 100%;
        }

       

        .concern-text {
            overflow: hidden;

            white-space: nowrap;
            font-size: 1.6rem;
            
        }
        

        .typed-text {
            margin: 0;
            padding: 0;
            margin-top: 10px;
        }

       

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0px);
            }
        }

        .animated-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden; /* Ensure content doesn't overflow */
}

        .patient-dash {
            font-size: 2rem;
            padding-bottom: 5px;
        }

        @media screen and (max-width: 768px) {
            .left-container,
            .right-container {
                width: 100%;
            }
        }
        .card-body {
    height: 100%; /* or any desired value */
    box-shadow: 0px 2px 4px 0px rgba(0,0,0, 0.5);
    border-radius: 9px;
    }
    .profile-card {
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
}

@keyframes slideIn {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(0);
        }
    }

    .banner-container {
        animation: slideIn 1s ease-out;
    }

    /* Add this if you want to apply the animation only once */
    .banner-container {
        animation: slideIn 1s ease-out forwards;
    }

    @keyframes slideInPatientCard {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .patient-card {
        animation: slideInPatientCard 1s forwards ease-out; /* Adjust the duration and easing function if needed */
    }
    
    </style>
    <title>Patient Dashboard</title>
</head>
<body>

<span><h1 class="h3 mb-0 text-gray-800">Patient Dashboard</h1></span>
<div class="left-right-container">
    <div class="left-container">
        <div class="banner-container">
            <div class="banner-text">
                <span class="purple-text">Good Evening</span>
                <span class="user"><?= User::model()->getFullname(Yii::app()->user->id); ?>!</span>
                <div class="typed-text">
                    <p class="concern-text">How are you feeling?</p>
                </div>
                <div class="banner-image">
                    <?php
                    $imageUrl = Yii::app()->baseUrl . '/images/banner.png';
                    echo CHtml::image($imageUrl, 'Banner Image', ['class' => 'banner-image']);
                    ?>
                </div>
            </div>
        </div>

        <div class="profile-container profile-card animated-container">
            <div class="content-container">
                <div class="info-container">
                    <!-- Your existing code for header, first-container, second-container, third-container, fourth-container, and fifth-container -->

                    <div class="header-container">
                        <h6 class="m-0 font-weight-bold text-primary">Patient Profile</h6>
                        <?php
                        $gender = 1; // Replace this with your logic to fetch the gender
                        ?>
                        <?php if ($gender === 1) : ?>
                            <img class="img-profile rounded-circle-img"
                                 src="<?= Yii::app()->request->baseUrl; ?>/images/male-icon.png">
                        <?php else : ?>
                            <img class="img-profile rounded-circle-img"
                                 src="<?= Yii::app()->request->baseUrl; ?>/images/female-icon.png">
                        <?php endif; ?>
                    </div>

                    <div class="first-container">
                        <p>
                            <span class="strong-text-one">Name</span>
                            <?= User::model()->getFullname(Yii::app()->user->id); ?>!
                        </p>
                    </div>

                    <div class="second-container">
                        <div class="third-container">
                            <p>
                                <span class="strong-text-two">Age:</span>
                                <?= User::model()->getAge(Yii::app()->user->id); ?>
                            </p>
                        </div>
                        <div class="fourth-container">
                            <p>
                                <span class="strong-text-two">Gender:</span>
                                <?= User::model()->getGender(Yii::app()->user->id); ?>
                            </p>
                        </div>
                    </div>

                    <div class="fifth-container">
                        <p>
                            <span class="strong-text-three">Assigned Doctor:</span>

                            <?php
                           
                                $consultationRecords = ConsultationRecord::model()->with('doctorAccount.user')->find(array(
                                    'condition' => 'patient_account_id=:id',
                                    'params' => array(':id' => Yii::app()->user->id),
                                ));
                                if (!empty($consultationRecords)) {
                                // Output details of each consultation record
                                // Access doctor's name
                                $doctorFullName = $consultationRecords->doctorAccount->user->firstname . ' ' . $consultationRecords->doctorAccount->user->lastname;

                                echo "Doctor Name: " . $doctorFullName . "<br>";

                                echo "<hr>"; // Add a horizontal line between records for better readability
                            } else {
                                echo 'No Doctor';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4 patient-card">
    <div class="card mb-5" style="height:100%;">
        <div class="card-body">
            <h6 class="m-0 font-weight-bold text-primary"><?= User::model()->getFullname(Yii::app()->user->id); ?>'s Appointment</h6>
            <?php echo $this->renderPartial('patientcalendar', array('listOfAppointment' => $listOfAppointment)); ?>
        </div>
    </div>
</div>

    </div>
</body>
</html>