<?php
$this->load->helper('form');


$ismobile = check_user_agent('mobile');
echo '<script> var baseratemin=' . json_encode($baserate->row()->rate_min) . ';';
echo ' var baseratemax=' . json_encode($baserate->row()->rate_max) . ';';
//echo "console.log(baseratemax['rate_max']);";
echo '</script>';
echo '<script> var framingarr=';
echo json_encode($framing->result());
echo ';</script>';
echo '<script> var statsarr = new Array()</script>';
$sname = "framing";
$arr = $framing;
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
    <meta http-equiv="Content-Type" content="image/gif">
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="/deckestimator/assets/lib/css/kona2.css" />
        <link rel="stylesheet" type="text/css" href="/deckestimator/assets/lib/css/kona_admin.css" />
        <script type="text/javascript" src="/deckestimator/assets/lib/js/kona.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    </head>
    <body>
        <div class="wrap">
        <div class="the_header"><img src="/deckestimator/assets/img/header.jpg" height="150" width="720"></div>
            <form name="the_form" id="form1" method="post">
            <div class="section border bdr_hdr" style="clear:both;">
                <div class="header">
                    <div class = "title">Dimension Data</div>
                    <div class="inputs">
                        <div class="input_container"><span class="dim_label">Length (ft.)</span><input class="dim_input" <? if($ismobile==1) echo 'style="width:60px;font-size:3.0em;"' ?> name="dims_length" type="text" id="length" onkeypress='validate(event,"length")' onblur="getdim(this),CheckCheckboxes()"/></div>
                        <div class="input_container"><span class="dim_label">Width (ft.)</span><input class="dim_input" <? if($ismobile==1) echo 'style="width:60px;font-size:3.0em;"' ?> name="dims_width" type="text" id="width" onkeypress='validate(event,"width")' onblur="getdim(this),CheckCheckboxes()"/></div>
                        <div class="input_container" style="border-right:none;"><span class="dim_label">Height (ft.)</span><input class="dim_input" <? if($ismobile==1) echo 'style="width:60px;font-size:3.0em;"' ?> name="dims_height" type="text" id="height" onkeypress='validate(event,"height")' onblur="getdim(this),CheckCheckboxes()"/></div>
                        <div id="deck_stat"></div>
                        <input hidden="true" name="mobile" type="text" value="<?=$ismobile?>"/>
                    </div>

                <div class="hdr_bottom">
                    <div class="hdr_image">
                        <img src="/deckestimator/assets/img/measuring.jpg" height="206" width="255" />
                    </div>
                </div>
            </div>
            </div>

<!----------------------------------------------------------------->
<!-----MATERIALS
<!----------------------------------------------------------------->

            <div class="section border bdr_hdr" id="deckmat">
                <?
                echo '<script> var deckmatarr=';
                echo json_encode($deckmat->result());
                echo ';</script>';
                $sname = "deckmat";
                $arr = $deckmat
                ?>

                <div class="data">
                    <div class = "title">Decking Material Selection
                        <div class="note" id="<?=$sname?>_note"></div>
                        <div id="<?=$sname?>_remchecks"></div>
                    </div>
                    <div class="cost">
                        <div class="section_cost border">
                            <div class="sc_title"><?=ucfirst($sname)?> Cost</div>
                            <div class="sc_data" id="<?=$sname?>_low_total"></div>
                            <div class="sc_data" id="<?=$sname?>_high_total"></div>
                        </div>
                        <div class="total_cost border">
                            <div class="tc_title" >Total Cost</div>
                            <div class="tc_data" name="total_low_cost"></div>
                            <div class="tc_data" name="total_high_cost"></div>
                        </div>
                    </div>

                </div>
                <div class="items">
                    <? foreach ($arr->result() as $val) {
                        if($val->name == "Redwood" || $val->name == "Composite")
                        {
                        ?>

                        <div class="item_img border">
                            <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio"  onclick="checkit(this.name ,this.id),CheckCheckboxes(<?=$val->id?>)"/>
                            <div class="item_title"><?=($val->name)?></div>
                            <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" <? if($val->name == "Composite") echo "checked = 'checked'"?> name="<?=$sname?>radio" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes(<?=$val->id?>)"/>
                        </div>
                    <?
                    }
                    }
                    ?>
                        <div id="base_breakdown" class="breakdown"></div>
                </div>
            </div>
<!--            <div class="section_right breakdown border">
            <div class="data">
                <div class="b_title">Materials Breakdown</div>
                <div class="b_data">
                    <ul>
                        <li><div id="<?/*=$sname*/?>_qty" name="<?/*=$sname*/?>_stats"></div></li>
                        <li><div id="<?/*=$sname*/?>_uc_low" name="<?/*=$sname*/?>_stats"></div></li>
                        <li><div id="<?/*=$sname*/?>_uc_high" name="<?/*=$sname*/?>_stats"></div></li>
                    </ul>
                </div>
            </div>
            </div>-->

