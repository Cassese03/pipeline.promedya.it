<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Sales Force</b> (ver. GT.321.24)
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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
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
                'copy', 'csv', 'excel', 'pdf', 'print'
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


</script>

