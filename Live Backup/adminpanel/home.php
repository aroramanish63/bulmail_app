<div>
    <ul class="breadcrumb">
        <li >
            <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
<div class="sortable row-fluid">
    <ul style=" white-space:normal;">
        <?php
        echo isset($_SESSION['role']['site_config']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=siteconfig"><i class="icon-wrench"></i><div><span class="hidden-tablet"> Site Configuration</span></div></a></li>' : '';
        echo isset($_SESSION['role']['user_role']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=userrole"><i class="icon-wrench"></i><div><span class="hidden-tablet"> User Role</span></div></a></li>' : '';
        echo isset($_SESSION['role']['user_group']) ? ' <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=usergroup"><i class="icon-wrench"></i><div><span class="hidden-tablet"> User Group</span></div></a></li>' : '';
        echo isset($_SESSION['role']['user']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=userDetail"><i class="icon-wrench"></i><div><span class="hidden-tablet"> Users</span></div></a></li>' : '';
        echo isset($_SESSION['role']['publish']) ? ' <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/"><i class="icon-home"></i><div><span class="hidden-tablet"> Publish</span></div></a></li>' : '';
        echo isset($_SESSION['role']['publish']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=multiplepublish"><i class="icon-picture"></i><div><span class="hidden-tablet"> Multiple Publish</span></div></a></li>' : '';
        echo (isset($_SESSION['role']['site_region']) || isset($_SESSION['role']['seo'])) ? ' <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=addSiteRegion"><i class="icon-list-alt"></i><div><span class="hidden-tablet"> Site Region</span></div></a></li>' : '';
        echo isset($_SESSION['role']['edit_key']) ? ' <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=editkeyword"><i class="icon-font"></i><div><span class="hidden-tablet"> Edit Keyword</span></div></a></li>' : '';
        echo isset($_SESSION['role']['imp_key']) ? ' <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=import"><i class="icon-th"></i><div><span class="hidden-tablet"> Import Keywords</span></div></a></li>' : '';
        echo isset($_SESSION['role']['manage_language']) ? '   <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=language"><i class="icon-folder-open"></i><div><span class="hidden-tablet"> Language</span></div></a></li>' : '';
        echo isset($_SESSION['role']['manage_currency']) ? '     <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=currency"><i class="icon-picture"></i><div><span class="hidden-tablet"> Currency Weight</span></div></a></li>' : '';
        echo isset($_SESSION['role']['manage_country']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=country"><i class="icon-align-justify"></i><div><span class="hidden-tablet"> Countries</span></div></a></li>' : '';
        echo isset($_SESSION['role']['exp_kay']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=export"><i class="icon-picture"></i><div><span class="hidden-tablet"> Export Keywords</span></div></a></li>' : '';
        echo isset($_SESSION['role']['add_key']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=addKeyWords"><i class="icon-eye-open"></i><div><span class="hidden-tablet"> Add Keywords</span></div></a></li>' : '';
        echo isset($_SESSION['role']['edit_page']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" target="_blank" href="' . $cfg["site_url"] . '"><i class="icon-calendar"></i><div><span class="hidden-tablet"> Edit Whole Page</span></div></a></li>' : '';
        echo isset($_SESSION['role']['plans']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=elasticpricing"><i class="icon-picture"></i><div><span class="hidden-tablet">Elastic Plan</span></div></a></li>' : '';
        echo isset($_SESSION['role']['plans']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=fixedpricing"><i class="icon-picture"></i><div><span class="hidden-tablet"> Add Fixed Plan</span></div></a></li>' : '';
        echo isset($_SESSION['role']['plans']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=pricing"><i class="icon-picture"></i><div><span class="hidden-tablet"> Edit Fixed Plan</span></div></a></li>' : '';
        echo isset($_SESSION['role']['plans']) ? ' <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=dbpricing"><i class="icon-picture"></i><div><span class="hidden-tablet">Cloud Databases</span></div></a></li>' : '';
        echo isset($_SESSION['role']['blog']) ? '
                            <li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip" href="' . $cfg["admin_url"] . 'module/?page=blog"><i class="icon-picture"></i><div><span class="hidden-tablet"> Blogs</span></div></a></li>' : '';
        echo isset($_SESSION['role']['slider']) ? '<li  style="display:inline; padding:5px;" ><a class="box well span3 top-block"  data-rel="tooltip"  href="' . $cfg["admin_url"] . 'module/?page=slider"><i class="icon-globe"></i><div><span class="hidden-tablet"> Slider</span></div></a></li>
' : '';
        ?>
    </ul>
</div>
