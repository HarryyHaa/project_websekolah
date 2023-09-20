<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id`=`user_menu`.`id`";

        return $this->db->query($query)->result_array();
    }
    public function savesubmenu()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('aktif')
        ];

        $this->db->insert('user_sub_menu', $data);
    }
}
