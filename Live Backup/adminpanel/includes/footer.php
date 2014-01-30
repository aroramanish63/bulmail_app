<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- content ends -->
    </div><!--/#content.span10-->
<?php } ?>
</div><!--/fluid-row-->
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

    <hr>

    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here settings can be configured...</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>

    <footer>
        <p class="pull-left">&copy; <a href="http://cyfuture.com" target="_blank">Futuristic Internet Services LLC</a> <?php echo date('Y') ?></p>
    </footer>
<?php } ?>

</div><!--/.fluid-container-->

<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<!-- jQuery UI -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="<?php echo $cfg['admin_script_url']; ?>bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.cookie.js"></script>
<!-- calander plugin -->
<script src="<?php echo $cfg['admin_script_url']; ?>fullcalendar.min.js"></script>
<!-- data table plugin -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.dataTables.min.js"></script>

<!-- chart libraries start -->
<script src="<?php echo $cfg['admin_script_url']; ?>excanvas.js"></script>
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.flot.min.js"></script>
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.flot.pie.min.js"></script>
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.flot.stack.js"></script>
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->


<!-- select or dropdown enhancer -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.noty.js"></script>
<!-- file manager library -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo $cfg['admin_script_url']; ?>charisma.js"></script>

<!-- Validation -->
<script src="<?php echo $cfg['admin_script_url']; ?>jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $cfg['admin_script_url']; ?>validation.js" type="text/javascript"></script>

</body>
</html>
