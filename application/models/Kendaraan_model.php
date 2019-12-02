<?php 

class Kendaraan_model extends CI_Model
{
    public function getKendaraan($noStnk = null)
    {
        if($noStnk === null) {
            return $this->db->get('kendaraan')->result_array();
        } else {
            return $this->db->get_where('kendaraan', ['nostnk' => $noStnk])->result_array();
        }

    }

    public function deleteKendaraan($noStnk)
    {
        $this->db->delete('kendaraan', ['nostnk' => $noStnk]);
        return $this->db->affected_rows();
    }

    public function createKendaraan($data)
    {
        $this->db->insert('kendaraan', $data);
        return $this->db->affected_rows();
    }

    public function updateKendaraan($data, $noStnk)
    {
        $this->db->update('kendaraan', $data, ['nostnk' => $noStnk]);
        return $this->db->affected_rows();
    }
}

?>