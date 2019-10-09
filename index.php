
<?php
        
        require 'vendor/autoload.php';
        
        use GuzzleHttp\Client;
        
        $baseUrl = "http://api.openweathermap.org";
        $appid = '55637e6222d641cb0e65d4b950b95aaa';
        $id = '3468879';
        
        //Recupera dados de criação
        
        $dataCriacao = file_get_contents('cache/validade_tempo.txt');
        
        if(time() - $dataCriacao >= 300){
   
    try{
        $client = new Client(array('base_uri' => $baseUrl));
        $response = $client->get('/data/2.5/weather', array(
            'query' => array('appid' => $appid, 'id' => $id)
        ));
        
        
        $tempo = json_decode($response->getBody());
        $dadosSerializados = serialize($tempo);
        file_put_contents('cache/dados_tempo.txt', $dadosSerializados);
        file_put_contents('cache/validade_tempo.txt', time());
         
    } catch (ClientException $e){
             
             echo"Erro: ", $e;
         }
         
        } else {
            
            $dadosSerializados = file_get_contents('cache/dados_tempo.txt');
            $tempo = unserialize($dadosSerializados);
    }
        $far = $tempo->main->temp;
        $pressaoAtual = $tempo->main->pressure;
        $humidadeAtual = $tempo->main->humidity;
        $temperaturaMinimaFallen= $tempo->main->temp_min;
        $temperaturaMinimaCelso= $tempo->main->temp_min-273;
        $temperaturaMaximaFallen = $tempo->main->temp_max;
        $temperaturaMaximaCelso = $tempo->main->temp_max-273;
        $celso =  ($far - 32) / 1.8;
    
        echo "Fallen: ", $far;
        echo "<br>";
        echo "Celso: " , $celso;
        echo "<br>";
        echo "Pressão atual: " , $pressaoAtual;
        echo "<br>";
        echo "Humidade atual: " , $humidadeAtual;
        echo "<br>";
        echo "Temperatura Mínima: " . $temperaturaMinimaFallen;
        echo "<br>";
        echo "Temperatura Mínima Celso: " . $temperaturaMinimaCelso;
        echo "<br>";
        echo "Temperatura Máxima: " . $temperaturaMaximaFallen;
        echo "<br>";
        echo "Temperatura Mínima Celso: " . $temperaturaMinimaCelso;
?>

