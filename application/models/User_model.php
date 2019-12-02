<?php 

class User_model extends CI_Model
{
    public function getUser($id = null)
    {
        if ($id === null) {
            return $this->db->get('users')->result_array();
        } else {
            return $this->db->get_where('users', ['iduser' => $id])->result_array();
        }
        
    }

    public function deleteUser($id)
    {
        $this->db->delete('users', ['iduser' => $id]);
        return $this->db->affected_rows();
    }

    public function createUser($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function updateUser($data, $id)
    {
        $this->db->update('users', $data, ['iduser' => $id]);
        return $this->db->affected_rows();  
    }
}

?>