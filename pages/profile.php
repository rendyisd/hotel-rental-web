<div class="container my-4">
    <div class="p-4 profile-box-1" style="letter-spacing: -1px;">
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
        <button type="button" class="btn btn-primary d-block" style="margin: 0 auto;">Edit Profile</button>
    </div>
</div>