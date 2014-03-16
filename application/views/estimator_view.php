<?php 
//var_dump($arr);
//for ($x = 0;$x<count($arr['materials']) ; $x++)
//{
//		print_r( $arr['materials'][$x][0]);
		//echo '<br />';
		//print_r( $arr[$x][$y])d;
		//echo  '<br />';	
//}
//    echo '<br />' . json_encode($style);
//    echo '<input class="input" type="button" onclick="getarr()" name="fname" />'
$this->load->helper('form');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kona Construction Deck Estimator</title>

  
 <link rel="stylesheet" href="/deckestimator/assets/lib/css/kona.css" />
 <script type="text/javascript" src="/deckestimator/assets/lib/js/kona.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- Css and js addons for vertex features -->

<script type="text/javascript">
//window.onload = function(){
function displaytotal(tot)
{
	var totalarr = document.getElementsByName('total');
	var cost = 0;
	//debugit("displaytotal tot: " + tot);
	//debugit("totalarr 0: " + totalarr[0]);
	for (var i=0; i<totalarr.length; i++) 
	{
		//debugit("totalarr len: " + totalarr[i].innerHTML);
		//display total	
		totalarr[i].innerHTML = '' + tot;
	}
}
//}
</script>
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--<script type="text/javascript" src="http://www.phpadmin.com/konacontractors/deckestimator/assets/mootools/mootools-core-1.4.5.js"></script>-->

</head>

