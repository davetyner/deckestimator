function setvalue(arr,id,mult_total)
{
    var low_total=0;
    var high_total=0;
    //console.log("cost_mult: " + mult_total)
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
            //console.log("total div for element: " + rw['class'] + '_total');
            var qty = mult_total;
            //console.log("qty: " + qty)
            if (qty<1) qty=1;
                low_total = (rate_min*qty);
            // if(mult_total) low_total = low_total + mult_total;
                high_total = (rate_max*qty);
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
                low_total = (sqft*rate_min);
                if(mult_total) low_total = low_total * mult_total;
                high_total = (sqft*rate_max);
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
                low_total = qty*rate_min;
                high_total = qty*rate_max;
            //console.log('Linear feet low total:\t'+low_total);
            //console.log('Linear feet high total:\t'+high_total);
            break;
        }
    }

    var tot_low=document.getElementById(rw['class'] + '_low_total');
    var tot_high=document.getElementById(rw['class'] + '_high_total');
/*    console.log(low_total);
    console.log(high_total);
    console.log(tot);*/
    if(low_total && high_total && tot_low && tot_high)
    {
        //debugit(total);
        //console.log("tot_low innerhtml" + tot_low.innerHTML );
        tot_low.innerHTML = '$' + low_total.toFixed(2);
        tot_high.innerHTML = '$' + high_total.toFixed(2);
        //return low_total.toFixed(2);
    }

}

//---------------> validate <----------------//

//validate numbers in input
function validate(evt,id) {
    var el=document.getElementById(id);
    el.onkeydown=function onlyNumbers(evt) {
        var theEvent = evt || window.event,
            key = theEvent.keyCode || theEvent.which,
            exclusions=[8,9,96,97,98,99,100,101,102,103,104,105]; /*Add exceptions here */
        if(exclusions.indexOf(key)>-1){return;}
        key = String.fromCharCode(key);
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
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
    //console.log("\t\tmult_check:\t" + mult_check);
    if(mult_check>0)
    {
        myname = myname.split('_')[0];
        mult = true;
        //console.log('name after split:\t' + myname);
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
            //console.log(myname + ' checkit-id:\t' + id + ':' + check[c].checked);
            //console.log('checkit id:\t' + check[c].id);
            //console.log('checkit name:\t' + check[c].name);
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
                            var b = document.getElementById(myid + "_low_total");
                            if(b)
                            {
                                b.innerHTML = "";
                            }
                            else
                            {
                                var b = document.getElementById(myid + "_low_total_b");
                                b.innerHTML = "";

                            }
                            var h = document.getElementById(myid + "_high_total");
                            if(h)
                            {
                                h.innerHTML = "";
                            }
                            else
                            {
                                var h = document.getElementById(myid + "_high_total_b");
                                h.innerHTML = "";

                            }
                            //console.log("b:\t" + b);
                            //console.log("myid:\t" + myid + "_total");
                            //console.log("m:\t" + m)
                        }

                    }
                    break;
            }


        }
        //console.log('type:\t' + check[c].type);
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

