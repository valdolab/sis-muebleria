<!-- Footer -->
</div>
<footer class="sticky-footer bg-gray">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Muebleria Compra Facil <?php echo date("Y"); ?></span>
      <br>
      <br>
      <span>Version 1.0</span>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>


<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../js/datatables.min.js" crossorigin="anonymous"></script>
<!--<script src="../js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>-->

<script src="../js/sweetalert2.all.min.js"></script>
<!--<script src="../js/jquery-ui/jquery-ui.min.js"></script>-->
<script src="../js/Chart.bundle.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/bootstrap4-toggle.min.js"></script>
<script src="../js/funciones.js"></script>

<script type="text/javascript">
  //Spanish
$(document).ready(function(){
  //$('#mensaje_success').modal('show');
    <?php
            if(!empty($modal)) {
                echo $modal;
            }
        ?>
});

</script>
<!-- Bootstrap core JavaScript
<script src="../js/jquery/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

 Core plugin JavaScript
<script src="../jquery-easing/jquery.easing.min.js"></script>
<script src="../js/all.min.js"></script>-->

</body>

</html>
<?php mysqli_close($conexion); ?>