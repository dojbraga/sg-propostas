<?php
/* @var $this TabelaValorController */
/* @var $model TabelaValor */


$model->id_cliente = $model->clientes->cliente;


$this->breadcrumbs=array(
	'Tabela Valor'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar TabelaValor', 'url'=>array('index')),
	array('label'=>'Cadastrar TabelaValor', 'url'=>array('create')),
	array('label'=>'Alterar TabelaValor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Excluir TabelaValor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar TabelaValor', 'url'=>array('admin')),
);
?>

<h1>View TabelaValor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_cliente',
		'valor',
	),
)); ?>
