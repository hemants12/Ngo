<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <!-- <img src="assets/images/logo-light.png" alt="" height="17"> -->
                 <h2 class="mt-4 text-light">NGO KING</h2>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
<!-- Dashboard -->
<li class="nav-item">
    <a class="nav-link menu-link" href="index.php" role="button">
        <i class="fas fa-chart-line"></i>
        <span data-key="t-dashboard">Dashboard</span>
    </a>
</li>
<!-- Donations -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarDonations" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarDonations">
        <i class="fas fa-donate"></i>


        <span data-key="t-donations">Donations</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarDonations">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="New-Donation.php" class="nav-link" data-key="t-new-donation">New Donation</a>
            </li>
            <li class="nav-item">
                <a href="donation-history.php" class="nav-link" data-key="t-donation-history">Donation History</a>
            </li>
            <li class="nav-item">
                <a href="top-donors.php" class="nav-link" data-key="t-top-donors">Top Donors</a>
            </li>
        </ul>
    </div>
</li>
<!-- Members -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarMembers" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarMembers">
        <i class="fas fa-user-plus"></i>
        <span data-key="t-members">Members</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarMembers">
        <ul class="nav nav-sm flex-column">
        <li class="nav-item">
                <a href="add-member.php" class="nav-link" data-key="t-member-list">Add Member</a>
            </li>
            <li class="nav-item">
                <a href="member_list.php" class="nav-link" data-key="t-member-list">Member List</a>
            </li>
            
            <li class="nav-item">
                <a href="renewal_reminders.php" class="nav-link" data-key="t-renewal-reminders">Renewal Reminders</a>
            </li>
            
        </ul>
    </div>
</li>
<!-- Campaigns -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarCampaigns" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarCampaigns">
        <i class="fas fa-tasks"></i>



        <span data-key="t-campaigns">Campaigns</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarCampaigns">
        <ul class="nav nav-sm flex-column">
        <li class="nav-item">
                <a href="create-campaign.php" class="nav-link" data-key="t-create-campaign">Create Campaign</a>
            </li>
            <li class="nav-item">
                <a href="active-campaigns.php" class="nav-link" data-key="t-active-campaigns">Active Campaigns</a>
            </li>
           
           
        </ul>
    </div>
</li>
<!-- Employee -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebaremployee" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebaremployee">
        <i class="fas fa-user-tie"></i>




        <span data-key="t-employee">HRM</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebaremployee">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="Staff.php" class="nav-link" data-key="t-staffs">Staffs</a>
            </li>
            <li class="nav-item">
                <a href="attandance.php" class="nav-link" data-key="t-attandance">Attandance</a>
            </li>
            <li class="nav-item">
                <a href="user-roles.php" class="nav-link" data-key="t-user-roles">User Roles</a>
            </li>
        </ul>
    </div>
</li>
<!-- Website-->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarCustomize" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarCustomize">
        <i class="fas fa-desktop"></i>


        <span data-key="t-customize">Website</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarCustomize">
        <ul class="nav nav-sm flex-column">
            <!-- Header Section -->
            <li class="nav-item">
                <a href="header-settings.php" class="nav-link" data-key="t-header-settings">Header Section</a>
            </li>
            
        </ul>
    </div>
</li>
<!-- Financials -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarFinancials" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarFinancials">
        <i class="fas fa-dollar-sign"></i>
 <span data-key="t-financials">Financials</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarFinancials">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="day_book.php" class="nav-link" data-key="t-day-book">Day Book</a>
            </li>
            <li class="nav-item">
                <a href="profit-loss.php" class="nav-link" data-key="t-profit-loss">Profit & Loss Statement</a>
            </li>
            <li class="nav-item">
                <a href="balance-sheet.php" class="nav-link" data-key="t-balance-sheet">Balance Sheet</a>
            </li>
        </ul>
    </div>
</li>
<!-- Reports -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarReports">
        <i class="fas fa-file-alt"></i>
        <span data-key="t-reports">Reports</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarReports">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="expense_reports.php" class="nav-link" data-key="t-custom-reports">Expense Reports</a>
            </li>
            <li class="nav-item">
                <a href="donation_reports.php" class="nav-link" data-key="t-donation-reports">Donation Reports</a>
            </li>
            <li class="nav-item">
                <a href="campaign_reports.php" class="nav-link" data-key="t-campaign-reports">Campaign Reports</a>
            </li>
            <li class="nav-item">
                <a href="financial_reports.php" class="nav-link" data-key="t-financial-reports">Financial Reports</a>
            </li>
        </ul>
    </div>
</li>     
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>