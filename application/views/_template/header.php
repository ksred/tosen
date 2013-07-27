
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php if(isset($title)) { echo $title; } else { echo "No title"; } ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="<?= BASE_URL ?>assets/favicon.ico">

        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap-glyphicons.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/ladda-themeless.min.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tosen.css">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.js"></script>
        <script src="<?= BASE_URL ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/chart.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/spin.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/ladda.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/tosen.js"></script>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php $this->load->view('_template/nav'); ?>
        <div class="container">
