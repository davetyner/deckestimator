<?php
class Get_db extends CI_Model{

    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    function getAll($q){
        $query=$this->db->query($q);
        return $query->result();
        //returns from this string in the db, converts it into an array
    }
}

/**
 * Created by PhpStorm.
 * User: davet_000
 * Date: 3/15/14
 * Time: 6:51 PM
 */
?>