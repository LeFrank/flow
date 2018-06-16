<?php

class Event_model extends CI_Model {

    var $tn = "event";

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
    public function capture_event() {
        $this->load->helper('date');
        $this->load->library("session");
        $data = array(
            'created_by' => $this->session->userdata("user")->id,
            'title' => $this->input->post('title'),
            'content' => preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $this->input->post('content')),
//            'status' => $this->input->post('status'),
            'order' => 0,
            'client_id' => $this->input->post('clientId'),
            'project_id' => $this->input->post('projectId'),
            'team_id' => $this->input->post('teamId'),
            'start_date' => date('Y/m/d H:i', strtotime($this->input->post('start_date'))),
            'end_date' => date('Y/m/d H:i', strtotime($this->input->post('end_date'))),
//            'status' => $this->input->post('status'),
            'created_date' => date('Y/m/d H:i')
        );
//        echo $id = $this->db->insert($this->tn, $data);
//        $tags = explode(",", $this->input->post('tags'));
//        foreach($tags as $k=>$v){
//            echo $v;
//            $
//        }
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
    public function getClient($id) {
        $query = $this->db->get_where($this->tn, array('id' => $id));
        return $query->row();
    }

    /**
     * Get notes bases on certain criteria
     * @param type $userId if present return this users notes.
     * @param type $limit if preset return a limited result set
     * @param type $offset if present offset the result by this value else no offset
     * @return null
     */
    public function getEvents($limit = null, $offset = 0, $count = false) {
//        echo "userId: ".$userId." >> limit: ".$limit . " >> offset: ". $offset ." >> count: ". $count;
        $this->db->order_by("start_date", "desc");
        if (null == $limit) {
            $query = $this->db->get_where($this->tn);
        } 
//        echo $this->db->last_query();
        if ($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }

    public function getEventsByDateRange($startDate, $endDate, $limit = null, $offset = 0 , $orderBy=null, $direction = "asc") {
        if(null != $orderBy){
            $this->db->order_by($orderBy, $direction);
        }else{
            $this->db->order_by("start_date", "desc");
        }
        if (null == $limit) {
            $query = $this->db->get_where($this->tn, array('start_date >=' => $startDate, 'end_date <= ' => $endDate));
        } else {
            $query = $this->db->get_where($this->tn, array('start_date >=' => $startDate, 'end_date <= ' => $endDate), $limit, $offset);
        }
       echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function getClientsByIds($clientIds) {
        $this->db->order_by("created_date", "desc");
        $this->db->where_in('id', $clientIds);
        $query = $this->db->get_where($this->tn);
//        echo $this->db->last_query();
        return $query->result_array();
    }

    public function searchClients($limit = null, $offset = 0, $count = false) {
        if ($this->input->post("fromDate") != "") {
            $fromDate = date('Y/m/d H:i', strtotime($this->input->post('fromDate')));
            $this->db->where('created_date >= ', $fromDate);
        }
        if ($this->input->post("toDate") != "") {
            $toDate = date('Y/m/d H:i', strtotime($this->input->post('toDate')));
            $this->db->where('created_date <= ', $toDate);
        }
        $this->db->order_by("created_date", "desc");
        if ($this->input->post("searchText") != "") {
            $search = $this->input->post("searchText");
            $this->db->or_like('name', $search);
            $this->db->or_like('description', $search);
        }
        $query = $this->db->get_where($this->tn, array('created_by' => $userId), 100);
        if ($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }
    
    public function searchClientsCriteria($limit = null, $offset = 0, $count = false , $text= null, $start_date = null, $end_date = null){
        if ($start_date != "0000-00-00 00:00:00") {
            $fromDate = date('Y/m/d H:i', strtotime($start_date));
            $this->db->where('created_date >= ', $fromDate);
        }
        if ($end_date != "0000-00-00 00:00:00") {
            $toDate = date('Y/m/d H:i', strtotime($end_date));
            $this->db->where('created_date <= ', $toDate);
        }
        $this->db->order_by("created_date", "desc");
        if ($text != null) {
            $where = "(name like '%".$text."%' or description like '%".$text."%')";
//            $this->db->or_like('heading', $text);
//            $this->db->or_like('body', $text);
//            $this->db->or_like('tagg', $text);
              $this->db->where($where);
        }
        if (null == $limit) {
            $query = $this->db->get_where($this->tn, array('created_by' => $userId));
        } else {
            $query = $this->db->get_where($this->tn, array('created_by' => $userId), $limit, $offset);
        }
//        echo $this->db->last_query();
        if ($count) {
            return $query->num_rows();
        } else {
            return $query->result_array();
        } 
    }

    /**
     * Update the note, expects post and session data to be present.
     * @return type
     */
    public function update() {
        $client = $this->getClient( $this->input->post('id'));
        $updateCount = $client->update_count + 1;
        $data = array(
            'created_by' => $this->session->userdata("user")->id,
            'name' => $this->input->post('name'),
            'description' => preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $this->input->post('description')),
            'status' => $this->input->post('status'),
            'created_date' => date('Y/m/d H:i', strtotime($this->input->post('created_date'))),
            'last_updated_by' =>$this->session->userdata("user")->id,
            'update_date' => date('Y/m/d H:i'),
            'update_count' => $updateCount
            
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update($this->tn, $data);
    }
}