<!----------------------------------------------------------------->
<!-----DECKING_OPTIONS
<!----------------------------------------------------------------->


            <div class="section border bdr_hdr"   id="deckingoptions">
                <?
                echo '<script> var deckingoptionsarr=';
                echo json_encode($deckingoptions->result());
                echo ';</script>';
                $sname = "deckingoptions";
                $arr = $deckingoptions;
                ?>

                <div class="data">
                    <div class="title_section">
                        <div class = "title">Decking Options</div>
                        <div class="note" id="<?=$sname?>_note"></div>
                        <div id="<?=$sname?>_remchecks"></div>
                    </div>
                    <div class="cost">
                        <div class="section_cost border">
                            <div class="sc_title">Deck Options Cost</div>
                            <div class="sc_data" id="<?=$sname?>_low_total"></div>
                            <div class="sc_data" id="<?=$sname?>_high_total"></div>
                        </div>
                        <div class="total_cost border">
                            <div class="tc_title">Total Cost</div>
                            <div class="tc_data" name="total_low_cost"></div>
                            <div class="tc_data" name="total_high_cost"></div>
                        </div>
                    </div>

                </div>
                <div class="items">
                    <? foreach ($arr->result() as $val) {
                        if($val->name != "Border")
                        {
                        ?>

                        <div class="item_img border">
                           <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio"  onclick="checkit(this.name ,this.id),CheckCheckboxes(<?$val->id?>)"/>
                            <div class="item_title"><?=($val->name)?></div>
                            <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" <? if($val->name == "Strait") echo "checked = 'checked'"?> name = "<?=$sname?>radio" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes(<?$val->id?>)"/>
                        </div>

                    <?
                    }
                    }
                    ?>
                    <div id="<?=$sname?>_breakdown" class="breakdown"></div>
                </div>
            </div>
<!--                <div class="section_right breakdown border">
                    <div class="data">
                        <div class="b_title"><?/*=ucfirst($sname)*/?> Breakdown</div>
                        <div class="b_data">
                            <ul>
                                <li><div id="<?/*=$sname*/?>_qty" name="<?/*=$sname*/?>_stats"></div></li>
                                <li><div id="<?/*=$sname*/?>_uc_low" name="<?/*=$sname*/?>_stats"></div></li>
                                <li><div id="<?/*=$sname*/?>_uc_high" name="<?/*=$sname*/?>_stats"></div></li>
                            </ul>
                        </div>
                    </div>
                </div>-->
<!----------------------------------------------------------------->
<!-----BORDER
<!----------------------------------------------------------------->
            <? $sname = "deckingoptionsbord";?>
            <div class="section border bdr_hdr"   id="deckingoptionsbord">
                <div class="data">
                    <div class="title_section">
                        <div class = "title">Decking Border</div>
                        <div class="note" id="<?=$sname?>_note"></div>
                        <div id="<?=$sname?>_remchecks"></div>
                    </div>
                    <div class="cost">
                        <div class="section_cost border">
                            <div class="sc_title">Border Cost</div>
                            <div class="sc_data" id="<?=$sname?>_low_total_b"></div>
                            <div class="sc_data" id="<?=$sname?>_high_total_b"></div>
                        </div>
                        <div class="total_cost border">
                            <div class="tc_title">Total Cost</div>
                            <div class="tc_data" name="total_low_cost"></div>
                            <div class="tc_data" name="total_high_cost"></div>
                        </div>
                    </div>

                </div>
                <div class="items">
                    <? foreach ($arr->result() as $val) {
                        if($val->name == "Border")
                        {
                        ?>

                        <div class="item_img border">
                            <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio_mult"  onclick="checkit(this.name ,this.id),CheckCheckboxes(<?=$val->id?>,'mult')"/>
                            <div class="item_title"><?=($val->name)?></div>
                            <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" <? if($val->name == "Strait") echo "checked = 'checked'"?> name = "<?=$sname?>radio_mult" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes(<?=$val->id?>,'mult')"/>
                        </div>

                    <?
                        }
                    }
                    ?>
                    <div id="<?=$sname?>_breakdown" class="breakdown"></div>
                </div>
            </div>
