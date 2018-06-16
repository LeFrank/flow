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
    
    public function index(){
        $startDate = $endDate = null;
        if(null != $this->input->post("fromDate")){
            $startDate = $this->input->post("fromDate");
        }
        if(null != $this->input->post("toDate")){
            $endDate = $this->input->post("toDate");
        }
        if($startDate == null){
            $startDate = date('Y/m/d H:i', strtotime('-1 year'));
        }else{
            $startDate = date('Y/m/d H:i', strtotime($startDate));
        }
//        echo $startDate;
        if($endDate== null ){
            $endDate = date('Y/m/d H:i', strtotime("now"));
        }else{
            $endDate = date('Y/m/d H:i', strtotime($endDate));
        }
//        echo "<br/>".$endDate;
        $search["startDate"] = $startDate;
        $search["endDate"] = $endDate;
        $data["startDate"] = $startDate;
        $data["endDate"] = $endDate;
//        $data["css"] = "<meta name='viewport' content='width=device-width, initial-scale=1'>";
//        $data["css"] = "<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>";
        $data["css"] = "<link href='/css/third_party/responsive-timeline/style.css' rel='stylesheet' />";
        $data["clients"] = arrayMap($this->client_model->getClients( null, 0, false, "name" ,"ASC"));
        $data["projects"] = arrayMap($this->project_model->getProjects(null, 0, false, "name" ,"ASC"));
        $data["teams"] = arrayMap($this->team_model->getTeams(null, 0, false, "name" ,"ASC"));
        $data["teamMembers"] = arrayMap($this->team_member_model->getTeamMembers(null, 0, false, "name" ,"ASC"));
        $data["events"] = $this->event_model->getEventsByDateRange($data["startDate"], $data["endDate"]);
//        $this->load->view('header_no_banner',$data);
        $this->load->view('header',$data);
        $this->load->view('timeline/index');
        $this->load->view('footer_no_banner');
    }
}
