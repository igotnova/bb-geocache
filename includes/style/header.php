<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Geo Hunter</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>



      
   

        <?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  ?>
    <li class="nav-item">
          <a class="nav-link" href="loginform.php">login</a>
        </li>
        <li class="nav-item">
        <li class="nav-item">
          <a class="nav-link" href="includes\php\register.php">register</a>
        </li>
  <?php
}else{
  ?>
       <li class="nav-item">
          <a class="nav-link" href="includes\php\logout.php">logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="home.php">Reserve</a>
        </li>
  <?php
}


?>




        
        
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</header>
