<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Images')); ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'layouts/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Base UI', 'title' => 'Images')); ?>

                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Image Rounded & Circle</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="rounded-circle-image" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="rounded-circle-image">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <p class="text-muted">Use
                                        <code>rounded</code> class and <code>rounded-circle</code> class to show an image with a round border and rounded shape respectively.
                                    </p>

                                    <div class="live-preview">

                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <img class="rounded material-shadow" alt="200x200" width="200" src="assets/images/small/img-4.jpg" data-holder-rendered="true">
                                            </div><!-- end col -->
                                            <div class="col-6">
                                                <div class="mt-4 mt-md-0">
                                                    <img class="rounded-circle avatar-xl material-shadow" alt="200x200" src="assets/images/users/avatar-4.jpg" data-holder-rendered="true">
                                                </div>
                                            </div><!-- end col -->
                                        </div>

                                    </div>

                                    <div class="d-none code-view">
                                        <pre class="language-markup">
<code>&lt;!-- Rounded Image --&gt;
&lt;img class=&quot;rounded material-shadow&quot; alt=&quot;200x200&quot; width=&quot;200&quot; src=&quot;assets/images/small/img-4.jpg&quot;&gt;</code>

<code>&lt;!-- Rounded-circle Image --&gt;
&lt;img class=&quot;rounded-circle avatar-xl material-shadow&quot; alt=&quot;200x200&quot; src=&quot;assets/images/users/avatar-4.jpg&quot;&gt;</code></pre>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->

                        </div>

                        <div class="col-xxl-6">

                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Image Thumbnails</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="thumbnails-image" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="thumbnails-image">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <p class="text-muted">Use <code>img-thumbnail</code> class to give an image rounded 1px border appearance.</p>

                                    <div class="live-preview">

                                        <div class="row">
                                            <div class="col-6">
                                                <img class="img-thumbnail" alt="200x200" width="200" src="assets/images/small/img-3.jpg" data-holder-rendered="true">
                                            </div><!-- end col -->
                                            <div class="col-6">
                                                <div class="mt-4 mt-md-0">
                                                    <img class="img-thumbnail rounded-circle avatar-xl" alt="200x200" src="assets/images/users/avatar-3.jpg" data-holder-rendered="true">
                                                </div>
                                            </div><!-- end col -->
                                        </div>



                                    </div>

                                    <div class="d-none code-view">
                                        <pre class="language-markup">
<code>&lt;!-- Thumbnails Images --&gt;
&lt;img class=&quot;img-thumbnail&quot; alt=&quot;200x200&quot; width=&quot;200&quot; src=&quot;assets/images/small/img-3.jpg&quot;&gt;</code>

<code>&lt;img class=&quot;img-thumbnail rounded-circle avatar-xl&quot; alt=&quot;200x200&quot; src=&quot;assets/images/users/avatar-3.jpg&quot;&gt;</code></pre>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Image Sizes</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="image-size" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="image-size">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <p class="text-muted mb-4">Use <code>avatar-xxs</code>, <code>avatar-xs</code>, <code>avatar-sm</code>, <code>avatar-md</code>, <code>avatar-lg</code>, <code>avatar-xl</code> class for different image sizes.</p>

                                    <div class="live-preview">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row g-3">
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded avatar-xxs material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-xxs</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded avatar-xs material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-xs</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded avatar-sm material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-sm</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded avatar-md material-shadow">
                                                            <p class="mt-2  mb-lg-0"><code>avatar-md</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded avatar-lg material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-lg</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded avatar-xl material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-xl</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div><!-- end col -->

                                            <div class="col-md-12">
                                                <div class="row g-3 mt-5">
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-xxs</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xs material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-xs</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-sm material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-sm</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                                            <p class="mt-2  mb-lg-0"><code>avatar-md</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-lg material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-lg</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-xxl-2 col-md-4 col-6">
                                                        <div>
                                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xl material-shadow">
                                                            <p class="mt-2 mb-lg-0"><code>avatar-xl</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-none code-view">
                                        <pre class="language-markup" style="height: 275px;"><code>&lt;!-- Image Sizes --&gt;
&lt;img src=&quot;assets/images/users/avatar-2.jpg&quot; alt=&quot;&quot; class=&quot;rounded avatar-xxs material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-10.jpg&quot; alt=&quot;&quot; class=&quot;rounded avatar-xs material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-3.jpg&quot; alt=&quot;&quot; class=&quot;rounded avatar-sm material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-4.jpg&quot; alt=&quot;&quot; class=&quot;rounded avatar-md material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-5.jpg&quot; alt=&quot;&quot; class=&quot;rounded avatar-lg material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-8.jpg&quot; alt=&quot;&quot; class=&quot;rounded avatar-xl material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-2.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-xxs material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-10.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-xs material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-3.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-sm material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-4.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-md material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-5.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-lg material-shadow&quot;&gt;</code>