<body>
<div class="clearfix" id="wrap">
		<div id="contentleft">
			<img class="logoimg"  src="/deckestimator/assets/img/s5_logo.png" />
				<form name="the_form" id="form1" method="post">

			<div class="post-left">	
				<div class="section-head">
					<div class="texthead">What are the rough dimensions of the deck?</div>
					<span class="textsub1"><a href="http://www.wikihow.com/Measure-Square-Footage" target="blank">How do I do this?</a></span><br />
					<div id="low_total" name="low_total"></div><div id="high_total" name="high_total"></div>
				</div>
			
				<div class="section-body" id="dims">
					<div class="fields">
						<div class="field" onblur="check_val(value)">Length </div>
						<div class="field" onblur="check_val(value)">Width </div>
						<div class="field">Height: </div>
						<div class="field">Total Square Feet: </div> 
                        <div class="field">Total Linear Feet: </div> 
					</div>
					<div class="inputs" style="display:block;">
						<input class="input" name="dims_length" type="text" id="length" onkeypress='validate(event,"length")' onblur="getdim(this),CheckCheckboxes()" />
						<input class="input" name="dims_width" type="text" id="width" onkeypress='validate(event,"width")' onblur="getdim(this),CheckCheckboxes()" />
						<input class="input" name="dims_height" type="text" id="height" onblur="getdim(this)" />
						<div class="sqft mydims" id="textsqft"></div>
                        <div class="linft mydims" id="textlinft"></div>
					</div>
                    
				</div>
					<!-- <canvas class="draw" id="draw-it" width="200" height="100" style="border:1px solid #d3d3d3;"></canvas> -->
					
			</div>
				
 			<div class="post-left">	
				<div class="section-head" id="framing">
                <?
                echo '<script> var framingarr=';
                echo json_encode($framing->result());
                echo ';</script>';
                ?>	
						 <div class="texthead">Deck Material
                             <span class="note" id="framing_note"></span>
                         </div>
				</div>

                <div id="image">
                    <? foreach ($framing->result() as $val) {
                    if($val->name == "Redwood" || $val->name == "Fiberon")
                    {
                    ?>
                    <div class="itemimg" align="center">
                        <div class = "item_title"><?=($val->name)?></div>
                        <img id="framing_<?=($val->id)?>" src="<?=($val->imgurl)?>" name = "framingradio"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/><br />
                        <input style="vertical-align:bottom;" id="framing_<?=($val->id)?>" align="middle" type="checkbox" name = "framingradio" value="framingradio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes()"/>
                    </div>
                    <?
                    }
                    }
                    ?>
                </div>
            </div>
            
			<div class="post-left">	
				<div class="section-head" id="style">	
                <?
                echo '<script> var stylearr=';
                echo json_encode($style->result());
                //echo json_encode($lights);
                echo ';</script>';
                ?>
						 <div class="texthead">Deck Style
                             <span class="note" id="style_note"></span>
                         </div>
						  <span class="texthead" id="style_total" name="style_total"> </span>
						
				</div>	 
			
				<div id="image">		
					<? foreach ($style->result() as $val) {	?>
						<div class="itemimg" align="center">
						<div id = "item_title" class = "<?=($val->id)?>"><?=($val->name)?></div>
                        <img id="style_<?=($val->id)?>" src="<?=($val->imgurl)?>" name = "styleradio"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/><br />
						<input style="vertical-align:bottom;" id="style_<?=($val->id)?>" align="middle" type="checkbox" name="styleradio" value="styleradio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes()"/>
						</div>
					<? } ?>
				</div>	
			</div>

			<div class="post-left">	
				<div class="section-head" id="railing">	
                <?
                echo '<script> var railingarr=';
                echo json_encode($railing->result());
                //echo json_encode($lights);
                echo ';</script>';
                ?>
						 <div class="texthead">Deck Railing
						  <div class="total" id="railing_total" name="railing_total"></div>
                            <div class="note" id="railing_note" name="railing_note"></div>
                         </div>
                        <div id="railing_remchecks"></div>
				</div>	 
				
				
				<div id="image">		
					<? foreach ($railing->result() as $val) {	?>
						<div class="itemimg" align="center">
                        <div class = "item_title"><?=($val->name)?></div>
                        <img id="railing_<?=($val->id)?>" src="<?=($val->imgurl)?>" name = "railingradio"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/><br />
						<input style="vertical-align:bottom;" id="railing_<?=($val->id)?>" align="middle" type="checkbox" name = "railingradio" value="railingradio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),setvalue(railingarr,<?=$val->id?>),CheckCheckboxes()"/>
						</div>
					<? } ?>
				</div>
			</div>

            <div class="post-left">
                <div class="section-head" id="stairs">
                    <?
                    echo '<script> var stairsarr=';
                    echo json_encode($stairs->result());
                    //echo json_encode($lights);
                    echo ';</script>';
                    ?>
                    <div class="texthead">Deck Stairs
                        <div class="total" id="stairs_total" name="stairs_total"></div>
                        <div class="note" id="stairs_note" name="stairs_note"></div>
                    </div>
                    <div id="stairs_remchecks"></div>
                </div>

                <div id="image">
                    <? foreach ($stairs->result() as $val) {	?>
                        <div class="itemimg" align="center">
                            <div class = "item_title"><?=($val->name)?></div>
                            <img id="stairs_<?=($val->id)?>" src="<?=($val->imgurl)?>" name = "stairsradio"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/><br />
                            <input style="vertical-align:bottom;" id="stairs_<?=($val->id)?>" align="middle" type="checkbox" name = "stairsradio" value="stairsradio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),setvalue(stairsarr,<?=$val->id?>),CheckCheckboxes()"/>
                        </div>
                    <? } ?>
                </div>
            </div>

			<div class="post-left">	
				<div class="section-head" id="lighting">
                <?
                $lights=''; 
                foreach ($lighting->result_array() as $val) {
                $lights .= implode(',',$val);	
                }

                echo '<script> var lightingarr=';
                echo json_encode($lighting->result());
                //echo json_encode($lights);
                echo ';</script>';
                ?>
					<div class="texthead">Deck Lighting
                        <div class="note" id="lighting_note">*Other light styles and types are available</div>
                    </div>
                    <div id="lighting_remchecks"></div>
					 <div class="total" id="lighting_total" name="lighting_total"></div>
				</div> 
				<div id="image">		
					<? foreach ($lighting->result() as $val) {	?>
						<div class="itemimg" align="center">
                        <div class = "item_title"><?=($val->name)?></div>
                        <img id="lighting_<?=($val->id)?>" src="<?=($val->imgurl)?>" name = "lightingradio_mult"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/><br />
						<input style="vertical-align:bottom;" id="lighting_<?=$val->id?>" align="middle" type="checkbox" value="lightingradio_<?=($val->id)?>" name="lightingradio_mult" onchange="checkit(this.name ,this.id),setvalue(lightingarr,<?=$val->id?>),CheckCheckboxes()"/>
						</div>
					<? } ?>
				</div>	
			</div>
			
			<div class="post-left">	
                <div class="section-head" id="extras">
                    <?
                    echo '<script> var extrasarr=';
                    echo json_encode($extras->result());
                    //echo json_encode($lights);
                    echo ';</script>';
                    ?>
                         <div class="texthead">Deck Extras </div>
                          <span id="extras_total" name="extras_total"></span>
                </div>
				<div id="image">		
					<? foreach ($extras->result() as $val) {	?>
						<div class="itemimg" align="center">
                        <div class = "item_title"><?=($val->name)?></div>
                        <img id="extras_<?=($val->id)?>" src="<?=($val->imgurl)?>" name = "extrasradio_mult"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/><br />
						<input style="vertical-align:bottom;" id="extras_<?=$val->id?>" align="middle" type="checkbox" value="extrasradio_<?=($val->id)?>" name="extrasradio_mult" onchange="checkit(this.name ,this.id),setvalue(extrasarr,<?=$val->id?>),CheckCheckboxes()"/>
						</div>
					<? } ?>
				</div>
            </div>

            <div class="post-left">
                <div class="section-head">
                    <span class="texthead">When you're ready...</span><br />
                    <span class="textsub1">Submit this form and one of our friendly estimators will contact you within 24 hours.</span>
                    <span class="note">*Required only when submitting a bid request</span>
                </div>
                <div id="contact">
                    <div class="fields">
                        <span class="field">First Name: </span>
                        <span class="field">Last Name: </span>
                        <span class="field">Email: </span>
                        <!--						<span class="field">Address: </span>
                                                <span class="field">City: </span>
                                                <span class="field">State: </span>
                                                <span class="field">Zip: </span> -->
                    </div>
                    <div class="inputs">
                        <input class="input" type="text" name="fname" />
                        <input class="input" type="text" name="lname" />
                        <input class="input" type="text" name="email" />
                        <!--						<input class="input" type="text" name="address" />
                                                <input class="input" type="text" name="city" />
                                                <input class="input" type="text" name="state" />
                                                <input class="input" type="text" name="zip" />-->

                    </div>
                </div>
            </div>
        <?echo form_submit('mysubmit', 'Submit Post!');?>
		</form>
		</div>
	</div>
