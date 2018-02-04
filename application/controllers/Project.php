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
class Project extends CI_Controller {

    var $toolId = 4;
    var $toolName = "project";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('client_model');
        $this->load->model('project_client_model');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('auth_helper');
        $this->load->helper("array_helper");
        $this->load->helper('usability_helper');
        $this->load->helper('url');
        $this->load->helper('email');
        $this->load->helper('timeline_helper');
        $this->load->helper('project_client_link_helper');
        $this->load->library('form_validation');
        can_access(
                $this->require_auth, $this->session);
    }

    public function index() {
        $data["exitCheck"] = true;
        $data["projects"] = $this->project_model->getProjects();
        $data["linkedClients"] = $this->project_client_model->getProjectClientLinks();
        $data["projectMap"] = mapProjectIdToClient($data["linkedClients"]);
        $linkedClients = getLinkedClientIds($data["linkedClients"]);
        $data["clients"] = arrayMap($this->client_model->getClientsByIds($linkedClients));
        $this->load->view('header');
        $this->load->view('project/index',$data);
        $this->load->view('project/project_includes', $data);
        $this->load->view('footer');
    }

    public function capture() {
        $data['title'] = 'Create a Client';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["projects"] = "";
            $this->load->view('header');
            $this->load->view('project/project_nav', $data);
            $this->load->view('project/index', $data);
            $this->load->view('footer');
        } else {
            $data["project"] = $this->project_model->capture_project();
            redirect("/projects", "refresh");
        }
    }
    
    
    public function linkClient($projectId) {
        $data['title'] = 'Link a project to a client';
        $this->load->model('client_model');
        
        $data["projectId"] = $projectId;
        $data["linkedClients"] = $this->project_client_model->getProjectClientLinksbyProjectId($projectId);
        $data["linkedClientArr"] = array_column($data["linkedClients"], "client_id");
        $data["clients"] = $this->client_model->getClients();
        $data["project"] = $this->project_model->getProject($projectId);
        $data["unlinkedClients"] = removeLinkedClients($data["clients"], $data["linkedClients"]);
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
        $this->load->view('header');
        $this->load->view('project/link_to_client',$data);
        $this->load->view('project/project_includes', $data);
        $this->load->view('footer');
    }

    public function edit($projectId) {
        $data['title'] = 'Edit a Project';
        $data["project"] = $this->project_model->getProject($projectId);
        $this->load->view('header');
        $this->load->view('project/project_nav', $data);
        $this->load->view('project/edit', $data);
        $this->load->view('project/project_includes', $data);
        $this->load->view('footer');
    }

    public function delete($projectId) {
        $outp = $data["project"] = $this->project_model->delete($projectId);
        echo "$outp: " . $outp;
        if($data["project"] = $this->project_model->delete($projectId)){
            echo "$projectId: e".$projectId;
            log_message("ERROR", "$projectId: ".$projectId );
            $this->project_client_model->deleteProjectClientLinkByProjectId($projectId);
            redirect("/projects", "refresh");
        }else{
            redirect("/projects", "refresh");
        }
            
    }

    public function update($projectId) {
        $data['title'] = 'Create a Project';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["projects"] = "";
            $this->load->view('header');
            $this->load->view('project/project_nav', $data);
            $this->load->view('project/index', $data);
            $this->load->view('footer');
        } else {
            $data["project"] = $this->project_model->update();
            redirect("/projects", "refresh");
        }
    }
    
}
