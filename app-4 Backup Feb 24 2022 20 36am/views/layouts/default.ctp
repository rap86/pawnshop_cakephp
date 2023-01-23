<!DOCTYPE html>
<html lang="en">

<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	

    <title>Pawnshop System</title>

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- MetisMenu CSS -->
    <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet"/>

    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet"/>

    <!-- Morris Charts CSS -->
    <link href="/vendor/morrisjs/morris.css" rel="stylesheet"/>

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- DataTables CSS -->
    <link href="/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	
	<!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
    <link href="/css/w3.css" rel="stylesheet" type="text/css">

	<!--jquery datepicker-->
	<link rel="stylesheet" href="/css/jquery-ui.css">
	
	<!--jsweet alert-->
	<link href="/swal/sweetalert2.min.css" rel="stylesheet" type="text/css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
		a {
			text-decoration: none !important;
		}
		
		.error-message { color:red; }
		/*
		 blink {
		  animation: blinker 0.6s linear infinite;
		  color: white;
		  font-size: 26px;
		  font-weight: bold;
		  font-family: sans-serif;
		  }
		  @keyframes blinker {  
			50% { opacity: 0; }
		  }
		  */
	</style>
</head>

<!--body onclick="clickMe()" onmousemove="onmousemoveMe()" onscroll="onscrollMe()"-->
<body>
	
    <div id="wrapper">

        <!-- Navigation -->
        <!--nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#008080;"-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; color:black; background-color:#008080;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand w3-text-white w3-xlarge" href="/homes/home">You: <?php echo $user_role; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!--li>
                    <a href="#">
                        <i class="glyphicon glyphicon-time"> </i> 
						<span id="time" class="w3-text-black"></span>
                    </a>
				</li-->
				<li>
					<a href="/homes/dashboard">
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>
				</li>
				<li>
					<a href="/homes/download_database">
                        <i class="fa fa-database fa-fw"></i> Backup DB
                    </a>
				</li>
				<li>
					<a href="/users/call_delete_log">
                        <i class="fa fa-close fa-fw"></i> DB Logs
                    </a>
				</li>
				<li>
					<a href="/homes/delete_internal_file_logs">
                        <i class="fa fa-close fa-fw"></i> Internal File Logs
                    </a>
				</li>
				<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-info fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Developer</strong>
                                    <span class="pull-right text-muted">
                                        <em></em>
                                    </span>
                                </div>
                                <div>
									Name: Ronaldo A. Panuelos<br />
									Email: ronaldo.panuelos@yahoo.com
								</div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
				<li>
					<a href="/users/logout">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
				</li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
			<!--
			pag masyado mahaba yung side bar at mag click 
			parang nasisisra layout ng side bar kaya pag 
			maulit yon mag lalagay ako ng <br /> tag dito mismo
			-->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                           <?php echo $this->Form->create('Customer', array('action'=>'search', 'class'=>'form-horizontal')); ?>
								<div class="input-group custom-search-form">
									<input type="text" name="data[Customer][name]" class="form-control" placeholder="Search Lastname..." id="customerName"/>
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit" id="btnCustomerName">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
							<?php echo $this->Form->end(); ?>
                        </li>
						 <li class="sidebar-search">
                            <?php echo $this->Form->create('TransactionInterestPayment', array('action'=>'search', 'class'=>'form-horizontal')); ?>
								<div class="input-group custom-search-form">
									<input type="text" name="data[TransactionInterestPayment][pt_number]" class="form-control" placeholder="Search PT No..." id="customerPTNUmber"/>
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit" id="btnCustomerPTNUmber">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
							<?php echo $this->Form->end(); ?>
                        </li>
                        <!--li>
                            <a href="/customers/add"><i class="fa fa-users fa-fw"></i> New Customer</a>
                        </li-->
                        <!--li>
                            <a href="/customers/index"><i class="fa fa-table fa-fw"></i> Customer</a>
                        </li-->
						<li>
							<a href="/customer_transactions/pawn" class="w3-red w3-margin-left w3-margin-right"><i class="fa fa-money fa-fw"></i> Pawned</a>
						</li>
						<li>
							<a href="/customer_transactions/under_auction" class="w3-green w3-margin-left w3-margin-right"><i class="fa fa-money fa-fw"></i> Under Auction</a>
						</li>
						<li>
							<a href="/customer_transactions/takeout" class="w3-gray w3-margin-left w3-margin-right"><i class="fa fa-money fa-fw"></i> Under Auction Takeout</a>
						</li>
						<li>
							<a href="/customer_transactions/redeemed" class="w3-blue w3-margin-left w3-margin-right"><i class="fa fa-money fa-fw"></i> Redeemed</a>
						</li>
						<li>
							<a href="/customer_transactions/auctioned" class="w3-amber w3-margin-left w3-margin-right"><i class="fa fa-money fa-fw"></i> Auctioned</a>
						</li>
                        <li>
                            <a href="#" class="w3-margin-left w3-margin-right"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
									<a href="/cash_books/cash_book_one">Cash Book 1</a>
								</li>
								<li>
									<a href="/cash_books/cash_book_two">Cash Book 2 (Book 1,2 and 3) </a>
								</li>
								<li>
									<a href="/cash_books/report_capital">Monthly Report</a>
								</li>
								<li>
									<a href="/cash_books/granted">Report (Granted)</a>
								</li>
								<li>
									<a href="/cash_books/collected">Report (Collected)</a>
								</li>
								<li>
									<a href="/cash_books/list_deposit">Add / List of Deposit</a>
								</li>
								<li>
									<a href="/cash_books/list_withdrawal">Add / List of Withdrawal</a>
								</li>
								<li>
									<a href="/cash_books/list_expenses">Add / List Expenses</a>
								</li>
								<li>
									<a href="/cash_books/list_cashtype">Add / List Cash type</a>
								</li>
								<li>
									<a href="/book_bir_payments/index">BIR list of payment</a>
								</li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php if($this->Session->read('Auth.User.roles') == 'admin') { ?>
						<li>
                            <a href="#" class="w3-margin-left w3-margin-right"><i class="fa fa-bar-chart-o fa-fw"></i> Admin Options<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
									<a href="/users/index"><i class="fa fa-user fa-fw"></i> Users</a>
								</li>
								<li>
									<a href="/books/index"><i class="fa fa-book fa-fw"></i> Books</a>
								</li>
								<li>
									<a href="/items/index"><i class="fa fa-edit fa-fw"></i> Items</a>
								</li>
								<li>
									<a href="/logs/index"><i class="fa fa-user fa-fw"></i> Activity Logs</a>
								</li>
								 <li>
									<a href="/homes/download_database"><i class="fa fa-database fa-fw"></i> Download Database</a>
								</li>
								 <li>
									<a href="/users/call_delete_log"><i class="glyphicon glyphicon-remove fa-fw"></i> Delete Logs</a>
								</li>
								<li>
									<a href="/pawnshop_emails/index"><i class="fa fa-envelope fa-fw"></i> Pawnshop Email</a>
								</li>
								<li>
									<a href="/book_month_interests/index"><i class="fa fa-envelope fa-fw"></i> Book Month Interests</a>
								</li>
								<li>
									<a href="/book_month_interests/categories"><i class="fa fa-envelope fa-fw"></i> Book Category Interest</a>
								</li>
								<li>
									<a href="/book_bir_interests/index"><i class="fa fa-envelope fa-fw"></i> BIR Interest Per Month</a>
								</li>
							</ul>
									<!-- /.nav-second-level -->
						</li>
						<?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $this->Session->flash(); ?>
					<?php echo $content_for_layout; ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/vendor/raphael/raphael.min.js"></script>
    <script src="/vendor/morrisjs/morris.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="/dist/js/sb-admin-2.js"></script>
	
	 <!-- DataTables JavaScript -->
    <script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/vendor/datatables-responsive/dataTables.responsive.js"></script>
	
	<!--jquery datepicker-->
	<script src="/js/jquery-ui.js"></script>
	
	<!--sweet alert js-->
	<script src="/swal/sweetalert2.all.min.js"></script>
	
	
	<a style="display:none;" id='myModalCustomerSearch' class="w3-button w3-block w3-dark-grey w3-round-small" data-toggle="modal" data-target="#myModalCustomerSearchStatus">Customer Search</a>
	
	<!-- Modal -->
	<div class="modal fade" id="myModalCustomerSearchStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header w3-red">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Alert !</h4>
				</div>
				<div class="modal-body">
					<p class="w3-center" id="textHere">
						
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="w3-button w3-light-grey w3-border w3-round-small" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<?php  echo $this->element('sql_dump'); ?>

</body>

</html>
<!--script>
$(document).ready(function(){
   $(document).bind("contextmenu",function(e){
      alert('Security Activated.');
	  return false;
   });
});
</script-->

<script>
$(document).ready(function() {
	
	$(document).bind("contextmenu",function(e){
	
		alertSwal('No right click.');
		
	    return false;
    });
	
	$("div.alert").fadeOut(1000);
	$("div.alert").siblings("br").fadeOut(1000);
	$("input[type=text]").attr('autocomplete', 'off');
	
	$('#dateFrom').datepicker({ dateFormat: "yy-mm-dd" });
	$('#dateTo').datepicker({ dateFormat: "yy-mm-dd" });
	
	// to check if date from is greater than date to
	var dateFrom  = $('#dateFrom').val();
	var dateto    = $('#dateTo').val();
	var from 	  = new Date(dateFrom);
	var to 		  = new Date(dateto);
	
	if(from > to) {
		
		alertSwal('Date From must be less than or equal to Date To!');
		
		return false;
	}

   // para malaman kung empty ba yung text box pag click ng search
   
   $('#btnCustomerName').click(function(e) {
		var customerName = $('#customerName').val();
		if( $.trim(customerName) == '' )
		{
			alertSwal('Type customer name you want to search!');
			
			return false;

		}
		if( $.isNumeric(customerName) )
		{
			alertSwal('Number is not a valid name');
			
			return false;
		}
		
   });
  
   $('#btnCustomerPTNUmber').click(function() {
		var pt_number = $('#customerPTNUmber').val();
		
		if($.trim(pt_number) == '')
		{
			alertSwal('Type PT Number!');
			
			return false;
		}
		
   });
   
   function alertSwal(alert_message)
   {
			
		Swal.fire({
		  type: 'error',
		  title: 'Oops...',
		  text: alert_message,
		  showConfirmButton: false,
		  timer: 1500
		});
   }
   
});
</script>

<!--script>
// timer page logout if users unattended

function clickMe()
{
	 callTimer();
}
function onscrollMe()
{
	 callTimer();
}
 
 function onmousemoveMe()
{
	callTimer();
}
 
 
var timer;

function myTimer(sec) {
	display = document.querySelector('#time');
    if (timer) clearInterval(timer);
    timer = setInterval(function() { 
        display.innerHTML = sec--;
        if (sec == -1) {
            clearInterval(timer);
            window.location='/users/logout';
        } 
    }, 1000);
}

function callTimer()
	{
		myTimer(60 * 5);	
		
	}	
window.onload = function () {

	callTimer();	
};
</script-->