</div>
</div>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
<script type="text/javascript">

//---------------> setvalue <----------------//

function setvalue(arr,id,mult_total)
{
    console.log("cost_mult: " + mult_total)
    for(var i=0;i<arr.length;i++)
    {
        if (arr[i]['id'] == id) var rw = arr[i]; 
    }
    
    if(rw['rate_min'])var rate_min = rw['rate_min'];
    if(rw['rate_max'])var rate_max = rw['rate_max'];
    var unit = rw['unit_type'];
    var qty = 4;
   // debugit('unit:\t' + unit);
    switch(unit)
	{
		case "1": 
        {
            console.log("total div for element: " + rw['class'] + '_total');
            var qty = mult_total;
            console.log("qty: " + qty)
            if (qty<1) qty=1;
            var low_total = (rate_min*qty);
           // if(mult_total) low_total = low_total + mult_total;
            var high_total = (rate_max*qty);
          //  debugit('total:\t' + total);
            break;
        }
		case "2": 
        {
            var thediv=document.getElementById('textsqft');
            var sqft = thediv.innerHTML;
            if(sqft)
            {
            //console.log((rw['class'] + '_total'));
            var low_total = (sqft*rate_min);
            if(mult_total) low_total = low_total * mult_total;
            var high_total = (sqft*rate_max);
            if(mult_total) high_total = high_total * mult_total;
           // console.log("low total: " + low_total);
            }
            break;
        }
        case "3": 
        {
            var qty = mult_total;
            if (qty<1) qty=1;
/*            var thediv=document.getElementById('textlinft');
            var linft = thediv.innerHTML;
            //console.log(linft);
            var num_rails = qty;*/
            var low_total = qty*rate_min;
            var high_total = qty*rate_max;
            console.log('Linear feet low total:\t'+low_total);
            //console.log('high total:\t'+high_total);
            break;
        }
  }
    
    var tot=document.getElementById(rw['class'] + '_total');
    console.log(low_total);
    console.log(high_total);
    console.log(tot);
    if(low_total && high_total && tot)
    {
        //debugit(total);
        console.log("tot innerhtml" + tot.innerHTML );
        tot.innerHTML = low_total.toFixed(2);
        return low_total.toFixed(2);
    }
    
}

