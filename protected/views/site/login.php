<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<style>

.form-login{
	text-align:center;
}

span{
 	text-align:left !important;
}


input[type="text"],
input[type="password"],
.uneditable-input {
text-align:left;
float: center;
}

input[type="submit"]{
margin-left:48%;
}

form label {
 float: center !important; 
 text-align: center !important;
 width:100%;
 font-weight: bold;
}

.rememberlogin label{
width:63%;
}
.rememberlogin input[type="checkbox"]{
margin-left:40%;
margin-top:7px;
}

div.errorMessage {
color: #b94a48;
background-color: #f2dede;
padding: 8px 35px 8px 14px;
width:200px !important;
margin-bottom: 10px;
float: center !important;
margin-left: 41%;
border: 1px solid #EED3D7;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}
fo

</style>
<div class="form-login">
<h1>Login</h1>

<p>Por favor acesse com suas credenciais</p>

<div class="form-login">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Campos com <span class="required">*</span>são obrigatórios.</p>

	<div class="row">
		<input name="LoginForm[username]" id="LoginForm_username" type="text" type="Usuário" placeholder="Usuário" value="" spellcheck="false" class="">
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
	<input name="LoginForm[password]" id="LoginForm_password" type="password" placeholder="Senha" class="">
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="rememberlogin">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'Relembrar login no próximo acesso'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Entrar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
