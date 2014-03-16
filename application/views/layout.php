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
                        <div class="input_container" style="border-right:none;"><span class="dim_label">Height (ft.)</span><input class="dim_input" <? if($ismobile==1) echo 'style="width:60px;font-size:3.0em;"' ?> name="dims_height" type="text" id="height" onkeypress='validate(event,"height")' onblur="getdim(this)"/></div>
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
                            <div class="tc_title">Total Cost</div>
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
    <div id="result_table">HELLO</div>
    </body>

<script type='text/javascript' language='javascript'>
    $(document).ready(function(){
        var sList = "";
/*        $('.item_img.border').click(function(){
           console.log($(this).prop("id"));
        });*/
        /*$('input[type=checkbox]').change(function(){*/
        $(".item_img.border").click(function(){

            var dims = getdims();
            var vals = {};
            console.log('\n');
            if(dims.length<2)return false; //not enough dims
            else
            {
                var length = dims['length'];
                var width = dims['width'];
                console.log('width\t' + width);
                var sqft = length*width;
                var linft = dims['linft'];
                var bordft = dims['bordft'];

                var dim = "";
                if(Number(width)>12) dim = "2x10";
                else dim = "2x8"
                vals['dim'] = dim;
            }

                $('input[type=checkbox]').each(function () {
                    var sThisVal = (this.checked ? "1" : "0");
                    if(sThisVal == "1") var chkid = ($(this).prop("id"));
                    if(chkid)
                    {
                        console.log("id:\t" + chkid);
                        var idstr = chkid.split("_");
                        if(idstr.length>0)
                        {
                            var sec = idstr[0];
                            var id = idstr[1];
                            var arrname = idstr[0] + "arr";
                            console.log("section name:\t" + sec);
                            console.log("section id:\t" + id);
                            console.log("arr name:\t" + arrname);
                            var rate_min = arrloop(arrname,"id",id,"rate_min")
                            var rate_max = arrloop(arrname,"id",id,"rate_max")
                            if(rate_min) console.log(sec + " rate_min:\t" + rate_min);
                            if(rate_max) console.log(sec + " rate_max:\t" + rate_max);
                            if(sec=="deckmat")
                            {
                                vals['material'] = arrloop("deckmatarr","id",id,"qname");
                                //console.log("material\t" + material);
                            }
                            else if(sec=="deckingoptions")
                            {
                                var style = arrloop("deckingoptionsarr","id",id,"name");
                                vals['style'] = style;
                                console.log("DO_sec:\t" + sec);
                                console.log("deckmat:\t" + $("#deckmat").prop("id"));
                                console.log('dim\t' + vals['dim']);
                                console.log('material\t' + vals['material']);
                                console.log('style\t' + vals['style']);
                                var q = "select * from framing where dim = '" + vals['dim'] + "' AND style = '" + vals['style'] + "' AND material = '" + vals['material'] + "'";
                                var qresults = sql(vals);
                                console.log(qresults);

                                console.log('\n');
                            }
                        }
                    }
                });
            });
    });

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
        console.log("length:\t" + length);
        var width = $("#width").val();
        var height = $("#height").val();
        if(length && width)
        {
            sqft = length*width;
            linft = length*(width*2);
            bordft = (length*2)*(width*2);

            console.log("sqft:\t" + sqft);
            //return sqft;
            var dims = {}
            dims['sqft'] = sqft;
            dims['linft'] = linft;
            dims['bordft'] = bordft;
            dims['width'] = width;
            dims['length'] = length;
            return dims;
        }
    }

    function getbase(id)
    {
        $('input[type=checkbox]').each(function () {
            var cid = $(this).prop("id");
            if (cid.indexOf("deckmat") >= 0){
                $.each( deckmatarr, function( key, value ) {
                    console.log( key + ": " + value );
                });
            }
        });

    }
    function checkme(chk)
    {
        myid = "#" + chk + "_chk";
       // $(myid).trigger('change');
            console.log("before check status:\t" + $(myid).prop('checked'));
        if ($(myid).prop("checked") == false){
            $(myid).trigger('click');
            console.log("after click event status:\t" + $(myid).prop('checked'));
            $(myid).prop('checked', true);
            console.log("after setting true check status:\t" + $(myid).prop('checked'));
        }
        else {
            $(myid).trigger('click');
            console.log("after click event status:\t" + $(myid).prop('checked'));
            $(myid).prop('checked', false);
            console.log("after setting true check status:\t" + $(myid).prop('checked'));
        }


    }

    function arrloop(arr,chkfield,chkval,rtnfield){
        var fval = chkfield;
        var val = chkval;
        var rtn = rtnfield;
        console.log('arrloop array:\t' + arr);
        console.log('arrloop fval:\t' + chkfield);
        console.log('arrayLoop val:\t' + chkval);
        console.log('arrloop rtn:\t' + rtnfield);
        arr = window[arr];
        if(arr && fval && rtn)
        {
            for(var x=0;x<arr.length;x++)
            {
                console.log("field " + fval + ':\t'  + arr[x][fval]);
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
        var i=0;
        $.each(data.results, function(k, v) {
            $.each(v, function(key, value) {
                //$('#result_table').append('<br/>' + key + ' : ' + value);
                if(key == "rate_min") addft = value;
            })
        });
        console.log('addft\t' + addft);
        var mat = $("#deckmat_low_total");
        var deckopt = $("#deckingoptions_low_total");
        var dims = getdims();
        var sqft = dims['sqft'];
        var basemin = Number(baseratemin);
        var basemax = Number(baseratemax);
        var num = basemin + Number(addft);
        var answer = num*sqft;
        $(mat).html('$' + answer);
        $(deckopt).html('$' + answer);
    }
</script>
</html>

<?

?>