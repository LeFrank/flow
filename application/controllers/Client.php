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
class Client extends CI_Controller {

    var $toolId = 3;
    var $toolName = "Client";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('client_model');
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

    public function index() {
        $data["exitCheck"] = true;
        $data["clients"] = $this->client_model->getClients();
        $this->load->view('header');
        $this->load->view('client/index',$data);
        $this->load->view('client/client_includes', $data);
        $this->load->view('footer');
    }

    public function capture() {
        $data['title'] = 'Create a Client';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["clients"] = "";
            $this->load->view('header');
            $this->load->view('client/client_nav', $data);
            $this->load->view('client/index', $data);
            $this->load->view('footer');
        } else {
            $data["client"] = $this->client_model->capture_client();
            redirect("/clients", "refresh");
        }
    }

}