function CheckCheckboxes3(id,m){
    //console.log(statsarr);
    if(m)console.log("id:\t" + id);
    var n=0;
    var lightcount = 0;
    var low_total=0;
    var high_total=0;
    var elLength = document.the_form.elements.length;
    var total = 0;
    var mat = 1;
    var tot=0;
    var span=document.getElementById('width').value;
    var sqft=document.getElementById('textsqft').innerHTML;
    var linft=document.getElementById('textlinft').innerHTML;

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
                case "deckmat":
                {

                    //get framing array
                    //get base cost = square feet * min & max


                    //check decking_options
                    //get span value set dim

                    var dim = "2x8";
                    if(span>12) dim = "2x10";
                    //get name from selected radio and database to the material name
                    if(m == 'mult')
                    {
                        var sec_name = "deckingoptionsbord";
                        var do_type = quickcheck(sec_name + "radio_mult",deckingoptionsarr,"name");
                    }
                    else
                    {
                        var sec_name = "deckingoptions";
                        var do_type = quickcheck(sec_name + "radio",deckingoptionsarr,"name");
                    }
                    if(m != 'mult')
                    {
                        for(var n=0;n<framingarr.length;n++)
                        {
                            var rw = framingarr[n];
                            var baserate = getbaserate(sec_name,rw,sqft);

                        }
                    }
                    else
                    {
                        for(var n=0;n<framingarr.length;n++)
                        {
                            var rw = framingarr[n];
                            if(rw['name']=='base')
                            {
                                var minrate = Number(rw['rate_min']);
                                var maxrate = Number(rw['rate_max']);
                                var base_mincost = sqft * minrate;
                                var base_maxcost = sqft * maxrate;
                            }
                        }
                    }


                    var mat = quickcheck("deckmatradio",deckmatarr,"qname");
                    //console.log("do type:" + do_type);
                        for(var n=0;n<framingarr.length;n++)
                        {

                            var rw = framingarr[n];
                            //console.log("dim:\t" + rw['dim'] + '\t basedim:\t'+dim);
                            //console.log("material:\t" + rw['material'] + '\t mat:\t'+mat);
                            //console.log('rw:\t' + rw['name']);
                            if(rw['dim'] == dim && rw['style'] == do_type && rw['material'] == mat)
                            {

                                if(rw['name']!="base" && rw['name']!="border")
                                {
                                    //console.log("name:\t" + rw['name']);
                                    var final_min_rate = minrate + Number(rw['rate_min']);
                                    //console.log("final_min_rate\t" + final_min_rate);
                                    var final_max_rate = maxrate + Number(rw['rate_max']);
                                    var min_total = (final_min_rate*sqft)-baserate[0];
                                    var max_total = (final_max_rate*sqft)-baserate[1];
                                    var low_tot = document.getElementById(sec_name + '_low_total');
                                    var high_tot = document.getElementById(sec_name + '_high_total');
                                    var base_low_tot = document.getElementById('deckmat_low_total');
                                    var base_high_tot = document.getElementById('deckmat_high_total');
                                    base_low_tot.innerHTML = '$' + min_total;
                                    base_high_tot.innerHTML = '$' + max_total;
                                    low_tot.innerHTML = '$' + min_total;
                                    high_tot.innerHTML = '$' + max_total;
                                }
                            }
                            else if(do_type=="border")
                            {
                                //console.log("rate_max\t" + rw['rate_max']);
                                var final_min_rate = minrate + Number(rw['rate_min']);
                                //console.log("final_min_rate\t" + final_min_rate);
                                var final_max_rate = maxrate + Number(rw['rate_max']);
                                var min_total = final_min_rate*linft;
                                var max_total = final_max_rate*linft;
                                //console.log("HELLO\t" + min_total);
                                var low_tot = document.getElementById(sec_name + '_low_total_b');
                                var high_tot = document.getElementById(sec_name + '_high_total_b');
                                low_tot.innerHTML = '$' + min_total;
                                high_tot.innerHTML = '$' + max_total;
                            }
                        }

                }
                    break;

                case "deckingoptions":

       /*             if(the_form.elements[i].checked)
                    {

                        //var frame_type = frameit();
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
                    }*/
                    break;

                case "railing":
                    if(the_form.elements[i].checked)
                    {
                        var deck_height = document.getElementById("height").value;
                        var deck_length = document.getElementById("length").value;
                        var railing_rem = document.getElementById("railing_remchecks");
                        //console.log("railing deck_length: " + deck_length);
                        //console.log("railing deck_height: " + deck_height);
                        var rail_div_name = "&quot;railingradio&quot;,&quot;railing_low_total&quot,&quot;railing_high_total&quot,&quot;railing_remchecks&quot;";
                        //var rail_total_name = "railing_total";
                        railing_rem.innerHTML = "<span id = 'railing_rem' class='remove_it' onclick='remCheck(" + rail_div_name + ")'>Clear Checkboxes</span>";
                        //console.log()
                        //get linear feet
                        var lf = Number(document.getElementById("textlinft").innerHTML);
                        //console.log("railing lf:" + lf);
                        //qty = linft/12
                        var qty = lf-deck_length;
                        //console.log("railing qty:" + qty);
                        tot = setvalue(railingarr,myid,qty);
                        //console.log(type + ' total:\t'+total+tot);
                    }
                    break;

                case "lighting":
                {
                    var light_div=document.getElementById('lighting_low_total');
                    var lighting_rem = document.getElementById("lighting_remchecks");
                    var light_div_name = "&quot;lightingradio_mult&quot;,&quot;lighting_low_total&quot,&quot;lighting_high_total&quot,&quot;lighting_remchecks&quot;";
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
                    var light_div_name = "&quot;stairsradio&quot;,&quot;stairs_low_total&quot,&quot;stairs_high_total&quot,&quot;stairs_remchecks&quot;";
                    //var rail_total_name = "railing_total";
                    stairs_rem.innerHTML = "<span id = 'stairs_rem' class='remove_it' onclick='remCheck(" + light_div_name + ")'>No Thanks</span>";
                    if(the_form.elements[i].checked)
                    {
                        var stairs_total = stepit();
                        //tot = setvalue(stairsarr,myid);
                        console.log(type + ' total:\t'+stairs_total);
                    }
                    break;

                case "extras":
                    if(the_form.elements[i].checked)
                    {
                        //console.log("CheckIt extras: " + myid);
                        tot = setvalue(extrasarr,myid,1);
                    }
                    break;

            }

            total = total+Math.round(tot);

        }
    }
    if(low_total)
    {
        var thediv = document.getElementById('low_total');
        thediv.innerHTML='Current Total:\t $' + low_total;
    }
    if(high_total)
    {
        var thediv = document.getElementById('high_total');
        thediv.innerHTML='Current Total:\t $' + high_total;
    }

    get_total();
}

