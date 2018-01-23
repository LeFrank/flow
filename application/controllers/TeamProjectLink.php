<?php

/*
 * To change this license header, choose License Headers in Team Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timeline
 *
 * @author francois
 */
class TeamProjectLink extends CI_Controller {

    var $toolId = 5;
    var $toolName = "Team Project Link";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('team_project_model');
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

    public function link_team_to_project() {
        $data['title'] = 'Create a Project';
        $this->load->model('team_project_model');
        $data["teamProjectLink"] = $this->team_project_model->link_team_to_project();
        echo $data["teamProjectLink"];
    }
}
