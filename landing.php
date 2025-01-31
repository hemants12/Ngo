
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Landing')); ?>

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-css.php'; ?>
    <style>
        .demo-section {
            padding: 40px 0;
        }

        .video-container {
            width: 100%;
            height: 315px;
            border-radius: 10px;
            overflow: hidden;
        }

        .form-container {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-message {
            display: none;
            margin-top: 10px;
            color: green;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="landing.php">
                    <h3><b> NGO KING </b></h3>
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link" href="#plans">Plans</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">Faq's</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reviews">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#demo">Demo</a>
                        </li>
                    </ul>

                    <div class="">
                        <a href="ngo-login.php" class="btn btn-primary" id="custom-sa-community">Sign Up</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->
        <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

        <!-- start hero section -->
        <section class="section pb-0 hero-section active" id="plans">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center  pt-5">
                            <h1 class="display-6 fw-semibold mb-3 lh-base">Making NGO Management Easy, Efficient And
                                <span class="text-success">Impactful </span>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                        <h5 class="fs-14 mb-0">Month</h5>
                                    </div>
                                    <div class="form-check form-switch fs-20 ms-3 " onclick="check()">
                                        <input class="form-check-input" type="checkbox" id="plan-switch">
                                        <label class="form-check-label" for="plan-switch"></label>
                                    </div>
                                    <div>
                                        <h5 class="fs-14 mb-0">Annual <span
                                                class="badge bg-success-subtle text-success">Save 20%</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <div class="card plan-box mb-0">
                                <div class="card-body p-4 m-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fw-semibold">Basic Plan</h5>
                                            <p class="text-muted mb-0">For Startup</p>
                                        </div>
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                <i class="ri-book-mark-line fs-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4 text-center">
                                        <h1 class="month"><sup><small>₹</small></sup><span
                                                class="ff-secondary fw-bold">19</span> <span
                                                class="fs-13 text-muted">/Month</span></h1>
                                        <h1 class="annual"><sup><small>$</small></sup><span
                                                class="ff-secondary fw-bold">171</span> <span
                                                class="fs-13 text-muted">/Year</span></h1>
                                    </div>

                                    <div>
                                        <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Upto <b>3</b> Projects
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Upto <b>299</b> Customers
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Scalable Bandwidth
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>5</b> FTP Login
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-danger me-1">
                                                        <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>24/7</b> Support
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-danger me-1">
                                                        <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> Storage
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-danger me-1">
                                                        <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Domain
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-4">
                                            <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-4">
                            <div class="card plan-box mb-0 ribbon-box right">
                                <div class="card-body p-4 m-2">
                                    <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fw-semibold">Pro Business</h5>
                                            <p class="text-muted mb-0">Professional plans</p>
                                        </div>
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                <i class="ri-medal-fill fs-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4 text-center">
                                        <h1 class="month"><sup><small>$</small></sup><span
                                                class="ff-secondary fw-bold">29</span> <span
                                                class="fs-13 text-muted">/Month</span></h1>
                                        <h1 class="annual"><sup><small>$</small></sup><span
                                                class="ff-secondary fw-bold">261</span> <span
                                                class="fs-13 text-muted">/Year</span></h1>
                                    </div>

                                    <div>
                                        <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Upto <b>15</b> Projects
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> Customers
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Scalable Bandwidth
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>12</b> FTP Login
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>24/7</b> Support
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-danger me-1">
                                                        <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> Storage
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-danger me-1">
                                                        <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Domain
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-4">
                                            <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-4">
                            <div class="card plan-box mb-0">
                                <div class="card-body p-4 m-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fw-semibold">Platinum Plan</h5>
                                            <p class="text-muted mb-0">Enterprise Businesses</p>
                                        </div>
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                <i class="ri-stack-fill fs-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4 text-center">
                                        <h1 class="month"><sup><small>$</small></sup><span
                                                class="ff-secondary fw-bold">39</span> <span
                                                class="fs-13 text-muted">/Month</span></h1>
                                        <h1 class="annual"><sup><small>$</small></sup><span
                                                class="ff-secondary fw-bold">351</span> <span
                                                class="fs-13 text-muted">/Year</span></h1>
                                    </div>

                                    <div>
                                        <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> Projects
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> Customers
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Scalable Bandwidth
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> FTP Login
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>24/7</b> Support
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <b>Unlimited</b> Storage
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 text-success me-1">
                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Domain
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-4">
                                            <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!-- end container -->

        </section>
        <!-- end hero section -->

        <!-- start features -->
        <section class="section" id="features">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="text-muted">
                            <h5 class="fs-12 text-uppercase text-success">Design</h5>
                            <h4 class="mb-3">Well Designed Dashboards</h4>
                            <p class="mb-4 ff-secondary">
                                Quality Dashboards (QD) is a simple web tool for tracking healthcare quality and patient
                                data. Integrated with EHR, it provides quick reports to help healthcare providers
                                monitor performance and improve care.</p>

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="vstack gap-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-xs icon-effect">
                                                    <div
                                                        class="avatar-title bg-transparent text-success rounded-circle h2">
                                                        <i class="ri-check-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">Donation Management</h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-xs icon-effect">
                                                    <div
                                                        class="avatar-title bg-transparent text-success rounded-circle h2">
                                                        <i class="ri-check-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">Reporting and Analytics</h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-xs icon-effect">
                                                    <div
                                                        class="avatar-title bg-transparent text-success rounded-circle h2">
                                                        <i class="ri-check-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">Donor and Fundraising Campaigns</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="vstack gap-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-xs icon-effect">
                                                    <div
                                                        class="avatar-title bg-transparent text-success rounded-circle h2">
                                                        <i class="ri-check-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">HRM</h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-xs icon-effect">
                                                    <div
                                                        class="avatar-title bg-transparent text-success rounded-circle h2">
                                                        <i class="ri-check-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">Accounting and Finance</h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-xs icon-effect">
                                                    <div
                                                        class="avatar-title bg-transparent text-success rounded-circle h2">
                                                        <i class="ri-check-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">Data Security</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="index.php" class="btn btn-primary">Buy Now <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-6 col-sm-7 col-10 ms-auto order-1 order-lg-2">
                        <div>
                            <img src="assets/images/landing/features/img-2.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row align-items-center mt-5 pt-lg-5 gy-4">
                    <div class="col-lg-6 col-sm-7 col-10 mx-auto">
                        <div>
                            <img src="assets/images/landing/features/img-3.png" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-muted ps-lg-5">
                            <h5 class="fs-12 text-uppercase text-success">structure</h5>
                            <h4 class="mb-3">Well Documented</h4>
                            <p class="mb-4">Our NGO software simplifies donation, volunteer, event, and financial
                                management, with secure access, reporting, and communication tools, helping
                                organizations focus on their mission efficiently.</p>

                            <div class="vstack gap-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar-xs icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Integration Features</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar-xs icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Customizable User Interface (UI)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar-xs icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Security Layer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end features -->



        <!-- start faqs -->
        <section class="section" id="faq">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-semibold">Frequently Asked Questions</h3>
                            <p class="text-muted mb-4 ff-secondary">If you can not find answer to your question in our
                                FAQ, you can always contact us or email us. We will answer you shortly!</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row g-lg-5 g-4">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-1">
                                <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fw-semibold">General Questions</h5>
                            </div>
                        </div>
                        <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                            id="genques-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genques-collapseOne" aria-expanded="true"
                                        aria-controls="genques-collapseOne">
                                        What is NGO software and how can it help my organization ?
                                    </button>
                                </h2>
                                <div id="genques-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        NGO software is a tool designed to help non-governmental organizations (NGOs)
                                        manage their operations, such as donations, volunteer coordination, event
                                        planning, and reporting. It can streamline processes, improve transparency, and
                                        provide better data management, allowing NGOs to focus on their missions.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genques-collapseTwo" aria-expanded="false"
                                        aria-controls="genques-collapseTwo">
                                        Can NGO software handle both donor and volunteer management ?
                                    </button>
                                </h2>
                                <div id="genques-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        Yes, most NGO software solutions include modules for donor and volunteer
                                        management. These features allow organizations to track donations, manage donor
                                        relationships, and keep records of volunteer participation and hours, enhancing
                                        engagement with supporters.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genques-collapseThree" aria-expanded="false"
                                        aria-controls="genques-collapseThree">
                                        Is NGO software customizable to fit the unique needs of my organization?
                                    </button>
                                </h2>
                                <div id="genques-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingThree" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        Many NGO software solutions offer customizable features, allowing organizations
                                        to tailor the system to their specific needs. This can include custom fields,
                                        reports, workflows, and integration with other tools your NGO may use.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genques-collapseFour" aria-expanded="false"
                                        aria-controls="genques-collapseFour">
                                        How does NGO software help with compliance and reporting ?
                                    </button>
                                </h2>
                                <div id="genques-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingFour" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        NGO software typically includes built-in reporting tools that help organizations
                                        comply with regulatory requirements and generate reports for donors,
                                        stakeholders, and government agencies. It simplifies financial tracking,
                                        donation history, and impact reporting, ensuring transparency and
                                        accountability.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->

                    </div>
                    <!-- end col -->
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-1">
                                <i class="ri-shield-keyhole-line fs-24 align-middle text-success me-1"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fw-semibold">Privacy &amp; Security</h5>
                            </div>
                        </div>

                        <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                            id="privacy-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#privacy-collapseOne" aria-expanded="false"
                                        aria-controls="privacy-collapseOne">
                                        What personal information does the NGO software collect?
                                    </button>
                                </h2>
                                <div id="privacy-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingOne" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        The software typically collects personal information like names, email
                                        addresses, phone numbers, addresses, donation history, and volunteer activity.
                                        This data is used to manage relationships with donors, volunteers, and
                                        beneficiaries, and to improve organizational processes.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#privacy-collapseTwo" aria-expanded="true"
                                        aria-controls="privacy-collapseTwo">
                                        How does the NGO software ensure the security of my data?
                                    </button>
                                </h2>
                                <div id="privacy-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingTwo" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        Most NGO software uses encryption, secure access controls, and other
                                        industry-standard security measures to protect your data. The software may also
                                        have regular audits, backups, and compliance with data protection regulations
                                        like GDPR or CCPA to ensure privacy and security.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#privacy-collapseThree" aria-expanded="false"
                                        aria-controls="privacy-collapseThree">
                                        Will my data be shared with third parties?
                                    </button>
                                </h2>
                                <div id="privacy-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingThree" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        NGO software providers usually do not share your data with third parties without
                                        explicit consent, except when necessary for service delivery (e.g., payment
                                        processors or cloud storage providers). The privacy policy should clearly state
                                        under what conditions data may be shared, ensuring transparency.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#privacy-collapseFour" aria-expanded="false"
                                        aria-controls="privacy-collapseFour">
                                        Can I access, update, or delete my personal data?
                                    </button>
                                </h2>
                                <div id="privacy-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingFour" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        Most NGO software allows users to access, update, or request the deletion of
                                        their personal data in compliance with data protection regulations. The privacy
                                        policy should outline the process for making these requests and the time frame
                                        for the software provider to respond.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end faqs -->
        <!-- start review -->
        <section class="section bg-primary" id="reviews">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center">
                            <div>
                                <i class="ri-double-quotes-l text-success display-3"></i>
                            </div>
                            <h4 class="text-white mb-5"><span class="text-success">9k</span>+ Satisfied clients</h4>

                            <!-- Swiper -->
                            <div class="swiper client-review-swiper rounded" dir="ltr">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 ff-secondary mb-4">" This software has been a
                                                        lifesaver for our NGO! It's so easy to manage donations, track
                                                        volunteer hours, and stay organized. The real-time reports help
                                                        us make better decisions, and the communication tools keep
                                                        everyone on the same page. "</p>

                                                    <div>
                                                        <h5 class="text-white">Mr.Abhishek</h5>
                                                        <p>PM Foundation</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end slide -->
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 ff-secondary mb-4">"We’ve been using this software
                                                        for several months now, and it's been a game-changer. The user
                                                        interface is simple, and it helps us stay on top of our
                                                        fundraising campaigns and volunteer hours. It saves us time and
                                                        effort every day. "</p>

                                                    <div>
                                                        <h5 class="text-white">Mr.Mukesh</h5>
                                                        <p>ITVE Help Foundation</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end slide -->
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 ff-secondary mb-4">"This software has completely
                                                        transformed the way we manage donations, volunteers, and events.
                                                        It's easy to use, and the reporting features help us track our
                                                        progress efficiently. Highly recommend for any organization
                                                        looking to streamline their operations. "</p>

                                                    <div>
                                                        <h5 class="text-white">Mrs. Aditi Bagchi</h5>
                                                        <p>RSWF Foundation</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end slide -->
                                </div>
                                <div class="swiper-button-next bg-white rounded-circle"></div>
                                <div class="swiper-button-prev bg-white rounded-circle"></div>
                                <div class="swiper-pagination position-relative mt-2"></div>
                            </div>
                            <!-- end slider -->
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end review -->
        <section class="container demo-section " id="demo">
            <div class="row">
                <h2 style="text-align:center; margin-bottom:30px;">Request For a Demo Schedule</h2>
                <!-- Video Section -->
                <div class="col-md-6">
                    <div class="video-container">
                        <video width="100%" controls autoplay loop muted>
                            <source src="Assets/images/Demo.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>

                <!-- Request a Demo Form -->
                <div class="col-md-6">

                    <div class="form-container">

                        <form id="demoForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile No</label>
                                <input type="tel" class="form-control" id="mobile" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Preferred Date</label>
                                <input type="date" class="form-control" id="date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Book Now</button>
                            <div class="form-message" id="formMessage">Your Demo Schedule is Being Confirmed</div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script>
            document.getElementById("demoForm").addEventListener("submit", function (event) {
                event.preventDefault();
                // Show the confirmation message
                document.getElementById("formMessage").style.display = "block";
            });
        </script>


        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <h1 style="color:white;"><b>NGO KING</b></h1>
                            </div>
                            <div class="mt-4 fs-13">
                                <!-- <p>Premium Multipurpose Admin & Dashboard Template</p> -->
                                <p class="ff-secondary">NGO-KING simplifies NGO operations by streamlining donations,
                                    automating online receipts sent directly to donors, and tracking member and donor
                                    records with payment details—all accessible from a single dashboard.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <!-- <div class="col-sm-6 mt-4">
                                <h5 class="text-white mb-0">Company</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-profile.php">About Us</a></li>
                                        <li><a href="pages-gallery.php">Gallery</a></li>
                                        <li><a href="apps-projects-overview.php">Projects</a></li>
                                        <li><a href="pages-timeline.php">Timeline</a></li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="col-sm-6 mt-4">
                                <h5 class="text-white mb-0">Quick Links</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="#plans">Plans</a></li>
                                        <li><a href="#features">Features</a></li>
                                        <li><a href="#faq">Faq's</a></li>
                                        <li><a href="#reviews">Reviews</a></li>
                                        <li><a href="#demo">Demo</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5 class="text-white mb-0">Contact</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-faqs.php">Email :- onlinevakilkaro@gmail.com</a></li>
                                        <li><a href="pages-faqs.php">Mobile :- +91 98281 23489</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="copy-rights mb-0">
                                <script> document.write(new Date().getFullYear()) </script> © Ngo King
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-google-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-instagram-line"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->


        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    <?php include 'layouts/vendor-scripts.php'; ?>

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- landing init -->
    <script src="assets/js/pages/landing.init.js"></script>
</body>

</html>