<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed'); ?>

<div class="container_12" style="min-height: 400px;">
    <!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="<?php echo SITE_URL; ?>?page=emails" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_write.gif" width="64" height="64" alt="edit" />
                	<span>Emails</span>
                </a>
                
                <a href="<?php echo SITE_URL; ?>?page=sites" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
                	<span>Sites</span>
                </a>
                
<!--                <a href="<?php echo SITE_URL; ?>?page=" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_files.gif" width="64" height="64" alt="edit" />
                	<span>Articles</span>
                </a>
                
                <a href="<?php echo SITE_URL; ?>?page=" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_calendar.gif" width="64" height="64" alt="edit" />
                	<span>Calendar</span>
                </a>-->
                
                <a href="<?php echo SITE_URL; ?>?page=client" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_user.gif" width="64" height="64" alt="edit" />
                	<span>Clients</span>
                </a>
                
<!--                <a href="<?php echo SITE_URL; ?>?page=" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_stats.gif" width="64" height="64" alt="edit" />
                	<span>Stats</span>
                </a>-->
                
<!--                <a href="<?php echo SITE_URL; ?>?page=settings" class="dashboard-module">
                	<img src="<?php echo IMAGEPATH; ?>Crystal_Clear_settings.gif" width="64" height="64" alt="edit" />
                	<span>Settings</span>
                </a>-->
                <div style="clear: both"></div>
            </div> <!-- End .grid_7 -->
            
            <!-- Account overview -->
            <div class="grid_5">
                <div class="module">
                        <h2><span>Account overview</span></h2>
                        
                        <div class="module-body">
                        
                        	<p>
                                <strong>User: </strong><?php echo $_SESSION['username']; ?><br />
                                <strong>Date: </strong><?php echo date('d M, Y'); ?>,<br />
                                <strong>IP Address: </strong><?php echo $_SERVER['REMOTE_ADDR']; ?>
                            </p>
                        
<!--                             <div>
                                 <div class="indicator">
                                     <div style="width: 23%;"></div> change the width value (23%) to dynamically control your indicator 
                                 </div>
                                 <p>Your storage space: 23 MB out of 100MB</p>
                             </div>
                             
                             <div>
                                 <div class="indicator">
                                     <div style="width: 100%;"></div> change the width value (100%) to dynamically control your indicator 
                                 </div>
                                 <p>Your bandwidth (January): 1 GB out of 1 GB</p>
                             </div>
                             
                        	<p>
                                Need to switch to a bigger plan?<br />
                                <a href="<?php echo SITE_URL; ?>?page=">click here</a><br />
                            </p>-->

                        </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
          
            <div style="clear:both;"></div>
        </div> <!-- End .container_12 -->