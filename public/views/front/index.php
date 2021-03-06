<!DOCTYPE html>
<html lang="en" data-ng-app="app">
<head>
    <meta charset="utf-8"/>
    <title translate="aside.nav.TITLE"></title>
    <meta name="description" content=""/>
    <link rel="icon" type="image/x-icon" href="#" alt=".">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="../../css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../../css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="../../css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="../../css/font.css" type="text/css"/>
    <link rel="stylesheet" href="../../css/app.css" type="text/css"/>
    <link rel="stylesheet" href="../../css/ngprogress-lite.css" type="text/css"/>
</head>
<body ng-controller="AppCtrl" data-csrf="<?php echo csrf_token(); ?>">
<div class="app" id="app"
     ng-class="{'app-header-fixed':app.settings.headerFixed, 'app-aside-fixed':app.settings.asideFixed, 'app-aside-folded':app.settings.asideFolded}"
     ui-view></div>
<!-- jQuery -->
<script src="../../vendor/jquery/jquery.min.js"></script>

<!-- Angular -->
<script src="../../vendor/angular/angular.js"></script>

<script src="../../vendor/angular/angular-animate/angular-animate.js"></script>
<script src="../../vendor/angular/angular-cookies/angular-cookies.js"></script>
<script src="../../vendor/angular/angular-resource/angular-resource.js"></script>
<script src="../../vendor/angular/angular-sanitize/angular-sanitize.js"></script>
<script src="../../vendor/angular/angular-touch/angular-touch.js"></script>
<!-- Vendor -->
<script src="../../vendor/angular/angular-ui-router/angular-ui-router.js"></script>
<script src="../../vendor/angular/ngstorage/ngStorage.js"></script>
<script src="../../vendor/angular/angular-ui-utils/ui-utils.js"></script>

<!-- bootstrap -->
<script src="../../vendor/angular/angular-bootstrap/ui-bootstrap-tpls.js"></script>
<!-- lazyload -->
<script src="../../vendor/angular/oclazyload/ocLazyLoad.js"></script>
<!-- translate -->
<script src="../../vendor/angular/angular-translate/angular-translate.js"></script>
<script src="../../vendor/angular/angular-translate/loader-static-files.js"></script>
<script src="../../vendor/angular/angular-translate/storage-cookie.js"></script>
<script src="../../vendor/angular/angular-translate/storage-local.js"></script>

<!-- App -->
<script src="../../js/front/app.js"></script>
<script src="../../js/front/config.js"></script>
<script src="../../js/front/config.lazyload.js"></script>
<script src="../../js/front/config.router.js"></script>
<script src="../../js/front/main.js"></script>
<script src="../../js/modules/ngprogress-lite.js"></script>
<script src="../../js/services/ui-load.js"></script>
<script src="../../js/filters/fromNow.js"></script>
<script src="../../js/directives/setnganimate.js"></script>
<script src="../../js/directives/ui-butterbar.js"></script>
<script src="../../js/directives/ui-focus.js"></script>
<script src="../../js/directives/ui-fullscreen.js"></script>
<script src="../../js/directives/ui-jq.js"></script>
<script src="../../js/directives/ui-module.js"></script>
<script src="../../js/directives/ui-nav.js"></script>
<script src="../../js/directives/ui-scroll.js"></script>
<script src="../../js/directives/ui-shift.js"></script>
<script src="../../js/directives/ui-toggleclass.js"></script>
<script src="../../js/directives/ui-verifypassword.js"></script>
<script src="../../js/directives/ui-numberformat.js"></script>
<script src="../../js/controllers/bootstrap.js"></script>
<script src="../../js/libs/lz-string.js"></script>
</body>
</html>