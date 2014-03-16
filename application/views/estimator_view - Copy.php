<?php 
//var_dump($arr);
//for ($x = 0;$x<count($arr['materials']) ; $x++)
//{
//		print_r( $arr['materials'][$x][0]);
		//echo '<br />';
		//print_r( $arr[$x][$y])d;
		//echo  '<br />';	
//}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kona Construction Deck Estimator</title>

	<style type="text/css">
	
	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 10px 15px 10px 15px;
	}
	
	form{
		margin:auto;
		position:relative;
		width:550px;
		text-decoration: none;
		padding:10px;
		margin: 0 20px 0 5px;	
	}
	
	input{
		display: inline-block;
		float: none;
		width:auto;
		margin:5px 0 0 10px; 
		padding:5px 5px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
		
	div.col {
		float: left;
		width: 33%;
		border-right:thin double #000;
		margin: 0px 5px 0px 5px;
    	}
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}

	</style>
	
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>


</head>

<body>

	<div id="container">
	<form name="formname" id="form1" action="welcome.php" method="post">
		<h1>Kona Estimator!</h1>
	
		<div id="body">
			Name: <input type="text" name="name"><br>
			E-mail: <input type="text" name="email"><br>
			Address: <input type="text" name="address"><br>
			City: <input type="text" name="city"><br>
			Zip: <input type="text" name="zip"><br>

		</div>
	</div>
	
	<div id="container">
	<h1>Deck Dimensions</h1>
		<div id="body">
			<div class="col">Length: <input id="dims" name="dims" type="text" name="length"></div>
			<div class="col">Width: <input id="dims" name="dims" type="text" name="width"></div>
			<div class="col">Height: <input id="dims" name="dims" type="text" name="height"></div>
		</div>
	</div>
	
	<div id="container">
	<h1>Deck Material</h1>
		<div id="body">
			<select id="materials" name="materials" onchange="handleSelection(this);">
			<? for ($x = 0 ; $x<count($arr['materials']) ; $x++) {	?>
			<option value="<? print_r($arr['materials'][$x][0]) ?>"> <? print_r($arr['materials'][$x][0]) ?> </option>
			<? } ?>
			</select>
		</div>
	</div>
	
	<div id="container">
	<h1>Deck Style</h1>
		<div id="body">
			<select id="style" name="style" onchange="handleSelection(this);">
			<? for ($x = 0 ; $x<count($arr['style']) ; $x++) {	?>
			<option value="<? print_r($arr['style'][$x][0]) ?>"> <? print_r($arr['style'][$x][0]) ?> </option>
			<? } ?>
			</select>
		</div>
	</div>
	
	<div id="container">
	<h1>Deck Lighting</h1>
		<div id="body">
			<select id="lighting" name="lighting" onchange="handleSelection(this)">
			<? for ($x = 0 ; $x<count($arr['lighting']) ; $x++) {	?>
			<option value="<? print_r($arr['lighting'][$x][0]) ?>"> <? print_r($arr['lighting'][$x][0]) ?> </option>
			<? } ?>
			</select>
		</div>
	</div>
	
	<div id="container">
	<h1>Deck Extras</h1>
		<div id="body">
			<select id="extras" name="extras" onchange="handleSelection(this)">
			<? for ($x = 0 ; $x<count($arr['extras']) ; $x++) {	?>	
			<option value="<? print_r($arr['extras'][$x][0]) ?>"> <? print_r($arr['extras'][$x][0]) ?> </option>
			<? } ?>
			</select>
		</div>
	</div>
	
	</form>
	<div>
	
	
	
	<h1>Total $<label id="total" name="lbl_total">0</label>
	</h1>
	
	<div>
	<img src="http://www.phpadmin.com/kona/assets/img/deck-cutaway.jpg">
	</div>
	
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
<script>
function handleSelection(menu) 
{
	var total=0;
	var arr = <?php echo json_encode($arr) ?>;
	var frm = document.getElementById("form1");
	var inputTags = document.getElementsByTagName("select");
	var dimtags = document.getElementsByName("dims");
	//console.log(dimtags.id);
	
 	for (var i=0; i<dimtags.length; i++) 
	{
		console.log("dim:" + parseInt(dimtags[i].value));
	}
	
	var tag;
	var total = 0;
	var name = "";
	var avgrate = 0;
	var unit = 0;
	var avgqty = 0;
	//console.log("frm name: " + frm.name);
	//console.log("select boxes: " + inputTags.length);
	//console.log("menu id: " + menu.id);
	//console.log("id of list: " + arr[menu.id]);
	//console.log("inputTags: " + inputTags);
	
	for (var i=0; i<inputTags.length; i++) 
	{
		console.log("inputTag name: " + inputTags[i].name);
		var current_element = inputTags[i].name;
		var val = arr[menu.id][i];
		//console.log(menu.id);
		if(val)
		{
			console.log(val);
			var valLen = val.length;
		}
		//console.log("\tval len: " + valLen);
		//console.log("\tarr value: " + val);
		var selectname = document.getElementById(inputTags[i].id);
		var selectval = selectname.options[selectname.selectedIndex].value;
		//console.log("\t\tselected value: " + selectval);
		//console.log("\t\tarr[inputpags]: " + arr[inputTags[i].name]);
		//console.log("\t\tlen arr[inputpags]: " + arr[inputTags[i].name].length);
		for (var n=0; n<arr[inputTags[i].name].length; n++)
		{
			var name = "";
			var avgrate = 0;
			var unit = 0;
			var avgqty = 0;
			
			var thename = arr[inputTags[i].name][n][0] ;
			//console.log("\t\t\tthename: " + thename);
			if (thename == selectval)
			{
				var itemarr = arr[inputTags[i].name][n];
				var arrlen = arr[inputTags[i].name][n].length;
				console.log("\tselected val: " + arr[inputTags[i].name][n]);
				
				for (var x=0;x<arrlen;x++)
				{
					if( itemarr[0]!="none")
					{
						switch(x)
						{
							case 0: var name = itemarr[x];
							case 1: var avgrate = calculatedim(itemarr[1],itemarr[2],"avgrate");
							case 3: var unit = itemarr[3]
							case 4: var avgqty = quantifier(parseInt(dimtags[0].value),parseInt(dimtags[1].value),itemarr[5],unit);
							default: console.log();
						}
					}
					else
					{
						//var total = 0;
					}
				}
				
				console.log("\tunit: " + unit + "\tavg qty: " + avgqty);
				if(avgrate && unit && avgqty)
				{
					console.log("\tname: " + name + "\taverage_qty: " + avgqty + "\taverage_rate: " + avgrate);
					console.log("section total: " + avgrate*avgqty);
					var total = total + (avgrate*avgqty);
					console.log("TOTAL: " + total);
				}
			}
		}
	
		//console.log(selectname);
		//console.log(selectval);
		//for (var n=0 ; n<arr[selectval])
		if(selectval!="Please select one")
		{
			//total = total + parseInt(total);
		}
	}
	
	var thediv=document.getElementById('total');
	thediv.innerHTML = total;
}

function calculatedim(num1,num2,str) 
{
	//console.log("num1: " + num1);
	console.log("\t\t" + str + ": " + (num1+num2)/2);
	return (num1+num2)/2;
}


function quantifier(n1,n2,startqty,t)
{
	var qty=0;
	var type = parseInt(t);
	switch(type)
	{
		case 1: 
			{
				qty = startqty;
				return qty;
			}
		case 2: 
			{
				qty = n1*n2;
				return qty;
			}
		case 3: 
			{
				qty = (n1+n2)*2;
				return qty;
			}
		default: qt = 0;
	}
	return qty;
	
}


function getunit(num)
{
	var unit="";
	switch(num)
	{
		case 1: unit = "each" ;
		case 2: unit = "square foot";
		case 3: unit = "linear foot";
	}
	return unit
}

</script>
</body>
</html>