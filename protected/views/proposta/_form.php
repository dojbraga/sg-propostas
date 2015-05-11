<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/tema_empresa/css/grid-atividades.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/jui/css/base/jquery-ui.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/ckeditor/ckeditor.js"></script>

<style>
.x-form-field {
	margin-bottom: 0px !important;
	float: none !important;
	margin-left: 0px !important;
	padding: 0px 0px !important;
	border: 0px solid !important;
	border-radius: 0px;
}

label {
	display: block;
	margin-bottom: 5px;
	text-align: left !important;
	margin-left: 15px !important;;
}

.error{
margin-left: 140px;
color: #b94a48;
background-color: #f2dede;
padding: 8px 35px 8px 14px;
width: auto;
margin-bottom: 10px;
float: left;
margin-left: 20px;
border: 1px solid #EED3D7;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}

#textarea-1{
    width: 440px;
    height: 200px;
    padding: 10px;
}

#salvando{
	text-align: center; 
	color: #4f324c; 
	background:#FAFAD2;  
	width:500px;	
	height:50px;  
	position:fixed; 
	top:50%; 
	left:30%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px; 
	border-radius: 5px;  
	border-style: solid; 
	margin-bottom:10px;
	border-width: 1px; 
	border-color:#CCC;
	display:none;
}

#salvando p{
	margin-top:15px;
}

</style>

<script type="text/javascript">
/* <![CDATA[ */

 var consultores;
 var objetoConsultores;
 var urlGeral ="<?echo $this->createUrl('/');?>";

/* ]]> */

