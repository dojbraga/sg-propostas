<?php
/* @var $this AtividadeController */
/* @var $model Atividade */

$this->breadcrumbs=array(
	'Atividade'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Atividade', 'url'=>array('index')),
	array('label'=>'Create Atividade', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#atividade-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Atividade</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'atividade-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_atividade',
		'id_proposta',
		'atividade',
		'carga_horaria',
		'data_execucao',
		'id_consultor',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
