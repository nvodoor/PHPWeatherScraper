<?php

//    $error = "This city does not exist."

    $weather = "";

    $where = file_get_contents("http://www.weather-forecast.com/locations/".$_POST['city']."/forecasts/latest/");
    
// code help from https://gist.github.com/anchetaWern/6150297. Made some adjustments to get it to work for me.
    $weather_doc = new DOMDocument();

    libxml_use_internal_errors(TRUE);

    if (!empty($where)) {
        
        $weather_doc->loadHTML($where);
        
        libxml_clear_errors();
        
        $weather_xpath = new DOMXPath($weather_doc);
        
        $weather_row = $weather_xpath->query('//p[@class]');
        
        $count = 0;
        
        $loc = array();
        
        if ($weather_row->length > 0) {
            foreach($weather_row as $row) {
                $loc[] = $row->nodeValue;
            }
        }
    }
    
    if ($_POST['city']) {
        $weather = '<div class="alert alert-success" role="alert">'.$loc[2].'</div>'; 
    };
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <style type="text/css">
        
        body {
            background-image: url("coolimage.jpg");
        }
        
        .container {
            text-align: center;
            margin-top: 5%;
        }
        
        #city {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .col-md-6 {
            margin-left: 25%;
        }
      
        #Submit {
            margin-bottom: 50px;
        }
      
    </style>
  </head>
  <body>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
          
      
    <div class="container">
      
        <h1>What's The Weather?</h1>
        <p>Enter the name of a city.</p>
        
        <form method="POST">
            <div class="col-md-6">
                <input class="form-control" type="text"  id="city" name="city">
                <button type="submit" id="Submit" class="btn btn-primary">Submit</button>
                <div id="weather"><? echo $weather ?></div>
            </div>
        </form> 
        
        
          
    </div>
          
    <script type="text/javascript">
          
          
    </script>
          
  </body>
</html>

<!--- www.weather-forecast.com/locations/ is where we need to go to get the weather information for our site.

    Goals:

    Bootstrap Site with a Header. (Done)
    Small paragraph text. (Done)
    Text Window. (Done)
    Submit button. (Done)
    Show weather information from specific part of site. (Done)

   Complete. 


--> 