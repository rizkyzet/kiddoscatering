<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/img/favicon_io/favicon.ico') ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- My Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Owl -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>owl/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>owl/owl.theme.default.min.css">

    <!-- My CSS -->
    <?php if ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '') : ?>
        <link rel="stylesheet" href="<?= base_url('assets/homepage/css/') ?>style_home.css">
    <?php else : ?>
        <link rel="stylesheet" href="<?= base_url('assets/homepage/css/') ?>style.css">
    <?php endif; ?>
    <title>Kiddos Catering</title>
</head>

<body>