function exibe(id) {
	if(document.getElementById(id).style.display=="none") {
		document.getElementById(id).style.display = "inline";
	}
	else {
		document.getElementById(id).style.display = "none";
	}
}

	window.onload = function()
	{
		
		CKEDITOR.config.removePlugins = "elementspath";
		CKEDITOR.config.resize_enabled = false; 
		CKEDITOR.config.height  = '150px';
		CKEDITOR.config.width  = '98%';
		CKEDITOR.config.border = '0px';
		CKEDITOR.config.skin = 'bootstrapck';
		CKEDITOR.config.font_names = 'Arial;Times New Roman;Verdana';

		CKEDITOR.replace( 'Proposta_observacoes',
			{
				toolbar :
				[
					{ name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
					{ name: 'paragraph', items : [ 'TextColor', 'BGColor','Styles','Format','Font','FontSize' ] },
					{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] }
				]});
		
		
				 
		CKEDITOR.replace( 'Proposta_obs_atividades',
			{
				toolbar :
				[
					{ name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
					{ name: 'paragraph', items : [ 'TextColor', 'BGColor','Styles','Format','Font','FontSize' ] }
				]});

		
		CKEDITOR.replace( 'Proposta_obs_objetivo_tecnico',
			{
			});

		CKEDITOR.replace( 'Proposta_obs_entrega',
				{
					toolbar :
					[
						{ name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
						{ name: 'paragraph', items : [ 'TextColor', 'BGColor','Styles','Format','Font','FontSize' ] },
						{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] }
					]});

		<?php if($model->isNewRecord){?>
			GridAtividades.add();
			
			$("#Proposta_vlr_desconto").val('0.00'); 
			$("#Proposta_vlr_deslocamento").val('0.00'); 			
			
		<?php }?>
	}


</script>


<?php

/* @var $this PropostaController */
/* @var $model Proposta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
 if($model->isNewRecord){
 	$acao = 'create';
 }else{
 	$acao = 'update/'.$model->id;
 }

$form = $this->beginWidget('CActiveForm', array (
	'id' => 'proposta-form',
	'action'=>$this->createUrl('proposta/'.$acao),
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => false,

));
?>

<?echo('<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>');?>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php echo $form->labelEx($model,'chamado'); ?>
	<?php echo $form->textField($model,'chamado',
	array(
								'size'=>5,
                               'ajax'=>array(
									      'type' => 'POST',
									      'url' => $this->createUrl('proposta/GetDadosByChamado'),
									      'beforeSend' => 'function(){' .
									      		'if(Proposta_chamado.value != ""){ // Executado antes da requisição ser enviada
									           data = "<option >Carregando...</option>";
									           $("#loading_img").css("display", "block"); // Mostra um loading gif enquanto consulta é feita
									           $("#Proposta_cliente").html(data); // Preencha dropdown modelo com opção "Carregando" enquanto consulta é feita
									       }}',
									       'success' => 'function(data){
									       		 // Executado após requisição ser concluída
									       	   $("#loading_img").css("display", "none"); // Esconde loading gif.
									           $("#Proposta_cliente").html(data);  // Preenche dropdown modelo com elementos retornos por funçao
									       	   	var url =urlGeral+"/proposta/getDescricaoClientesContato/?id="+Proposta_cliente.value+"&chamado="+Proposta_chamado.value;  
														  $.ajax({url:url,success:function(result){
														   $("#Proposta_solicitante").html(result); // 
														  }}); 
											    var url = urlGeral+"/proposta/getValorHoraCliente/?id="+Proposta_cliente.value;			  		
									           		  	$.ajax({url:url,success:function(result){
														   $("#Proposta_vlr_hora_cliente").val(result); // 
														  }}); 
									           		 
									           		return false;
									       }',
	),
	)) ?>


	<?php echo $form->error($model,'chamado'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'cliente'); ?>
	<?php echo $form->dropDownList($model,'cliente', $model->getDescricaoClientes(),array(
		                               'ajax'=>array(
									      'type' => 'POST',
									      'url' => $this->createUrl('proposta/getDescricaoClientesContato'),
									      'beforeSend' => 'function(){' .
									      		'if(Proposta_chamado.value != ""){ // Executado antes da requisição ser enviada
									           data = "<option >Carregando...</option>";
									           $("#loading_img").css("display", "block"); // Mostra um loading gif enquanto consulta é feita
									           $("#Proposta_solicitante").html(data); // Preencha dropdown modelo com opção "Carregando" enquanto consulta é feita
									       }}',
									       'success' => 'function(data){
									       		 // Executado após requisição ser concluída
									           $("#loading_img").css("display", "none"); // Esconde loading gif.
									           $("#Proposta_solicitante").html(data);  // Preenche dropdown modelo com elementos retornos por funçao
									       	   	var url =urlGeral+"/proposta/getValorHoraCliente/?id="+Proposta_cliente.value;			  		
									           		  	$.ajax({url:url,success:function(result){
														   $("#Proposta_vlr_hora_cliente").val(result); // 
														  }}); 
									           return false;
									       }',
	))); ?>
	<?php echo $form->error($model,'cliente'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'solicitante'); ?>
	<?php echo $form->dropDownList($model,'solicitante', $model->getDescricaoClientesContato($model->cliente, $model->solicitante)); ?>
	<?php echo $form->error($model,'solicitante'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'consultor_negocio'); ?>
	<?php echo $form->dropDownList($model,'consultor_negocio', $model->getDescricaoConsultor()); ?>
	<?php echo $form->error($model,'consultor_negocio'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'id_situacao'); ?>
	<?php echo $form->dropDownList($model,'id_situacao', $model->getDescricaoSituacao()); ?>
	<?php echo $form->error($model,'id_situacao'); ?>
	</div>
	
	<div class="row" id="motivo_recusa" style= "margin-bottom:10px; display:none;">
	<?php echo $form->labelEx($model,'Motivo recusa'); ?>
	<?php echo $form->textArea($model,'motivo_recusa',array('rows'=>3, 'cols'=>110,'wrap'=>'virtual',)); ?>
	<?php echo $form->error($model,'motivo_recusa'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'objetivo_tecnico'); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
      'attribute'=>'servico',
        'model'=>'CatalogoServico',
        'sourceUrl'=>array('catalogoservico/getAll'),
        'name'=>'Proposta[objetivo_tecnico]',
        'value'=>utf8_decode($model->objetivo_tecnico),
  'options'=>array(
     'showAnim'=>'fold',
     'select'=>"js: function(event, ui) {
     	 document.getElementById('dv-objetivo').style.display='block';
         $('#valorObjetivo').text('A estimativa para o serviço escolhido é de '+ui.item['horas']+' hora(s).');
         $('#requisitoObjetivo').text('Os requisitos necessários para este serviço são: '+ui.item['requisito']);
     }"
     ),
        'htmlOptions'=>array(
          'size'=>123 ),
     )); ?>
		<?php echo $form->error($model,'objetivo_tecnico'); ?>	
		<br> <br>
		<div id="dv-objetivo" style="display:none; text-align: center; color: #4f324c; background:#FAFAD2; width:97%; position:relative; left:15px;-webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;  border-style: solid; margin-bottom:10px;
    border-width: 1px; border-color:#CCC;">
			<div name='valorObjetivo' id='valorObjetivo'></div>
			<div name='requisitoObjetivo' id='requisitoObjetivo'></div>
		</div>
	</div>
	<div class="row" style= "margin-left: 0px !important; margin-bottom:10px;" id="obs_objetivo_tecnico">
	<?php echo $form->labelEx($model,'Objetivo técnico'); ?>
	<?php echo $form->textArea($model,'obs_objetivo_tecnico',array('rows'=>3, 'cols'=>110,'wrap'=>'virtual')); ?>
	<?php echo $form->error($model,'obs_objetivo_tecnico'); ?>
	</div>

		<table id="grid-atividades" class="grid-atividades ">
			<thead>
				<tr>
				<th colspan="7" class="th-atividade-top">
					<input type="button" value="Adicionar" id="adicionar-atividade" onclick="GridAtividades.add()"/>
				</th>
				</tr>
				<tr>
					<th class="th-atividade-atividade">Atividade</th>
					<th class="th-atividade-ch">CH</th>
					<th class="th-atividade-data">Data</th>
					<th class="th-atividade-inicio">Início</th>
					<th class="th-atividade-termino">Término</th>
					<th class="th-atividade-consultor">Consultor</th>
					<th class="th-atividade-acao">Ação</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!$model->isNewRecord){for($i=0;$i<count($model->atividades);$i++) {
				//verifica se a data é valida
				if(strtotime($model->atividades[$i]->data_execucao) > strtotime("2000-01-01")){
					$data = date("d/m/Y", strtotime($model->atividades[$i]->data_execucao));
				}else{
					$data = '';
				}
				
				if($model->atividades[$i]->horario_inicio == '00:00:00.00000'){
					$horaInicio = '';
				}else{
					$horaInicio = substr($model->atividades[$i]->horario_inicio,0,5);
				}
				
				if($model->atividades[$i]->horario_termino == '00:00:00.00000'){
					$horaTermino = '';
				}else{
					$horaTermino = substr($model->atividades[$i]->horario_termino,0,5);
				}
			?>
				<tr>
					<td class="atividade-atividade">
						<input type="text" name="Proposta[atividades][][atividade]" value="<?php echo $model->atividades[$i]->atividade;?>"/>
					</td>
					<td class="atividade-ch">
						<input type="text" name="Proposta[atividades][][carga_horaria]" value="<?php echo $model->atividades[$i]->carga_horaria;?>" />
					</td>
					<td class="atividade-data">
						<input type="text" class="calendario" name="Proposta[atividades][][data_execucao]" value="<?php echo $data;?>" />
					</td>
					<td class="atividade-inicio">
						<input type="text" name="Proposta[atividades][][horario_inicio]" value="<?php echo $horaInicio;?>" />
					</td>
					<td class="atividade-termino">
						<input type="text" name="Proposta[atividades][][horario_termino]" value="<?php echo $horaTermino;?>" />
					</td>
					<td class="atividade-consultor">
						<?php echo $form->dropDownList($model,'atividades[][id_consultor]', $model->getDescricaoConsultores(),array('options' => array($model->atividades[$i]->id_consultor=>array('selected'=>true))));?>
					</td>
					<td class="atividade-acao">
						<input type="hidden" class="id-atividade" name="Proposta[atividades][][id_atividade]" value="<?php echo $model->atividades[$i]->id_atividade;?>"/>
						<input type="hidden" class="atividade-excluida" name="Proposta[atividades][][excluido]" value="0"/>
						<input type="button" value="" style="margin:0px;" class="remover-atividade"/>
					</td>
				</tr>
				<?php }}?>
				<tr id="tr-clone" style="display:none;">
					<td class="atividade-atividade">
						<input type="text" name="Proposta[atividades][][atividade]"/>
					</td>
					<td class="atividade-ch">
						<input type="text" name="Proposta[atividades][][carga_horaria]" onchange="GridAtividades.calc();"/>
					</td>
					<td class="atividade-data">
						<input type="text" class="calendario" name="Proposta[atividades][][data_execucao]" />
					</td>
					<td class="atividade-inicio">
						<input type="text" name="Proposta[atividades][][horario_inicio]" />
					</td>
					<td class="atividade-termino">
						<input type="text" name="Proposta[atividades][][horario_termino]" />
					</td>
					<td class="atividade-consultor">
						<?php echo $form->dropDownList($model,'atividades[][id_consultor]', $model->getDescricaoConsultores());?>
					</td>
					<td class="atividade-acao">
						<input type="hidden" class="atividade-excluida" name="Proposta[atividades][][id_atividade]" value=""/>
						<input type="hidden" class="atividade-excluida" name="Proposta[atividades][][excluido]" value="0"/>
						<input type="button" value="" style="margin:0px;" class="remover-atividade"/>
					</td>
				</tr>
			</tbody>
			<tfoot>
			<tr>
				<th colspan="7" class="th-atividade-foot">
					<input type="button" value="Calcular Atividades" id="calcular-atividades" onclick="GridAtividades.calc()"/>
				</th>
			</tr>
			<tfoot>
		</table>
	</div>
	<script type="text/javascript">

	var GridAtividades = {
		clone : null,
		grid : $("#grid-atividades"),
		_getClone:function(){
			this.clone= $("#tr-clone").clone();
			this.clone.removeAttr("id");
			this.clone.show();

			this.clone.find(".atividade-data input").datepicker({
		        dateFormat: 'dd/mm/yy',
		        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		    });

			this.clone.find(".atividade-ch input").mask('?9999');
			this.clone.find(".atividade-inicio input").mask("99:99");
			this.clone.find(".atividade-termino input").mask("99:99");
			
			this.clone.find(".atividade-data input").datepicker({
		        dateFormat: 'dd/mm/yy',
		        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		    });

			this.clone.find(".atividade-data input").mask("99/99/9999");

			return this.clone; 
		},
		add : function(){
			this.grid.append(this._getClone());
		},
		remove:function(id){
			this.grid.find("atividade-id input[value="+id+"]");
		},
		calc: function(){
			 var total = 0;
			 var valor = 0;
			 $("#grid-atividades td.atividade-ch").each(function(){
				 valor = (isNaN(parseFloat($(this).find("input").val())))?(0):(parseFloat($(this).find("input").val()));
                 total+=valor;
			});

			 	var valorHora = (isNaN(parseFloat($("#Proposta_vlr_hora_cliente").val())))?(0):(parseFloat($("#Proposta_vlr_hora_cliente").val()));
		    	var valorDesconto = parseFloat($("#Proposta_vlr_desconto").val());
		    	var valorDeslocamento = parseFloat($("#Proposta_vlr_deslocamento").val());
		    	var vltInvestimento = (valorHora * total)+valorDeslocamento-valorDesconto;
		    	$("#Proposta_vlr_investimento").val(vltInvestimento);
		    	
		}
	}
	$("body").on("click",".remover-atividade",function(){
		$(this).parent().find(".atividade-excluida").val(1);
		$(this).parent().parent().hide();
	});
	</script>
	
	

	<div class="row" id="obs_atividades" style= "margin-left: 0px !important; margin-bottom:10px;">
	<?php echo $form->labelEx($model,'Detalhamento das atividades (Premissas e entregáveis)'); ?>
	<?php echo $form->textArea($model,'obs_atividades',array('rows'=>3, 'cols'=>110,'wrap'=>'virtual')); ?>
	<?php echo $form->error($model,'obs_atividades'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'vlr_hora_cliente'); ?>
	<?php echo $form->textField($model,'vlr_hora_cliente',array('size'=>15,'maxlength'=>15,'onchange'=>'GridAtividades.calc();')); ?>
	<?php echo $form->error($model,'vlr_hora_cliente'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'vlr_desconto'); ?>
	<?php echo $form->textField($model,'vlr_desconto',array('size'=>15,'maxlength'=>15,'onchange'=>'GridAtividades.calc();')); ?>
	<?php echo $form->error($model,'vlr_desconto'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'vlr_deslocamento'); ?>
	<?php echo $form->textField($model,'vlr_deslocamento',array('size'=>15,'maxlength'=>15,'onchange'=>'GridAtividades.calc();')); ?>
	<?php echo $form->error($model,'vlr_deslocamento'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'vlr_investimento'); ?>
	<?php echo $form->textField($model,'vlr_investimento',array('size'=>15,'maxlength'=>15)); ?>
	<?php echo $form->error($model,'vlr_investimento'); ?>
	<input type="button" value="Calcular Atividades" id="calcular-atividades" onclick="GridAtividades.calc();"/>
	</div>

	<div class="row" style= "margin-left: 0px !important; margin-bottom:10px; label{margin-left:0px !important;}">
		<b><?php echo $form->labelEx($model,'observacoes'); ?>
		<?php echo $form->textArea($model,'observacoes',array('rows'=>3, 'cols'=>110)); ?>
		<?php echo $form->error($model,'observacoes'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'id_forma_pgto'); ?>
	<?php echo $form->dropDownList($model,'id_forma_pgto', $model->getDescricaoFormaPgto()); ?>
	<?php echo $form->error($model,'id_forma_pgto'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'dt_envio'); ?>
	<?php
	$this->widget("zii.widgets.jui.CJuiDatePicker", array (
		"attribute" => "dt_envio",
		"model" => $model,
		"language" => "pt",
		"options" => array (
			"showAnim"=>"fold",
			"dateFormat" => "dd/mm/yy",
			"showButtonPanel" => true,
			"changeYear" => true,
			"yearRange" => "0:10",
			"minDate" => "-30D"
			),"htmlOptions"=>array(
			'size'=>10,
			'value'=>!$model->isNewRecord ? date('d/m/Y',strtotime($model->dt_envio)):date('d/m/Y')),
			));
			?>
			<?php echo $form->error($model,'dt_envio'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'dt_validade'); ?>
	<?php
	$this->widget("zii.widgets.jui.CJuiDatePicker", array (
		"attribute" => "dt_validade",
		"model" => $model,
		"language" => "pt",
		"options" => array (
			"showAnim"=>"fold",
			"dateFormat" => "dd/mm/yy",
			"showButtonPanel" => true,
			"changeYear" => true,
			"yearRange" => "0:10",
			"minDate" => "-30D"
			),  "htmlOptions"=>array(
			'size'=>10,
			'value'=>!$model->isNewRecord ? date('d/m/Y',strtotime($model->dt_validade)):date('d/m/Y', strtotime("+10 days"))),
			));
			?>
			<?php echo $form->error($model,'dt_validade'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'prazo_entrega'); ?>
	<?php
	$this->widget("zii.widgets.jui.CJuiDatePicker", array (
		"attribute" => "prazo_entrega",
		"model" => $model,
		"language" => "pt",
		"options" => array (
			"showAnim"=>"fold",
			"dateFormat" => "dd/mm/yy",
			"showButtonPanel" => true,
			"changeYear" => true,
			"yearRange" => "0:10",
			"minDate" => "-30D"
			),  "htmlOptions"=>array(
			'size'=>10,
			'value'=>!$model->isNewRecord ? date('d/m/Y',strtotime($model->prazo_entrega)):date('d/m/Y', strtotime("+20 days"))),
			));
			?>
			<?php echo $form->error($model,'dt_validade'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'chamado_servico'); ?>
	<?php echo $form->textField($model,'chamado_servico',
	array(
								'size'=>5)) ?>


	<?php echo $form->error($model,'chamado'); ?>
	</div>
	
	<div class="row" id="obs_entrega" style= "margin-left: 0px !important; margin-bottom:10px;">
	<?php echo $form->labelEx($model,'Observações para a entrega do consultor'); ?>
	<?php echo $form->textArea($model,'obs_entrega',array('rows'=>3, 'cols'=>110,'wrap'=>'virtual')); ?>
	<?php echo $form->error($model,'obs_entrega'); ?>
	</div>
	
	
	<div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>
	


	<?php $this->endWidget(); ?>
			<div id="salvando">
				<p><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/tema_empresa/images/ajax-loader2.gif"> Salvando...</p>
		</div>
	
</div>
<!-- form -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/tema_empresa/js/jquery.serialize-object.min.js"></script>
<script type="text/javascript">


$(document).ready(function(){

	if($("#Proposta_id_situacao").val() != 8){
		$( "#motivo_recusa" ).hide();
	}else{
		$( "#motivo_recusa" ).show();
	}
	
	
	$("#Proposta_id_situacao").change(function(){ 
			if($("#Proposta_id_situacao").val() != 8){
					$( "#motivo_recusa" ).hide();
				}else{
					$( "#motivo_recusa" ).show();
				}
	
		});
	
	$("#proposta-form").validate({
        // Define as regras
        rules:{
        	'Proposta[cliente]':{
                // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            'Proposta[solicitante]':{
                // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true
            },
            'Proposta[objetivo_tecnico]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true,
                maxlength: 250
            },
            'Proposta[vlr_hora_cliente]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            'Proposta[vlr_investimento]':{
                required: true,
            },
            'Proposta[dt_envio]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            'Proposta[dt_validade]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
        },
        // Define as mensagens de erro para cada regra
        messages:{
        	'Proposta[cliente]':{
                required: "Selecione um Cliente"
            },
            'Proposta[solicitante]':{
                required: "Selecione um Solicitante"
            },
            'Proposta[objetivo_tecnico]':{
               required: "Informe um objetivo técnico",
               maxlength: "O máximo de caracters é 250"
            },'Proposta[vlr_hora_cliente]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: "Informe um valor"
            },
            'Proposta[vlr_investimento]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            	required: "Informe um valor"
            },
            'Proposta[dt_envio]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            	required: "Informe uma data"
            },
            'Proposta[dt_validade]':{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            	required: "Informe uma data"
            },
        }
    });
	
	$("#proposta-form").on("submit",function(e){

		$("#Proposta_obs_objetivo_tecnico").val(CKEDITOR.instances.Proposta_obs_objetivo_tecnico.getData());
		$("#Proposta_obs_atividades").val(CKEDITOR.instances.Proposta_obs_atividades.getData());
		$("#Proposta_observacoes").val(CKEDITOR.instances.Proposta_observacoes.getData());
		$("#Proposta_obs_entrega").val(CKEDITOR.instances.Proposta_obs_entrega.getData());
		e.preventDefault();
		$.post($(this).attr("action"),$("form#proposta-form").serializeObject(),function(data){
			$("#salvando").css("display", "block");		
			<?php if($model->isNewRecord){?>
			window.location = "../proposta/view/"+data.idProposta;
			<?php }else{?>
			window.location = "../view/"+data.idProposta;
			<?php }?>
		},"json");
	})
});
</script>
