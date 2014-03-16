
function check_val(myVal)
{
    //console.log(myVal);
    var f = document.getElementById(myVal.id)
    if (myVal.value == "")
    {
        alert('Please fill out this field to continue');
        f.focus();
    }
}


function getarrvalue(val,arrname)
{
	//console.log(arrname);
	var thearr = getarr();
	var arr = thearr[arrname];
	//console.log(arr);
	var arrlen = arr.length;
	for(var i=0; i<arrlen; i++)
	{
		var len = arr[i].length;
		//console.log("arr[i] val: " + arr[i].value);
		for(var x=0; x<len; x++)
		{
		//	console.log("getarrvalue: " + arr[i]);
			if(arr[i][x]==val)
			{
				return arr[i];
			}
		}
		
	}
}


function getvalues()
{
	var total=0;
	var dim = document.getElementsByName('dims');
	var sqft = document.getElementById('textsqft').innerHTML;
	var darr = new Array();
	for (var x=0; x<dim.length;x++)
	{
		var val = (!isNaN(dim[x].value)) ? dim[x].value : "1";
		darr.push(val);
	}

	sqft = parseInt(sqft);
	var dstyle = deckstyle(stylearr);
    //console.log('dstyle:\t'+ dstyle);
	var dmat = deckmaterial();
	var dpiers = deckpier();
	total = total + parseInt(dpiers);
	var dframing_total = deckframing(framingarr,darr,dmat,dstyle);
	//console.log('dframing_total: ' + parseInt(dframing_total));
	total = total + parseInt(dframing_total);
	var drailing = deckrailing(railingarr);
	var dlighting = decklighting(lightingarr);
	var dextras = deckextras();	
	total = total + dextras;
	//console.log('getvalues total: ' + total);
	displaytotal(total);
}


function deckpier()
{
//need peir formula from Ryan
	return (115*4);
}

function deckframing(arr,id)
{
    var total = 0;
	var total = 1;
    var dlen=document.getElementById('length').value;
    var dwidth=document.getElementById('width').value;
    var sqft = dlen*dwidth;
    console.log('id:\t' + id);
    for(var x=0;x<arr.length;x++)
    {
   	    var rw = arr[x]; 
        if(rw['name'].toLowerCase() == id)
        {
            var rate = rw['rate_min'];
        	//console.log("deckframing fn sqft: " + sqft);
        	var thick = "2x8";
        	if(dwidth>12) thick = "2x10";
            {
            	//console.log("deckframing fn material: " + rw['name']);
            	if(rw['dim'] == thick) //found 2x thickness
            	{
            	//	console.log("deckframing fn material: " + rw['name']);
            	//	console.log("deckframing fn rate: " + rate);
            		total = rate*sqft;
            	   console.log("deckframing fn total: " + total);
                    var tot = document.getElementById('framing_style');
                    tot.innerHTML = 'Section Cost:\t$' + total;
            		return parseInt(total);
            	}
            }
        }
    }
	return 1;
}


function deckmaterial()
{
// if no material is specified use redwood as default
// on radio selection, grey out other images in div
	var radtagsN = document.getElementsByName('matradio');
	var markup = 0;
//console.log("name: " + radtagsN);
	for (var i=0; i<radtagsN.length; i++) 
	{
		var btn = radtagsN[i];
		if (btn.checked)
		{
			return(btn.id);
		}
	}
}


function deckstyle(arr)
{
//alert(arr[0]['name']);
// if diagonal, change structure to 12" Narrow OC
// if length > 12' then 2x10's are needed.
	var radtagsN = document.getElementsByName('styleradio');
	var markup = 0;
//console.log("name: " + radtagsN);
	for (var i=0; i<radtagsN.length; i++) 
	{
		var btn = radtagsN[i];
		if (btn.checked)
		{
		  for(var x=0;x<arr.length;x++)
            {
               // console.log(arr['rate_min']);
                if(arr['name']==btn.id)
                {
                 //   console.log(arr['rate_min']);
                    return(arr['rate_min']);          
                } 
            }
		}
	}
}

function deckrailing()
{
	var radtagsN = document.getElementsByName('railradio');
	var cost = 0;
//console.log("name: " + radtagsN);
	for (var i=0; i<radtagsN.length; i++) 
	{
//		var v = "id: " + radtagsN[i].id + "  name: " + radtagsN[i].name + "  value: " + radtagsN[i].value;
//		console.log("v: " + v);
		switch(radtagsN[i].id)
		{
			case "Composite Rail Fortress Balusters": cost = 1.75;
			case "Metal Rail Panels": cost = 1.0;
		}
	}
	
	return cost;
}

function decklighting()
{
}


function deckstair()
{
// add width option
// closed riser

}

function resetradio()
{
	tag = '<div id="extras" name="remextras" class="remextras" onclick="resetradio()">Remove</div>';
	var rad = document.getElementsByName('extraradio');
	var rem = document.getElementsByName('remextras');
	if(rem[0].innerHTML != '') rem[0].innerHTML='';
	rad[0].checked = false;
	getvalues();
}

function deckextras()
{
	//var rem = document.getElementsByName('removeextra');
	var rad = document.getElementsByName('extraradio');
	//resetradio(rad);
/* 	if (rad[0].value == 'on')
		{
			rad[0].checked = false;
			rad[0].value = 'off';
		} */
		for (var i=0; i<rad.length; i++) 
		{
			//console.log(rad[i].value);
			if (rad[i].checked)
			{
				//toggle remove button
				tag = '<div id="extras" name="remextras" class="remextras" onclick="resetradio()">Remove</div>';
				var rem = document.getElementsByName('remextras');
				(rem[0].innerHTML == '') ? rem[0].innerHTML += tag : rem[0].innerHTML='';
				//console.log("deckextra: " + rad[i].id);
				var val = getarrvalue(rad[i].id,"extras");
				//console.log("extras: " + val);
				var cost = calculatedim(val[1],val[2],"extra cost");
				return cost;
				//var v = "id: " + radtagsN[i].id + "  name: " + radtagsN[i].name + "  value: " + radtagsN[i].value;
				//console.log("v: " + v);
			}
			else
			{
				
				return 0;
			}
		}
	
	//return cost;
	
}

