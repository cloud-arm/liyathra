<div class="wrapper">



  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>ARM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">CLOUD<b> ARM</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>



      <?php
      include('connect.php');
      date_default_timezone_set("Asia/Colombo");
      $date =  date("Y/m/d");
      $count = 0;
      ?>




      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->


          <?php

          include('connect.php');
          date_default_timezone_set("Asia/Colombo");
          $date =  date("Y/m/d");
          $rowcount123 = 0;
          $ttre = 0;
          //$tre=$ttre-$rowcount123;
          $rv = 0;
          $rate = 0;
          ?>


          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-refresh fa-spin"></i>
              <span class="label label-danger" id="sync_count">0</span>
            </a>
            <ul class="dropdown-menu">

              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>




          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['SESS_FIRST_NAME']; ?></span>
            </a>
            <ul class="dropdown-menu user">
              <!-- User image -->
              <li class="user-header">
                <div>
                  <span class="badge"><i class="glyphicon glyphicon-user"></i><?php echo $_SESSION['SESS_LAST_NAME']; ?></span>
                </div>
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <p> <?php echo $_SESSION['SESS_FIRST_NAME']; ?></p>
                <small>Member since Nov. 2023</small>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href=" ../../../index.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Dark & Light Theme Button -->
          <li>
            <a href="#" class="day-night s-icon"> <i class="fa fa-adjust"></i> </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->


      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>



        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>

        <?php if ($_SESSION['SESS_FIRST_NAME'] == "Mr.Chaminda") { ?>
          <li>
            <a href="stock.php">
              <i class="fa fa-cubes"></i> <span>Stock</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

          <li>
            <a href="stock_up.php">
              <i class="fa fa-cubes"></i> <span>Stock Update</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

          <li>
            <a href="stock_re.php">
              <i class="fa fa-cubes"></i> <span> Re Order Stock</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-line-chart"></i> <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li><a href="stock_up_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>"><i class="fa fa-circle-o text-yellow"></i> Stock up Report</a></li>

            </ul>
          </li>

        <?php } else { ?>



          <li class="treeview">
            <a href="#">
              <i class="fa fa-group"></i> <span>Customer</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="cus.php"><i class="fa fa-circle-o text-yellow"></i> Add customer</a></li>
              <li><a href="cus_view.php"><i class="fa fa-circle-o text-aqua"></i> View customer</a></li>
            </ul>
          </li>
          <li>
            <a href="product.php?id=0">
              <i class="fa fa-wrench"></i> <span>Product & Service</span>
              <span class="pull-right-container"></span>
            </a>
          </li>
          <li>
            <a href="sales1.php">
              <i class="fa fa-file-text-o"></i> <span>Sales</span>
              <span class="pull-right-container"></span>
            </a>
          </li>





          <li>
            <a href="expenses.php?id=exp<?php echo date("ymdhis"); ?>&year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>">
              <i class="fa fa-dollar"></i> <span>Expenses</span>
              <span class="pull-right-container">

              </span>
            </a>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-cubes"></i> <span>Stock</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="stock.php"><i class="fa fa-circle-o text-yellow"></i>Stock View</a></li>
              <li><a href="stock_up.php"><i class="fa fa-circle-o text-aqua"></i>Stock Update</a></li>
            </ul>
          </li>



          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>HR</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="hr_employee.php"><i class="fa fa-user text-yellow"></i>Employee</a></li>
              <li><a href="hr_attendance.php?emp=all&dates=<?php echo date("Y") . '%2F' . date("m") . '%2F01'; ?>+-+<?php echo date("Y") . '%2F' . date("m") . '%2F' . date("d"); ?>"><i class="fa  fa-500px text-yellow"></i>Attendance</a></li>
              <li><a href="hr_allowances.php"><i class="fa fa-star-o text-yellow"></i>Allowances</a></li>
              <li><a href="hr_salary_advance.php"><i class="fa fa-money text-yellow"></i>Advance</a></li>
              <li><a href="hr_loan.php"><i class="fa fa-university text-yellow"></i>Loan</a></li>
              <li><a href="hr_payroll.php"><i class="fa fa-list-alt text-red"></i>Payroll </a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-line-chart"></i> <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>"><i class="fa fa-circle-o text-red"></i> Sales Report</a></li>

              <li><a href="purchases_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>"><i class="fa fa-circle-o text-yellow"></i> Purchases Report</a></li>
              <li><a href="pnl_rp.php?d1=<?php echo date("Y-m"); ?>-01&d2=<?php echo date("Y-m"); ?>-31"><i class="fa fa-circle-o text-yellow"></i> PNL Report</a></li>
              <li><a href="inventory_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>"><i class="fa fa-circle-o text-yellow"></i> Inventory Report</a></li>
              <li><a href="sms_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>"><i class="fa fa-circle-o text-yellow"></i> SMS Report</a></li>
              <li><a href="stock_up_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>"><i class="fa fa-circle-o text-yellow"></i> Stock up Report</a></li>

              <li><a href="stock_rp.php"><i class="fa fa-circle-o text-yellow"></i> Stock Value Report</a></li>

            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-cubes"></i><span>Purchases</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="grn.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-yellow"></i> GRN</a></li>
              <li><a href="grn_supply.php?id=0"><i class="fa fa-circle-o text-yellow"></i> Suppliers</a></li>
              <li><a href="grn_payment.php"><i class="fa fa-circle-o text-yellow"></i> Payment</a></li>
              <li><a href="grn_return.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-yellow"></i> GRN Return</a></li>
              <li><a href="grn_order.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-yellow"></i> Purchase Order</a></li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-line-chart"></i>
                  <span>Report</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="grn_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-aqua"></i> GRN Record</a></li>
                  <li><a href="grn_payment_rp.php?dates=<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>-<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>"><i class="fa fa-circle-o text-aqua"></i> Payment Record</a></li>
                  <li><a href="grn_return_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-aqua"></i> Return Record</a></li>
                  <li><a href="grn_order_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-aqua"></i> Order Record</a></li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="treeview">
                <a href="#"><i class="fa fa-pie-chart"></i><span>Accounting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="acc_transfer.php"><i class="fa fa-circle-o text-yellow"></i> Account Transfer</a></li>
                    <li><a href="acc_bank_transfer.php"><i class="fa fa-circle-o text-yellow"></i> Bank Transfer</a>
                    </li>
                    <!-- <li><a href="bank_loan.php"><i class="fa fa-circle-o text-yellow"></i> Bank Loan</a>
                    </li> -->
                    <li><a href="acc_chq_realizing.php"><i class="fa fa-circle-o text-yellow"></i> Chq Realizing</a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-line-chart"></i>
                            <span>Report</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="acc_regeneration.php?dates=<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>-<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>&account=1"><i class="fa fa-circle-o text-aqua"></i> Transfer Recode</a></li>
                            <li><a href="acc_bank_regeneration.php?dates=<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>-<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>&bank=1"><i class="fa fa-circle-o text-aqua"></i> Bank Reconciliation</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

          <li class="header">CLOUD ARM SERVICE</li>

          <li>
            <a href="cloud_arm_service.php">
              <i class="fa fa-commenting"></i> <span>SERVICE REQUEST</span>
              <span class="pull-right-container">

              </span>
            </a>
          </li>

      </ul>
      </li>

    <?php } ?>
    </ul>
    </section>