<code>&lt;img src=&quot;assets/images/users/avatar-8.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-xl material-shadow&quot;&gt;</code></pre>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Avatar With Content</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="avatar-content" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="avatar-content">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <p class="text-muted">Use <code>avatar-xxs, avatar-xs,avatar-sm,avatar-md,avatar-lg,avatar-xl</code> class to set different avatar content.</p>

                                    <div class="live-preview">

                                        <div class="row g-3">
                                            <div class="col-xxl-2 col-md-4 col-6">
                                                <div class="avatar-xxs mt-3">
                                                    <div class="avatar-title rounded bg-primary-subtle text-primary fs-10 material-shadow">
                                                        XXS
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2 col-md-4 col-6">
                                                <div class="avatar-xs mt-3">
                                                    <div class="avatar-title rounded bg-secondary-subtle text-secondary material-shadow">
                                                        XS
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2 col-md-4 col-6">
                                                <div class="avatar-sm mt-3">
                                                    <div class="avatar-title rounded bg-success-subtle text-success fs-14 material-shadow">
                                                        SM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2 col-md-4 col-6">
                                                <div class="avatar-md mt-3">
                                                    <div class="avatar-title rounded bg-info-subtle text-info fs-16 material-shadow">
                                                        MD
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2 col-md-4 col-6">
                                                <div class="avatar-lg mt-3">
                                                    <div class="avatar-title rounded bg-warning-subtle text-warning fs-20 material-shadow">
                                                        LG
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2 col-md-4 col-6">
                                                <div class="avatar-xl mt-3">
                                                    <div class="avatar-title rounded bg-danger-subtle text-danger fs-22 material-shadow">
                                                        XL
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-none code-view">
                                        <pre class="language-markup" style="height: 200px;">
<code>&lt;!-- Avatar With Content --&gt;
&lt;div class=&quot;avatar-xxs&quot;&gt;
    &lt;div class=&quot;avatar-title rounded bg-primary-subtle text-primary material-shadow&quot;&gt;
        XXS
    &lt;/div&gt;
&lt;/div&gt;</code>

<code>&lt;div class=&quot;avatar-xs&quot;&gt;
    &lt;div class=&quot;avatar-title rounded bg-secondary-subtle text-secondary material-shadow&quot;&gt;
        XS
    &lt;/div&gt;
&lt;/div&gt;</code>

<code>&lt;div class=&quot;avatar-sm&quot;&gt;
    &lt;div class=&quot;avatar-title rounded bg-success-subtle text-success material-shadow&quot;&gt;
        Sm
    &lt;/div&gt;
&lt;/div&gt;</code>

<code>&lt;div class=&quot;avatar-md&quot;&gt;
    &lt;div class=&quot;avatar-title rounded bg-info-subtle text-info material-shadow&quot;&gt;
        Md
    &lt;/div&gt;
&lt;/div&gt;</code>

<code>&lt;div class=&quot;avatar-lg&quot;&gt;
    &lt;div class=&quot;avatar-title rounded bg-warning-subtle text-warning material-shadow&quot;&gt;
        Lg
    &lt;/div&gt;
&lt;/div&gt;</code>

<code>&lt;div class=&quot;avatar-xl&quot;&gt;
    &lt;div class=&quot;avatar-title rounded bg-danger-subtle text-danger material-shadow&quot;&gt;
        Xl
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Avatar Group</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="avatar-group" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="avatar-group">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mt-lg-0 mt-3">
                                                    <p class="text-muted">Use <code>avatar-group</code> class to show avatar images with the group.</p>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item material-shadow">
                                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-sm">
                                                        </div>
                                                        <div class="avatar-group-item material-shadow">
                                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-sm">
                                                        </div>
                                                        <div class="avatar-group-item material-shadow">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                                    A
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item material-shadow">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-6">
                                                <div class="mt-lg-0 mt-3">
                                                    <p class="text-muted">Use <code>avatar-group</code> class with <code>data-bs-toggle="tooltip"</code> to show avatar group images with tooltip.</p>
                                                    <div class="avatar-group">
                                                        <a href="javascript: void(0);" class="avatar-group-item material-shadow" data-bs-toggle="tooltip" data-bs-placement="top" title="Christi">
                                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-sm">
                                                        </a>
                                                        <a href="javascript: void(0);" class="avatar-group-item material-shadow" data-bs-toggle="tooltip" data-bs-placement="top" title="Frank Hook">
                                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-sm">
                                                        </a>
                                                        <a href="javascript: void(0);" class="avatar-group-item material-shadow" data-bs-toggle="tooltip" data-bs-placement="top" title="Christi">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                                    C
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="javascript: void(0);" class="avatar-group-item material-shadow" data-bs-toggle="tooltip" data-bs-placement="top" title="mORE">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title rounded-circle">
                                                                    2+
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div> <!-- end preview-->

                                    <div class="d-none code-view">
                                        <pre class="language-markup" style="height: 275px;">
