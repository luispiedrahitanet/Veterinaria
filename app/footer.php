<?php
if (!isset($_SESSION["usu_id"])) {
    header('Location: ../login.php');
}
?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>MESSAVET 2021 &copy. Página creada por Innovate Software SENA</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Está seguro de salir de la session?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="bin/Salir.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    <script src="view/public/vendor/jquery/jquery.min.js"></script>
    <script src="view/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->


    <!-- Core plugin JavaScript-->
    <script src="view/public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="view/public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="view/public/vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="view/public/js/demo/chart-area-demo.js"></script>
    <script src="view/public/js/demo/chart-pie-demo.js"></script> -->

    <!-- Page level plugins -->
    <script src="view/public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="view/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="view/public/vendor/datatables/dataTables.select.min.js"></script>
    <!-- <script src="view/public/gijgo/gijgo.min.js"></script>
    <script src="view/public/gijgo/messages.es-es.js"></script> -->

    <!-- <script src="view/public/js/scripts.js"></script> -->


</body>

</html>
