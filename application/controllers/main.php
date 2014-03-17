<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Main extends CI_Controller
{

public function __construct()
{
	
	parent::__construct();
    $this->load->database();
	
}


function index($data = null)
{
	//error_reporting(E_ALL);
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');


    if($data)
    {
	$data = array('arr' => $this->estimator_model->estimator_form());

        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('layout');
        }
        else
        {
            $this->load->view('success');
        }
    }

    $this->load->model('estimator_model');
    $data = $this->estimator_model->estimator_form();
    $this->load->view('layout',$data);

}

function test()
{
	$this->load->view('contact');
}

function data($data=null)
{
	echo 'This is the ' . $data . ' from data';
}

function alter($name=null)
{
    $table = array(
        "framing",
        "extras",
        "lighting",
        "pier",
        "railing",
        "stairs",
        "style"
    );

    for ($t=0;$t<count($table);$t++)
    {
        //$q = 'ALTER TABLE $table[$t] ADD $name INT NULL';
        //$q = 'ALTER TABLE $table[$t] DROP $name';
        $q = "UPDATE " . $table[$t] . " SET " .$name ." = REPLACE(" . $name . ", '/konacontractors', '') WHERE " . $name . " LIKE '%/konacontractors%'" . ";";
        echo $q . "<br />";
        //$this->db->query($q);
//        ALTER TABLE  `style` ADD  `user_id` INT NULL ;
    }
}

    function getValues(){
        if($_POST)
        {
            $bordid=0;
            $railingid=0;
            $stairsid=0;
            $dim = $this->input->post('dim');
            $material = $this->input->post('material');
            $style = $this->input->post('style');
            if($this->input->post('deckingoptionsbordid')) $bordid = $this->input->post('deckingoptionsbordid');
            if($this->input->post('railingid')) $railingid = $this->input->post('railingid');
            if($this->input->post('stairsid')) $stairsid = $this->input->post('stairsid');
        }

        $q = "select * from framing where dim = '" . $dim . "' AND style = '" . $style . "' AND material = '" . $material . "'";
        $q2 = "select * from framing where dim = '" . $dim . "' AND material = '" . $material . "'";
        $this->load->model('get_db');

        $bord_q = "select * from deckingoptions where id =" . $bordid;
        $data['bord_result'] = $this->get_db->getAll($bord_q);

        $railing_q = "select * from railing where id =" . $railingid;
        $data['railing_result'] = $this->get_db->getAll($railing_q);

        $stairsid_q = "select * from stairs where id =" . $stairsid;
        $data['stairs_result'] = $this->get_db->getAll($stairsid_q);

        $data['results'] = $this->get_db->getAll($q);
        $data['base_result'] = $this->get_db->getAll($q2);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
        return $data;
    }

function success($data = null)
{
	echo 'Success';
}


}

?>
