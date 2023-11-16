<style>
  .logo {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100px;
    height: 50px;
    overflow: hidden;
    margin-right: 10px; 
  }

  .logo img {
    width: 120%; 
    height: auto;
  }

  .navbar {
    padding: 10px 120px;
  }

  /* Added CSS for shadow effect */
  .company-name {
    font-size: 22px;
    font-family: prata;
    text-transform: uppercase;
    align-items: center;
    color: black;
  }
</style>

<nav class="navbar" style="background: linear-gradient(to left, #0F52BA, #00FFFF);">
  <div class="container-fluid">
    <div class="col-lg-12">
      <div class="col-md-1 float-left">
        <div class="logo">
          <img src="assets/img/logo.png" alt="Laundry Logo">
        </div>
      </div>
      <div class="col-md-5 float-left text-white">
        <!-- Apply the class to add shadow effect -->
        <large class="company-name"><b>JUMAMIL GARMENTS MANUFACTURING</b></large>
      </div>
      <div class="col-md-2 float-right text-white" 
      style="
      display: flex; 
      font-size: 22px; 
      font-family: prata; 
      text-transform: uppercase;
      color: black;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
      ">
        <a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
      </div>
    </div>
  </div>
</nav>