//---------------> page_section <----------------//

function page_section()
{
    var arr = new array('framing','style','railing','lighting','extras');
    var total = 0;
    for(var x=0;x<arr.count;x++)
    {
        var tot = document.getElementById(arr[x]+'_total');
        if (tot) total = total+tot;
        //debugit(arr[x] + '_total:\t' + tot);
    }
   // debugit('total:\t' + total);
}

//---------------> CheckIt <----------------//

function checkit(name,id)
{
    //var name = theName.split("_")[0];
    //console.log('checkit:\t' + id);
    var myname = name;
    var n=0;
    var mult = false;
    var check = document.getElementsByName(name);
    var myChk = document.getElementById(id);
    //console.log('myChk name:\t' + myChk.name);
    var mult_check = myname.indexOf('_');
    console.log("\t\tmult_check:\t" + mult_check);
    if(mult_check>0)
    {
        myname = myname.split('_')[0];
        mult = true;
        console.log('name after split:\t' + myname);
    }
    for (var c=0;c<check.length;c++)
    {
        //console.log('checkname:\t' +check[c].name.split('_')[0]);
        if(check[c] && check[c].type=="checkbox")
        {
            if(check[c].name.split('_').length>0)
            {
                cname = check[c].name.split('_')[0];
                cid = check[c].name.split('_')[1]
                //console.log('cname:\t' + cname);
            }
            console.log(myname + ' checkit-id:\t' + id + ':' + check[c].checked);
            console.log('checkit id:\t' + check[c].id);
            console.log('checkit name:\t' + check[c].name);
           switch(check[c].checked)
           {
               case false:
                   if(mult==false)
                   {
                       if(cname == myname && check[c].id == id)
                       {
                           check[c].checked=true;
                       }
                   }
                   else
                   {
                        if(cname == myname && check[c].id == id) check[c].checked=true;
                   }
               break;
               case true:
                   if(mult==false)
                   {
                       if(cname == myname && check[c].id != id)
                       {
                           check[c].checked=false;
                       }
                   }
                   else
                   {
                       var nm = myname + "_" + cid;
                       //console.log("remchk:\t" + nm);
                       if(cname == myname && check[c].id == id)
                       {
                           check[c].checked=false;
                           var myid = id.split('_')[0];
                           //var m = remCheck(name);
                           var b = document.getElementById(myid + "_total");
                           b.innerHTML = "";
                           //console.log("b:\t" + b);
                           //console.log("myid:\t" + myid + "_total");
                           //console.log("m:\t" + m)
                       }

                   }
               break;
           }


        }
        ////console.log('type:\t' + check[c].type);
    }

    if(myChk && myChk.checked==true)
    {
       /* //console.log(name + ' myChk true:\t' + myChk.checked);
        //console.log('myChk true:\t' + myChk.innerHTML);*/
        myChk.checked=false;
    }
    else if(myChk)
    {
        /*//console.log(name + ' myChk type:\t' + myChk.type);
        //console.log(name + ' myChk false:\t' + myChk.checked);
        //console.log('myChk false:\t' + myChk.name);*/
        myChk.checked=true;
    }
 }

