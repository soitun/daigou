{include file="header.tpl" title=foo}
<div style="width:1280px; text-align: center" >
<table width="100%" border="0">
	<tr>
		<td width="70%" valign="top">
		
		<h2> <img width="15px" src="./image/icon2.gif"> 关于我们 </h2>	
		<hr>
		<br>
	
		
		已放入购物车
		<br><br><br>
		产品名称
		<hr>		
		{$product.name}
		
		<br><br>
		产品描述
		<hr>
		{$product.description}
		
	
			
		
		
		</td>
		<td rowspan="3" valign="top">
		{include file="rightcolumn.tpl" title=foo}
		</td>
	</tr>
	
	
</table>
</div>
{include file="footer.tpl"}