function getbaserate(sec_name,rw,sqft)
{
/*    console.log("name:\t" + rw['name']);
    console.log("section name\t" + sec_name);*/
    var base_min_rate = Number(baseratemin['rate_min']);
    var base_max_rate = Number(baseratemax['rate_max']);
    var base_min_total = base_min_rate*sqft;
    var base_max_total = base_max_rate*sqft;
    return Array(base_min_total,base_max_total);
/*    var low_tot = document.getElementById(sec_name + '_low_total');
    var high_tot = document.getElementById(sec_name + '_high_total');
    low_tot.innerHTML = '$' + base_min_total;
    high_tot.innerHTML = '$' + base_max_total;*/
}

function quickcheck(elname,dbname,fieldname)
{
    var elLength = document.the_form.elements.length;
    for (var i=0; i<elLength; i++)
    {
        var ftype = document.the_form.elements[i].type;
        var fid = document.the_form.elements[i].id.toLowerCase();
        var fname = document.the_form.elements[i].name.toLowerCase();
        if (ftype=="checkbox")
        {
            //console.log('quickcheck id\t' + fid + '\nelname\t' + elname + "\nName:\t" + fname);
            if(document.the_form.elements[i].checked && document.the_form.elements[i].name == elname)
            {
                //console.log('checked id\t' + fid)

                var id = fid.split("_")[1];
                for (var x=0;x<dbname.length;x++)
                {
                    //console.log("id\t" + dbname[x]['id'])
                    if(dbname[x]['id']==id)
                    {

                        if (document.the_form.elements[i].checked == true) return dbname[x][fieldname].toLowerCase();
                    }
                }
            }
        }
    }

}
//---------------> remCheck <----------------//