<!----------------------------------------------------------------->
<!-----RAILING
<!----------------------------------------------------------------->

            <div class="section border bdr_hdr"   id="railing">
                <?
                echo '<script> var railingarr=';
                echo json_encode($railing->result());
                echo ';</script>';
                $sname = "railing";
                $arr=$railing;
                ?>
                <div class="data">
                    <div class = "title">Deck <?=ucfirst($sname)?>
                        <div class="note" id="<?=$sname?>_note"></div>
                        <div id="<?=$sname?>_remchecks"></div>
                    </div>
                    <div class="cost">
                        <div class="section_cost border">
                            <div class="sc_title"><?=ucfirst($sname)?> Cost</div>
                            <div class="sc_data" id="<?=$sname?>_low_total"></div>
                            <div class="sc_data" id="<?=$sname?>_high_total"></div>
                        </div>
                        <div class="total_cost border">
                            <div class="tc_title">Total Cost</div>
                            <div class="tc_data" name="total_low_cost"></div>
                            <div class="tc_data" name="total_high_cost"></div>
                        </div>
                    </div>


                </div>
                <div class="items">
                    <? foreach ($arr->result() as $val)
                    {
                        ?>

                        <div class="item_img border">
                           <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/>
                            <div class="item_title"><?=($val->name)?></div>
                            <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" name = "<?=$sname?>radio" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes()"/>
                        </div>
                    <?
                    }
                    ?>
                    <div id="<?=$sname?>_breakdown" class="breakdown"></div>
                </div>
            </div>
<!--            <div class="section_right breakdown border">
                <div class="data">
                <div class="b_title"><?/*=ucfirst($sname)*/?> Breakdown</div>
                <div class="b_data">
                    <ul>
                        <li><div id="<?/*=$sname*/?>_qty" name="<?/*=$sname*/?>_stats"></div></li>
                        <li><div id="<?/*=$sname*/?>_uc_low" name="<?/*=$sname*/?>_stats"></div></li>
                        <li><div id="<?/*=$sname*/?>_uc_high" name="<?/*=$sname*/?>_stats"></div></li>
                    </ul>
                </div>
                </div>
            </div>-->
<!----------------------------------------------------------------->
<!-----STAIRS
<!----------------------------------------------------------------->

                <div class="section border bdr_hdr"   id="stairs">
                    <?
                    echo '<script> var stairsarr=';
                    echo json_encode($stairs->result());
                    echo ';</script>';
                    $sname = "stairs";
                    $arr = $stairs;
                    ?>

                    <div class="data">
                        <div class = "title">Deck <?=ucfirst($sname)?>
                            <div class="note" id="<?=$sname?>_note"></div>
                            <div id="<?=$sname?>_remchecks"></div>
                        </div>
                        <div class="cost">
                            <div class="section_cost border">
                                <div class="sc_title"><?=ucfirst($sname)?> Cost</div>
                                <div class="sc_data" id="<?=$sname?>_low_total"></div>
                                <div class="sc_data" id="<?=$sname?>_high_total"></div>
                            </div>
                            <div class="total_cost border">
                                <div class="tc_title">Total Cost</div>
                                <div class="tc_data" name="total_low_cost"></div>
                                <div class="tc_data" name="total_high_cost"></div>
                            </div>
                        </div>

                    </div>
                    <div class="items">
                        <? foreach ($arr->result() as $val) {
                            ?>

                            <div class="item_img border">
                               <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/>
                                <div class="item_title"><?=($val->name)?></div>
                                <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" name = "<?=$sname?>radio" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes()"/>
                            </div>

                        <?
                        }
                        ?>
                        <div id="<?=$sname?>_breakdown" class="breakdown"></div>
                    </div>
                </div>


<!----------------------------------------------------------------->
<!-----LIGHTING
<!----------------------------------------------------------------->

            <div class="section border bdr_hdr clearfix"   id="lighting">
                <?
                echo '<script> var lightingarr=';
                echo json_encode($lighting->result());
                echo ';</script>';
                $sname = "lighting";
                $arr = $lighting;
                ?>

                <div class="data">
                    <div class = "title">Low Voltage Accent Lighting
                        <div class="note" id="<?=$sname?>_note">*Other light styles and types are available</div>
                        <div id="<?=$sname?>_remchecks"></div>
                    </div>
                    <div class="cost">
                        <div class="section_cost border">
                            <div class="sc_title"><?=ucfirst($sname)?> Cost</div>
                            <div class="sc_data" id="<?=$sname?>_low_total"></div>
                            <div class="sc_data" id="<?=$sname?>_high_total"></div>
                        </div>
                        <div class="total_cost border">
                            <div class="tc_title">Total Cost</div>
                            <div class="tc_data" name="total_low_cost"></div>
                            <div class="tc_data" name="total_high_cost"></div>
                        </div>
                    </div>
                </div>

                <div class="items">
                    <? foreach ($arr->result() as $val) {
                        ?>

                        <div class="item_img border">
                           <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio_mult"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/>
                            <div class="item_title"><?=($val->name)?></div>
                            <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" name = "<?=$sname?>radio_mult" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes()"/>
                        </div>

                    <?
                    }
                    ?>
                    <div id="<?=$sname?>_breakdown" class="breakdown"></div>
                </div>
            </div>
