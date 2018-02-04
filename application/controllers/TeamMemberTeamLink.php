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
class TeamMemberTeamLink extends CI_Controller {

    var $toolId = 5;
    var $toolName = "Team Member_Team Link";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('team_member_team_model');
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

    public function link_team_member_to_team() {
        $data['title'] = 'Create a MemberTeam';
        $this->load->model('team_member_team_model');
        $data["teamMemberTeamLink"] = $this->team_member_team_model->link_team_member_to_team();
        echo $data["teamMemberTeamLink"];
    }
}
