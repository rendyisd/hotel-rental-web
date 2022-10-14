<div class="container mt-4">
    <h5><?php echo $_SESSION['name']; ?></h5>
    <div class="d-flex" style="font-size: 12px;">
        <span class="mr-1"><i class="bi bi-star-fill"></i>&nbsp;&nbsp;.../5</span>
        <span><i class="bi bi-dot"></i></span>
        <span class="mx-1"><b><?php echo $_SESSION['city'].", ".$_SESSION['country']; ?></b></span>
    </div>
    <div class="d-flex mt-4">
        <div class="container p-0 mr-4">
            <div <?php echo'id="hotel-carousel-'.$_SESSION['id'].'"'; ?> class="carousel slide h-100" data-interval="false">
                <ol class="carousel-indicators">
                    <?php 
                        $query_hotel_image = "SELECT Image FROM hotel_image WHERE HotelID = ".$_SESSION['id'];
                        $hotel_image = mysqli_query($db, $query_hotel_image);

                        for($i=0; $i<mysqli_num_rows($hotel_image); $i++){
                            if($i == 0){
                                echo '<li data-target="#hotel-carousel-'.($i+1).'" data-slide-to="'.$i.'" class="active"></li>';
                            }
                            else{
                                echo '<li data-target="#hotel-carousel-'.($i+1).'" data-slide-to="'.$i.'"></li>';
                            }
                        }
                        
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php 
                        $query_hotel_image = "SELECT Image FROM hotel_image WHERE HotelID = ".$_SESSION['id'];
                        $hotel_image = mysqli_query($db, $query_hotel_image);
                        $it = 1;
                        while($hotel_image_entry = mysqli_fetch_array($hotel_image)){
                            if($it == 1){
                                echo '
                                <div class="carousel-item book-carousel-item active">
                                    <img class="d-block w-100 rounded-img" src="image/hotel_images/hotel_'.$_SESSION['id'].'/'.$hotel_image_entry['Image'].'.jpg">
                                </div>
                                ';
                            }
                            else{
                                echo'
                                <div class="carousel-item book-carousel-item">
                                    <img class="d-block w-100 rounded-img" src="image/hotel_images/hotel_'.$_SESSION['id'].'/'.$hotel_image_entry['Image'].'.jpg">
                                </div>
                                ';
                            }
                            $it++;
                        }
                    ?>
                </div>
                <a class="carousel-control-prev" <?php echo'href="#hotel-carousel-'.$_SESSION['id'].'"'; ?> role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" <?php echo'href="#hotel-carousel-'.$_SESSION['id'].'"'; ?> role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        
        <!-- --------------------------------------------------------------------------- -->

        <div class="container book-box px-5 py-4" style="width: 32rem">
            <div class="d-flex justify-content-between">
                <span><b>$<?php echo $_SESSION['price'] ?></b>/night</span>
                <span class="mr-1"><i class="bi bi-star-fill"></i>&nbsp;&nbsp;...</span>
            </div>
            <form method="post" action="process/book-process.php" id="book-process">
                <div class="container p-0 d-flex flex-column align-items-center">
                    <span class="mt-5 mb-2" style="font-size: 12PX;"><b>CHECK-IN - CHECKOUT</b></span>
                    <div id="reportrange" class="rounded w-100 text-center" style="padding: 0 5px 0 5px; cursor: pointer; border: 1px solid #ccc; font-size: 14px; width: fit-content;">
                        <i class="bi bi-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                    <span class="mt-4 mb-2" style="font-size: 12PX;"><b>GUESTS</b></span>
                    <!-- max val here should be adjusted based on how many guest per room -->
                    <input type="range" class="custom-range w-100" min="1" max="5" value="1" name="guest" oninput="document.getElementById('n-guest').value = this.value + ' Guest'">
                    <output id="n-guest" style="font-size: 12px;">1 Guest</output>
                </div>

                <input type="hidden" name="check-in-date">
                <input type="hidden" name="check-out-date">
                <input type="hidden" name="final-price">
            </form>
            <button class="btn btn-danger w-100 my-4" onclick="$('#book-process').submit();" style="color: white; font-size: 14px; height: 45px;">Book</button>
            <div class="container border-top d-flex justify-content-between px-0 pt-3">
                <span>Total Price</span>
                <span id="total-price"></span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


$(function() {

    var start = moment();
    var end = moment().add(1, 'days');

    function cb(start, end) {
        let dayCount = end.diff(start, 'days');
        let finalPrice = "$" + (<?php echo $_SESSION['price']; ?>*dayCount);
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $('#total-price').html(finalPrice);
        $('input[name=final-price]').val(finalPrice);

        $('input[name=check-in-date]').val(start.format('MMMM D, YYYY'));
        $('input[name=check-out-date]').val(end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        opens: 'left',
        minDate: start,
        startDate: start,
        endDate: end,
    }, cb);

    cb(start, end);
});
</script>