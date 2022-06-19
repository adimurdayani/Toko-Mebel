<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy;
                <?php if (!empty($get_config)) : ?>
                    <?= $get_config['nama_web'] ?>
                <?php endif; ?>
                Created by <a href="javascript:void(0);">Adi Murdayani</a>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript:void(0);">About Us</a>
                    <a href="javascript:void(0);">Help</a>
                    <a href="<?= base_url('dashboard/contac_us') ?>">Contact Us</a>
                    <span class="ml-4"><strong>Versi 0.20</strong></span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="<?= base_url() ?>/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?= base_url() ?>/assets/js/app.min.js"></script>

</body>

</html>