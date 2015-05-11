<?php
	Yii::app()->clientscript
		// use it when you need it!
		/*
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
		*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/tema_empresa/js/extjs/examples/shared/include-ext.js"></script>
<!-- Le fav and touch icons -->
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'Propostas', 'url'=>array('/proposta')),
							array('label'=>'Catálogo de Serviços', 'url'=>array('/CatalogoServico')),
							array('label'=>'Forma de Pagamento', 'url'=>array('/FormaPgto')),
							array('label'=>'Tabela de Valores', 'url'=>array('/TabelaValor')),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Sair ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						),
					)); ?>
					
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
	
	<?php echo $content ?>
	
	
	</div><!--/.fluid-container-->
	</div>
	

	
	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" class="col-md-6">
			
			</div> <!-- /span6 -->
			<div id="footer-terms" class="col-md-6">Â© 2014 <a href="www.siteempresa.com.br" target="_blank">Nome_EMPRESA</a>.
			</div> <!-- /.span6 -->
		 </div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
	
	
<script>
$(document).ready(function(){
	$("#mask").click(function(){
		$("#modal").hide();
		$("#modal .content").html("");
	});

//seleciona os elementos a com atributo name="modal"
	$('.openModal').click(function(e) {
		//cancela o comportamento padrão do link
		e.preventDefault();
		
		//armazena o atributo href do link
		var urlBase = $(this).attr('href');
	
		var modalContent = $(this).siblings(".boxes").html();
		
		//efeito de transição
		$("#modal .content").html(modalContent);
		$('#modal').fadeIn(1000);
		
		$('#modal .submit').click(function () {
			var valueSelected = $("input[name='tipoProposta']:checked").val();
			urlBase += "?tipoProposta=" + valueSelected;
			window.open(urlBase,'_blank');
			$("#modal").hide();
			$("#modal .content").html("");
		});
	});
});

function gerarPdfProposta(id){
	 var url ="gerarPdfProposta/?id="+id;			  		
			  	$.ajax({url:url,success:function(result){
				  }}); 
	
}
</script>

<style>/* O z-index do div#mask deve ser menor que do div#boxes e do div.window */
body {
	position: relative;
}
#modal {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	width: 100%;
	height: 100%;
	display: none;
}
#modal .content {
	position: absolute;
	top: 200px;
	left: 50%;
	margin: 0 0 0 -150px;
	width: 300px;
	min-height: 150px;
	background-color: #fff;
	z-index: 1;
}

#modal .content p {
	font-weight: bold;
	text-align: center;
	margin-bottom:20px;
}

#modal .content input {
	margin-right:10px;
	margin-left:110px;
}

#modal .content button {
	margin-left:110px;
	margin-top:20px;
	
}

#mask {
	width: 100%;
	height: 100%;
	opacity: 0.8;
	position:absolute; 
	background-color:#000;
	z-index: 0;
}
.boxes {
	display: none;
}
</style>
<div id="modal">
	<div class="content"></div>
	<div id="mask"></div>
</div>
</body>
</html>
