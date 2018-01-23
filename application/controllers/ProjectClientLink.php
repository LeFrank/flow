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
class ProjectClientLink extends CI_Controller {

    var $toolId = 5;
    var $toolName = "Project Client Link";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('project_client_model');
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

    public function link_project_to_client() {
        $data['title'] = 'Create a Client';
        $this->load->model('project_client_model');
        $data["projectClientLink"] = $this->project_client_model->link_project_to_client();
        echo $data["projectClientLink"];
    }
}
