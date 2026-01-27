<footer class="main-footer" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: #fff; border-top: 3px solid #4f46e5; padding: 1.5rem 1rem;">
    <div class="pull-right hidden-xs" style="display: flex; align-items: center; gap: 0.5rem;">
        <span style="background: linear-gradient(135deg, #4f46e5, #2563eb); padding: 0.25rem 0.75rem; border-radius: 6px; font-weight: 600; box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);">
            Smart Sales Force
        </span>
        <span style="color: #cbd5e1; font-size: 0.875rem; font-weight: 500;">
            ver. GT.010.26
        </span>
    </div>
    <div style="display: flex; align-items: center; gap: 0.5rem;">
        <i class="fas fa-building" style="color: #4f46e5;"></i>
        <strong style="color: #f1f5f9;">
            <a href="#" style="color: #60a5fa; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#93c5fd'" onmouseout="this.style.color='#60a5fa'">Promedya SRL</a>
            <span style="color: #94a3b8; margin-left: 0.5rem;">P.IVA IT 03144930645</span>
        </strong>
    </div>
    {{--&copy; 2024--}}
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo URL::asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo URL::asset('backend/dist/js/adminlte.js') ?>"></script>
<script src="<?php echo URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js" defer></script>

</body>
</html>


<script>

    $(function () {
        const table = $('.datatable').DataTable({
            "order": [],
            autoWidth: false,
            searching: false,
            paging: true,
            pageLength: 25,
            pagingType: "simple",
            dom: 'lBfrtip',
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-sm'
                    }
                },
                buttons: ['excel', 'copy', 'csv']
            },
            columnDefs: [
                {targets: 'no-sort', orderable: false}
            ],
            deferRender: true,
            scrollX: true,
            info: false,
            language: {
                paginate: {
                    previous: '←',
                    next: '→'
                }
            },
            initComplete: function() {
                // Nascondi le righe non visibili dopo l'inizializzazione
                this.api().page.len(25).draw(false);
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

