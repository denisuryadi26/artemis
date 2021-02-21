<body class="sidebar-mini layout-fixed sidebar-collapse" style="height: auto;">
<div class="loader">
    <img src="<?php echo base_url() ?>assets/Spin-1s-200px.gif" alt="Loading..." width="80">
    <p>Please Wait...</p>
</div>
  <div class="wrapper">
    <?php
      if ($this->session->userdata('users_id') == null) 
      {
        redirect('C_login');
      }
      $location       = $this->session->userdata('list_location'); // list location dari SSO
      $location_id    = $this->session->userdata('location_id'); // location id setelah dipilih dari list
      $location_name  = $this->session->userdata('location_name'); // location name setelah dipilih dari list
      $loc_id         = $this->session->userdata('loc_id'); // location id sebelum dipilih dari list
      $loc_name       = $this->session->userdata('loc_name'); // location name sebelum dipilih dari list
      $program_id     = $this->session->userdata('program_id');
      $program_name   = $this->session->userdata('program_name');
      $prog_id        = $this->session->userdata('prog_id'); // program id sebelum dipilih dari list
      $prog_name      = $this->session->userdata('prog_name'); // program name sebelum dipilih dari list
    ?>
    <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php base_url() ?>" class="nav-link">Home</a>
          </li> -->
          <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li> -->
          <div class="col-md-5">
            <select class="form-control" style="width: 100%" name="location_id" id="location_id">
              <option value="<?= $location_id; ?>"><?= $location_name; ?></option>
              <?php              
                if($location_id == NULL)
                {
                  echo '<option value="'.$loc_id.'" selected="selected">'.$loc_name.'</option>';
                }
                foreach ($location as $lokasi)
                {                
              ?>
              <option value="<?= $lokasi->loc_id; ?>"><?php echo $lokasi->name; ?></option>

                  <!-- <option 
                    value="<?//= $lokasi->loc_id; ?>" 
                    <?php 
                      // if(!empty($location_id) && $lokasi->loc_id == $location_id) 
                      // {
                      //   echo "selected";
                      // }
                      // elseif ($lokasi->loc_id == $loc_id) 
                      // {
                      //   echo "selected";
                      // }
                  ?>
                   ><?php //echo $lokasi->name; ?>
                  </option> -->
                  
              <?php
                }
              ?>
            </select>
          </div>
          <div class="col-md-5 ">
            <select class="form-control" style="width: 100%" name="program_id" id="program_id" >
              <?php
                //$loc_id = $this->session->userdata('list_location');
                $program_id     = $this->session->userdata('program_id');
                $program_name   = $this->session->userdata('program_name');
                $prog_id        = $this->session->userdata('prog_id'); // program id sebelum dipilih dari list
                $prog_name      = $this->session->userdata('prog_name'); // program name sebelum dipilih dari list
                //$client				  = array_unique($get_client, SORT_REGULAR);
                //$clientname			= array_unique($get_client_name, SORT_REGULAR);
                
                if($program_id == NULL)
                {
                    echo '<option value="'.$prog_id.'" selected="selected">'.$prog_name.'</option>';
                  
                }
                else
                {
                  foreach($location as $lok)
                  {
                    if($lok->loc_id == $location_id)
                    {
                      foreach($lok->client as $clot)
                      {
                  ?>
                          <option value="<?= $clot->c_id; ?>" 
                              <?php 
                                if(!empty($program_id) && $clot->c_id == $program_id){
                                  echo " selected";
                                }
                                elseif($clot->c_id == $prog_id)
                                {
                                  echo " selected";
                                }
                              ?>
                          >
                            <?php echo $clot->name; ?>
                          </option>
                  <?php
                        }
                      }
                    }
                    ?>
                <?php
                }
                ?>
                  <!-- <option value="<?//= $navprogram->program_id; ?>" ><?php //echo $navprogram->program_name; ?></option> -->
            </select>
          </div>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="<?php echo base_url() ?>assets/admin/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="<?php echo base_url() ?>assets/admin/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <div class="media">
                    <img src="<?php echo base_url() ?>assets/admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm">The subject goes here</p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li> -->

          <!-- Notifications Dropdown Menu -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li> -->
          <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <?php
                if (empty($this->session->userdata('photo')) || $this->session->userdata('photo') == null || $this->session->userdata('photo') == "")
                {
                  echo "<img src='".base_url('assets/admin/dist/img/profile.png')."' class='img-circle img-size-32 mr-2' alt='User Image'>";
                }
                else
                {
                  echo "<img src='".$this->session->userdata('photo')."' class='img-circle img-size-32 mr-2' alt='User Image'>";
                }
              ?>
                <!-- <img src="<?php echo base_url() ?>assets/admin/dist/img/profile.png" class="user-image img-circle elevation-2" alt="User Image"> -->
                <span class="d-none d-md-inline text-white">Welcome, <?php echo $this->session->userdata('username'); ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-info">
                <?php
                  if (empty($this->session->userdata('photo')) || $this->session->userdata('photo') == null || $this->session->userdata('photo') == "")
                  {
                    echo "<img src='".base_url('assets/admin/dist/img/profile.png')."' class='img-circle img-size-32 mr-2' alt='User Image'>";
                  }
                  else
                  {
                    echo "<img src='".$this->session->userdata('photo')."' class='img-circle img-size-32 mr-2' alt='User Image'>";
                  }
                ?>
                <!-- <img src="<?php echo base_url() ?>assets/admin/dist/img/profile.png" class="img-circle elevation-2" alt="User Image"> -->
                <p>
                  Welcome, <?php echo $this->session->userdata('full_name'); ?>
                  <small><?php echo $this->session->userdata('current_authorization'); ?></small>
                </p>
              </li>
          </li>
              <!-- Menu Footer-->
          <li class="user-footer">
            <!-- <a href="<?= base_url('admin/Profile') ?>" class="btn btn-default btn-flat">Profile</a> -->
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-info btn-flat float-right">Logout</a>
          </li>
        </ul>
    </nav>
  <!-- /.navbar -->