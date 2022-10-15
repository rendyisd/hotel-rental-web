<div class="container">
    <?php 
        $history_query = "SELECT * FROM book_history WHERE id = ".$_SESSION['id_user'];
        

        $q1 = mysqli_query($db, $history_query);

        if(mysqli_num_rows($q1) == 0){
            echo "<h3 class='text-center mt-5'>Ain't Nobody Here but Us Chickens.</h3>";
        }

        $it = 1;
        while($q1_ret = mysqli_fetch_array($q1)){
            $history_hotel_query = "SELECT HotelName FROM hotels WHERE HotelID = ".$q1_ret['HotelID'];
            $q2 = mysqli_query($db, $history_hotel_query);
            $q2_ret = mysqli_fetch_array($q2);
    ?>
        <div class="container p-4 mt-4 mb-2 bg-primary text-white" style="border-radius: 15px;">
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
