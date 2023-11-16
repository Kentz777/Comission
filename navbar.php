<style>
</style>
<nav id="sidebar"
 style="background: linear-gradient(to left, #0F52BA, #00FFFF);
 font-family: Prata;
 text-transform: uppercase;
 ">
		
		<div class="sidebar-list" style="background: #0096FF;">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=laundry" class="nav-item nav-laundry"><span class='icon-field'><i class="fas fa-clipboard-list"></i></span> Order List</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fas fa-boxes"></i></span> Product Category</a>	
				<a href="index.php?page=supply" class="nav-item nav-supply"><span class='icon-field'><i class="fa fa-list"></i></span> Product List</a>	
				<a href="index.php?page=inventory" class="nav-item nav-inventory"><span class='icon-field'><i class="fas fa-box"></i></span> Inventory</a>
				<a href="index.php?page=reports" class="nav-item nav-reports"><span class='icon-field'><i class="fa fa-th-list"></i></span> Reports</a>				
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
			<?php endif; ?>
		</div>
</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login_type'] == 2): ?>
	<style>
		.nav-sales ,.nav-users{
			display: none!important;
		}
	</style>
<?php endif ?>