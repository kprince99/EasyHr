 <div class="sidebar">
    <div class="logo_content">
      <div class="logo">
        <i class='bx bxs-dashboard'></i>
        <div class="logo_name">Dashboard</div>
      </div>
    </div>
    <ul style = "padding-left:0" class="nav_list">
      <!-- <li>
          <i class='bx bx-search' ></i>
          <input type="text" placeholder="Search...">
        <span class="tooltip">Search</span>
      </li> -->
      <li>
        <a href="./pri_panel.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-user' ></i>
          <span class="links_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-chat' ></i>
          <span class="links_name">Messages</span>
        </a>
        <span class="tooltip">Messages</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="links_name">Analytics</span>
        </a>
        <span class="tooltip">Analytics</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-folder' ></i>
          <span class="links_name">File Manager</span>
        </a>
        <span class="tooltip">Files</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cart-alt' ></i>
          <span class="links_name">Order</span>
        </a>
        <span class="tooltip">Order</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-heart' ></i>
          <span class="links_name">Saved</span>
        </a>
        <span class="tooltip">Saved</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li>
    </ul>
    
  </div>
  <div class="home_content">
    <div class="text">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
   <div class="container-fluid">
   <i class='bx bx-menu' id="btn" ></i>
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto"> 
        <li class="nav-item dropdown bg-primary-700">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
            <?php echo strtoupper($_SESSION['uname']) ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <div class="container-fluid ">
  <div class="input-group mt-2">
    <input type="date" class="form-control sm-3" id="inlineFormInputdate" required>
    <div class="input-group-prepend">
      <div class="input-group-text"><i class='bx bx-calendar' style="font-size:26;"></i></div>
    </div>
  </div>
</div>