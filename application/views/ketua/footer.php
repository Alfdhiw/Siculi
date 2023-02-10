<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; SICULI Pengadilan Negeri Semarang</span>
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
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih Tombol "Logout" dibawah ini jika kamu ingin keluar akun</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('login/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/admin/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/admin/bootstrap/js/bootstrap.bundle.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/vendor/admin/jquery-easing/jquery.easing.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/admin/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>js/admin/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/admin/datatables/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/admin/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/js/admin/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>assets/js/admin/demo/chart-pie-demo.js"></script>

<script>
    $(document).ready(function() {
        $('.dataproses').DataTable({
            "pageLength": 5,
            order: [
                [0, '']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataprosesatas').DataTable({
            "pageLength": 5,
            order: [
                [0, '']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataprosesijin').DataTable({
            "pageLength": 5,
            order: [
                [0, '']
            ]
        });
    });
    $(document).ready(function() {
        $('.datapegawai').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datacuti').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datacutiatasan').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datapersetujuan').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datasetujuatas').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datakar').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.dataatasan').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datadepart').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.datajabat').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
    $(document).ready(function() {
        $('.dataijin').DataTable({
            "pageLength": 20,
            order: [
                [0, ]
            ]
        });
    });
</script>

<script>
    function sisa_cuti() {
        var fname = document.getElementById('form1').status.value;

        var p_sisax = document.getElementById("sisax");

        var p_sisay = document.getElementById("sisay");

        var p_cuti = document.getElementById("cuti");

        var p_masuk = document.getElementById("masuk");

        var p_profily = document.getElementById("status_profily");

        var p_profil = document.getElementById("status_profil");

        if (fname == "Disetujui") {
            p_sisax.disabled = false;
            p_sisay.disabled = true;
            p_cuti.readOnly = true;
            p_masuk.readOnly = true;
            p_profil.disabled = true;
            p_profily.disabled = false;
        } else if (fname == "Ditolak") {
            p_sisax.disabled = true;
            p_sisay.disabled = false;
            p_cuti.readOnly = true;
            p_masuk.readOnly = true;
            p_profil.disabled = false;
            p_profily.disabled = true;
        } else if (fname == "Ditangguhkan") {
            p_sisax.disabled = false;
            p_sisay.disabled = true;
            p_cuti.readOnly = false;
            p_masuk.readOnly = false;
            p_profil.disabled = true;
            p_profily.disabled = false;
        }
    }
    document.getElementById('status').addEventListener('change', sisa_cuti);
</script>

<script>
    function sisa_cutix() {
        var fname = document.getElementById('form4').statusx.value;

        var p_sisax = document.getElementById("sisaxx");

        var p_sisay = document.getElementById("sisayx");

        var p_cuti = document.getElementById("cutix");

        var p_masuk = document.getElementById("masukx");

        var p_profilyx = document.getElementById("profily");

        var p_profilx = document.getElementById("profilx");

        if (fname == "Disetujui") {
            p_sisax.disabled = false;
            p_sisay.disabled = true;
            p_cuti.readOnly = true;
            p_masuk.readOnly = true;
            p_profilx.disabled = true;
            p_profilyx.disabled = false;
        } else if (fname == "Ditolak") {
            p_sisax.disabled = true;
            p_sisay.disabled = false;
            p_cuti.readOnly = true;
            p_masuk.readOnly = true;
            p_profilx.disabled = false;
            p_profilyx.disabled = true;
        } else if (fname == "Ditangguhkan") {
            p_sisax.disabled = false;
            p_sisay.disabled = true;
            p_cuti.readOnly = false;
            p_masuk.readOnly = false;
            p_profilx.disabled = true;
            p_profilyx.disabled = false;
        }
    }
    document.getElementById('statusx').addEventListener('change', sisa_cutix);
</script>

<script>
    function myFunction() {
        document.getElementById("tes1").submit();
    }
</script>

<script>
    function myFunctionAtasan() {
        document.getElementById("tes3").submit();
    }
</script>

<script>
    function myFunctionx() {
        document.getElementById("tes2").submit();
    }
</script>

<script>
    function myFunctiony() {
        document.getElementById("tes7").submit();
    }
</script>

</body>

</html>