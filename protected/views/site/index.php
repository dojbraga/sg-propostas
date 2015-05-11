<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/morris/morris.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/9339cbe0/morris/morris.js"></script>

<script>
$(document).ready(function(){

	$.ajax({
		  type: "POST",
		  url: "<?php echo $this->createUrl('site/getGrafico');?>",
		})
		  .done(function( data ) {
			  Morris.Donut({
		            element: 'consultores',
		            data:data['consultores'],
		            backgroundColor: '#ccc',
		            labelColor: '#060',
		            colors: [
		              '#0BA462',
		              '#39B580',
		              '#67C69D',
		              '#95D7BB']
		        });
			  Morris.Line({
				  element: 'propbydia',
				  data: data['propDia'],
				  xkey: 'dia',
				  ykeys: ['value'],
				  labels: ['Propostas'],
				  parseTime: false
				});

			  Morris.Bar({
			    element: 'consultor-status',
			    data: data['conStatus'],
			    xkey: 'nome',
			    ykeys: ['ag', 'ap', 'c', 'p','r'],
			    labels: ['Aguardando', 'Aprovado', 'Concluído', 'Prorrogado','Reprovado'],
			    stacked: true
			  });
			});
		  });



</script>
<div style="text-align:center;"><p><h2>Número de Propostas x Dia</h2></p></div>
<div id="consultor-status" style="height: 350px;"></div>
<div style="text-align:center; margin-top:70px;"><p><h2>Número de Propostas x Consultor</h2></p></div>
<div id="consultores" style="height: 350px;"></div>
<div style="text-align:center; margin-top:70px;"><p><h2>Número de Propostas x Dia</h2></p></div>
<div id="propbydia" style="height: 350px;"></div>



