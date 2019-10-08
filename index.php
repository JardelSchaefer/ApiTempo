
<?php
        
        require 'vendor/autoload.php';
        
        use GuzzleHttp\Client;
        
        $baseUrl = "https://api.openweathermap.org";
        $appid = '55637e6222d641cb0e65d4b950b95aaa';
        $id = '3468879';
        
        $client = new Client(array('base_uri' => $baseUrl));
        $response =  $client->get('/data/2.5/weather', array(
            'query' => array('appid' => $appid, 'id' => $id)
        ));
        
        print_r($response);
        
?>

