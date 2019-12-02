<?php 

class Bengkel_model extends CI_Model
{
    public function getBengkel($id = null)
    {
        if($id === null) {
            return $this->db->get('bengkel')->result_array();
        } else {
            return $this->db->get_where('bengkel', ['idbengkel' => $id])->result_array();
        }
    }

    public function deleteBengkel($id)
    {
        $this->db->delete('bengkel', ['idbengkel' => $id]);
        return $this->db->affected_rows();
    }

    public function createBengkel($data)
    {
        $this->db->insert('bengkel', $data);
        return $this->db->affected_rows();
    }

    public function updateBengkel($data, $id)
    {
        $this->db->update('bengkel', $data, ['idbengkel' => $id]);
        return $this->db->affected_rows();
    }
}


?>