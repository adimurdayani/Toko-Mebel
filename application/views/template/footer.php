<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy;
                <?php if (!empty($get_config)) : ?>
                    <?= $get_config->nama_web ?>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript:void(0);">About Us</a>
                    <a href="javascript:void(0);">Help</a>
                    <a href="javascript:void(0);">Contact Us</a>
                    <a href="javascript:void(0);"><strong>Versi 0.1</strong></a>
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
<script src="<?= base_url('assets/') ?>/js/vendor.min.js"></script>

<!-- third party js -->
<script src="<?= base_url('assets/') ?>/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/') ?>/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url('assets/') ?>libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Summernote js -->
<script src="<?= base_url('assets/') ?>libs/summernote/summernote-bs4.min.js"></script>

<!-- Tippy js-->
<script src="<?= base_url('assets/') ?>libs/tippy.js/tippy.all.min.js"></script>

<!-- Plugins js -->
<script src="<?= base_url('assets/') ?>libs/dropzone/min/dropzone.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/select2/js/select2.min.js"></script>

<!-- Magnific Popup-->
<script src="<?= base_url('assets/') ?>libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- Gallery Init-->
<script src="<?= base_url('assets/') ?>js/pages/gallery.init.js"></script>
<!-- App js -->
<script src="<?= base_url('assets/') ?>js/app.min.js"></script>

<script>
    $('.select3').select2();
</script>

<script>
    // datepicker
    $('[data-toggle="select2"]').select2(), $('[data-select2-id="satuan"]').select2(), $('[data-toggle="flatpicker"]').flatpickr({
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d"
    });
    // file upload
    $('.input1').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // error
    <?= $this->session->flashdata('error'); ?>
    // sukses
    <?= $this->session->flashdata('success'); ?>
    // delete
    $('.hapus').on('click', function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda ingin menghapus data ini!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Iya, hapus!",
            cancelButtonText: "Tidak, Tutup!",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ml-2 mt-2",
            buttonsStyling: !1
        }).
        then(function(t) {
            t.value ? Swal.fire({
                document: location.href = href,
                title: "Dihapus!",
                text: "File anda telah di hapus.",
                type: "success"
            }) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                title: "Batal",
                text: "File anda tidak terhapus.",
                type: "error"
            })
        })
    })

    //delete-all
    $("#hapus").hide();
    $(document).ready(function() {

        $("#chack-all").click(function() {
            if ($(this).is(":checked")) {
                $(".check-item").prop("checked", true);
                $("#hapus").show();
            } else {
                $(".check-item").prop("checked", false);
                $("#hapus").hide();
            }
        });

        $("#hapus").click(function(e) {
            e.preventDefault();
            const confirm = $("#form-delete");

            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Anda ingin menghapus data ini!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, hapus!",
                cancelButtonText: "Tidak, Tutup!",
                confirmButtonClass: "btn btn-danger mt-2",
                cancelButtonClass: "btn btn-secondary ml-2 mt-2",
                buttonsStyling: !1
            }).
            then(function(t) {
                t.value ? Swal.fire({
                    document: confirm.submit(),
                    title: "Dihapus!",
                    text: "File anda telah di hapus.",
                    type: "success"
                }) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                    title: "Batal",
                    text: "File anda tidak terhapus.",
                    type: "error"
                })
            })
        });
    });

    $(document).ready(function() {
        $("#basic-datatable").DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });
        $('#content').summernote({
            height: 230,
            styleWithSpan: false,
            placeholder: "Tulis sesuatu...",
            callbacks: {
                onInit: function(e) {
                    n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")
                }
            }
        });

    });

    $('.ubahakses').on('click', function() {
        const menuId = $(this).data('menuid');
        const userId = $(this).data('userid');

        $.ajax({
            url: "<?= base_url('grup/akses/ubahakses') ?>",
            type: 'post',
            data: {
                menuId: menuId,
                userId: userId
            },
            success: function() {
                document.location.href = "<?= base_url('grup/akses/get_akses/') ?>" + btoa(userId);
            }
        })
    })

    $('.ubahKategori').on('click', function() {
        const kategoriid = $(this).data('kategoriid');
        const statuskategori = $(this).data('statuskategori');

        $.ajax({
            url: "<?= base_url('master/kategori/ubahaktif') ?>",
            type: 'post',
            data: {
                kategoriid: kategoriid,
                statuskategori: statuskategori
            },
            success: function() {
                document.location.href = "<?= base_url('master/kategori/') ?>";
            }
        })
    })

    $('.ubahsatuan').on('click', function() {
        const satuanid = $(this).data('satuanid');
        const statussatuan = $(this).data('statussatuan');

        $.ajax({
            url: "<?= base_url('master/satuan/ubahaktif') ?>",
            type: 'post',
            data: {
                satuanid: satuanid,
                statussatuan: statussatuan
            },
            success: function() {
                document.location.href = "<?= base_url('master/satuan/') ?>";
            }
        })
    })

    $('.ubahsuplier').on('click', function() {
        const suplierid = $(this).data('suplierid');
        const suplierstatus = $(this).data('suplierstatus');

        $.ajax({
            url: "<?= base_url('pembelian/suplier/ubahsuplier') ?>",
            type: 'post',
            data: {
                suplierid: suplierid,
                suplierstatus: suplierstatus
            },
            success: function() {
                document.location.href = "<?= base_url('pembelian/suplier') ?>";
            }
        })
    })

    $('.ubahstatususer').on('click', function() {
        const userid = $(this).data('userid');
        const useractive = $(this).data('useractive');

        $.ajax({
            url: "<?= base_url('user/ubahuseractive') ?>",
            type: 'post',
            data: {
                userid: userid,
                useractive: useractive
            },
            success: function() {
                document.location.href = "<?= base_url('user') ?>";
            }
        })
    })
</script>

</body>

</html>