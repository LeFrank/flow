<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('form');
    }

    public function index() {
        $this->load->helper('cookie');
        $this->load->helper('email');
        $this->load->library('form_validation');
        $this->load->view('header');
        $this->load->view('home/home');
        $this->load->view('footer');
    }

    function dashboard() {
        $this->load->view('header');
        $this->load->helper('url');
        if (empty($this->session->userdata["loggedIn"])) {
                redirect('/', 'refresh');
        }else if(!$this->session->userdata["loggedIn"]){
            redirect('/', 'refresh');
        }
   
        if ($this->session->userdata("isAdmin")) {
            $data["css"] = "<link href='/css/third_party/fullcalendar/fullcalendar.css' rel='stylesheet' />
                            <link href='/css/third_party/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />";
            $user = $this->session->userdata("user");
            //get calendar data
            $search["showOnDashboard"] = 1;
            // get admin data
            // what is admin data?
            $data["registered_users"] = $this->user_model->get_admin_data();
            $this->load->view('home/admin-dashboard', $data);
        } else {

            $data["css"] = "<link href='/css/third_party/fullcalendar/fullcalendar.css' rel='stylesheet' />
                            <link href='/css/third_party/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />";
            $user = $this->session->userdata("user");
            //get calendar data
            $search["showOnDashboard"] = 1;
            //$this->expenseBudgetItems->manage(7);
            $this->load->view('home/user-dashboard');
        }
        $this->load->view('footer');
    }

}
