<?php
    include "partidas.php";
    // Para formatar data, você pode utilizar
    // as funções de data e hora
    // Com ela você pode pegar, separadamente,
    // Data, Hora e dia da semana
    // consulte: https://www.php.net/manual/en/datetime.format.php
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copa do Mundo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Copa do Mundo</h1>
    <form action="tabela.php" method="post">
        <?php
            $semanas = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'];
            foreach($partidas as $partida){
                $d = new DateTime($partida['data']);
                $data = $d->format('d/m/Y');
                $hora = $d->format('H:i');
                $semana = $d->format('N');


                if ($partida['partida'] % 2 !== 0)
                    print "<h2>{$partida['rodada']}ª Rodada</h2>";

                print "<div class='partida'>
            <div class='local'><span class='bold'>{$semanas[$semana-1]} {$data}</span> {$partida['local']} <span class='bold'>{$hora}</span></div>
            <div class='placar'>
                <span>{$partida['time1']}</span>
                <input name='{$partida['partida']}[]' type='number'/>
                <span>x</span>
                <input name='{$partida['partida']}[]' type='number'/>
                <span>{$partida['time2']}</span>
            </div>
        </div>";
            }
        ?>
        
        
        <button type="submit">Enviar</button>
    </form>
</body>
</html>