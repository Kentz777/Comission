<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<nav class="navbar" style="background: linear-gradient(to left, #0F52BA, #00FFFF);">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" 
      style="display: flex;">
  			<div class="logo">
  				<div class="laundry-logo"></div>
  			</div>
  		</div>
      <div class="col-md-5 float-left text-white"
      style="
      display: flex;
      font-size: 22px;
      font-family: prata;
      text-transform: uppercase;
       ">
        <large><b>Company name</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white"
      style="
      display: flex;
      font-size: 22px;
      font-family: prata;
      text-transform: uppercase;
       ">
	  		<a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
</nav>