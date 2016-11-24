<?php
abstract class banco {
    public $servidor = 'localhost';
    public $usuario = 'root';
    public $senha = 'j';
    public $nomebanco = 'paineladm';
    public $conexao = NULL;
    public $dataset = NULL;
    public $linhasafetadas = -1;
    
    //Metodos
    
    public function __construct() {
        $this->conecta();
    }
    
    public function __destruct() {
        if($this->conexao != NULL):
            mysqli_close($this->conexao);
        endif;
    }
    
    public function conecta(){
        $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->nomebanco)
        or die($this->trataerro(__FILE__,__FUNCTION__, mysqli_errno($this->conexao), mysqli_connect_error(),TRUE));             
        mysqli_select_db($this->conexao, $this->nomebanco)
        or die($this->trataerro(__FILE__,__FUNCTION__, mysqli_errno($this->conexao), mysqli_error($this->conexao),TRUE));       
        echo 'Conexao realizada com sucesso';
        mysqli_query($this->conexao,"SET NAMES 'utf8'");
        mysqli_query($this->conexao,"SET character set connection=utf8");
        mysqli_query($this->conexao,"SET character set client=utf8");
        mysqli_query($this->conexao,"SET character set results=utf8");
        
    }
    
    public function trataerro($arquivo=NULL, $rotina=NULL, $numero=NULL, $msgerro=NULL, $geraexcept=FALSE){
        if($arquivo==NULL) $arquivo = "nao informado";
        if($rotina==NULL) $rotina = "nao informada";
        if($numero==NULL) $numero = mysqli_errno($this->conexao);
        if($msgerro==NULL) $msgerro = mysqli_connect_error();
        
        $resultado = "Ocorreu um erro com os seguintes detalhes:<br>
                <strong>Arquivo:</strong>".$arquivo."<br>
                <strong>Rotina:</strong>".$rotina."<br>
                <strong>Codigo:</strong>".$numero."<br>
                <strong>Mensagem:</strong>".$msgerro."<br>";
               
        if($geraexcept==FALSE):
            echo($resultado);
        else:
            die($resultado);
        endif;      
        
    }
    
    
}