//---------------> CheckCheckboxes <----------------//

function CheckCheckboxes(id){
    //console.log("op:\t" + op);
    var n=0;
    var lightcount = 0;
    var elLength = document.the_form.elements.length;
    var total = 0;
    var mat = 1;
    var tot=0;
    var thediv=document.getElementById('textsqft');
    var lindiv=document.getElementById('textlinft');
    var sqft = thediv.innerHTML;
    //console.log('sqft:\t'+ sqft);
    for (i=0; i<elLength; i++)
    {
        var type = the_form.elements[i].type;

        if (type=="checkbox")
        {
                var f = the_form.elements[i];
                //console.log("The Name: " + the_form.elements[i].name);
                if (f) var mytype = f.id.split('_');
                var name = mytype[0];
                var myid = mytype[1];

            switch(name)
            {
                case "framing":

                    //tot = setvalue(framingarr,myid);
                    //console.log("framing" + tot);
                    break;

                case "style":
                    if(the_form.elements[i].checked)
                    {

                        var frame_type = frameit();
                        //console.log("frame type: " + frame_type);
                        if (frame_type == 'Fiberon')
                        {
                            //console.log('sqft2:\t' + Number(sqft).toFixed(2)*1.5);
                            //tot = tot + (Number(sqft).toFixed(2)*1.5);
                            tot = setvalue(stylearr,myid,1.5);
                            //console.log('tot post:\t' + tot);
                        }
                        else
                        {
                            tot = setvalue(stylearr,myid);
                        }
                        //console.log(type + ' total:\t'+setvalue(stylearr,type[1]));
                    }
                break;

                case "railing":
                    if(the_form.elements[i].checked)
                    {
                        var deck_height = document.getElementById("height").value;
                        var deck_length = document.getElementById("length").value;
                        var railing_rem = document.getElementById("railing_remchecks");
                        console.log("railing deck_length: " + deck_length);
                        console.log("railing deck_height: " + deck_height);
                        var rail_div_name = "&quot;railingradio&quot;,&quot;railing_total&quot,&quot;railing_remchecks&quot;";
                        //var rail_total_name = "railing_total";
                        railing_rem.innerHTML = "<span id = 'railing_rem' class='remove_it' onclick='remCheck(" + rail_div_name + ")'>Clear Checkboxes</span>";
                        //console.log()
                        //get linear feet
                        var lf = Number(document.getElementById("textlinft").innerHTML);
                        console.log("railing lf:" + lf);
                        //qty = linft/12
                        var qty = lf-deck_length;
                        console.log("railing qty:" + qty);
                        tot = setvalue(railingarr,myid,qty);
                        //console.log(type + ' total:\t'+total+tot);
                    }
                break;

                case "lighting":
                    {
                        var light_div=document.getElementById('lighting_total');
                        var lighting_rem = document.getElementById("lighting_remchecks");
                        var light_div_name = "&quot;lightingradio_mult&quot;,&quot;lighting_total&quot,&quot;lighting_remchecks&quot;";
                        //var rail_total_name = "railing_total";
                        lighting_rem.innerHTML = "<span id = 'lighting_rem' class='remove_it' onclick='remCheck(" + light_div_name + ")'>No Thanks</span>";
                        //console.log("lightingarr:\t\t" + lightcount);
                        var light_total = lightit();
                        //tot = setvalue(lightingarr,myid,light_total[0]+140);
                        //console.log(type + ' total:\t'+total+tot);
                    }

                break;

                case "stairs":
                    var stairs_rem = document.getElementById("stairs_remchecks");
                    var light_div_name = "&quot;stairsradio&quot;,&quot;stairs_total&quot,&quot;stairs_remchecks&quot;";
                    //var rail_total_name = "railing_total";
                    stairs_rem.innerHTML = "<span id = 'stairs_rem' class='remove_it' onclick='remCheck(" + light_div_name + ")'>No Thanks</span>";
                    if(the_form.elements[i].checked)
                    {
                        var stairs_total = stepit();
                        //tot = setvalue(stairsarr,myid);
                        //console.log(type + ' total:\t'+total+tot);
                    }
                break;

                case "extras":
                    if(the_form.elements[i].checked)
                    {
                        console.log("CheckIt extras: " + myid);
                        tot = setvalue(extrasarr,myid,1);
                    }
                break;
                
            }

            total = total+Math.round(tot);

        }
    }

    var thediv = document.getElementById('low_total');
    thediv.innerHTML='Current Total:\t $' + low_total;
    var thediv = document.getElementById('high_total');
    thediv.innerHTML='Current Total:\t $' + high_total;
}