function remCheck(name,total_low_div,total_high_div,rem_div)
{
    var n=0;
    //if(name)console.log("total_div:\t" + total_low_div);
    var s_name = total_low_div.split("_")[0];
    var check = document.getElementsByName(name);
    if(check)
    {
        //console.log(document.getElementById(total_low_div).innerHTML);

        for (var c=0;c<check.length;c++)
        {
            //console.log(check[c].name);
            //console.log(check[c].checked);
            if(check[c].type=="checkbox" && check[c].checked == true) check[c].checked = false;
        }
    }
    if(total_low_div) document.getElementById(total_low_div).innerHTML = "";
    if(total_high_div) document.getElementById(total_high_div).innerHTML = "";
    if(rem_div) document.getElementById(rem_div).innerHTML = "";

    if(s_name)
    {
        var stats = document.getElementsByName(s_name + "_stats");
        for(var n=0;n<stats.length;n++)
        {
            stats[n].innerHTML = "";
        }
    }
    //return n;
    get_total();
}

//---------------> frameit <----------------//
function styleit()
{
//get style id
//get framing price
//cost of framing - cost of style
}
//---------------> frameit <----------------//

function frameit(id)
{
    for(var x=0;x<framingarr.length;x++)
    {
        var rw = framingarr[x];
        //console.log(id + "\tframing id: " + rw['id'])
        if(rw['id'] == id)
        {
            var minrate = rw['rate_min'];
            var maxrate = rw['rate_max'];
            var thick = "2x8";
            if(span>12) thick = "2x10";
                //console.log("deckframing fn material: " + rw['name']);
                if(rw['dim'] == thick) //found 2x thickness
                {
                    //	console.log("deckframing fn material: " + rw['name']);
                    //	console.log("deckframing fn rate: " + rate);
                    var min_total = minrate*sqft;
                    var max_total = maxrate*sqft;
                    //console.log("deckframing fn total: " + total);
                    var low_tot = document.getElementById('style_low_total');
                    var high_tot = document.getElementById('style_high_total');
                    low_tot.innerHTML = '$' + min_total;
                    high_tot.innerHTML = '$' + max_total;
                }
        }
    }
/*    var val = document.getElementsByName('framingradio');
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
    }*/
}

//---------------> lightit <----------------//

function lightit()
{
    var deck_height = document.getElementById("height").value;
    var deck_length = document.getElementById("length").value;
    var lf = Number(document.getElementById("textlinft").innerHTML);
    //console.log("railing lf:" + lf);
    //qty = linft/12
    var qty = (lf-deck_length)/7;
    var min_total = Number(document.getElementById("lighting_low_total"));
    var max_total = Number(document.getElementById("lighting_high_total"));
    if(!min_total) min_total=0;
    if(!max_total) max_total=0;
    //var max_total = 0;
    var total_arr = new Array();
    var val = document.getElementsByName('lightingradio_mult');
    //console.log("lightit len: " + val.length);
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
                        //console.log('lighting min: ' + lightingarr[n]['rate_min']);
                        max_total = max_total + Number(lightingarr[n]['rate_max']);
                        //console.log('lighting max: ' + lightingarr[n]['rate_max']);
                    }
                }
            }
        }
    }

    var light_low_total=document.getElementById('lighting_low_total');
    var light_high_total=document.getElementById('lighting_high_total');
    if(min_total>0)
    {
        //debugit(total);
        //console.log(tot.innerHTML );
        var transformer = Number('140');
        var min_tot = min_total;
        var max_tot = max_total;
        //console.log("max_total: " + max_total.toString());
        //console.log("min_total: " + min_total.toString());
        var mtotal = (min_tot*qty) + transformer;
        var htotal = (max_tot*qty) + transformer;
        light_low_total.innerHTML = '$' + mtotal.toFixed(2);
        light_high_total.innerHTML ='$' + htotal.toFixed(2);
    }
    else
    {
        light_low_total.innerHTML = "";
        light_high_total.innerHTML = "";
        document.getElementById("lighting_rem").innerHTML = "";
    }

}

//---------------> stepit <----------------//