function findval(val,id,sf,lf,type)
{
	
		/*
		console.log("\tfindval id: " + id);
		console.log("\tfindval type: " + type);
		console.log("\tfindval sf: " + sf);
		console.log("\tfindval lf: " + lf);
		*/
		switch(type)
		{
		case "sqft":
			{
				//console.log(dim.id + " :" + parseInt(dimtags[i].value));	
				sf = sf*val;
				//console.log(id + " square ft: " + sf);
				return sf;
			}
		case "linft":
			{
				//console.log(id + " :" + val);	
				lf = lf+val;
				//console.log("\t" + id + " linear ft: " + lf);
				return lf;	
			}
		}
}




/* function drawline(dim)
{
	var dimtags = document.getElementsByName("dims");
	var sqft = 1;
	var length = 1;
	var width = 1;
	var height = 1;
	var mydims = new Array(); // (point1,point2)
	for (var i=0; i<dimtags.length; i++) 
	{
		//console.log(dimtags[i].id) 
		if (parseInt(dimtags[i].value)>0)
		{
			//console.log(dim.id + " :" + parseInt(dimtags[i].value));
			
			sqft = sqft*parseInt(dimtags[i].value);
		}
		
	
	console.log(sqft);
	var c=document.getElementById("draw-it");
	var val = parseInt(dimtags[i].value);

	if(isNaN(val)) val=0;
	console.log("val: " + val);
	s
	switch(dimtags[i].id)
	{
	case "length": 
		{
			if(val>0)
			{
			var ctx=c.getContext("2d");
			ctx.strokeStyle = '#ff0000';
			ctx.moveTo(5,5);
			ctx.lineTo(195,5);
			ctx.stroke();
			val = 0;
			}
		}

	case "width": 
		{
			if(val>0)
			{
			var ctx1=c.getContext("2d");
			ctx1.strokeStyle = '#ff0000';
			ctx1.moveTo(5,5);
			ctx1.lineTo(5,90);
			ctx1.stroke();
			var ctx2=c.getContext("2d");
			ctx2.strokeStyle = '#ff0000';
			ctx2.moveTo(195,5);
			ctx2.lineTo(195,90);
			ctx2.stroke();
			}

		}

	case "height":
		{
			if(val>0)
			{
			}
		}
	default:1
	}
	
	}
} 

function handleSelection(menu) 
{
	
	var total=0;
	var thesqft = document.getElementById('textsqft');
	console.log("thesqft: " + thesqft.innerHTML);
	var arr = <?php echo json_encode($arr) ?>;
	var dimtags = document.getElementsByName("dims");
	var markup;
	var tag;
	var total = 0;
	var name = "";
	var avgrate = 0;
	var unit = 0;
	var avgqty = 0;
	for (var i=0; i<dimtags.length; i++) 
	{
		if (!dimtags[i].value)
		{
			console.log(dimtags[i].name + ": " + parseInt(dimtags[i].value));
		}
		else
		{
			console.log("dim: empty");
		}
	}
}
function handleSelection2(menu) 
{
	var total=0;
	var arr = <?php echo json_encode($arr) ?>;
	var frm = document.getElementById("form1");
	var inputTags = document.getElementsByTagName("select");
	var dimtags = document.getElementsByName("dims");
	var markup;
	var tag;
	var total = 0;
	var name = "";
	var avgrate = 0;
	var unit = 0;
	var avgqty = 0;
	
 	for (var i=0; i<dimtags.length; i++) 
	{
		if (!dimtags[i].value)
		{
			console.log(dimtags[i].name + ": " + parseInt(dimtags[i].value));
		}
		else
		{
			console.log("dim: empty");
		}
	}
	

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
				
				console.log("\tunit: " + unit + "\tavg qty: " + avgqty + "\tmarkup: " + markup);
				if(avgrate && unit && avgqty)
				{
					console.log("\tname: " + name + "\taverage_qty: " + avgqty + "\taverage_rate: " + avgrate);
					console.log("section total: " + avgrate*avgqty);
					var total = total + (avgrate*avgqty);
					console.log("TOTAL: " + total);
				}
			}
		}
		
		markup = checkRadioButtons(menu);
		total = total * markup;
		//console.log(selectname);
		//console.log(selectval);
		//for (var n=0 ; n<arr[selectval])
		if(selectval!="Please select one")
		{
			//total = total + parseInt(total);
		}
	}
	
	var thediv=document.getElementById('total');
	thediv.innerHTML = "$" + total;
}
*/
function calculatedim(num1,num2,str) 
{
	//console.log("num1: " + num1);
	//console.log("\t\t" + str + ": " + (num1+num2)/2);
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
/*
	$( "img" ).hover(
	function() {
	  //console.log("here");
	  	$( this ).fadeTo( "slow" , 0.5 ),
	 	$( this ).append( $( "<span> ***</span>" ) );
	}, 
	function() {
		 $( this ).fadeTo( "slow" , 1.0 ),
		$( this ).find( "span:last" ).remove();
	}
	);
 
 $( "img.fade" ).hover(function() {
  $( this ).fadeOut( 100 );
  $( this ).fadeIn( 500 );
}); */

function debugit(str)
{
	var d = true;
	if(d)
	{
		console.log(str)
	}
}