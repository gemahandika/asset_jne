</div>


</div>

<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script src="../../../app/assets/js/qrcode.js"></script>

<!--   Core JS Files   -->
<script src="../../../app/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../../../app/assets/js/core/popper.min.js"></script>
<script src="../../../app/assets/js/core/bootstrap.min.js"></script>
<!-- jQuery Scrollbar -->
<script src="../../../app/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Chart JS -->
<script src="../../../app/assets/js/plugin/chart.js/chart.min.js"></script>
<!-- jQuery Sparkline -->
<script src="../../../app/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
<!-- Chart Circle -->
<script src="../../../app/assets/js/plugin/chart-circle/circles.min.js"></script>
<!-- Datatables -->
<script src="../../../app/assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Bootstrap Notify -->
<!-- <script src="../../../app/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->
<!-- jQuery Vector Maps -->
<script src="../../../app/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../../../app/assets/js/plugin/jsvectormap/world.js"></script>
<!-- Sweet Alert -->
<script src="../../../app/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<!-- Kaiadmin JS -->
<script src="../../../app/assets/js/kaiadmin.min.js"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="../../../app/assets/js/setting-demo.js"></script>
<script src="../../../app/assets/js/demo.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
    new DataTable('#example', {
        paging: false,
        scrollCollapse: true,
        scrollY: '300px'
    });
</script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.71/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.71/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#mauexport').DataTable({
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    className: 'btn btn-outline-secondary mb-3',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    className: 'btn btn-outline-info mb-3',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column
                    }
                }
            ],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            pageLength: 10
        });
    });

    function exportToExcel(tableID) {
        var exportTable = $('#' + tableID).DataTable();
        exportTable.button('.buttons-excel').trigger();
    }

    function exportToPDF(tableID) {
        var exportTable = $('#' + tableID).DataTable();
        exportTable.button('.buttons-pdf').trigger();
    }

    function exportToPrint(tableID) {
        var exportTable = $('#' + tableID).DataTable();
        exportTable.button('.buttons-print').trigger();
    }
</script>


</body>

</html>