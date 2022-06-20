<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>L O M B U | <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CV. Lombu Cipta Perkasa, Desa Tettekang Kec. Bajo Barat Kab. Luwu Sulawesi Selatan" name="description" />
    <meta content="Adi Murdayani" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <?php if (!empty($get_config)) : ?>
        <link rel="shortcut icon" href="<?= base_url('assets/images/upload/') . $get_config['icon_web'] ?>">
    <?php endif; ?>

    <!-- App css -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= base_url() ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="<?= base_url() ?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
    <link href="<?= base_url() ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">