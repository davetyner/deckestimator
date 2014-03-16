<?php

	$arr = array
	(
		"sqft",
		"deck",
		"piers",
		"rails"
		
	);

?>

<!DOCTYPE html>
<html>
  <head>
  <title>blank</title>
    <meta charset="UTF-8">
</head>

<body>
<form name="form1" id="form1">
<select id="sqft" name="select1" onChange="handleSelection(this)">
<option selected>Please select one </option>
<option value="1">01</option>
<option value="2">02</option>
</select>

<select id="deck" name="select2" onChange="handleSelection(this)">
<option selected>Please select one </option>
<option value="3">03</option>
<option value="7">07</option>
</select>

<select id="piers" name="select3" onChange="handleSelection(this)">
<option selected>Please select one </option>
<option value="5">05</option>
<option value="10">10</option>
</select>
</form>
<div id="div1"></div>
<div id="div2"></div>

<script type="text/javascript">
function handleSelection(menu) 
{
	var frm = document.getElementById('form1');
	var inputTags = frm.getElementsByTagName('select');
	var tag;
	var total=0;
	console.log("select boxes: " + inputTags.length);
	console.log(menu.id);
	for (var i=0; i<inputTags.length; i++) 
	{
		var selectname = document.getElementById(inputTags[i].id);
		var selectval = selectname.options[selectname.selectedIndex].value;
		//console.log(selectname);
		console.log(selectval);
		
		if(selectval!="Please select one")
		{
			total = total + parseInt(selectval);
		}
	}
	
	var thediv=document.getElementById('div1');
	thediv.innerHTML = total;
}
/*
	//document.getElementById('select').disabled=false;
	var val = menu.value;
	//var total;
	console.log(document.getElementById('div1').innerHTML);
	if(!document.getElementById('div1').innerHTML)
	{
		total=0;
	}
	else
	{
		total = total;
	}
	
	if (val) 
	{
		var thediv=document.getElementById('div1');
		total = total + parseInt(val);
		thediv.innerHTML = total;
		console.log(total);
 		var extras=document.createElement('div');
		extras.innerHTML='<input type="text" style="width:400px"></input>'
		thediv.appendChild(extras);
		var extras2=document.createElement('div');
		extras2.innerHTML='<input type="checkbox" id="cb1" />'
		thediv.appendChild(extras2);
		var extras3=document.createElement('div');
		extras3.innerHTML='<input type="text" style="width:400px"></input>'
		thediv.appendChild(extras3); 

	}
	
/* 	
	if (choice=="second") 
	{
		var thediv=document.getElementById('div2');
		var extras=document.createElement('div');
		extras.innerHTML='<input type="checkbox" id="cb1"/>'
		thediv.appendChild(extras);
		var extras2=document.createElement('div');
		extras2.innerHTML='<input type="text" id="tbox1"></input>'
		thediv.appendChild(extras2);
		var extras3=document.createElement('div');
		extras3.innerHTML='<input type="checkbox" id="cb1"/>'
		thediv.appendChild(extras3);
		var extras4=document.createElement('div');
		extras4.innerHTML='<textarea></textarea>'
		thediv.appendChild(extras4);
	}
 */
 
</script>
</body>
</html>
