<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/all.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="wrapper">
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.html">La POS</a></h1>         
               </div>
             <div class=" border-bottom">
            <div class="full-left">
              <section class="full-top">
                <button id="toggle"><i class="fa fa-arrows-alt"></i></button>   
            </section>
            <form class=" navbar-left-right">
              <input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
              <input type="submit" value="" class="fa fa-search">
            </form>
            <div class="clearfix"> </div>
           </div>
            @include('layouts.navbar')
            <div class="clearfix"></div>
      
            @include('layouts.sidebar')
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
        <!--banner-->   
            <div class="banner">
           
                <h2>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>{{$title}}</span>
                </h2>
            </div>
        <!--//banner-->
        
        <!--content-->
        <div class="content-top">
        @yield('content')
                      
            <div class="clearfix"> </div>
        </div>
        
        <div class="content-mid">
            <div class="clearfix"></div>
        </div>
        <!--//content-->
        
     
        <!---->
        <div class="copy">
            <p> &copy; 2016 Minimal. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
        </div>
        <div class="clearfix"> </div>
       </div>
     </div>
<!---->

        
<!-- Scripts -->
<script src="/js/all.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/scripts.js"></script>
@stack('javascript')
</body>
</html>
