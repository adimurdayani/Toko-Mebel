<?php $get_config = $this->db->get('tb_konfigurasi')->row(); ?>
<footer class="footer footer-alt">
    <script>
        document.write(new Date().getFullYear())
    </script> &copy; <?= $get_config->nama_web; ?>.
</footer>

<!-- Vendor js -->
<script src="<?= base_url('assets/'); ?>/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?= base_url('assets/'); ?>/js/app.min.js"></script>

</body>

</html>