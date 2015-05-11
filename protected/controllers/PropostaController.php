<?php
include('CalendarioController.php');
class PropostaController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters() {
		return array (
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array (
			array (
				'allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array (
					'index',
					'view'
				),
				'users' => array (
					'@'
				),
				
			),
			array (
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array (
					'create',
					'update',
					'GetDadosByChamado',
					'getDescricaoClientesContato',
					'getValorHoraCliente',
					'getDescricaoConsultores',
					'gerarPdfProposta'
				),
				'users' => array (
					'@'
				),
				
			),
			array (
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array (
					'admin',
					'delete'
				),
				'users' => array (
					'admin'
				),
				
			),
			array (
				'deny', // deny all users
				'users' => array (
					'*'
				),
				
			),
			
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view', array (
			'model' => $this->loadModel((int)$id),
			
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionCreate() {
		$model = new Proposta;
		
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		 
		
		if(isset($_POST['Proposta'])){
			$_POST['Proposta']['dt_envio'] = $this->ajustaData($_POST['Proposta']['dt_envio'], "/","-");
			$_POST['Proposta']['dt_validade'] = $this->ajustaData($_POST['Proposta']['dt_validade'], "/","-");
			$_POST['Proposta']['prazo_entrega'] = $this->ajustaData($_POST['Proposta']['prazo_entrega'], "/","-");
			$_POST['Proposta']['vlr_hora_cliente'] = number_format($_POST['Proposta']['vlr_hora_cliente'],2,'.',',');
			$_POST['Proposta']['vlr_desconto'] = number_format($_POST['Proposta']['vlr_desconto'],2,'.',',');
			$_POST['Proposta']['vlr_deslocamento'] = number_format($_POST['Proposta']['vlr_deslocamento'],2,'.',',');
			$_POST['Proposta']['vlr_investimento'] = str_replace(",", ".", $_POST['Proposta']['vlr_investimento']);

			$model->attributes = $_POST['Proposta'];

			if ($model->save()){
				$atividades = $_POST['Proposta']['atividades'];
				
				foreach ($atividades as $indice => $atributos){
					if($indice > 0 && $atributos['excluido'] == '0'){
						$atributos['data_execucao'] = (!empty($atributos['data_execucao']))?($this->ajustaData($atributos['data_execucao'], "/","-")):('');
						$atributos['id_proposta'] = (int)$model->id;
						$atributos['cliente'] = $model->cliente;
						$atributos['atividade'] = utf8_decode($atributos['atividade']);

						$modelAtividade = new Atividade();
						$modelAtividade->attributes = $atributos;
						if($modelAtividade->save()){
							//verifica se existe consultor e se o os campos data estão marcados para gerra o registro.
							if(($atributos['id_consultor'] > 0)&&(!empty($atributos['data_execucao'])) && (!empty($atributos['horario_inicio'])) &&(!empty($atributos['horario_termino']))){
								$calendario = new CalendarioController();
								$calendario->registraEventoCalendario($atributos);				
							}
						}
					}
										
				}
				
				echo json_encode(array('idProposta'=>(int)$model->id));
				return true;
			}
		}

		$this->render('create', array (
			'model' => $model,
			
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		 $model = $this->loadModel($id);
		if(isset($_POST['Proposta'])){
			$_POST['Proposta']['dt_envio'] = $this->ajustaData($_POST['Proposta']['dt_envio'], "/","-");
			$_POST['Proposta']['dt_validade'] = $this->ajustaData($_POST['Proposta']['dt_validade'], "/","-");
			$_POST['Proposta']['prazo_entrega'] = $this->ajustaData($_POST['Proposta']['prazo_entrega'], "/","-");
			$_POST['Proposta']['vlr_hora_cliente'] = number_format($_POST['Proposta']['vlr_hora_cliente'],2,'.',',');
			$_POST['Proposta']['vlr_desconto'] = number_format($_POST['Proposta']['vlr_desconto'],2,'.',',');
			$_POST['Proposta']['vlr_deslocamento'] = number_format($_POST['Proposta']['vlr_deslocamento'],2,'.',',');
			$_POST['Proposta']['vlr_investimento'] = str_replace(",", ".", $_POST['Proposta']['vlr_investimento']);
			$_POST['Proposta']['motivo_recusa'] = utf8_decode($_POST['Proposta']['motivo_recusa']);
			
			$model->attributes = $_POST['Proposta'];
			
			if ($model->save()){
				$atividades = $_POST['Proposta']['atividades'];
				
				foreach ($atividades as $indice => $atributos){
					if($atributos['excluido'] == 0 ){
							$atributos['data_execucao'] = (!empty($atributos['data_execucao']))?($this->ajustaData($atributos['data_execucao'], "/","-")):('');
							$atributos['id_proposta'] = (int)$model->id;
							$atributos['cliente'] = $model->cliente;
							$atributos['atividade'] = utf8_decode($atributos['atividade']);

							if(!empty($atributos['id_atividade']) && (!empty($atributos['atividade']))){
								$modelAtividade = Atividade :: model()->findByPk($atributos['id_atividade']);
								$modelAtividade->attributes = $atributos;
								
								if($modelAtividade->save()){
									//verifica se existe consultor e se o os campos data estão marcados para gerra o registro.
									if(($atributos['id_consultor'] > 0)&&(!empty($atributos['data_execucao'])) && (!empty($atributos['horario_inicio'])) &&(!empty($atributos['horario_termino']))){
										$calendario = new CalendarioController();
										$calendario->registraEventoCalendario($atributos);				
									}
								}
							}
							if(empty($atributos['id_atividade']) && (!empty($atributos['atividade']))){
								$modelAtividade = new Atividade;
								$modelAtividade->attributes = $atributos;
								if($modelAtividade->save()){
									//verifica se existe consultor e se o os campos data estão marcados para gerra o registro.
									if(($atributos['id_consultor'] > 0)&&(!empty($atributos['data_execucao'])) && (!empty($atributos['horario_inicio'])) &&(!empty($atributos['horario_termino']))){
										$calendario = new CalendarioController();
										$calendario->registraEventoCalendario($atributos);				
									}
								}
								
							}
					}else{
							if(!empty($atributos['id_atividade'])){
								$modelAtividade = Atividade :: model()->findByPk($atributos['id_atividade']);
								$modelAtividade->delete();
							}							
					}
			}
				echo json_encode(array('idProposta'=>(int)$model->id));
				return true;
			
		}
	}
			$this->render('update', array (
			'model' => $model,
			
		));
		
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset ($_GET['ajax']))
			$this->redirect(isset ($_POST['returnUrl']) ? $_POST['returnUrl'] : array (
				'admin'
			));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Proposta',array(
    'criteria'=>array(
        'order'=>'id DESC'
    )));
		

		
		$this->render('index', array (
			'dataProvider' => $dataProvider,
			
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Proposta('search');
		$model->unsetAttributes(); // clear any default values
		if (isset ($_GET['Proposta']))
			$model->attributes = $_GET['Proposta'];

		$this->render('admin', array (
			'model' => $model,
			
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Proposta the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Proposta :: model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Proposta $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ($_POST['ajax']) && $_POST['ajax'] === 'proposta-form') {
			echo CActiveForm :: validate($model);
			Yii :: app()->end();
		}
	}

	public function actionGetDadosByChamado() {

		$model = new Proposta;
		
		if ($_POST['Proposta']['chamado'] != '') {
		
			$retorno = $model->getDadosByChamado($_POST['Proposta']['chamado']);
			
			if(isset($retorno[0])){
			
			$_SESSION['cdcontato'] = $retorno[0]['cdcontato'];
			
			echo CHtml :: tag('option', array (
				'value' => $retorno[0]['cdcliente']
			), utf8_encode($retorno[0]['nmcliente']), true);
			}else{
					echo CHtml :: tag('option', array (
				'value' => 0
			), utf8_encode("Número de chamado inexistente!"), true);	
			}
		} else {
			$clientes = $model->getDescricaoClientes();

			echo CHtml :: tag('option', array (
				'value' => ''
			), 'Selecione', true);

			foreach ($clientes as $value => $name) {
				echo CHtml :: tag('option', array (
					'value' => $value
				), utf8_encode($name), true);
			}
		}

	}

	public function actiongetDescricaoClientesContato() {

		$model = new Proposta;

		if (isset($_GET['id'])) {
				$contatos = $model->getDescricaoClientesContato($_GET['id']);

				echo CHtml :: tag('option', array (
					'value' => ''
				), 'Selecione', true);

				$cdsolicitante = $_SESSION['cdcontato'];
				
				foreach ($contatos as $value => $name) {
					if($value == $cdsolicitante){
						echo CHtml :: tag('option', array ('value' => $value, 'selected'=>'selected'), utf8_encode($name), true);
					}else{
						echo CHtml :: tag('option', array ('value' => $value), utf8_encode($name), true);
					}
				}
		} else {

			$contatos = $model->getDescricaoClientesContato($_POST['Proposta']['cliente']);

			echo CHtml :: tag('option', array (
				'value' => ''
			), 'Selecione', true);

			foreach ($contatos as $value => $name) {
				echo CHtml :: tag('option', array (
					'value' => $value
				), utf8_encode($name), true);
			}
		}

	}
	
	public function actiongetValorHoraCliente(){
			$model = new Proposta;
			if (isset($_GET['id'])) {
				$valorHora = $model->getValorHoraCliente($_GET['id']);
				
				echo $valorHora;
			}
	}
	
	public function actiongetDescricaoConsultores(){
		
		$model = new Proposta;
		$consultores = $model->getDescricaoConsultores();
		echo json_encode($consultores);
		
	}
	
	public function ajustaData($data, $caracter,$divisor="/"){
		
		if(isset($data)){
			$data = explode($caracter, $data);
			$novaData = $data[2].$divisor.$data[1].$divisor.$data[0];
		}else{
			$novaData = $data;
		}
		
		return $novaData;
		
	}
	
	public function actionGerarPdfProposta($id, $tipoProposta){
		
		$dadosProposta = Proposta::model()->findbyPk($id);
		
		$Proposta = $dadosProposta->getAttributes();	
		
		
		///////// INICIO DA CRIAÇÃO DAS MACROS\\\\\\\\\\\\\\
		
		$MacrosProposta = array();
		
		$MacrosProposta = $Proposta;	
		
		// Via webservice pega todos clientes
		$clientes = Proposta::model()->getDescricaoClientes();
		
		$consultores = Proposta::model()->getDescricaoConsultores();
		
		$MacrosProposta['DescricaoCliente'] = $clientes[$Proposta['cliente']]; // Adiciona Macro de descrição do cliente
		
		$contato = Proposta::model()->getDescricaoContatobyID($Proposta['solicitante']); 
		foreach($contato as $solicitante);
		$MacrosProposta['solicitante'] = $solicitante; // Adiciona Solicitante
		$MacrosProposta['consultor_negocio'] = $dadosProposta->consultor->nome;
		$MacrosProposta['situacao'] = $dadosProposta->situacao->descricao;
		$MacrosProposta['forma_pgto'] = $dadosProposta->formapgto->forma_pgto;
		$MacrosProposta['dt_envio'] = $this->ajustaData($Proposta['dt_envio'],"-");
		$MacrosProposta['dt_validade'] = $this->ajustaData($Proposta['dt_validade'],"-");
		$MacrosProposta['prazo_entrega'] = $this->ajustaData($Proposta['prazo_entrega'],"-");
		
		$atividades = $dadosProposta->atividades;
		
		
		
		foreach($atividades as $dados){
			$MacrosProposta['Atividade'][]=$dados->getAttributes();
		}
		$MacrosProposta['valorCliente'] = (isset($dadosProposta->tabelavalor->valor))?($dadosProposta->tabelavalor->valor):(0);

		
		///////// FIM DAS MACROS \\\\\\\\\\\\\\
		
		// pega pasta RAIZ
		$caminho = explode("controllers",__FILE__);
		$pastaRaiz = $caminho[0];
	    // get the HTML
	    ob_start();
	    
	    //caminho do template
	    if($tipoProposta!= 0){
	    	include(dirname($pastaRaiz).'\templates\proposta_consultor.php');
	    }else{
	    	include(dirname($pastaRaiz).'\templates\proposta.php');
	    }
	    $content = ob_get_clean();
	    
	  

	    
	    // convert to PDF
	    try
	    {
	        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'pt', true, 'UTF-8', 3);
	        $html2pdf->pdf->SetDisplayMode('fullpage');
	        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	        $idProposta = $MacrosProposta['id']."_".substr($MacrosProposta['dt_validade'],6,10);
	        $html2pdf->Output($idProposta."_Proposta_".$MacrosProposta['DescricaoCliente'].".pdf");
	    }
	    catch(HTML2PDF_exception $e) {
	        echo $e;
	        exit;
	    }
 
        ////////////////////////////////////////////////////////////////////////////////////
 
       /* # Example from HTML2PDF wiki: Send PDF by email
        $content_PDF = $html2pdf->Output('', EYiiPdf::OUTPUT_TO_STRING);
        require_once(dirname(__FILE__).'/pjmail/pjmail.class.php');
        $mail = new PJmail();
        $mail->setAllFrom('webmaster@my_site.net', "My personal site");
        $mail->addrecipient('mail_user@my_site.net');
        $mail->addsubject("Example sending PDF");
        $mail->text = "This is an example of sending a PDF file";
        $mail->addbinattachement("my_document.pdf", $content_PDF);
        $res = $mail->sendmail();
			*/
		
				

	}
}