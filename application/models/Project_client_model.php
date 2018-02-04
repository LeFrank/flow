<?php

class Project_client_model extends CI_Model {

    var $tn = "project-clients";

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
//        $this->load->model("note_tag_model");
        date_default_timezone_set('Africa/Johannesburg');
    }

    /**
     * Capture a users expense from a post request. 
     * @return type
     */
    public function link_project_to_client() {
        $this->load->helper('date');
        $this->load->library("session");
        $data = array(
            'created_by' => $this->session->userdata("user")->id,
            'project_id' => $this->input->post('project_id'),
            'client_id' => $this->input->post('client_id'),
            'status' => $this->input->post('status'),
            'created_date' => date('Y/m/d H:i')
        );
        return $this->db->insert($this->tn, $data);
    }

    /**
     * 
     * @param type $id
     */
    public function delete($id) {
        $this->db->where("id", $id);
        $this->db->delete($this->tn);
    }

    /**
     * 
     * @param type $userId
     */
    public function deleteUserData($userId) {
        $this->db->where("user_id", $userId);
        $this->db->delete($this->tn);
    }

    /**
     * 
     * @param type $userId
     * @param type $id
     * @return type
     */
    public function doesItBelongToMe($userId, $id) {
        $query = $this->db->get_where($this->tn, array('created_by' => $userId, 'id' => $id));
        return $query->num_rows();
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getProjectClientLinkById($id) {
        $query = $this->db->get_where($this->tn, array('id' => $id));
        return $query->row();
    }
    
    public function deleteProjectClientLinkByProjectId($projectId) {
        $this->db->where('project_id' ,$projectId);
        $this->db->delete($this->tn);
        log_message('ERROR',$this->db->last_query());
        echo $this->db->last_query();
    }
    
    public function getProjectClientLinks() {
        $query = $this->db->get_where($this->tn);
        return $query->result();
    }

    /**
     * Get notes bases on certain criteria
     * @param type $userId if present return this users notes.
     * @param type $limit if preset return a limited result set
     * @param type $offset if present offset the result by this value else no offset
     * @return null
     */
    public function getProjectClientLinksbyProjectId($projectId, $limit = null, $offset = 0, $count = false) {
//        echo "userId: ".$userId." >> limit: ".$limit . " >> offset: ". $offset ." >> count: ". $count;
        $this->db->order_by("created_date", "desc");
        $query = $this->db->get_where($this->tn, array("project_id"=> $projectId));
//        echo $this->db->last_query();
        if ($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }
    /**
     * Get notes bases on certain criteria
     * @param type $userId if present return this users notes.
     * @param type $limit if preset return a limited result set
     * @param type $offset if present offset the result by this value else no offset
     * @return null
     */
    public function getProjectClientLinksbyClientId($clientId, $limit = null, $offset = 0, $count = false) {
//        echo "userId: ".$userId." >> limit: ".$limit . " >> offset: ". $offset ." >> count: ". $count;
        $this->db->order_by("created_date", "desc");
        if (null == $limit) {
            $query = $this->db->get_where($this->tn);
        }
        $query = $this->db->get_where($this->tn, array("client_id"=> $clientId));
//        echo $this->db->last_query();
        if ($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }

    public function getProjectClientLinksByIds($userId, $projectClientIds) {
        if ($userId == null) {
            return null;
        }
        if ($noteIds == null) {
            return null;
        }
        $this->db->order_by("create_date", "desc");
        $this->db->where_in('id', $projectIds);
        $query = $this->db->get_where($this->tn, array('created_by' => $userId), 100);
        return $query->result_array();
    }

    /**
     * Update the note, expects post and session data to be present.
     * @return type
     */
    public function update() {
        $data = array(
            'created_by' => $this->session->userdata("user")->id,
            'project_id' => $this->input->post('project_id'),
            'client_id' => $this->input->post('client_id'),
            'status' => $this->input->post('status'),
            'created_date' => date('Y/m/d H:i', strtotime($this->input->post('created_date')))
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update($this->tn, $data);
    }
}
