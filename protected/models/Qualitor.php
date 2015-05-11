<?php

/**
 * This is the model class for table "atividades".
 *
 * The followings are the available columns in table 'atividades':
 * @property integer $id_atividade
 * @property integer $id_proposta
 * @property string $atividade
 * @property string $carga_horaria
 * @property string $data_execucao
 * @property integer $id_consultor
 */
class Qualitor extends CActiveRecord
{
	
	public $conexao = '';
	public $hash = '';
	public $client = '';

	public function __construct($ws=null){
		
		// VERIFICA SE ALGUM WS FOI PASSADO POR PARÂMETRO, CASO TENHA SIDO FAZ A CONEXÃO
		
		if(isset($ws)){
			$dadosConexao = Yii::app()->getParams()->wsQualitor;	
			$url = $dadosConexao['host']."/".$ws;
			$this->client = new SoapClient($url, array (
				'login' => $dadosConexao['username'],
				'password' => $dadosConexao['password'],
				'exceptions' => true
			));
			$this->hash = $this->client->login($dadosConexao['username'], $dadosConexao['password'], "1");
			
		}else{
			try {
				$dadosConexao = Yii::app()->getParams()->dbQualitor;	
		   		 $this->conexao = new PDO ("mssql:host={$dadosConexao['host']};dbname={$dadosConexao['dbname']}","{$dadosConexao['username']}","{$dadosConexao['password']}");
		    
		  } catch (PDOException $e) {
		    echo "Erro de Conexão " . $e->getMessage() . "\n";
		    exit;
		  }
		}


	}
	
	function __destruct(){
		if(isset($this->conexao)){
			unset ($this->conexao);
		}
		if(isset($this->hash)){
			unset ($this->hash);
		}
		if(isset($this->client)){
			unset ($this->client);
		}
	}

}
