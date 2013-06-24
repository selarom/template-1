<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title . ' | ' . $site_name; ?></title>
      
    <!-- css -->
    <link rel="stylesheet" href=<?php echo '"' . base_url() .  'assets/css/bootstrap.css"';?> />
    <link rel="stylesheet" href=<?php echo '"' . base_url() .  'assets/css/sticky.css"';?> />
    <link rel="stylesheet" href=<?php echo '"' . base_url() .  'assets/css/members.css"';?> />
    <!-- end css -->

</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="back"><!-- Container useful for the background -->
      <div class="main_container"><!-- 960 pixels limit, centered -->
             <div id="top_header">
                    <div class="logo">
                            <h1><a href="#">Ecommerce Panel</a></h1>
                    </div>

              <div class="member">
                      <p class="welcome">Welcome <?php echo $this->session->userdata('username');?></p>
                      <p class="login">logged in as<span>Member</span></p>
                      <a class="logout" href="<?php echo base_url(); ?>site_login/logout">Logout</a>
              </div>
       </div>
       <div class="down_header">
       
              <ul class="navigation">
                     <li><a class="dashboard" href="<?php echo base_url();?>member-area">Dashboard</a></li>
                     <li><a class="settings" href="<?php echo base_url();?>member-area/settings">Settings</a></li>
                     <!-- <li><a class="privileges" href="#">Privileges</a></li>
                     <li><a class="reports" href="#">Reports</a></li> -->
              </ul>
           
       </div>
       
       <div class="clear"></div><!-- div useful to separate the different boxes avoiding float issues -->
       