function stepit()
{
    var stair_low_total = document.getElementById("stairs_low_total");
    var stair_high_total = document.getElementById("stairs_high_total");
    var val = document.getElementsByName('stairsradio');
    var height = document.getElementById('height');
    var rmin = railingarr[0]['rate_min'];
    var rmax = railingarr[0]['rate_max'];
    if (Number(height.value)>0)
    {
        //console.log("stair_total: " + stair_low_total.innerHTML);
        //console.log("val length: " + val.length);
        //console.log("height: " + height.value);
        var tot = (Number(height.value)*12);
        var qty = Math.ceil(tot/7);
        console.log("qty:\t" + qty);
        var qtylights = 1;
        if (qty <= 3 && qty > 1) qtylights = 2;
        else qtylights = qty/3;
        console.log("qty lights:\t" + qtylights);
        //console.log("frameit len: " + val.length);
        rmin = (rmin*qty)*2;
        rmax = (rmax*qty)*2;
        console.log("railing cost on stairs (min):\t" + rmin);
        console.log("railing cost on stairs (max):\t" + rmax);

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
                            if(stair_low_total && stair_high_total && qty)
                            {
/*                                document.getElementById("stairs_qty").innerHTML = "<div id='stat' class=''>Steps: " + qty + "</div>";
                                document.getElementById("stairs_uc_low").innerHTML = "<div id='stat' class=''>$ per step (low): $" + min_total + "</div>";
                                document.getElementById("stairs_uc_high").innerHTML = "<div id='stat' class=''>$ per step (high): $" + max_total + "</div>";*/
                                stair_low_total.innerHTML ='$' + ((min_total * qty)+rmin);
                                stair_high_total.innerHTML ='$' + ((max_total * qty)+rmax);
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
            railing_note.innerHTML = "<br />Decks over the height of 30&quot; above grade are required to have a railing."
        }
        else
        {
            railing_note.innerHTML = "";
        }
    }

    if (!length) var length = 1;
    if (!width) var width = 1;
    var sqft = length*width;
    var linft = (length + width*2);
    var bordft = (length*2 + width*2);
    if(width>1 && length>1)
    {
        var thediv=document.getElementById('textsqft');
        var len = statsarr.length+1;
        statsarr[0] = "<li>" +  sqft + "&nbsp;square feet</li>";
        statsarr[1] = "<li>" +  linft + "&nbsp;linear feet</li>";
        //document.getElementById('unitsq').innerHTML
        //document.getElementById('unitlin').innerHTML = "&nbsp;linear feet";
        thediv.innerHTML = sqft;// + "<span class='dim_text'> square feet</span>";
        var lin=document.getElementById('textlinft');
        lin.innerHTML = linft;// + "<span class='dim_text'> linear feet</span>";
    }
}

//---------------> get_total <----------------//

function get_total()
{
    var low_total = 0;
    var high_total = 0;
    var elLength = document.getElementsByTagName("*");
    for (i=0; i<elLength.length; i++)
    {
        var id = elLength[i].id;
        var elid = id.split('_');
        if (elid.length>2)
        {
            if (elid[1] == "low" && elid[2]=="total")
            {
                var lt = elLength[i].innerHTML;
                if(lt.substring(0,1)=="$")
                {
                    low_total = low_total + Number(lt.substr(1,lt.length));
                }
                else
                {
                    low_total = low_total + Number(elLength[i].innerHTML);
                }
            }
            if (elid[1] == "high" && elid[2]=="total")
            {
                var ht = elLength[i].innerHTML;
                if(ht.substring(0,1)=="$")
                {
                    high_total = high_total + Number(ht.substr(1,ht.length));
                }
                else
                {
                    high_total = high_total + Number(elLength[i].innerHTML);
                }
            }
        }


            var low_el = document.getElementsByName("total_low_cost");
            if (low_el.length>0)
            {
                for(var x=0;x<low_el.length;x++)
                {
                    low_el[x].innerHTML = '';
                    if(low_total>0)
                    {
                        low_el[x].innerHTML = '$' + low_total;
                    }


                }
            }
            var high_el = document.getElementsByName("total_high_cost");
            if (high_el.length>0)
            {
                for(var x=0;x<high_el.length;x++)
                {
                    high_el[x].innerHTML = '';
                    if(high_total>0)
                    {
                        high_el[x].innerHTML = '$' + high_total;
                    }
                }
            }


    }
    //lighting_low_total
}