//---------------> remCheck <----------------//

function remCheck(name,total_div,rem_div)
{
    var n=0;
    if(name)console.log("total_div:\t" + total_div);
    var check = document.getElementsByName(name);
    if(check)
    {
        console.log(document.getElementById(total_div).innerHTML);

        for (var c=0;c<check.length;c++)
        {
            //console.log(check[c].name);
            //console.log(check[c].checked);
            if(check[c].type=="checkbox" && check[c].checked == true) check[c].checked = false;
        }
    }
    if(total_div) document.getElementById(total_div).innerHTML = "";
    if(rem_div) document.getElementById(rem_div).innerHTML = "";
    //return n;
}

//---------------> frameit <----------------//

function frameit()
{
    var val = document.getElementsByName('framingradio');
    //console.log("frameit len: " + val.length);
    for(var i =0;i<val.length;i++)
    {
        var type = val[i].type;
        if (type=="checkbox")
        {
            if(val[i].checked == true)
            {
                //console.log("val checked: " + val[i].id);
                var id = val[i].id.split("_")[1];
                //console.log("frameit id: " + id);
                for(var n =0;n<framingarr.length;n++)
                {
                    if (framingarr[n]['id'] == id)
                    {
                        //console.log("framingarr id: " + framingarr[n]['id']);
                        return framingarr[n]['name'];
                    }
                }
            }
        }
    }
}

function lightit()
{
    var min_total = Number(document.getElementById("lighting_total"));
    if(!min_total) min_total=0;
    //var max_total = 0;
    var total_arr = new Array();
    var val = document.getElementsByName('lightingradio_mult');
    console.log("lightit len: " + val.length);
    for(var i =0;i<val.length;i++)
    {
        var type = val[i].type;
        if (type=="checkbox")
        {
            if(val[i].checked == true)
            {
                //console.log("val checked: " + val[i].id);
                var id = val[i].id.split("_")[1];
                //console.log("frameit id: " + id);
                for(var n =0;n<lightingarr.length;n++)
                {
                    if (lightingarr[n]['id'] == id)
                    {
                        min_total = min_total + Number(lightingarr[n]['rate_min']);
                        console.log('lighting min: ' + lightingarr[n]['rate_min']);
                        var max_total = max_total + Number(lightingarr[n]['rate_max']);
                        console.log('lighting max: ' + lightingarr[n]['rate_max']);
                    }
                }
            }
        }
    }

    var light_total=document.getElementById('lighting_total');
    if(min_total>0)
    {
        //debugit(total);
        //console.log(tot.innerHTML );
        var transformer = Number('140');
        var tot = Number(min_total);
        var total = (tot + transformer);
        light_total.innerHTML = total.toFixed(2);
    }
    else
    {
        light_total.innerHTML = "";
        document.getElementById("lighting_rem").innerHTML = "";
    }

}

