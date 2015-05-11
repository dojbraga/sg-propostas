<?php
$url = Yii::import('application.vendors.*');
$url = str_replace("vendors","vendor", $url);
require_once($url.'\\googlecalendarwrap\\GoogleCalendarWrapper.php');

class CalendarioController extends Controller
{
	
	public function __construct(){
		
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	
	public function registraEventoCalendario($dados){
	
		
			$modelProposta = new Proposta();
			$dadosConsultor = $modelProposta->getDadosConsultorByiD($dados['id_consultor']);
			
			// Carrega configurações de email
			$dadosConexao = Yii::app()->getParams()->emailAgendas;	
			
			$gc = new GoogleCalendarWrapper($dadosConexao['email'], $dadosConexao['password']);
			
			$mail = $dadosConsultor->email;
			$mail = str_replace("@","%40",$mail);

			$gc->feed_url = "http://www.google.com/calendar/feeds/$mail/public/basic";
			
			$model = Cliente :: model()->findByPk($dados['cliente']);
			
			$s = array();
			$s["title"] = utf8_encode("Pré-Reserva ".$dados['atividade']);
			$s["content"] = utf8_encode($dados['atividade']);
			$s["where"] = utf8_encode($model->cliente);
			$s["startDay"] = date("Y-m-d", strtotime($dados['data_execucao']));
			$s["startTime"] = date('H:i:s', strtotime("+3 hours",strtotime($dados['horario_inicio'])));
			$s["endDay"] = date("Y-m-d", strtotime($dados['data_execucao']));
			$s["endTime"] = date('H:i:s', strtotime("+3 hours",strtotime($dados['horario_termino'])));
			
		if($gc->add_event($s)){
		 // echo "event '".$s["title"]."' Agenda Registrada(s) para o(s) Consultor(es)";
		 $retorno = true;
		}
		
		$retorno = true;
		
		return $retorno;
	}
	
}