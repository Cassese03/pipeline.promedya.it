<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Smart Sales Force</b> (ver. GT.389.25)
    </div>
    <strong><a href="#">Promedya SRL</a> - IT 03144930645 </strong>
    {{--&copy; 2024--}}
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- ./wrapper -->

<!-- jQuery -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo URL::asset('backend/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>

<script src="<?php echo URL::asset('backend/plugins/fullcalendar/main.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/fullcalendar/locales-all.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="<?php echo URL::asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/chart.js/Chart.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/sparklines/sparkline.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/select2/js/select2.js') ?>"></script>
<script
    src="<?php echo URL::asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/dist/js/adminlte.js') ?>"></script>
<script src="<?php echo URL::asset('backend/dist/js/demo.js') ?>"></script>
<script src="<?php echo URL::asset('backend/dist/js/pages/dashboard.js') ?>"></script>
<script src="<?php echo URL::asset('backend/dist/js/countdown.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/dist/js/print.min.js') ?>"></script>
<script src="<?php echo URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>


<script>

    $(function () {
        $('.datatable').dataTable({
            /* No ordering applied by DataTables during initialisation */
            "order": [],
            autoWidth: false,
            // togliamo la search bar
            searching: false,
            iDisplayLength: 25,
            pagingType: "simple",
            dom: 'lBfrtip',
            buttons: [
                'excel', 'copy', 'csv', 'pdf', 'print'
            ],
            columnDefs: [
                {targets: 'no-sort', orderable: false,},
            ],
            responsive: true,
            scrollX: true,
            scrollY: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
        });

        $('.date-picker').datepicker({
            language: "it",
            autoclose: true,
            orientation: "bottom left"
        });

        $('.date-picker').attr('autocomplete', 'off');

        $('.datetime-picker').attr('autocomplete', 'off');
        $('.datetime-picker').datetimepicker({
            language: "it",
            autoclose: true
        });

        $('.select2').select2();
    })

    // Enhanced Sidebar Treeview Menu Script & Hover Functionality
    $(document).ready(function() {
        var hoverTimer;
        
        // Sidebar hover functionality - open on hover when collapsed
        $('.main-sidebar').hover(
            function() {
                // Mouse enter
                if ($('body').hasClass('sidebar-collapse')) {
                    clearTimeout(hoverTimer);
                    $('body').removeClass('sidebar-collapse').addClass('sidebar-open');
                }
            },
            function() {
                // Mouse leave
                if ($('body').hasClass('sidebar-open')) {
                    hoverTimer = setTimeout(function() {
                        $('body').removeClass('sidebar-open').addClass('sidebar-collapse');
                    }, 300);
                }
            }
        );
        
        // Toggle treeview menu on click
        $('.nav-item.has-treeview > .nav-link').off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $parentItem = $(this).parent('.nav-item');
            
            // Close all OTHER open menus (not the current one)
            $('.nav-item.has-treeview').not($parentItem).removeClass('menu-open');
            
            // Toggle current menu
            $parentItem.toggleClass('menu-open');
        });
        
        // Don't close menu when clicking on submenu items
        $('.nav-treeview .nav-link').on('click', function(e) {
            e.stopPropagation();
        });
        
        // Mark current page as active
        var currentUrl = window.location.pathname;
        var currentFullUrl = window.location.href;
        
        $('.nav-sidebar .nav-link').each(function() {
            var $link = $(this);
            var linkUrl = $link.attr('href');
            
            if (linkUrl && linkUrl !== '<?php echo URL::asset('') ?>') {
                // Get the path from the link URL
                var linkPath = linkUrl.replace(window.location.origin, '');
                
                // Exact match or starts with (for sub-pages)
                var isActive = false;
                
                // Exact match
                if (currentFullUrl === linkUrl || currentUrl === linkPath) {
                    isActive = true;
                }
                // Or current URL starts with link URL (for sub-pages) but only if link is longer
                else if (linkPath.length > 1 && currentUrl.startsWith(linkPath) && currentUrl.charAt(linkPath.length) === '/') {
                    isActive = true;
                }
                
                if (isActive) {
                    $link.addClass('active');
                    
                    // Open parent menu if this is a submenu item
                    var $parentTreeview = $link.closest('.nav-treeview');
                    if ($parentTreeview.length) {
                        $parentTreeview.parent('.nav-item').addClass('menu-open');
                        $parentTreeview.show();
                    }
                }
            }
        });
        
        // Keep treeview functionality working with AdminLTE
        $('[data-widget="treeview"]').each(function() {
            $(this).Treeview && $(this).Treeview('init');
        });
    });


</script>

