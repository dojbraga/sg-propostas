<?php
/* @var $this TabelaValorController */
/* @var $model TabelaValor */

$this->breadcrumbs=array(
	'Tabela Valor'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TabelaValor', 'url'=>array('index')),
	array('label'=>'Manage TabelaValor', 'url'=>array('admin')),
);
?>

<h1>Create TabelaValor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>