<div class="cl-sidebar">
    <div class="cl-toggle"><span class="fa fa-bars"></span></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">
                <div class="sidebar-logo">
                    @include('auth.logo')
                </div>
                <ul class="cl-vnavigation">
                    <li class="parent"><a data-page="dashboard" href="#"><span class="jcon jcon-dashboard">&nbsp;</span><span>dashboard</span></a></li>
                    <li class="parent open"><a data-page="" href="#"><span class="jcon jcon-trans">&nbsp;</span><span>Transactions</span></a>
                        <ul class="sub-menu" style="display: block;">
                            <li><a data-page="workbook" href="#">Workbook</a></li>
                            <li><a data-page="banking" href="#">Bank import</a></li>
                        </ul>
                    </li>
                    <li class="parent"><a data-page="client" href="#"><span class="jcon jcon-client">&nbsp;</span><span>Clients</span></a></li>
                    <li class="parent"><a data-page="invoices" href="#"><span class="jcon jcon-invoice">&nbsp;</span><span>Invoices</span></a></li>
                    <li class="parent"><a data-page="project" href="#"><span class="jcon jcon-project">&nbsp;</span><span>Projects</span></a></li>
                    <li class="parent open"><a data-page="" href="#"><span class="jcon jcon-report">&nbsp;</span><span>Reports</span></a>
                        <ul class="sub-menu" style="display: block;">
                            <li><a data-page="report" href="#"> BAS</a></li>
                            <!--start modify: member-1 -->
                            <li ><a data-page="expenseReport" href="#"><span>Expense Reports</span></a></li>
                            <!--end modify: member-1 -->

                        </ul>
                    </li>

                    <li class="parent open"><a data-page="" href="#"><span class="jcon jcon-setting">&nbsp;</span><span>Settings</span></a>
                        <ul class="sub-menu" style="display: block;">
                            <li><a data-page="businessDetail" href="#"> Business Details</a></li>
                            <li><a data-page="gstSettings" href="#">GST Settings</a></li>
                            <li><a data-page="invoicing" href="#">Invoicing</a></li>
                            <li><a data-page="emailTemplates" href="#">Email Templates</a></li>
                            <li><a data-page="reminders" href="#">Reminders</a></li>
                            <!--start modify: member-2 -->
                            <li><a data-page="category" href="#"><span>Categories</span></a></li>
                            <!--end modify: member-2 -->
                        </ul>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>