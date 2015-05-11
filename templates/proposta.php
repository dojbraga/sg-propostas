<style>

h2{
	font-size:12pt;
	color: #4f324c;
}

#page_header img{
	postion:relative;
	width:100px;
	float:right;
}

#page_header2 img{
	postion:relative;
	width:100px;
	float:right;
}

#capa{
	margin-top:300px;
}

#capa h1{
	text-align:center;
	margin-bottom:50px;
	margin-top:150px;
	color: #4f324c;
	font-size:16pt;
}

#capa table{
	position:relative;
	float:left;
	background:EED2EE !important;
	cellpadding:5px; 
	cellspacing:0;
	margin-left:130px;
}

#capa table td{
	width:300px;
	border:0.2;
}

#capa table .td-left{
	background:#EED2EE !important;
	width:200px;
}

#page{
	line-height:18px;
	text-align:justify;
	text-justify:inter-word;
	
}

#dv-atividade{
	position:relative;
	float:left;
}

#tb-atividade, #tb-investimento{
	margin-top:20px;
}

#footer{
	position:relative;
	float:left;
	margin-left:-11px;
	margin-top:326px;
}

#footer img{
	width:792.5px;
}



</style>
<page backtop="10mm" backbottom="-50mm" backleft="0mm" backright="0mm">
    <div id="capa">
    <page_header id="page_header">
       <img src="./themes/empresanome/images/empresanome.jpg" alt="Logo"><br>
    </page_header>
    <h1>PROPOSTA DE SERVIÃ‡O</h1>
    <table width="100%" cellspacing="0" border="0.5">
  
			     <tr>
                	<td class="td-left"><?php echo utf8_encode("Número da Proposta");?></td>
                	<td><?php echo CHtml::encode($MacrosProposta['id'])." / ".substr($MacrosProposta['dt_validade'],6,10); ?></td>
                </tr>
                 <tr>
                	<td class="td-left"><?php echo utf8_encode("Nome do cliente");?></td>
               		 <td><?php echo utf8_encode($MacrosProposta['DescricaoCliente']); ?></td>
                </tr>
                 <tr>
                	<td class="td-left"><?php echo utf8_encode("Data de envio");?></td>
               		 <td> <?php echo $MacrosProposta['dt_envio']; ?></td>
                </tr>
                 <tr>
                	<td class="td-left"><?php echo utf8_encode("Validade da Proposta");?></td>
               		 <td> <?php echo $MacrosProposta['dt_validade']; ?></td>
                </tr>
                <tr>
                <td class="td-left"><?php echo utf8_encode("Responsável pela proposta");?></td>
               		 <td> <?php echo utf8_encode($MacrosProposta['consultor_negocio']); ?></td>
                </tr>
    </table>
    <div id="footer">
		<img src="./themes/empresanome/images/fundorepeat.png">
    </div>
	</div>
