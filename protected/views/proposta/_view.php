<?php
/* @var $this PropostaController */
/* @var $data Proposta*/

?>

<div>
	<div class="boxes">
		<p>Selecione a opção de impressão:</p>
		<label><input type="radio" name="tipoProposta" value="0" checked/>Cliente</label>
		<label><input type="radio" name="tipoProposta" value="1" />Consultor</label>
		<button class="submit">Imprimir</button>
	</div>

	<a class="openModal" href="<? echo $this->createUrl('gerarPdfProposta',array('id'=>$data->id));?>" target="_blank">
		<img width="25px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/print.jpg" />
	</a>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br /><b><?php echo CHtml::encode($data->getAttributeLabel('chamado')); ?>:</b>
	<?php echo CHtml::encode($data->chamado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente')); ?>:</b>
	<?php echo ($data->clientes->cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('solicitante')); ?>:</b>
	<?php echo ClienteContato::Model()->findContato($data->solicitante, $data->cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consultor_negocio')); ?>:</b>
	<?php echo CHtml::encode($data->consultor->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_situacao')); ?>:</b>
	<?php echo CHtml::encode($data->situacao->descricao); ?>
	<br />
	
	<?php if($data->id_situacao == 8){?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo_recusa')); ?>:</b>
	<?php echo CHtml::encode($data->motivo_recusa); ?>
	<br />
	<?php }?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('objetivo_tecnico')); ?>:</b>
	<?php echo utf8_decode($data->objetivo_tecnico); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vlr_investimento')); ?>:</b>
	<?php echo CHtml::encode($data->vlr_investimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_forma_pgto')); ?>:</b>
	<?php echo CHtml::encode($data->id_forma_pgto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vlr_desconto')); ?>:</b>
	<?php echo CHtml::encode($data->vlr_desconto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dt_envio')); ?>:</b>
	<?php echo CHtml::encode($data->dt_envio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dt_validade')); ?>:</b>
	<?php echo CHtml::encode($data->dt_validade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observacoes')); ?>:</b>
	<?php echo CHtml::encode($data->observacoes); ?>
	<br />

	*/ ?>
	
	<br />

</div>