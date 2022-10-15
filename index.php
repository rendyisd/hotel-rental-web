<?php
    require_once 'connect.php';

	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder - Homestays | Hotels Rental</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">

    <!-- Daterange -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <!-- CSS external -->
    <link rel="stylesheet" type="text/css" href="index-style.css?d=<?php echo time(); ?>" />

</head>
<body>
<!-- Login/Register Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center align-items-end" role="document">
            <div class="modal-content w-75">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Sign in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="auth.php">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email-form" class="form-control" name="email" />
                            <label class="form-label" for="email-form">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline">
                            <input type="password" id="pass-form" class="form-control" name="password" />
                            <label class="form-label" for="pass-form">Password</label>
                        </div>
                        <?php 
                            if(isset($_SESSION['failedLogin']) && $_SESSION['failedLogin']){
                                echo '
                                <p class="text-danger mb-4" id="login-failed">Email or Password incorrect!</p>
                                ';
                                unset($_SESSION['failedLogin']);
                            }
                        ?>
                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember-form" checked />
                                    <label class="form-check-label" for="remember-form"> Remember me </label>
                                </div>
                            </div>

                            <div class="col">
                            <!-- Simple link -->
                            <a href="#!">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">Sign in</button>

                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Not a member? <a href="#register-modal" data-toggle="modal" data-target="#register-modal">Register</a></p>
                            <p>or sign up with:</p>
                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="bi bi-facebook"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="bi bi-google"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="bi bi-twitter"></i>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center align-items-end" role="document">
            <div class="modal-content w-75 mt-5">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Sign up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="POST" action="register.php">
                    <div class="text-center mb-3">
                        <p>Sign up with:</p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="bi bi-facebook"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="bi bi-google"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="bi bi-twitter"></i>
                        </button>
                    </div>

                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="registerUsername" class="form-control" name="username" />
                        <label class="form-label" for="registerUsername">Username</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="registerEmail" class="form-control" name="email" />
                        <label class="form-label" for="registerEmail">Email address</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="registerPassword" class="form-control" name="password" />
                        <label class="form-label" for="registerPassword">Password</label>
                    </div>

                    <!-- Repeat Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="registerRepeatPassword" class="form-control" />
                        <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" style="left: 16%;" type="checkbox" value="" id="registerCheck" checked
                        aria-describedby="registerCheckHelpText" />
                        <label class="form-check-label" for="registerCheck">
                        I have read and agree to the terms
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!------------------------------------------------------------------------------------------------>

    <div class="header-menu">
        <div class="phone-menu">
            <nav>
                <ul>
                    <li><a href="./#" class="btn-phone">HOME</a></li>
                    <li><a href="./#book-anchor" class="btn-phone">BOOK</a></li>
                    <li><a href="./#contact" class="btn-phone">CONTACT US</a></li>
                </ul>
            </nav>
        </div>
        <div class="logo-nav">
            <a href="index.php"><img class="logo-img" src="image/index-page/logo-white.png"></a>
            <nav>
                <ul>
                    <li><a href="./#" class="btn btn-desktop">Home</a></li>
                    <li><a href="./#book-anchor" class="btn btn-desktop">Book</a></li>
                    <li><a href="./#contact" class="btn btn-desktop">Contact us</a></li>
                </ul>
            </nav>
            <div class="nav-menu-icon">
                <div class="icon-bar"></div>
                <div class="icon-bar"></div>
                <div class="icon-bar"></div>
            </div>

            <div class="dropdown">
                <button class="profile" style="outline: none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://img.icons8.com/external-those-icons-fill-those-icons/24/000000/external-down-arrows-those-icons-fill-those-icons-4.png" id="dropdown-caret">
                    <img src="image/index-page/profile.png" id="profile-img">
                </button>
                <div class="dropdown-menu dropdown-menu-sw" aria-labelledby="dropdownMenuButton">
                    <?php 
                        if(isset($_SESSION['loggedin'])){
                            echo '
                            <a class="dropdown-item" href=#profile>Hello, <b>'.$_SESSION["username"].'</b></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php?p=profile">Your Profile</a>
                            <a class="dropdown-item" href="index.php?p=profile">Booking History</a>
                            ';
                        }
                        else if(!isset($_SESSION['loggedin'])){
                            echo '
                            <a class="dropdown-item" href="#login-modal" data-toggle="modal" data-target="#login-modal">Login / Register</a>
                            ';
                        }
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Help</a>
                    <?php 
                        if(isset($_SESSION['loggedin'])){
                            echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php
			$pages_dir='pages';
			if(!empty($_GET['p'])){
				$pages=scandir($pages_dir,0);
				unset($pages[0],$pages[1]);
				$p=$_GET['p'];
				if(in_array($p.'.php',$pages)){
					include($pages_dir.'/'.$p.'.php');
				}
                else{
					echo'Page does not exist!';
				}
			}
            else{
				include($pages_dir.'/home.php');
			}
		?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        // Prevents confirm resubmission dialog box from showing up 
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <script src="index-script.js?d=<?php echo time(); ?>"></script>
</body>
</html>