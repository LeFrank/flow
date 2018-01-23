<?php

class Team_member_team_model extends CI_Model {

    var $tn = "team-member-team";

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
    public function link_team_member_to_team() {
        $this->load->helper('date');
        $this->load->library("session");
        $data = array(
            'created_by' => $this->session->userdata("user")->id,
            'team_member_id' => $this->input->post('team_member_id'),
            'team_id' => $this->input->post('team_id'),
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
    public function getTeamMemberTeamLinkById($id) {
        $query = $this->db->get_where($this->tn, array('id' => $id));
        return $query->row();
    }
    
    public function getTeamMemberTeamLinks() {
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
    public function getTeamMemberTeamLinksbyTeamId($teamId, $limit = null, $offset = 0, $count = false) {
//        echo "userId: ".$userId." >> limit: ".$limit . " >> offset: ". $offset ." >> count: ". $count;
        $this->db->order_by("created_date", "desc");
        if (null == $limit) {
            $query = $this->db->get_where($this->tn, array("team_id" => $teamId));
        }
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
    public function getTeamMemberTeamLinksbyTeamMemberId($teamMemberTeam, $limit = null, $offset = 0, $count = false) {
//        echo "userId: ".$userId." >> limit: ".$limit . " >> offset: ". $offset ." >> count: ". $count;
        $this->db->order_by("created_date", "desc");
        if (null == $limit) {
            $query = $this->db->get_where($this->tn);
        }
        $query = $this->db->get_where($this->tn, array("team_member_id", $teamMemberId));
//        echo $this->db->last_query();
        if ($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }

    public function getTeamMemberTeamLinksByIds($userId, $teamMemberTeamIds) {
        if ($userId == null) {
            return null;
        }
        $this->db->order_by("create_date", "desc");
        $this->db->where_in('id', $teamMemberTeamIds);
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
            'team_member_id' => $this->input->post('team_member_id'),
            'team_id' => $this->input->post('team_id'),
            'status' => $this->input->post('status'),
            'created_date' => date('Y/m/d H:i', strtotime($this->input->post('created_date')))
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update($this->tn, $data);
    }
}
