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
class Event extends CI_Controller {

    var $toolId = 6;
    var $toolName = "Event";
    var $require_auth = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->model('client_model');
        $this->load->model('project_model');
        $this->load->model('team_model');
        $this->load->model('team_member_model');
        $this->load->model('event_model');
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
        $data["clients"] = arrayMap($this->client_model->getClients( null, 0, false, "name" ,"ASC"));
        $data["projects"] = arrayMap($this->project_model->getProjects(null, 0, false, "name" ,"ASC"));
        $data["teams"] = arrayMap($this->team_model->getTeams(null, 0, false, "name" ,"ASC"));
        $data["teamMembers"] = arrayMap($this->team_member_model->getTeamMembers(null, 0, false, "name" ,"ASC"));
        $data["events"] = $this->event_model->getEvents();
        $this->load->view('header');
        $this->load->view('event/event_nav', $data);
        $this->load->view('event/index', $data);
        $this->load->view('event/event_includes', $data);
        $this->load->view('footer');
    }

    public function capture() {
        $data['title'] = 'Create an Event';
        $this->form_validation->set_rules('title', 'title', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo "fail";
            $data["events"] = "";
            $this->load->view('header');
            $this->load->view('event/event_nav', $data);
            $this->load->view('event/index', $data);
            $this->load->view('footer');
        } else {
            echo "suc";
            $data["event"] = $this->event_model->capture_event();
            redirect("/events", "refresh");
        }
    }

    public function edit($clientId) {
        $data['title'] = 'Edit a Client';
        $data["client"] = $this->client_model->getClient($clientId);
        $this->load->view('header');
        $this->load->view('client/client_nav', $data);
        $this->load->view('client/edit', $data);
        $this->load->view('client/client_includes', $data);
        $this->load->view('footer');
    }

    public function delete($clientId) {
        if($data["client"] = $this->client_model->delete($clientId)){
            redirect("/clients", "refresh");
        }else{
            redirect("/clients", "refresh");
        }
            
    }

    public function update($clientId) {
        $data['title'] = 'Create a Client';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["clients"] = "";
            $this->load->view('header');
            $this->load->view('client/client_nav', $data);
            $this->load->view('client/index', $data);
            $this->load->view('footer');
        } else {
            $data["client"] = $this->client_model->update();
            redirect("/clients", "refresh");
        }
    }

}
