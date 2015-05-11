<?php
/* @var $this PropostaController */
/* @var $model Proposta */

$this->breadcrumbs=array(
	'Proposta'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Proposta', 'url'=>array('index')),
	array('label'=>'Cadastrar Proposta', 'url'=>array('create')),
	array('label'=>'Visualisar Proposta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gerenciar Proposta', 'url'=>array('admin')),
);
?>

<h1>Editar Proposta <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>