<?php

require_once('Barbeiro.php');
// BARBEIRO, QTDE DE CADEIRAS, N MAXIMO DE CLIENTES, HORAS DE EXPEDIENTE
$barbeiro = new Barbeiro( 'Leonardo', 1, 5, 20);
echo '<br>';

$barbeiro->run();