<code>&lt;!-- Simple Group --&gt;
&lt;div class=&quot;avatar-group&quot;&gt;
    &lt;div class=&quot;avatar-group-item material-shadow&quot;&gt;
        &lt;img src=&quot;assets/images/users/avatar-4.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-sm&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;avatar-group-item material-shadow&quot;&gt;
        &lt;img src=&quot;assets/images/users/avatar-5.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-sm&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;avatar-group-item material-shadow&quot;&gt;
        &lt;div class=&quot;avatar-sm&quot;&gt;
            &lt;div class=&quot;avatar-title rounded-circle bg-light text-primary&quot;&gt;
                A
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;avatar-group-item material-shadow&quot;&gt;
        &lt;img src=&quot;assets/images/users/avatar-2.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-sm&quot;&gt;
    &lt;/div&gt;
&lt;/div&gt;</code>

<code>&lt;!-- Avatar Group with Tooltip --&gt;
&lt;div class=&quot;avatar-group&quot;&gt;
    &lt;a href=&quot;javascript: void(0);&quot; class=&quot;avatar-group-item material-shadow&quot; data-bs-toggle=&quot;tooltip&quot; data-bs-placement=&quot;top&quot; title=&quot;Christi&quot;&gt;
        &lt;img src=&quot;assets/images/users/avatar-4.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-sm&quot;&gt;
    &lt;/a&gt;
    &lt;a href=&quot;javascript: void(0);&quot; class=&quot;avatar-group-item material-shadow&quot; data-bs-toggle=&quot;tooltip&quot; data-bs-placement=&quot;top&quot; title=&quot;Frank Hook&quot;&gt;
        &lt;img src=&quot;assets/images/users/avatar-3.jpg&quot; alt=&quot;&quot; class=&quot;rounded-circle avatar-sm&quot;&gt;
    &lt;/a&gt;
    &lt;a href=&quot;javascript: void(0);&quot; class=&quot;avatar-group-item material-shadow&quot; data-bs-toggle=&quot;tooltip&quot; data-bs-placement=&quot;top&quot; title=&quot;Christi&quot;&gt;
        &lt;div class=&quot;avatar-sm&quot;&gt;
            &lt;div class=&quot;avatar-title rounded-circle bg-light text-primary&quot;&gt;
                C
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/a&gt;
    &lt;a href=&quot;javascript: void(0);&quot; class=&quot;avatar-group-item material-shadow&quot; data-bs-toggle=&quot;tooltip&quot; data-bs-placement=&quot;top&quot; title=&quot;more&quot;&gt;
        &lt;div class=&quot;avatar-sm&quot;&gt;
            &lt;div class=&quot;avatar-title rounded-circle&quot;&gt;
                2+
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/a&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Figures</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="Figures-image" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="Figures-image">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <p class="card-title-desc text-muted">Use the included <code>figure</code>, <code>figure-img</code> and <code>figure-caption</code> classes to provide some baseline styles for the HTML5 <code>&lt;figure&gt;</code> and <code>&lt;figcaption&gt;</code> elements.</p>

                                    <div class="live-preview">

                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <figure class="figure mb-0">
                                                    <img src="assets/images/small/img-4.jpg" class="figure-img img-fluid rounded" alt="...">
                                                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                                                </figure>
                                            </div>
                                            <div class="col-sm-6">
                                                <figure class="figure mb-0">
                                                    <img src="assets/images/small/img-5.jpg" class="figure-img img-fluid rounded" alt="...">
                                                    <figcaption class="figure-caption text-end">A caption for the above image.</figcaption>
                                                </figure>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-none code-view">
                                        <pre class="language-markup">
<code>&lt;!-- figures Images --&gt;
&lt;figure class=&quot;figure&quot;&gt;
    &lt;img src=&quot;assets/images/small/img-4.jpg&quot; class=&quot;figure-img img-fluid rounded&quot; alt=&quot;...&quot;&gt;
    &lt;figcaption class=&quot;figure-caption&quot;&gt;A caption for the above image.&lt;/figcaption&gt;
&lt;/figure&gt;</code>

<code>&lt;figure class=&quot;figure mb-0&quot;&gt;
    &lt;img src=&quot;assets/images/small/img-5.jpg&quot; class=&quot;figure-img img-fluid rounded&quot; alt=&quot;...&quot;&gt;
    &lt;figcaption class=&quot;figure-caption text-end&quot;&gt;A caption for the above image.&lt;/figcaption&gt;
&lt;/figure&gt;</code></pre>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Responsive Images</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="responsive-image" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="responsive-image">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <p class="card-title-desc text-muted">Responsive Images with <code>img-fluid,max-width: 100%; and height: auto;</code> to the image so that it scales with the parent width.</p>

                                    <div class="live-preview">

                                        <div>
                                            <img src="assets/images/small/img-2.jpg" class="img-fluid" alt="Responsive image">
                                        </div>

                                    </div>

                                    <div class="d-none code-view">
                                        <pre class="language-markup">
<code>&lt;!-- Responsive Images --&gt;
&lt;img src=&quot;assets/images/small/img-2.jpg&quot; class=&quot;img-fluid&quot; alt=&quot;Responsive image&quot;&gt;</code></pre>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include 'layouts/customizer.php'; ?>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>


</body>

</html>