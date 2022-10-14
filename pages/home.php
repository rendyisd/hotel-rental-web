<header class="site-header" id="header-id">
    <div class="header-img">
        <div class="img-text" id="text1">Where</div>
        <div class="img-text" id="text2">would you like to stay?</div>
    </div>
</header>

<div class="location mb-5" id="book">
    <h2 class="loc-section__title">Suggestion for your trip</h2>
    <div class="loc-section" id="loc-section">
        <div class="loc-section__card loc-section__card1">
            <img src="image/index-page/backgrounds/bg1.jpg">
            <div class="loc-section__card__curve curve-outer-layer"></div>
            <div class="loc-section__card__curve"></div>
            <div class="curve-block"></div>
        </div>
        <div class="loc-section__card loc-section__card2">
            <img src="image/index-page/backgrounds/bg2.jpg">
            <div class="loc-section__card__curve curve-outer-layer"></div>
            <div class="loc-section__card__curve"></div>
            <div class="curve-block"></div>
        </div>
        <div class="loc-section__card loc-section__card3">
            <img src="image/index-page/backgrounds/bg3.jpg">
            <div class="loc-section__card__curve curve-outer-layer"></div>
            <div class="loc-section__card__curve"></div>
            <div class="curve-block"></div>
        </div>
        <div class="loc-section__card loc-section__card4">
            <img src="image/index-page/backgrounds/bg4.jpg">
            <div class="loc-section__card__curve curve-outer-layer"></div>
            <div class="loc-section__card__curve"></div>
            <div class="curve-block"></div>
        </div>
    </div>
</div>
<hr id="book-anchor" color="black">

<div class="container-fluid pt-2">
    <h2 class="loc-section__title">Settlements for your trip</h2>
    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0" method="post">
        <i class="bi bi-search" aria-hidden="true"></i>
        <input class="form-control form-control-sm ml-3" name="search" style="border: none; border: solid 1px #000; border-radius: 15px; width: 250px;" type="text" placeholder="Search" aria-label="Search">
    </form>
    
    

    <div class="container mt-3 d-flex flex-wrap justify-content-center">
        
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $search_value = trim(mysqli_real_escape_string($db, $_POST['search']));

                if($search_value != ""){
                    $query_hotel = "SELECT * FROM hotels WHERE
                    HotelName LIKE '%$search_value%'
                    OR HotelCountry LIKE '%$search_value%'
                    OR HotelCity LIKE '%$search_value%'
                    ";
                }
                else{
                    $query_hotel = "SELECT * FROM hotels";
                }
            }
            else{
                $query_hotel = "SELECT * FROM hotels";
            }
            $hotel = mysqli_query($db, $query_hotel);
            
            while($hotel_entry = mysqli_fetch_array($hotel)){
        ?>
                
            <form id="hotel-form" method="post" action="process/hotel-process.php">
                <div class="card">
                    <div <?php echo'id="hotel-carousel-'.$hotel_entry['HotelID'].'"'; ?> class="carousel slide" data-interval="false">
                        <ol class="carousel-indicators">
                            <?php 
                                $query_hotel_image = "SELECT Image FROM hotel_image WHERE HotelID = ".$hotel_entry['HotelID'];
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
                                $query_hotel_image = "SELECT Image FROM hotel_image WHERE HotelID = ".$hotel_entry['HotelID'];
                                $hotel_image = mysqli_query($db, $query_hotel_image);
                                $it = 1;
                                while($hotel_image_entry = mysqli_fetch_array($hotel_image)){
                                    if($it == 1){
                                        echo '
                                        <div class="carousel-item active">
                                            <img class="d-block w-100 rounded-img" src="image/hotel_images/hotel_'.$hotel_entry['HotelID'].'/'.$hotel_image_entry['Image'].'.jpg">
                                        </div>
                                        ';
                                    }
                                    else{
                                        echo'
                                        <div class="carousel-item">
                                            <img class="d-block w-100 rounded-img" src="image/hotel_images/hotel_'.$hotel_entry['HotelID'].'/'.$hotel_image_entry['Image'].'.jpg">
                                        </div>
                                        ';
                                    }
                                    $it++;
                                }
                            ?>
                        </div>
                        <a class="carousel-control-prev" <?php echo'href="#hotel-carousel-'.$hotel_entry['HotelID'].'"'; ?> role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" <?php echo'href="#hotel-carousel-'.$hotel_entry['HotelID'].'"'; ?> role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="card-body" onclick="this.closest('form').submit();">
                        <h5 class="card-title"><?php echo $hotel_entry['HotelCity'].", ".$hotel_entry['HotelCountry']; ?></h5>
                        
                        <p class="card-text">
                            <?php echo $hotel_entry['HotelName']; ?><br>
                            <i class="bi bi-star-fill"></i>&nbsp;&nbsp;.../5
                        </p>
                        <p class="card-text">
                            <b><?php echo "$".$hotel_entry['HotelPrice']; ?></b> / night
                        </p>
                    </div>
                </div>

                <?php
                    echo "<input type='hidden' name='hotel-name' value='".$hotel_entry['HotelName']."'>";
                    echo "<input type='hidden' name='hotel-country' value='".$hotel_entry['HotelCountry']."'>";
                    echo "<input type='hidden' name='hotel-city' value='".$hotel_entry['HotelCity']."'>";
                    echo "<input type='hidden' name='hotel-price' value='".$hotel_entry['HotelPrice']."'>";
                    echo "<input type='hidden' name='hotel-id' value='".$hotel_entry['HotelID']."'>";
                ?>
                
            </form>
        <?php }?>
    </div>
</div>