<!--                <div class="section_right breakdown border">
                    <div class="b_title"><?/*=ucfirst($sname)*/?> Breakdown</div>
                    <div class="b_data">
                        <ul>
                            <li><div id="<?/*=$sname*/?>_qty" name="<?/*=$sname*/?>_stats"></div></li>
                            <li><div id="<?/*=$sname*/?>_uc_low" name="<?/*=$sname*/?>_stats"></div></li>
                            <li><div id="<?/*=$sname*/?>_uc_high" name="<?/*=$sname*/?>_stats"></div></li>
                        </ul>
                    </div>
            </div>-->

<!----------------------------------------------------------------->
<!-----Extras
<!----------------------------------------------------------------->

            <div class="section border bdr_hdr clearfix"   id="extras">
                <?
                echo '<script> var extrasarr=';
                echo json_encode($extras->result());
                echo ';</script>';
                $sname = "extras";
                $arr = $extras;
                ?>

                <div class="data">
                    <div class = "title">Deck Extras!
                        <div class="note" id="<?=$sname?>_note"></div>
                        <div id="<?=$sname?>_remchecks"></div>
                    </div>
                    <div class="cost">
                        <div class="section_cost border">
                            <div class="sc_title"><?=ucfirst($sname)?> Cost</div>
                            <div class="sc_data" id="<?=$sname?>_low_total"></div>
                            <div class="sc_data" id="<?=$sname?>_high_total"></div>
                        </div>
                        <div class="total_cost border">
                            <div class="tc_title">Total Cost</div>
                            <div class="tc_data" name="total_low_cost"></div>
                            <div class="tc_data" name="total_high_cost"></div>
                        </div>
                    </div>
                </div>

                <div class="items">
                    <? foreach ($arr->result() as $val) {
                        ?>

                        <div class="item_img border">
                            <img id="<?=$sname . '_' . ($val->id)?>" height="200" width="175" src="<?=($val->imgurl)?>" name = "<?=$sname?>radio_mult"  onclick="checkit(this.name ,this.id),CheckCheckboxes()"/>
                            <div class="item_title"><?=($val->name)?></div>
                            <input style="vertical-align:bottom;" id="<?=$sname . '_' . ($val->id)?>" align="middle" type="checkbox" name = "<?=$sname?>radio_mult" value="<?=$sname?>radio_<?=($val->id)?>" onchange="checkit(this.name ,this.id),CheckCheckboxes()"/>
                        </div>

                    <?
                    }
                    ?>
                    <div id="<?=$sname?>_breakdown" class="breakdown"></div>
                </div>
            </div>
<!--            <div class="section_right breakdown border">
                <div class="b_title"><?/*=ucfirst($sname)*/?> Breakdown</div>
                <div class="b_data">
                    <ul>
                        <li><div id="<?/*=$sname*/?>_qty" name="<?/*=$sname*/?>_stats"></div></li>
                        <li><div id="<?/*=$sname*/?>_uc_low" name="<?/*=$sname*/?>_stats"></div></li>
                        <li><div id="<?/*=$sname*/?>_uc_high" name="<?/*=$sname*/?>_stats"></div></li>
                    </ul>
                </div>
            </div>-->
            <div class="section stats border">
                <div class="stats_title">Submit Your Deck!</div>
                <ul>
                    <li><span hidden="true" class="stats_sqft" id="textsqft"></span><span hidden="true" id="unitsq"></span></li>
                    <li><div hidden="true" class="stats_linft" id="textlinft"></div><span hidden="true" id="unitlin"></span></li>
                </ul>
                <!--</div>-->

                <!----------------------------------------------------------------->
                <!-----SUBMIT
                <!----------------------------------------------------------------->

            <?$this->load->view('contact') ?>
            <input style="float:right;" class="submit" type="submit" name="mysubmit" value="Submit Post!" />

        </div>



            </form>
        </div>
    
    </body>

