<?php
Class Estimator_model extends CI_Model
{
function Estimator_model()
{
        parent::__construct();
        $this->load->database();
}

function estimator_form()
{
    $editing = false;
    if($_POST) $editing = true;
	$data['fields'] = array
	(
		'fname' => 'First Name',
		'lname' => 'Last Name',
		'email' => 'Email',
		'deck_lenth' => 'Deck Length',
		'deck_width' => 'Deck Width',
		'deck_len' => 'Deck Height'
	);

    if($editing)
    {
        //die(print_r($this->input->post()));
        $val_user = array
        (
            'fname'=>$this->input->post('fname'),
            'lname'=>$this->input->post('lname'),
            'email'=>$this->input->post('email'),
            'ip'=>$_SERVER['REMOTE_ADDR']
        );

//<----------- Save user data

        $saveit = $this->save_data($val_user,'users');

//<----------- Get user_id back from db to insert into session table

        $uid_query = $this->db->query("select id from users where email = '" .  $val_user['email'] . "' and ip = '" . $val_user['ip'] . "'");
        if ($uid_query->num_rows() > 0) $uid = $uid_query->row_array();
        //die($uid['id']);

        $count = count($this->input->post());
        $ms="";
        $x=0;
        foreach($this->input->post() as $k=>$arr)
        {

            if(strpos($k,'addl_services') !== false)
            {
                //echo $arr . "<br/>";
                if($x>0)$ms .= ',' . (string)$arr;
                else $ms = (string)$arr;
                $x++;
                echo $ms;
            }

        }
        $val_session = array
        (
            'mobile'=>$this->input->post('mobile'),
            'dims_length'=>$this->input->post('dims_length'),
            'dims_width'=>$this->input->post('dims_width'),
            'dims_height'=>$this->input->post('dims_height'),
            'user_id'=>(int)$uid['id'],
            'material_id'=>explode("_",$this->input->post('deckmatradio'))[1],
            'style_id'=>explode("_",$this->input->post('deckingoptionsradio'))[1],
            'border_id'=>explode("_",$this->input->post('deckingoptionsbordradio_mult'))[1],
            'lighting_id'=>explode("_",$this->input->post('lightingradio_mult'))[1],
            'railing_id'=>explode("_",$this->input->post('railingradio'))[1],
            'stairs_id'=>explode("_",$this->input->post('stairsradio'))[1],
            'extra_id'=>explode("_",$this->input->post('extrasradio_mult'))[1],
            'addl_services'=>$ms,
            'feedback'=>$this->input->post('feedback')
        );
       //die(print_r($this->input->post()));

//<----------- Save session data

        $saveit = $this->save_data($val_session,'session');
        redirect('main');

    }
	$imgurl = $this->config->base_url() . "assets/img/";
	$x=0;
 /*
	$data['materials'] = array
	(
		// Type,Rate Min, Rate Max, Unit (1=ea. 2= sq. ft. 3= linear feet, avg min, avg max)
		
		'Redwood'=>array
        (
        'name'=>"Redwood",
        'imgurl'=>$imgurl . "icons/redwood_small.jpg",
        ),
		'Fiberon'=>array
        (
        'name'=>"Fiberon",
        'imgurl'=>$imgurl . "icons/fiberon_small.jpg"
        )
	);
	$data['style'] = array
	(
		'Strait'=>array
        (
        'name'=>"Strait",
        'imgurl'=>$imgurl . "strait-deck.jpg",
        'rate_min'=>31,
        'rate_max'=>32,
        'unit_type'=>2,
        'avg_min'=>250,
        'avg_max'=>400
        ),
		'Diagonal'=>array(
        'name'=>"Diagonal",
        'imgurl'=>$imgurl . "angled-deck.jpg",
        'rate_min'=>45,
        'rate_max'=>50,
        'unit_type'=>2,
        'avg_min'=>250,
        'avg_max'=>400
        )
		// ADD BORDER
		// Type,Rate Min, Rate Max, Unit (1=ea. 2= sq. ft. 3= linear feet, avg min, avg max)
	);
	*/
/*
        array("Fiberon","2x8","16in. OC",31,32,2,250,400),
		array("Fiberon","2x10","16in. OC",33,35,2,1,1),
		array("Redwood","2x8","16in. OC",24.5,26,2,0,0),
		array("Redwood","2x10","16in. OC",26,29,2,0,0),
		array("Narrow,12in OC",3.45,3.75,2,1)

	
	);
    
    	$data['railing'] = array
	(
		// Type,Rate Min, Rate Max, Unit (1=ea. 2= sq. ft. 3= linear feet, avg min, avg max)
		array("Composite Rail Fortress Balusters",30,35,3,1,1, $imgurl . "composite-rail-fortress-balusters.jpg", "http://www.bhg.com/home-improvement/deck/ideas/choose-the-right-material-decking/"),
		array("Metal Rail Panels",30,35,3,1,1, $imgurl . "railingworksphoto.jpg", "http://www.bhg.com/home-improvement/deck/ideas/choose-the-right-material-decking/"),
	
	);
    
    	$data['lighting'] = array
	(
		array("Transformer 12v",140,165,1,1,1,$imgurl . "12v-transformer.jpg"),
		array("Post Lights",65,70,1,6,6,$imgurl . "deck-lighting.jpg"),
		array("Riser Lights",50,55,1,1,1,$imgurl . "deck-riser-lights.jpg")
	);
    	$x+=1;
	$data['extras'] = array
	(
		array("Fire Pit",1900,2500,1,1,1,$imgurl . "firepit.jpg")
	);
    	$data['stairs']= array
	(
		array("Composite Stairs 3' wide -closed",55,60,1,8,8, $imgurl . "icons/straitdecking.jpg")
	);
*/	
   // $data['material'] = $this->db->query('select * from material');
	$data['pier'] = $this->db->query('select * from pier');
	$data['deckingoptions'] = $this->db->query('select * from deckingoptions');
    $data['railing'] = $this->db->query('select * from railing');
    $data['framing'] = $this->db->query('select * from framing');
    $data['deckmat'] = $this->db->query('select * from deckmat');
    $data['lighting'] = $this->db->query('select * from lighting');
    $data['stairs'] = $this->db->query('select * from stairs');
    $data['extras'] = $this->db->query('select * from extras');
    $data['addl_services'] = $this->db->query('select * from addl_services');
    $data['baserate'] = $this->db->query('select rate_min,rate_max from framing where name = "base"');

    return $data;
	//$this->load->view('estimator_view',$data);
}

function save_data($form_data=null,$table)
{
        $this->db->insert($table, $form_data);
}


}

/* USER-AGENTS
================================================== */
function check_user_agent ( $type = NULL ) {
    $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
    //print_r( $user_agent);
    if ( $type == 'bot' ) {
        // matches popular bots
        if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
            return true;
            // watchmouse|pingdom\.com are "uptime services"
        }
    } else if ( $type == 'browser' ) {
        // matches core browser types
        if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
            return true;
        }
    } else if ( $type == 'mobile' ) {
        // matches popular mobile devices that have small screens and/or touch inputs
        // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
        // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
        if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
            // these are the most common
            return $user_agent;
        } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
            // these are less common, and might not be worth checking
            return true;
        }
    }
    return false;
}

?>
