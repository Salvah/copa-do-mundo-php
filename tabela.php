<?php
 include "partidas.php";

 for ($i = 0; $i < count($partidas); $i++){
     $partidas[$i]['placar1'] = $_POST[$partidas[$i]['partida']][0];
     $partidas[$i]['placar2'] = $_POST[$partidas[$i]['partida']][1];
 }





 $times = [
     ['nome' => 'Catar'],
     ['nome' => 'Equador'],
     ['nome' => 'Holanda'],
     ['nome' => 'Senegal'],
 ];
 
 echo "<pre>";
var_dump($times);
 foreach($times as $k => $time) {
    $times[$k]['v'] = 0;
    $times[$k]['e'] = 0;
    $times[$k]['d'] = 0;
    $times[$k]['gp'] = 0;
    $times[$k]['gc'] = 0;


    foreach($partidas as $p){
         if (in_array($time['nome'], [$p['time1'], $p['time2']])){
            if ($p['time1'] === $time['nome']){
                $times[$k]['gp'] += $p['placar1'];
                $times[$k]['gc'] += $p['placar2'];
                if($p['placar1'] > $p['placar2']) $times[$k]['v']++;
                else if($p['placar1'] === $p['placar2']) $times[$k]['e']++;
                else $times[$k]['d']++;
            }else {
                $times[$k]['gp'] += $p['placar2'];
                $times[$k]['gc'] += $p['placar1'];
                if($p['placar2'] > $p['placar1']) $times[$k]['v']++;
                else if($p['placar2'] === $p['placar1']) $times[$k]['e']++;
                else $times[$k]['d']++;
            }
         }
     }
     $times[$k]['p'] = $times[$k]['v']*3+$times[$k]['e'];
     $times[$k]['j'] = $times[$k]['v'] +$times[$k]['e'] +$times[$k]['d'];
     $times[$k]['s'] = $times[$k]['gp'] - $times[$k]['gc'];
     $times[$k]['ap'] = number_format($times[$k]['p'] * 100 / ($times[$k]['j'] * 3), 0);
 }
 var_dump($times);
 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificação</title>
    <link rel="stylesheet" href="tabela.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Seleção</th>
                <th>P</th>
                <th>J</th>
                <th>V</th>
                <th>E</th>
                <th>D</th>
                <th>GP</th>
                <th>GC</th>
                <th>S</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            <?php

            function ordem ($a, $b){
                
                return $a['p'] > $b['p'] 
                    ? -1 
                    : ($a['s'] > $b['s'] ? -1 :
                    ($a['gp'] > $b['gc'] ? -1 :
                    1));
            }

            uasort($times, "ordem");
            foreach($times as $time){
                
                print "<tr>
                <td>{$time['nome']}</td>
                <td>{$time['p']}</td>
                <td>{$time['j']}</td>
                <td>{$time['v']}</td>
                <td>{$time['e']}</td>
                <td>{$time['d']}</td>
                <td>{$time['gp']}</td>
                <td>{$time['gc']}</td>
                <td>{$time['s']}</td>
                <td>{$time['ap']}</td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>