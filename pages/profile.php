<div class="container my-4">
    <div class="p-4 position-fixed profile-box-1" style="letter-spacing: -1px;">
        <img src="image/index-page/profile.png" class="w-50 d-block mb-4" style="margin: 0 auto;">
        <hr class="bg-dark">
        <h4 class="m-0"><?php echo $_SESSION['username'] ?></h4>
        <p class="profile-box-text mb-4">Super User</p>
        <div>
            <span style="font-size: 1rem;">
                <i class="bi bi-check-lg mr-2"></i>
                <span class="d-inline-block">Personal identity</span>
            </span>
        </div>
        <div>
            <span style="font-size: 1rem;">
                <i class="bi bi-check-lg mr-2"></i>
                <span class="d-inline-block">Email address</span>
            </span>
        </div>
        <div>
            <span style="font-size: 1rem;">
                <i class="bi bi-check-lg mr-2"></i>
                <span class="d-inline-block">Phone number</span>
            </span>
        </div>
        <div>
            <span style="font-size: 1rem;">
                <i class="bi bi-check-lg mr-2"></i>
                <span class="d-inline-block">Payment methods</span>
            </span>
        </div>
        <hr class="bg-dark">
        <button type="button" class="btn btn-primary d-block" data-toggle="modal" data-target="#editProfile" style="margin: 0 auto;">Edit Profile</button>
        
    </div>
    <div class="container ml-4 profile-box-2">
        <h2 style="letter-spacing: -2px;">History</h2>
        <hr class="bg-dark">
        <div>
            <?php 
                $history_query = "SELECT * FROM book_history WHERE id = ".$_SESSION['id_user'];
                

                $q1 = mysqli_query($db, $history_query);

                if(mysqli_num_rows($q1) == 0){
                    echo "<h3 class='text-center' style='margin-top: 12rem'>Ain't Nobody Here but Us Chickens.</h3>";
                }

                $it = 1;
                while($q1_ret = mysqli_fetch_array($q1)){
                    $history_hotel_query = "SELECT HotelName FROM hotels WHERE HotelID = ".$q1_ret['HotelID'];
                    $q2 = mysqli_query($db, $history_hotel_query);
                    $q2_ret = mysqli_fetch_array($q2);
            ?>
                <div class="container p-4 mt-4 mb-2 bg-info text-white" style="border-radius: 15px;">
                    <form method="post" action="process/history-delete-process.php"
                    <?php echo "id='history-submit-".$it."'"; ?>>
                        <span class="d-flex justify-content-between">
                            <h3><?php echo $q2_ret['HotelName']; ?></h3>
                            <button type="button" class="close" style="color: white;"
                            <?php echo 'onclick="$('."'#history-submit-".$it."'".').submit();"' ?>>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </span>
                        <span style="font-size: 12px;">
                            <?php echo $_SESSION['username']; ?> checked in from 
                            <b><?php echo $q1_ret['CheckInDate']; ?></b> to 
                            <b><?php echo $q1_ret['CheckOutDate']; ?></b> for 
                            <b><?php echo $q1_ret['GuestCount']; ?> guest(s)</b> and charged for
                            <b><?php echo $q1_ret['TotalPrice']; ?></b>
                        <span>

                        <input type="hidden" name="history-id" <?php echo "value=".$q1_ret['BookID'] ?> >
                    </form>
                </div>
            <?php $it++;} ?>
        </div>
    </div>
</div>
<!-- Edit profile modal  -->
<div class="modal fade" id="editProfile" role="dialog" style="margin-top: 3rem;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
            </div>
            <form action=""> <!-- TODO: Edit placeholder to show user's current account identity -->
                <div class="modal-body" style="font-size: 0.8rem;">
                    <h6>Personal Identity</h6>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-fname">First name</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-fname" name="edit-profile-fname" placeholder="" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-surname">Surname</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-surname" name="edit-profile-surname" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-id-number">ID / Passport number</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-id-number" name="edit-profile-id-number" placeholder="" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-country">Country</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-country" name="edit-profile-country" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-city">City</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-city" name="edit-profile-city" placeholder="" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-address">Address</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-address" name="edit-profile-address" placeholder="" >
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <h6>Contact Information</h6>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-email">Email address</label>
                                    <input type="email" class="form-control form-control-sm" id="edit-profile-email" name="edit-profile-email" placeholder=<?php echo "'".$_SESSION['email']."'" ?>>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-phone">Phone number</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-phone" name="edit-profile-phone" placeholder="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6>Payment Methods</h6>
                    <div class="container d-flex justify-content-around bg-light w-75 py-3 mb-4" style="border-radius: 1rem;">
                        <span class="text-center" style="cursor: pointer;" onclick="">
                            <i class="bi bi-paypal" style="font-size: 2rem;"></i>
                            <p class="m-0">Paypal</p>
                        </span>
                        <span class="text-center" style="cursor: pointer;" onclick="">
                            <i class="bi bi-credit-card" style="font-size: 2rem;"></i>
                            <p class="m-0">Method2</p>
                        </span>
                        <span class="text-center" style="cursor: pointer;" onclick="">
                            <i class="bi bi-credit-card-2-front" style="font-size: 2rem;"></i>
                            <p class="m-0">Method3</p>
                        </span>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="edit-profile-card-number">Card number</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-card-number" name="edit-profile-card-number" placeholder="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-profile-cvv">CVV</label>
                                    <input type="text" class="form-control form-control-sm" id="edit-profile-cvv" name="edit-profile-cvv" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button> <!-- TODO: save profile -->
                    <button type="reset" class="btn btn-danger" onclick="$('#editProfile').modal('toggle')">Discard</button>
                </div>
            </form>
        </div>
    </div>
</div>