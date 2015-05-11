<?php
/* @var $this TabelaValorController */
/* @var $model TabelaValor */

$this->breadcrumbs=array(
	'Tabela Valor'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TabelaValor', 'url'=>array('index')),
	array('label'=>'Create TabelaValor', 'url'=>array('create')),
	array('label'=>'View TabelaValor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TabelaValor', 'url'=>array('admin')),
);
?>

<h1>Update TabelaValor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>