<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <h1 style="padding-left: 20px;">
                <span class="m-0 font-weight-bold text-primary" style="font-size: 32px; color: blue;">Welcome, </span>
                <span class="m-0 font-weight-bold text-color: gray" style="font-size: 32px; color: gray;"><?php echo User::model()->getFullname(Yii::app()->user->id); ?>!</span>
            </h1>
            <img src="/MARS/images/superadminprof.png" alt="Super Admin" style="height: auto; width: auto; margin-left: 10px;">
        </div>
    </div>

    <div class="col-xl-12 col-lg-12">
        <?php foreach($listofAccounts as $modelValue): ?>
            <div class="card shadow mb-4 text-center">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Super Admin Profile</h6>
                </div>

                <div class="card-body">
                    <p class="mx-2">
                        Edit Your Profile <?php echo CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('account/updateSuperAdmin/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'));?>
                    </p>
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">Fullname</th>
                                <td><?php echo $modelValue->user->getFullname($modelValue->id); ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">Email Address</th>
                                <td><?php echo $modelValue->email_address; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">Gender</th>
                                <td><?php echo $modelValue->user->getGender($modelValue->id); ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">Status</th>
                                <td><?php echo $modelValue->getAccountStatus($modelValue->id); ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">DOB</th>
                                <td><?php echo date('M d, Y', strtotime($modelValue->user->dob)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