<script type='text/javascript' language='javascript'>
    $(document).ready(function(){
        var sList = "";
    });
        /*$(".item_img.border").click(function(){*/
        function CheckCheckboxes(){
            var length = $("#length").val();
            var width = $("#width").val();
            var matcheck = false;
            if(!length || !width) return false;
            var dims = getdims();
            //console.log("dims return");
            var vals = {};
            //console.log('\n');

            if(dims.length<2)return false; //not enough dims
            else
            {
                var length = dims['length'];
                var width = dims['width'];
                var sqft = length*width;
                var dim = "";
                if(Number(width)>12) dim = "2x10";
                else dim = "2x8"
                vals['dim'] = dim;
            }
            var options = get_checkboxes();
            for (var key in options) {
                vals[key] = options[key];
                //console.log('options\t' + key + ' : ' + options[key]);
            }
                $('input[type=checkbox]').each(function () {
                    var sThisVal = (this.checked ? "1" : "0");
                    if(sThisVal == "1") var chkid = ($(this).prop("id"));
                    if(chkid)
                    {
                        //console.log("id:\t" + chkid);
                        var idstr = chkid.split("_");

                        if(idstr.length>0)
                        {
                            var sec = idstr[0];
                            var id = idstr[1];
                            var arrname = idstr[0] + "arr";
/*                            //console.log("section name:\t" + sec);
                            console.log("section id:\t" + id);
                            console.log("arr name:\t" + arrname);
                            var rate_min = arrloop(arrname,"id",id,"rate_min")
                            var rate_max = arrloop(arrname,"id",id,"rate_max")
                            if(rate_min) console.log(sec + " rate_min:\t" + rate_min);
                            if(rate_max) console.log(sec + " rate_max:\t" + rate_max);*/
                            if(sec=="deckmat")
                            {
                                vals['material'] = arrloop("deckmatarr","id",id,"qname");
                                matcheck = true;
                                //console.log("matcheck\t" + matcheck);
                            }
                            else if(sec=="deckingoptions")
                            {
                                var style = arrloop("deckingoptionsarr","id",id,"name");
                                vals['style'] = style;
                                //console.log("DO_sec:\t" + sec);
                                //console.log("deckmat:\t" + $("#deckmat").prop("id"));
                                //console.log('dim\t' + vals['dim']);
                                //console.log('material\t' + vals['material']);
                                //console.log('style\t' + vals['style']);
                                var q = "select * from framing where dim = '" + vals['dim'] + "' AND style = '" + vals['style'] + "' AND material = '" + vals['material'] + "'";
                                //console.log(q);
                                if(matcheck==true) var qresults = sql(vals);
                            }

                        }
                    }
                });
        }

    function get_checkboxes()
    {
        var vals={};
        vals['lightingid']="";
        $('input[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? "1" : "0");
            if(sThisVal == "1") var chkid = ($(this).prop("id"));
            if(chkid)
            {
                //console.log("id:\t" + chkid);
                var idstr = chkid.split("_");
                if(idstr.length>0)
                {
                    var sec = idstr[0];
                    var id = idstr[1];
                    var arrname = idstr[0] + "arr";
                }

                if(sec=="deckingoptionsbord")
                {
                    //console.log("border id\t" + id);
                    vals['deckingoptionsbordid'] = id
                }
                else if(sec == "railing")
                {
                    vals['railingid'] = id
                }
                else if(sec == "stairs")
                {
                    vals['stairsid'] = id
                }
                else if(sec == "lighting")
                {
                    var i=0;
                    //var light = get_light_sel();
                    $( "input[name^='lighting']").each(function(){
                        var sThisVal = (this.checked ? "1" : "0");
                        if(sThisVal == "1")
                        {
                            var chkid = $(this).prop("id");
                            var idstr = chkid.split("_");
                            if(idstr.length>0)
                            {
                                var id = idstr[1];
                            }
                            if(i==0)
                            {
                                vals['lightingid1'] = id;
                                //console.log("lightingid1\t" + id);
                            }
                            else
                            {
                                vals['lightingid2'] = id;
                                //console.log("lightingid2\t" + id);
                            }
                            i++;
                        }
                    });


                }
                else if(sec == "extras")
                {
                    vals['extrasid'] = id
                }

            }

        });
        return vals;
    }

    function get_light_sel()
    {
        var lightid = "";
        var i=0;
        $( "input[name^='lighting']").each(function(){
            var sThisVal = (this.checked ? "1" : "0");
            if(sThisVal == "1")
            {
                var chkid = $(this).prop("id");
                var idstr = chkid.split("_");
                if(idstr.length>0)
                {
                    var id = idstr[1];
                }
                if(i==0) lightid = id;
                else lightid = lightid + "_" + id;
                i++;
            }
        });
        //console.log("lightid:\t" + lightid);
        return lightid;

    }

    function count_checkboxes()
    {
        var i=0;
        $('input[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? "1" : "0");
            if(sThisVal == "1") i=i+1;
        });
        return i;
    }

    function getdims()
    {
        var sqft = 1;
        var linft = 1;
        var bordft = 1;
        var length = $("#length").val();
        //console.log("length:\t" + length);
        var width = $("#width").val();
        var height = $("#height").val();
        if(length && width)
        {
            sqft = length*width;
            linft = (+width*2)+(+length);
            bordft = (length*2)+(width*2);

            //console.log("sqft:\t" + sqft);
            //return sqft;
            var dims = {}
            dims['sqft'] = sqft;
            dims['linft'] = linft;
            dims['bordft'] = bordft;
            dims['width'] = width;
            dims['length'] = length;
            //console.log("dims length:\t" + dims['length']);
            if(height)
            {
                dims['height'] = height;
                var tot = +height*12;
                var nsteps = Math.ceil(tot/7);
                dims['num_steps'] = nsteps;
                var qtylights = 1;
                if (nsteps <= 3 && nsteps > 1) qtylights = 2;
                else qtylights = nsteps/3;
                dims['num_step_lights'] = qtylights;
            }
            else
            {
                dims['height'] = 'Please enter Height for Deck'
            }

            return dims;
        }
    }

    function getbase(id)
    {
        $('input[type=checkbox]').each(function () {
            var cid = $(this).prop("id");
            if (cid.indexOf("deckmat") >= 0){
                $.each( deckmatarr, function( key, value ) {
                    //console.log( key + ": " + value );
                });
            }
        });

    }
    function checkme(chk)
    {
        myid = "#" + chk + "_chk";
       // $(myid).trigger('change');
            //console.log("before check status:\t" + $(myid).prop('checked'));
        if ($(myid).prop("checked") == false){
            $(myid).trigger('click');
            //console.log("after click event status:\t" + $(myid).prop('checked'));
            $(myid).prop('checked', true);
            //console.log("after setting true check status:\t" + $(myid).prop('checked'));
        }
        else {
            $(myid).trigger('click');
            //console.log("after click event status:\t" + $(myid).prop('checked'));
            $(myid).prop('checked', false);
            //console.log("after setting true check status:\t" + $(myid).prop('checked'));
        }


    }

    function arrloop(arr,chkfield,chkval,rtnfield){
        var fval = chkfield;
        var val = chkval;
        var rtn = rtnfield;
        //console.log('arrloop array:\t' + arr);
        //console.log('arrloop fval:\t' + chkfield);
        //console.log('arrayLoop val:\t' + chkval);
        //console.log('arrloop rtn:\t' + rtnfield);
        arr = window[arr];
        if(arr && fval && rtn)
        {
            for(var x=0;x<arr.length;x++)
            {
                //console.log("field " + fval + ':\t'  + arr[x][fval]);
                if(arr[x][fval] == val){
                    return arr[x][rtn];
                }
            }
        }
        else
        {
            return false;
        }

    }

    function sql(q)
    {
        $.ajax({
            url: '/deckestimator/main/getValues',
            type:'POST',
            data: q,
            error: function(){
                $('#result_table').append('<p>goodbye world</p>');
            },
            success:function(data){
                $('#result_table').html('');
                //alert("Success!");
                get_totals(data);
            }
        }); // End of ajax call

    }

    function get_totals(data)
    {
        var res=[];
        var addft = 0;
        var addftmax = 0;
        var bordft = 0 ;
        var linft = 0 ;
        var baseaddft = 0;
        var baseaddftmax = 0;
        var bordmin = 0;
        var bordmax = 0;
        var railingmin = 0;
        var railingmax = 0;
        var i=0;
        var min_sec_diff = 0 ;
        var mindiff = 0 ;
        var min_base_total = 0;
        var min_base_rate = 0;
        var nummin = 0;
        var style = "" ;
        var qual_arr = {};
        var max_base_total = 0;
        var max_sec_diff = 0;
        var lighting1min = 0;
        var lighting1max = 0;
        var lighting2min = 0;
        var lighting2max = 0;
        var lighting2min = 0;
        var lighting2max = 0;
        var extrasmin = 0;
        var extrasmax = 0;
        var dimarr = getdims();
        $('#deck_stat').html();
        $('#deck_stat').html('<ul>');
        for (var key in dimarr) {
            $('#deck_stat').append('<li>' + key + ' : ' + dimarr[key] + '</li>');
            if(key=="bordft") bordft = dimarr[key];
            if(key=="linft") linft = dimarr[key];
        }
        $('#deck_stat').append('</ul>');


        $('#deckingoptions_breakdown').html();
        $('#deckingoptions_breakdown').html('<ul>');
        //$('#result_table').append('<br/>' + 'base rate : ' + baseratemin);
        $.each(data.results, function(k, v) {
            $.each(v, function(key, value) {
                if(key != "imgurl") $('#deckingoptions_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                if(key == "rate_min") addft = value;
                if(key == "rate_max") addftmax = value;
                if(key == "style") style = value;
            })
        });
        $('#deckingoptions_breakdown').append('</ul>');

        $('#base_breakdown').html();
        $('#base_breakdown').html('<ul>');
        //$('#result_table').append('<br/>');
        $.each(data.base_result, function(k, v) {
            $.each(v, function(key, value) {
                if (v['style'] == "strait")
                {
                    if(key != "imgurl") $('#base_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") baseaddft = value;
                    if(key == "rate_max") baseaddftmax = value;
                }
            })
        });
        $('#base_breakdown').append('</ul>');
        //console.log("Am I dead here base_results?");

        $('#deckingoptionsbord_breakdown').html();
        $('#deckingoptionsbord_breakdown').html('<ul>');
        if(data.bord_result)
        {
        //$('#result_table').append('<br/>BORDER<br/>');
        $.each(data.bord_result, function(k, v) {
            $.each(v, function(key, value) {
                if(key != "imgurl") $('#deckingoptionsbord_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                if(key == "rate_min") bordmin = value;
                if(key == "rate_max") bordmax = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
            });
        });
        }
        $('#deckingoptionsbord_breakdown').append('</ul>');
        if(+bordmin>0) $("#deckingoptionsbord_low_total_b").html('$' + bordmin*bordft);
        if(+bordmax>0) $("#deckingoptionsbord_high_total_b").html('$' + bordmax*bordft);

        $('#lighting_breakdown').html();
        $('#lighting_breakdown').html('<ul>');
        if(data.lighting1_result)
        {
            //$('#result_table').append('<br/>Lighting1<br/>');
            $.each(data.lighting1_result, function(k, v) {
                $.each(v, function(key, value) {
                    if(key != "imgurl") $('#lighting_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") lighting1min = value;
                    if(key == "rate_max") lighting1max = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
                });
            });
        }
        $('#lighting_breakdown').append('</ul>');


        $('#lighting_breakdown').append('<ul>');
        if(data.lighting2_result)
        {
            //$('#result_table').append('<br/>Lighting2<br/>');
            $.each(data.lighting2_result, function(k, v) {
                $.each(v, function(key, value) {
                    if(key != "imgurl") $('#lighting_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") lighting2min = value;
                    if(key == "rate_max") lighting2max = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
                });
            });
        }
        $('#lighting_breakdown').append('</ul>');


        var num_step_lights = dimarr['num_step_lights'];
        if(num_step_lights>0)
        {
            if(+lighting1min>0) $("#lighting_low_total").html('$' + lighting1min*num_step_lights);
            if(+lighting1max>0) $("#lighting_high_total").html('$' + lighting1max*num_step_lights);
            //$('#result_table').append('<br/>Stairs Lights Min:' + lighting1min*num_step_lights);
            //$('#result_table').append('<br/>Stairs Lights Max:' + lighting1max*num_step_lights);
        }

        if(data.lighting2_result)
        {
            //$('#result_table').append('<br/>Lighting2<br/>');
            $.each(data.lighting2_result, function(k, v) {
                $.each(v, function(key, value) {
                    if(key != "imgurl") $('#lighting_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") lighting2min = value;
                    if(key == "rate_max") lighting2max = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
                });
            });
        }

        if(linft>0)
        {
            var n_post_lights = Math.ceil(linft/7);
            if(+lighting2min>0) $("#lighting_low_total").html('$' + lighting2min*n_post_lights);
            if(+lighting2max>0) $("#lighting_high_total").html('$' + lighting2max*n_post_lights);
            //$('#result_table').append('<br/>Post Lights Min:' + lighting2min*n_post_lights);
            //$('#result_table').append('<br/>Post Lights Max:' + lighting2max*n_post_lights);
        }

        $('#railing_breakdown').html();
        $('#railing_breakdown').html('<ul>');
        if(data.railing_result)
        {
            //$('#result_table').append('<br/>RAILING<br/>');
            $.each(data.railing_result, function(k, v) {
                $.each(v, function(key, value) {
                    if(key != "imgurl") $('#railing_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") railingmin = value;
                    if(key == "rate_max") railingmax = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
                });
            });
        }
        $('#railing_breakdown').append('</ul>');

        if(+railingmin>0) $("#railing_low_total").html('$' + +railingmin*linft);
        if(+railingmax>0) $("#railing_high_total").html('$' + +railingmax*linft);

        $('#stairs_breakdown').html();
        $('#stairs_breakdown').html('<ul>');
        if(data.stairs_result)
        {
            //$('#result_table').append('<br/>RAILING<br/>');
            $.each(data.stairs_result, function(k, v) {
                $.each(v, function(key, value) {
                    if(key != "imgurl") $('#stairs_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") stairsmin = value;
                    if(key == "rate_max") stairsmax = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
                });
            });
        }
        $('#railing_breakdown').append('</ul>');
        var nsteps = dimarr['num_steps'];

        if(+stairsmin>0)
        {
            var stairs_rail_min = (railingmin*nsteps)*2;
            var stairsmin = (stairsmin*nsteps);
            var stairs_min_total = stairs_rail_min + stairsmin;
            $("#stairs_low_total").html('$' + +stairs_min_total);
            //$('#result_table').append('<br/>Stairs Min:' + stairsmin);
            //$('#result_table').append('<br/>Stair Rail Min:' + stairs_rail_min);
        }
        if(+stairsmax>0){
            var stairs_rail_max = (railingmax*nsteps)*2;
            var stairsmax = (stairsmax*nsteps);
            var stairs_max_total = stairs_rail_max + stairsmax;
            $("#stairs_high_total").html('$' + +stairs_max_total);
            //$('#result_table').append('<br/>Stairs Max:' + stairsmax);
            //$('#result_table').append('<br/>Stair Rail Max:' + stairs_rail_max);
        }

        $('#extras_breakdown').html();
        $('#extras_breakdown').html('<ul>');
        if(data.extras_result)
        {
            //$('#result_table').append('<br/>RAILING<br/>');
            $.each(data.extras_result, function(k, v) {
                $.each(v, function(key, value) {
                    if(key != "imgurl") $('#extras_breakdown').append('<li>' + key + ' : ' + value + '</li>');
                    if(key == "rate_min") extrasmin = value;
                    if(key == "rate_max") extrasmax = value;
                    //$('#result_table').append('<br/>' + key + ' : ' + value);
                });
            });
        }
        $('#extras_breakdown').append('</ul>');

        if(+extrasmin>0) $("#extras_low_total").html('$' + +extrasmin);
        if(+extrasmax>0) $("#extras_high_total").html('$' + +extrasmax);
        
        //console.log('addft\t' + addft);
        var mat = $("#deckmat_low_total");
        var matmax = $("#deckmat_high_total");
        var deckopt = $("#deckingoptions_low_total");
        var deckoptmax = $("#deckingoptions_high_total");

        baseaddft = +baseaddft;
        baseaddftmax = +baseaddftmax;
        addft = +addft;
        addftmax = +addftmax;

        var sqft = dimarr['sqft'];
        var basemin = Number(baseratemin);
        var basemax = Number(baseratemax);
        min_base_rate = basemin;

        if (baseaddft < 0 )
        {
            min_base_rate = basemin + baseaddft;
            //console.log("Baseaddft base rate\t"  + min_base_rate);
            min_base_total = min_base_rate * sqft
        }
        else min_base_total = basemin * sqft;


        $(mat).html('$' + min_base_total);

        if (addft != basemin)
        {
            if (addft < 0 )
            {
                opt_min_rate = basemin + addft;
                //console.log('OPT base rate\t' + opt_min_rate);
                min_sec_diff = (opt_min_rate * sqft) - min_base_total;
                //console.log("min_sec_diff\t" + min_sec_diff);
                if( min_sec_diff < 0 ) min_sec_diff = 0;
            }
            else if(addft > 0)
            {
                var opt_min_rate = basemin + addft;
                //console.log("opt_min_rate\t" + opt_min_rate);
                min_sec_diff = (opt_min_rate * sqft) - min_base_total;
                //console.log("min_sec_diff\t" + min_sec_diff);
                //console.log("min_base_total\t" + min_base_total);
                if( min_sec_diff < 0 ) min_sec_diff = 0;
            }
        }

        var max_base_rate = basemax;

        if (baseaddftmax < 0 )
        {
            max_base_rate = basemax + baseaddftmax;
            //console.log("baseaddftmax base rate\t"  + max_base_rate);
            max_base_total = max_base_rate * sqft
        }
        else max_base_total = basemax * sqft;


        $(matmax).html('$' + max_base_total);

        if (addftmax != basemax)
        {
            if (addftmax < 0 )
            {
                opt_max_rate = basemax + addftmax;
                //console.log('OPT base rate\t' + opt_max_rate);
                max_sec_diff = (opt_max_rate * sqft) - max_base_total;
                //console.log("max_sec_diff\t" + max_sec_diff);
                if( max_sec_diff < 0 ) max_sec_diff = 0;
            }
            else if(addftmax > 0)
            {
                var opt_max_rate = basemax + addftmax;
                //console.log("opt_max_rate\t" + opt_max_rate);
                max_sec_diff = (opt_max_rate * sqft) - max_base_total;
                //console.log("max_sec_diff\t" + max_sec_diff);
                //console.log("max_base_total\t" + max_base_total);
                if( max_sec_diff < 0 ) max_sec_diff = 0;
            }
        }


        //$('#result_table').append('<br/>' + 'max_sec_diff : ' + min_sec_diff);

        $(deckopt).html('$' + min_sec_diff);
        $(deckoptmax).html('$' + max_sec_diff);
        get_total();
    }
</script>
</html>

<?

?>