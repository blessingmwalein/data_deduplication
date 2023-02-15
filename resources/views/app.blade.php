<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&amp;display=swap" rel="stylesheet">


    <!-- App css -->
    <link rel="stylesheet" href="/assets/css/app.min.css" type="text/css">


    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia

    <script src="/assets/vendors/bundle.js"></script>
    <!-- <script src="../../../../../cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
    <script src="../../../../../cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script> -->

    <!-- Apex chart -->
    <!-- <script src="../../../../../apexcharts.com/samples/assets/irregular-data-series.js"></script> -->
    <script src="/assets/vendors/charts/apex/apexcharts.min.js"></script>

    <!-- Dashboard scripts -->
    <script src="/assets/js/examples/pages/file-dashboard.js"></script>

    <!-- App scripts -->
    <script src="/assets/js/app.min.js"></script>

    <script src="/assets/vendors/jstree/jstree.min.js"></script>

    <!-- Files page examples -->
    <script src="/assets/js/examples/files.js"></script>
</body>

</html>