</page>
<page  backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
   <div id="page">
   <h2><?php echo utf8_encode("1. Apresentação")?></h2>
  		 <p><?php echo $MacrosProposta['objetivo_tecnico']; ?></p>
   <h2><?php echo utf8_encode("2. Objetivo Técnico")?></h2>
  		 <p><?php echo ($MacrosProposta['obs_objetivo_tecnico']); ?></p>
   <h2><?php echo utf8_encode("3. Cronograma e Atividades")?></h2>
   <table id="tb-atividade" cellspacing=0;>
    <thead>
            <tr>
                <th style="width: 15%; text-align: center; border: solid 0.5px; background: #EED2EE;">Data</th>
                <th style="width: 48%; text-align: center; border: solid 0.5px; background: #EED2EE;">Atividades</th>
                <th style="width: 27%; text-align: center; border: solid 0.5px; background: #EED2EE;">Consultor</th>
				<th style="width: 8%; text-align: center; border: solid 0.5px; background: #EED2EE;">CH</th>
            </tr>
    </thead>
    <? $cont=0;
    ?>
    <? foreach($MacrosProposta['Atividade'] as $atividades){?>
    	<?
    	   $modelProposta = new Proposta();
    	   $data = $this->ajustaData($atividades['data_execucao'],"-");
    	   $data = ($data == '01/01/1900')?("A definir"):($data);
    	   $consultor = ($atividades['id_consultor'] == 0)?("A definir"):($modelProposta->getDadosConsultorByiD($atividades['id_consultor'])->nome);
    	?>
    	<? $cont+=$atividades['carga_horaria'];?>
    	<tr>
    		<td style="border: solid 0.5px; width: 15%;"><?php echo CHtml::encode($data);?></td>
    		<td style="border: solid 0.5px; width: 48%; "><?php echo utf8_encode($atividades['atividade']);?></td>
			<td style="border: solid 0.5px; width: 27%;"><?php echo utf8_encode($consultor);?></td>
    		<td style="border: solid 0.5px; width: 8%;"><?php echo CHtml::encode($atividades['carga_horaria']);?>h</td>
    	</tr>
    	<?}?>
    	<tr>
    		<td></td>
    		<td></td>
    		<td></td>
    		<td style="border: solid 0.5px; background: #EED2EE;"><b><?php echo CHtml::encode($cont);?>h</b></td>
    	</tr>
    </table>
     <h2><?php echo utf8_encode("4. Detalhamento das Atividades (Premissas e entregáveis):");?></h2>
     <?php 
     		$valor=trim($MacrosProposta['obs_atividades']);
     		if(!empty($valor)){
     			$texto = ($MacrosProposta['obs_atividades']);
     }
    		 else{
     		$texto = "Não é aplicável para esta proposta.";
     }?>
     <p><?php echo utf8_encode($texto); ?></p>
	 <br />
	</div>
	<div>
     <h2><?php echo utf8_encode("5. Investimento:");?></h2>
	 <table id="tb-investimento" cellspacing="0" style="text-align: left; font-size: 14px">
	     <tr>
		     <td style="border: solid 0.5px; background: #EED2EE;">Total de Horas </td>
		     <td style="border: solid 0.5px;"><?php echo CHtml::encode($cont);?>h</td>
	     </tr>
	     <tr>
		     <td style="border: solid 0.5px; background: #EED2EE;">Valor da Hora</td>
		     <td style="border: solid 0.5px;">R$<?php echo CHtml::encode(number_format($MacrosProposta['vlr_hora_cliente'],2,',','.'));?></td>
	     </tr>
	     <?if($MacrosProposta['vlr_deslocamento'] > 0){?>
	      <tr>
		     <td style="border: solid 0.5px; background: #EED2EE;">Deslocamento</td>
		     <td style="border: solid 0.5px;">R$<?php echo CHtml::encode(number_format($MacrosProposta['vlr_deslocamento'],2,',','.'));?></td>
	     </tr>
	     <?}?>
	     <?if($MacrosProposta['vlr_desconto'] > 0){?>
	      <tr>
		     <td style="border: solid 0.5px; background: #EED2EE;">Desconto</td>
		     <td style="border: solid 0.5px;">R$<?php echo CHtml::encode(number_format($MacrosProposta['vlr_desconto'],2,',','.'));?></td>
	     </tr>
	      <?}?>
	      <tr>
		     <td style="border: solid 0.5px; background: #EED2EE;" width="180">Total do Investimento</td>
		     <td style="border: solid 0.5px;">R$<?php echo CHtml::encode(number_format($MacrosProposta['vlr_investimento'],2,',','.'));?></td>
	     </tr>
	     </table>
	</div>
	<div style="width:100%;">
		<h2><?php echo utf8_encode("6. Observação:")?></h2>
		<p><?php echo utf8_encode($MacrosProposta['observacoes']); ?></p>
			 <h2><?php echo utf8_encode("7. Forma de Pagamento");?></h2>
	 <p> <?php echo utf8_encode($MacrosProposta['forma_pgto']);?></p>
	 <p><b><?php echo utf8_encode("O faturamento da primeira parcela desta proposta de serviço será realizado dentro do mês de aprovação e terá vencimento no mês subsequente.");?></b></p>
	 </div>
	 <div style="width:100%;">
	 <h2><?php echo utf8_encode("8. Aceite da proposta ".$MacrosProposta['id']);?></h2> 
<p>Aprovada em ____/____/_______</p>
<p>Por _____________________________________________________________.</p>
<p>Assinatura: ___________________________</p>
<span><?php echo utf8_encode("A aprovação da proposta deve ser enviada por e-mail para o consultor responsável ou para relacionamento@empresanome.com.br, dentro do prazo de validade da proposta.");?></span>

</div>

</page>