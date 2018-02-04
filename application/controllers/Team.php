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
class Team extends CI_Controller {

    var $toolId = 6;
    var $toolName = "Team";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('team_model');
        $this->load->model('team_model');
        $this->load->model('project_model');
        $this->load->model('team_project_model');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('auth_helper');
        $this->load->helper("array_helper");
        $this->load->helper('usability_helper');
        $this->load->helper('url');
        $this->load->helper('email');
        $this->load->helper('timeline_helper');
        $this->load->helper('team_project_link_helper');
        $this->load->library('form_validation');
        can_access(
                $this->require_auth, $this->session);
    }

    public function index() {
        $data["exitCheck"] = true;
        $data["teams"] = $this->team_model->getTeams();
        $data["linkedProjects"] = $this->team_project_model->getTeamProjectLinks();
        $data["teamMap"] = mapTeamIdToProject($data["linkedProjects"]);
        $linkedProjects = getLinkedProjectIds($data["linkedProjects"]);
        $data["projects"] = arrayMap($this->project_model->getProjectsByIds($linkedProjects));
        $this->load->view('header');
        $this->load->view('team/index',$data);
        $this->load->view('team/team_includes', $data);
        $this->load->view('footer');
    }

    public function capture() {
        $data['title'] = 'Create a Project';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["teams"] = "";
            $this->load->view('header');
            $this->load->view('team/team_nav', $data);
            $this->load->view('team/index', $data);
            $this->load->view('footer');
        } else {
            $data["team"] = $this->team_model->capture_team();
            redirect("/teams", "refresh");
        }
    }
    
    
    public function linkProject($teamId) {
        $data['title'] = 'Link a team to a project';
        $this->load->model('project_model');
        
        $data["teamId"] = $teamId;
        $data["linkedProjects"] = $this->team_project_model->getTeamProjectLinksbyTeamId($teamId);
        $data["linkedProjectArr"] = array_column($data["linkedProjects"], "project_id");
        $data["projects"] = $this->project_model->getProjects();
        $data["team"] = $this->team_model->getTeam($teamId);
        $data["unlinkedProjects"] = removeLinkedProjects($data["projects"], $data["linkedProjects"]);
        $this->load->view('header');
        $this->load->view('team/link_to_project',$data);
        $this->load->view('team/team_includes', $data);
        $this->load->view('footer');
    }

        public function edit($teamId) {
        $data['title'] = 'Edit a Team';
        $data["team"] = $this->team_model->getTeam($teamId);
        $this->load->view('header');
        $this->load->view('team/team_nav', $data);
        $this->load->view('team/edit', $data);
        $this->load->view('team/team_includes', $data);
        $this->load->view('footer');
    }

    public function delete($teamId) {
        if($data["team"] = $this->team_model->delete($teamId)){
            redirect("/teams", "refresh");
        }else{
            redirect("/teams", "refresh");
        }
            
    }

    public function update($teamId) {
        $data['title'] = 'Create a Team';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["teams"] = "";
            $this->load->view('header');
            $this->load->view('team/team_nav', $data);
            $this->load->view('team/index', $data);
            $this->load->view('footer');
        } else {
            $data["team"] = $this->team_model->update();
            redirect("/teams", "refresh");
        }
    }
    
}
