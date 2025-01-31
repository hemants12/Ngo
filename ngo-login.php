<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Log Out')); ?>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/fonts/material-design-iconic-font.css">
    <?php include 'layouts/head-css.php'; ?>
<style>
    /* Forward button style */
.forward {
    background-color: #28a745; /* Green background */
    color: #fff; /* White text */
    padding: 12px 30px; /* Size of the button */
    font-size: 16px; /* Text size */
    border: none; /* No borders */
    border-radius: 25px; /* Rounded corners */
    cursor: pointer; /* Pointer on hover */
    transition: background-color 0.3s ease; /* Smooth transition for hover */
}

.forward:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Style for Backward button if you need to adjust */
.backward {
    background-color: #dc3545; /* Red background */
    color: #fff;
    padding: 12px 30px;
    font-size: 16px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.backward:hover {
    background-color: #c82333;
}

</style>
</head>

<body>

<div class="wrapper">
            <form action="" id="wizard">
        		<!-- SECTION 1 -->
                <h2></h2>
                <section>
                    <div class="inner">
						<div class="image-holder">
							<img src="images/form-wizard-1.jpg" alt="">
						</div>
						<div class="form-content" >
							<div class="form-header">
								<h3>Registration</h3>
							</div>
							<p style="margin-bottom:40px;">Please fill with your details</p>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="First Name" class="form-control">
								</div>
								<div class="form-holder">
									<input type="text" placeholder="Last Name" class="form-control">
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="Your Email" class="form-control">
								</div>
								<div class="form-holder">
                                    
									<input type="text" placeholder="Phone Number" class="form-control">
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="Age" class="form-control">
								</div>
							</div>
							<div class="checkbox-circle">
								<label>
									<input type="checkbox ml-4"> Nor again is there anyone who loves or pursues or desires to obtaini.
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
					</div>
                </section>

				<!-- SECTION 2 -->
                <h2></h2>
                <section>
                    <div class="inner">
						<div class="image-holder">
							<img src="images/form-wizard-2.jpg" alt="">
						</div>
						<div class="form-content">
							<div class="form-header">
								<h3>Registration</h3>
							</div>
							<p style="margin-bottom:40px;">Please fill with additional info</p>
							<div class="form-row">
								<div class="form-holder w-100">
									<input type="text" placeholder="Address" class="form-control">
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="City" class="form-control">
								</div>
								<div class="form-holder">
									<input type="text" placeholder="Zip Code" class="form-control">
								</div>
							</div>

							<div class="form-row">
								<div class="select">
									<div class="form-holder">
										<div class="select-control">Your country</div>
										<i class="zmdi zmdi-caret-down"></i>
									</div>
									<ul class="dropdown">
										<li rel="United States">United States</li>
										<li rel="United Kingdom">United Kingdom</li>
										<li rel="Viet Nam">Viet Nam</li>
									</ul>
								</div>
								<div class="form-holder"></div>
							</div>
						</div>
					</div>
                </section>

                <!-- SECTION 3 -->
                <h2></h2>
                <section>
                    <div class="inner">
						<div class="image-holder">
							<img src="images/form-wizard-3.jpg" alt="">
						</div>
						<div class="form-content">
							<div class="form-header">
								<h3>Registration</h3>
							</div>
							<p style="margin-bottom:40px;">Send an optional message</p>
							<div class="form-row">
								<div class="form-holder w-100">
									<textarea name="" id="" placeholder="Your messagere here!" class="form-control" style="height: 99px;"></textarea>
								</div>
							</div>
							<div class="checkbox-circle mt-24">
								<label>
									<input type="checkbox" checked>  Please accept <a href="#">terms and conditions ?</a>
									<span class="checkmark">d</span>
								</label>
							</div>
						</div>
					</div>
                </section>
            </form>
		</div>


    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/jquery-3.3.1.min.js"></script>

<!-- JQUERY STEP -->
<script src="assets/js/jquery.steps.js"></script>
<script src="assets/js/main.js"></script>
<!-- Template created and distributed by Colorlib -->
</body>

</html>