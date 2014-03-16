<?php
/**
 * Created by PhpStorm.
 * User: davet_000
 * Date: 2/16/14
 * Time: 1:22 PM
 */
?>
<table display="border:none;" cellpadding="0" cellspacing="0" width="700" class="form">
    <tbody><tr><td class="label top">First Name</td><td class="value"><input name="fname" class="input">
        </td></tr>
    <tr><td class="label">Last Name</td><td class="value"><input name="lname" class="input">
        </td></tr>
    <tr><td class="label">Email Address</td><td class="value"><input name="email" class="input">
        </td></tr>
<!--
        <tr>
        <td class="label">Site Logo</td>
        <td class="lu">   <div class="anew-instr">PNG format only. Background knocked out. Please resize your logo to be no taller than 200px and no wider than 400px. The optimal size is 120px height x300 width</div>

            <div id="logoUpload" class="gupl" style="width:0;">
                <strong>Upload : Replace this image  <br><small>Web formats only (jpg, gif, png, bmp)</small> </strong>
                <input type="file" class="input" name="site_logo" size="20">
                <small><a href="javascript:;" onclick="replaceGraphic('logo','logoUpload',0)">cancel</a></small>
            </div>
            <img src="/client/uploads/logos/29000Now_New_Logo.png" height="70" id="logo"> <br>
            <small><a href="javascript:;" onclick="replaceGraphic('logo','logoUpload',1)">replace this image</a></small>
        </td></tr>

    <tr>

    </tr><tr><td class="label">What city or area is your market? </td><td class="value"><input class="input">  <div class="anew-instr">This goes in a couple spots including the masthead text: "The Best of "<br>ie: Mid-South, Greater Salt Lake Area or Western Texas</div>
        </td></tr><tr><td class="label">Default City</td><td class="value"><input name="defaultCity" class="input" value="West Palm Beach">	  <div class="anew-instr">used as the default for web forms</div>					</td></tr>
    <tr><td class="label">Default State </td><td class="value"><input name="defaultState" class="input" value="FL">	<div class="anew-instr"> (2 letter abbr)</div>
        </td></tr>

    <tr><td class="label">Timezone</td><td class="value"><select name="time_offset" class="select">
                <option value="-6">HST (Hawaiian Time)</option>
                <option value="-4">AKDT (Alaska Time)</option>
                <option value="-3">PDT (Pacific Time)</option>
                <option value="AZ">ADT (Arizona Time)</option>
                <option value="-2">MDT (Mountain Time)</option>
                <option value="-1">CDT (Central Time)</option>
                <option value="0" selected="">EDT (Eastern Time)</option>
            </select>
        </td></tr>
 -->



    <tr><td class="label">I am also interested in:</td><td class="value">
            <?
            //$count = count($addl_services);
            foreach($addl_services->result() as $val)
            {
            ?>
                <label><?=$val->name?></label><input name="addl_services_<?=$val->id?>" type="checkbox" value="<?=$val->id?>" id="<?=$val->id?>">&nbsp;

            <?
            }
            ?>
        </td></tr>



    <tr>
        <td class="label">Feedback</td>
        <td class="value">
            <div class="anew-instr">
                We'd love to hear what you think about our deck tool
            </div>
            <textarea class="textarea" name="feedback"></textarea>
        </td>
    </tr>

    </tbody></table>