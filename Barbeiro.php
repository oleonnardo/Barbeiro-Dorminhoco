<?php

class Barbeiro{

    private $cadeiraDeEspera = 0; // DEFINE QTAS PESSOAS PODEM ESPERAR O ATENDIMENTO
    public $cadeiraOcupada = false; // true = OCUPADA, false = LIVRE
    public $clientes = array(); // NUMERO ALEATORIO DE CLIENTES.
    public $barbeiroDorme = false; // true = DORME, false - ATENDE
    private $nomeBarbeiro; // NOME DO BARBEIRO
    private $cliNovos = 0; // GERA Nº MAXIMO DE CLIENTES
    public $nClientes = 0; // TOTAL DE CLIENTES
    private $horasTrabalhadas = 0; // CONTROLE DO WHILE

    // METODO CONSTRUTOR DA CLASSE, RECEBE OS PARAMENTOS PARA INICIALIZAR O BARBEIRO
    public function __construct( $nomeBarbeiro, $cadeiraDeEspera, $cliNovos, $horasTrabalhadas ){
        $this->cliNovos = $cliNovos;
        $this->nomeBarbeiro = $nomeBarbeiro;
        $this->cadeiraDeEspera = $cadeiraDeEspera;
        $this->horasTrabalhadas = $horasTrabalhadas;

        echo 'O Barbeiro ' . $this->nomeBarbeiro . ' chegou no salão.';
    }


    // FUNÇÃO PARA CRIAR OS CLIENTES ALEATORIAMENTE 
    protected function clientes(){
        $r = rand( 0, $this->cliNovos ); // GERA UM NUMERO ALEATORIO DE CLIENTES
        // echo $r . ' novos clientes.';
        $this->nClientes = $r; // NUMERO DE CLIENTES DEFINIDO.

        // PREENCHE O ARRAY COM O NÚMERO DE CLIENTES.
        $i=1;
        while( $r > 0 ){
            $this->clientes[] = $i;
            $r--; $i++;
        }
    }

    // MÉTODO QUE SE NÃO HÁ CLIENTES O BARBEIRO ESPERA.
    protected function BarbeiroDorme(){
        echo 'Não existe(m) cliente(s) no salão do Barbeiro ' . $this->nomeBarbeiro . '.<br>';
        echo 'O Barbeiro ' . $this->nomeBarbeiro . ' está esperando a chegada de clientes.<br>';
        echo '...<br>';
        sleep(1); // PAUSA A EXECUCAO
        
        echo 'A cadeira do barbeiro ' . $this->nomeBarbeiro . ' está livre.<br>';
        $this->clientes();
    }

    
    protected function BarbeiroAtende(){
        
        if( $this->nClientes != 0 ){
            // EXISTE MAIS DE UM CLIENTE
            if( $this->nClientes > 1 && $this->cadeiraOcupada == false){
                //SE TEM MAIS DE UM CLIENTE E A CADEIRA NÃO ESTÁ OCUPADA
                echo 'Entrou(Entraram) ' . $this->nClientes . ' cliente(s) no salão.<br>';
                $this->cadeiraOcupada == true;
            }else{
                // SE TEM MAIS DE UM CLIENTE E TEM CADEIRA OCUPADAS, TEM CLIENTES ESPERANDO
                echo 'Existe(m) ' . $this->nClientes . ' cliente(s) esperando atendimento, Barbeiro ' . $this->nomeBarbeiro .'.<br>';
                $this->cadeiraOcupada = false;
            }

            // SE HÁ CLIENTES, 1 JÁ PODE SER ATENDIDO.
            echo 'Um cliente ocupou a cadeira do barbeiro ' . $this->nomeBarbeiro . '<br>';
            $this->nClientes--; // UM CLIENTE FOI ATENDIDO
            echo  'Um cliente está sendo atendido pelo Barbeiro ' . $this->nomeBarbeiro . '<br>';
            echo $this->nClientes . ' cliente(s) está(estão) esperando.<br>';
            
            echo '...<br>';
            sleep(1); // PAUSA A EXECUCAO

            echo 'Qtde de cadeiras : ' . $this->cadeiraDeEspera . '<br>'; 
            // SE O NUMEMO DE CLIENTES PE MAIOR QUE O NUMERO DE CADEIRAS DE ESPERA
            if( $this->nClientes > $this->cadeiraDeEspera ){
                // VERIFICA QUANTOS CLIENTES VÃO EMBORA
                $cli = $this->nClientes - $this->cadeiraDeEspera;
                // QUANDOS CLIENTES ESPERAM
                $this->nClientes = $cli;
                $r = $this->nClientes;

                // ATUALIZA O TOTAL DE CLIENES 
                $j=0;
                while( $r > 0 ){
                    $this->clientes[$j] = $j+1;
                    $r--; $j++;
                }

                // MOSTRA QUANTOS CLIENTES FORAM EMBORA. 
                echo '1 cliente(s) foi(foram) embora.<br>';
                // MOSTRA QUANTOS CLIENTES FICARAM.
                
                echo 'Um cliente ocupou a cadeira do barbeiro ' . $this->nomeBarbeiro . '<br>';
                echo  'Um cliente está sendo atendido pelo Barbeiro ' . $this->nomeBarbeiro . '<br>';
                
                echo $this->nClientes . ' cliente(s) está(estão) esperando.<br>';
            }

            //MOSTRA QUAL CLIENTE O BARBEIRO JÁ ATENDEU
            echo 'Um cliente já foi atendido pelo Barbeiro ' . $this->nomeBarbeiro . '<br>';

        }else if( $this->nClientes == 1 ){
            // EXISTE SOMENTE UM CLIENTE
            echo 'A cadeira do Barbeiro ' . $this->nomeBarbeiro . ' está ocupada, não existe clientes esperando.<br>';
            
            echo '...<br>';
            sleep(1); // PAUSA A EXECUCAO

            $this->nClientes--; // UM CLIENTE FOI ATENDIDO
            echo 'Um cliente já foi atendido pelo Barbeiro ' . $this->nomeBarbeiro . '.<br>';


        }else{
            // NÃO EXISTEM CLIENTES - BARBEIRO LIVRE
            echo ' A cadeira do Barbeiro ' . $this->nomeBarbeiro . ' está livre.<br>';
            // LIBERA A CADEIRA DE ESPERA
            $this->cadeiraOcupada = false;
        }

    }

    // FUNÇÃO DE EXECUCAO DA CLASS
    public function run(){
        while ($this->horasTrabalhadas > 0) { //FICA VERIFICANDO TODO O TEMPO
            // echo $this->nClientes.'.<br>' ;
            if( $this->nClientes <= 0 ){
                    //O BARBEIRO ESPERA
                $this->BarbeiroDorme();
                echo '<hr>';
            }else{ 
                //O BARBEIRO ATENDE SE TEM CLIENTE
                $this->BarbeiroAtende();
                echo '<hr>';
            }

            $this->horasTrabalhadas--;
        }

        echo 'O Barbeiro ' . $this->nomeBarbeiro . ' terminou o seu expediente.';
    }


}