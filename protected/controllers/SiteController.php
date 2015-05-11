<?php

class SiteController extends Controller
{

	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	
	 public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('index'),
                'users'=>array('?'),
            )
        );
    }
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	public function actiongetGrafico(){
		
		$propostas = Proposta::model()->findAll(array('order'=>'id DESC'));
		
		$arrDados = array();
		$arrConsultor = array();
		$arrPropostaDia = array();
		$arrConsultorStatus = array();
		
		
		foreach ($propostas as $i => $dados){
			
			$arrConsultor[$dados->consultor->id]['nome'] = $dados->consultor->nome;
			if(!isset($arrConsultor[$dados->consultor->id]['total'])){
				$arrConsultor[$dados->consultor->id]['total']=1;
			}else{
				$arrConsultor[$dados->consultor->id]['total']++;
			}
			
			$arrConsultorStatus[$dados->consultor->id]['nome'] = $dados->consultor->nome;
			
			switch ($dados->id_situacao) {
    		case 1:
				if(!isset($arrConsultorStatus[$dados->consultor->id]['Aguardando'])){
					$arrConsultorStatus[$dados->consultor->id]['Aguardando']=1;
				}else{
					$arrConsultorStatus[$dados->consultor->id]['Aguardando']++;
				}
			break;
			case 2:
				if(!isset($arrConsultorStatus[$dados->consultor->id]['Aprovada'])){
					$arrConsultorStatus[$dados->consultor->id]['Aprovada']=1;
				}else{
					$arrConsultorStatus[$dados->consultor->id]['Aprovada']++;
				}
			break;
			case 3:
				if(!isset($arrConsultorStatus[$dados->consultor->id]['Cancelada'])){
					$arrConsultorStatus[$dados->consultor->id]['Cancelada']=1;
				}else{
					$arrConsultorStatus[$dados->consultor->id]['Cancelada']++;
				}
			break;
			case 4:
				if(!isset($arrConsultorStatus[$dados->consultor->id]['Prorrogada'])){
					$arrConsultorStatus[$dados->consultor->id]['Prorrogada']=1;
				}else{
					$arrConsultorStatus[$dados->consultor->id]['Prorrogada']++;
				}
			break;
			case 5:
				if(!isset($arrConsultorStatus[$dados->consultor->id]['Reprovada'])){
					$arrConsultorStatus[$dados->consultor->id]['Reprovada']=1;
				}else{
					$arrConsultorStatus[$dados->consultor->id]['Reprovada']++;
				}
			break;
			}
			
			if(!isset($arrPropostaDia[$dados->dt_envio]['total'])){
				$arrPropostaDia[$dados->dt_envio]['total']=1;
			}else{
				$arrPropostaDia[$dados->dt_envio]['total']++;
			}
			
			
			
			
			$arrDados[$i]=$dados->attributes;
			foreach ($dados->atividades as $id => $atividades){
				$arrDados[$i]['atividades'] = 	$atividades->attributes;
			}
		}
		
		foreach ($arrConsultor as $valor){
			$arrCon[] = array('label'=>$valor['nome'],'value'=>$valor['total']);
		}
		
		foreach ($arrPropostaDia as $dia => $valor){
			$dia = date("d/m/Y", strtotime($dia));
			$arrPropDia[] = array('dia'=>$dia,'value'=>$valor['total']);
		}
		
			foreach ($arrConsultorStatus as $dia => $valor){
				
				$cancelada = isset($valor['Cancelada'])?($valor['Cancelada']):0;
				$aprovada = isset($valor['Aprovada'])?($valor['Aprovada']):0;
				$aguardando = isset($valor['Aguardando'])?($valor['Aguardando']):0;
				$prorrogada = isset($valor['Prorrogada'])?($valor['Prorrogada']):0;
				$reprovada = isset($valor['Reprovada'])?($valor['Reprovada']):0;
				
				$arrConStatus[] = array('nome'=>$valor['nome'],'ag'=>$aguardando,'ap'=>$aprovada,'c'=>$cancelada,'p'=>$prorrogada,'r'=>$reprovada);
			}
		
		
		$geral['consultores'] = $arrCon;
		$geral['propDia'] = $arrPropDia;
		$geral['conStatus'] = $arrConStatus;

		header('Content-Type: application/json');
		echo json_encode($geral);
		
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}