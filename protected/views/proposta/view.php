<?php
/* @var $this PropostaController */
/* @var $model Proposta */


$model->solicitante = ClienteContato::Model()->findContato($model->solicitante, $model->cliente);

$cliente = $model->getDescricaoClientes();
$model->cliente = $cliente[$model->cliente];

$model->objetivo_tecnico = utf8_decode($model->objetivo_tecnico);
$model->dt_envio = date("d/m/Y", strtotime($model->dt_envio));
$model->dt_validade = date("d/m/Y", strtotime($model->dt_validade));
$model->prazo_entrega = date("d/m/Y", strtotime($model->prazo_entrega));

$model->consultor_negocio = $model->consultor->nome;

if($model->id_situacao == 8){
	$linhas = array(
		'id',
		'chamado',
		'cliente',
		'solicitante',
		'consultor_negocio',
		'objetivo_tecnico',
		'vlr_investimento',
		'id_forma_pgto',
		'vlr_desconto',
		'dt_envio',
		'dt_validade',
		'prazo_entrega',
		'situacao',
		'motivo_recusa',
	);
}
else{
		$linhas = array(
		'id',
		'chamado',
		'cliente',
		'solicitante',
		'consultor_negocio',
		'objetivo_tecnico',
		'vlr_investimento',
		'id_forma_pgto',
		'vlr_desconto',
		'dt_envio',
		'dt_validade',
		'prazo_entrega',
		'situacao'
	);
	
}
	

$model->situacao =  $model->situacao->descricao;

$this->breadcrumbs=array(
	'Proposta'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Proposta', 'url'=>array('index')),
	array('label'=>'Cadastrar Proposta', 'url'=>array('create')),
	array('label'=>'Editar Proposta', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Deletar Proposta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'VocÃª tem certeza que deseja deletar este item??')),
	array('label'=>'Gerenciar Proposta', 'url'=>array('admin')),
);
?>

<div class="boxes">
	<p>Selecione a opção de impressão:</p>
	<label><input type="radio" name="tipoProposta" value="0" checked/>Cliente</label>
	<label><input type="radio" name="tipoProposta" value="1" />Consultor</label>
	<button class="submit">Imprimir</button>
</div>

	<a style="position: absolute; float:left; margin-left:67%; margin-top:10px;" class="openModal" href="<? echo $this->createUrl('gerarPdfProposta',array('id'=>$model->id));?>" target="_blank">
		<img width="25px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/print.jpg" />
	</a>

<h1>Visualizar Proposta #<?php echo $model->id; ?> <div></div></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$linhas,
)); ?>
