  <?php
    $C_menu = $this->uri->segment(2);
    // echo $C_menu; die;
    $location       = $this->session->userdata('list_location'); // list location dari SSO
    $location_id    = $this->session->userdata('location_id'); // location id setelah dipilih dari list
    $location_name  = $this->session->userdata('location_name'); // location name setelah dipilih dari list
    $loc_id         = $this->session->userdata('loc_id'); // location id sebelum dipilih dari list
    $loc_name       = $this->session->userdata('loc_name'); // location name sebelum dipilih dari list
  ?>

  <aside class="main-sidebar sidebar-dark-info elevation-4"> <!-- Active Menu -->
    <!-- Brand Logo -->
    

    <a href="<?php echo base_url('admin/C_home') ?>" class="brand-link bg-info">
      <img src="<?php echo base_url() ?>assets/admin/dist/img/logo-system3.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ARTEMIS  </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">    
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php 
              $listmenu = $this->session->userdata('list_menu');
              foreach ($listmenu as $menu)
              {
                $active= "";

                $subitem = isset($menu->itemOptions)?1:0;
                //$menu->itemOptions = false;
                if(strpos($menu->url[0], $C_menu) !== false){
                    $active = "active";
                }

                if($subitem == true) { 
                  //$menu->itemOptions = true;
            ?>
              <li class="nav-item">
                  <a href="#" class='nav-link'>
                    <?php echo $menu->label; ?>
                  </a>

                  <ul class="nav nav-treeview" style="display: none;">

                  <?php 
                    foreach ($menu->items as $submenu) {
                  ?>

                    <li class="nav-item">
                    <a href="<?= base_url($submenu->url); ?>" class='nav-link'>
                      <?php echo $submenu->label; ?>
                    </a>
                    </li>

                  <?php
                            
                    }
                  ?>

                  </ul>
              </li>
            <?php
                }
                else
                {
                // print_r($menu->url[0]); die;
            ?>          
                <li class="nav-item">
                  <a href="<?= base_url($menu->url); ?>" class='nav-link text-white <?php echo $active; ?>'>
                    <?php echo $menu->label; ?>
                  </a>
                </li>
              <?php

                }
              }
              ?>
        </ul>
      </nav>
    </div>
  </aside>

