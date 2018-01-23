<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timeline
 *
 * @author francois
 */
class Timeline extends CI_Controller {
        var $toolId = 1;
    var $toolName = "Time Line";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('auth_helper');
        $this->load->helper("array_helper");
        $this->load->helper('usability_helper');
        $this->load->helper('url');
        $this->load->helper('email');
        $this->load->helper('timeline_helper');
        $this->load->library('form_validation');
        can_access(
                $this->require_auth, $this->session);
    }
    
    public function index(){
        $data["css"] = "<meta name='viewport' content='width=device-width, initial-scale=1'><link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'><link href='/css/third_party/responsive-timeline/style.css' rel='stylesheet' />";
        $this->load->view('header_no_banner',$data);
        $this->load->view('timeline/index');
        $this->load->view('footer_no_banner');
    }
}
