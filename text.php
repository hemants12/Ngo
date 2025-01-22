<div class="row">
    <!-- Top 5 Donors Section -->
    <div class="col-xl-6">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="card-title mb-0">Top 5 Donors</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Donor Name</th>
                                <th>Donation Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Example donor data
                            $topDonors = [
                                ['name' => 'John Doe', 'amount' => '₹ 5000'],
                                ['name' => 'Jane Smith', 'amount' => '₹ 4500'],
                                ['name' => 'Alex Johnson', 'amount' => '₹ 4000'],
                                ['name' => 'Emily Davis', 'amount' => '₹ 3500'],
                                ['name' => 'Michael Brown', 'amount' => '₹ 3000']
                            ];

                            foreach ($topDonors as $index => $donor) {
                                echo "<tr>
                                        <td>" . ($index + 1) . "</td>
                                        <td>{$donor['name']}</td>
                                        <td>{$donor['amount']}</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <!-- Largest and Smallest Donations Section (This Month and This Year) -->
    <div class="col-xl-6">
        <div class="row">
            <!-- This Month's Largest and Smallest Donations -->
            <div class="col-12 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">This Month's Largest and Smallest Donations</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <?php
                        // Example data for this month
                        $largestDonorMonth = ['name' => 'Samuel Green', 'amount' => '₹ 7000'];
                        $smallestDonorMonth = ['name' => 'Sophia White', 'amount' => '₹ 500'];
                        ?>
                        <!-- Largest Donation -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <p class="mb-0">Largest Single Donation</p>
                                <h5 class="mb-0"><?php echo $largestDonorMonth['name']; ?> - <?php echo $largestDonorMonth['amount']; ?></h5>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-primary-subtle rounded fs-4">
                                    <i class="fas fa-trophy text-primary"></i>
                                </span>
                            </div>
                        </div>
                        <!-- Smallest Donation -->
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">Smallest Donation</p>
                                <h5 class="mb-0"><?php echo $smallestDonorMonth['name']; ?> - <?php echo $smallestDonorMonth['amount']; ?></h5>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-danger-subtle rounded fs-4">
                                    <i class="fas fa-heart text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <!-- This Year's Largest and Smallest Donations -->
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">This Year's Largest and Smallest Donations</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <?php
                        // Example data for this year
                        $largestDonorYear = ['name' => 'William Lee', 'amount' => '₹ 10000'];
                        $smallestDonorYear = ['name' => 'Ava Brown', 'amount' => '₹ 300'];
                        ?>
                        <!-- Largest Donation -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <p class="mb-0">Largest Single Donation</p>
                                <h5 class="mb-0"><?php echo $largestDonorYear['name']; ?> - <?php echo $largestDonorYear['amount']; ?></h5>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-primary-subtle rounded fs-4">
                                    <i class="fas fa-trophy text-primary"></i>
                                </span>
                            </div>
                        </div>
                        <!-- Smallest Donation -->
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">Smallest Donation</p>
                                <h5 class="mb-0"><?php echo $smallestDonorYear['name']; ?> - <?php echo $smallestDonorYear['amount']; ?></h5>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-danger-subtle rounded fs-4">
                                    <i class="fas fa-heart text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end col -->
</div><!-- end row -->