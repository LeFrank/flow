<?php

/*
 * To change this license header, choose License Headers in TeamMember Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timeline
 *
 * @author francois
 */
class TeamMember extends CI_Controller {

    var $toolId = 6;
    var $toolName = "TeamMember";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('team_member_model');
        $this->load->model('team_model');
        $this->load->model('team_member_team_model');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('auth_helper');
        $this->load->helper("array_helper");
        $this->load->helper('usability_helper');
        $this->load->helper('url');
        $this->load->helper('email');
        $this->load->helper('timeline_helper');
        $this->load->helper('team_member_team_link_helper');
        $this->load->library('form_validation');
        can_access(
                $this->require_auth, $this->session);
    }

    public function index() {
        $data["exitCheck"] = true;
        $data["team_members"] = $this->team_member_model->getTeamMembers();
        $data["linkedTeams"] = $this->team_member_team_model->getTeamMemberTeamLinks();
        $data["team_memberMap"] = mapTeamMemberIdToTeam($data["linkedTeams"]);
        $linkedTeams = getLinkedTeamIds($data["linkedTeams"]);
        $data["teams"] = arrayMap($this->team_model->getTeamsByIds($linkedTeams));
        $this->load->view('header');
        $this->load->view('team_member/index',$data);
        $this->load->view('team_member/team_member_includes', $data);
        $this->load->view('footer');
    }

    public function capture() {
        $data['title'] = 'Create a Team';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["team_members"] = "";
            $this->load->view('header');
            $this->load->view('team_member/team_member_nav', $data);
            $this->load->view('team_member/index', $data);
            $this->load->view('team_member/team_member_includes', $data);
            $this->load->view('footer');
        } else {
            $data["team_member"] = $this->team_member_model->capture_team_member();
            redirect("/team_members", "refresh");
        }
    }
    
    
    public function linkTeam($team_memberId) {
        $data['title'] = 'Link a team_member to a team';
        $this->load->model('team_model');
        
        $data["team_memberId"] = $team_memberId;
        $data["linkedTeams"] = $this->team_member_team_model->getTeamMemberTeamLinksbyTeamMemberId($team_memberId);
        $data["linkedTeamArr"] = array_column($data["linkedTeams"], "team_id");
        $data["teams"] = $this->team_model->getTeams();
        $data["team_member"] = $this->team_member_model->getTeamMember($team_memberId);
        $data["unlinkedTeams"] = removeLinkedTeams($data["teams"], $data["linkedTeams"]);
        $this->load->view('header');
        $this->load->view('team_member/link_to_team',$data);
        $this->load->view('team_member/team_member_includes', $data);
        $this->load->view('footer');
    }

}