function stepit()
{
    var stair_total = document.getElementById("stairs_total");
    var val = document.getElementsByName('stairsradio');
    var height = document.getElementById('height');
    console.log("height: " + Number(height.value));
    if (Number(height.value)>0)
    {
        console.log("stair_total: " + stair_total.innerHTML);
        console.log("val length: " + val.length);
        console.log("height: " + height.value);
        var tot = (Number(height.value)*12);
        var qty = Math.ceil(tot/7);
        console.log("qty: " + qty);
        var qtylights = 1;
        if (qty <= 3 && qty > 1) qtylights = 2;
        else qtylights = qty/3;
        console.log("qty lights: " + qtylights);
        //console.log("frameit len: " + val.length);
        for(var i =0;i<val.length;i++)
        {
            var type = val[i].type;
            if (type=="checkbox")
            {
                if(val[i].checked == true)
                {
                    //console.log("val checked: " + val[i].id);
                    var id = val[i].id.split("_")[1];
                    //console.log("frameit id: " + id);
                    for(var n =0;n<stairsarr.length;n++)
                    {
                        if (stairsarr[n]['id'] == id)
                        {
                            var min_total = stairsarr[n]['rate_min'];
                            var max_total = stairsarr[n]['rate_max'];
                            if(stairs_total && qty)
                            {
                                document.getElementById("stairs_note").innerHTML = "<div id='numsteps' class=''>Steps: " + qty + "</div>";
                                stairs_total.innerHTML ="Between $" + (min_total * qty) + " and $" + (max_total * qty);
                            }
                            //console.log("framingarr id: " + framingarr[n]['id']);
                            return stairsarr[n]['name'];
                        }
                    }
                }
            }
        }
    }
}

//---------------> getdim <----------------//

function getdim(menu)
{
// if we have Length and Width do something
// don't forget we also need linear feet

    var dimtype = menu.id; //split('_');


    if (dimtype == "length" || dimtype == "width")
    {
        var length = document.getElementById("length").value;
        var width = document.getElementById("width").value;
    }
    if(dimtype == "height")
    {
        var height = document.getElementById("height").value;
        var rail_note_div = document.getElementById("railing_note");
        if (height>3)
        {
            railing_note.innerHTML = "<br />According to Colorado building code, decks over the height of 3' above grade are required to have a railing."
        }
        else
        {
            railing_note.innerHTML = "";
        }
    }

    if (!length) var length = 1;
    if (!width) var width = 1;
        var sqft = length*width;
        var linft = (length*2 + width*2);
        if(width>1 && length>1)
        {
        var thediv=document.getElementById('textsqft');
        thediv.innerHTML = sqft;
        var lin=document.getElementById('textlinft');
        lin.innerHTML = linft;
        }

/*    for (var i=0; i<dimtags.length; i++)
    {
        var val = parseInt(dimtags[i].value);
        var id = dimtags[i].id
        if(isNaN(val)) val=0;

        switch(dimtags[i].id)
        {
            case "length":
            {
                if(val>0)
                {
                    sqft = findval(val,id,sqft,linft,"sqft");
                    lensqft = val;
                    linft = linft + val;//findval(val,id,sqft,linft,"linft");
                    mydims.push(val);
                    val=0;

                    //console.log("\t\treturned length sqft: " + sqft);
                }
            }

            case "width":
            {
                if(val>0)
                {
                    //console.log("width val: " + val);
                    sqft = findval(val,id,sqft,linft,"sqft");
                    linft = linft + val*2;//findval(val,id,sqft,linft,"linft");
                    mydims.push(val);
                    val=0;
                    //console.log("\t\treturned width sqft: " + sqft);
                }
            }

            case "height":
            {
                if(val>0)
                {
                    val=0;
                    //console.log("\t\treturned height sqft: " + sqft);
                }
            }
        }

    }*/

}
</script>

</body>
</html>