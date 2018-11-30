<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProjectMan</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
   
    <style type="text/css">
      .is-full-width {
        width: 100%;
      }
      section {
        padding-top: 48px;
        padding-bottom: 48px;
      }
      label{
        font-size: 20px;
      }
      .badge
      {
        background-color: #e41818 !important;
      }
      .blockedText
      {
        color: red !important;
      }


    </style>

    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ URL::to('css/app2.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<!-- Before it is commented -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--    -->
  </head>
  <body>
    <div>
        <br>
        @yield('content')
    </div>
  </body>
</html>