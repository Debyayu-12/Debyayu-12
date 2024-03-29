<?php
function is_logged_in()
{
      //membuat instansiasi agar fitur dari ci bisa dipakai
      
      $ci = get_instance();
      if (!$ci->session->userdata('email')) {
          redirect('auth');
      } else {
          $role_id = $ci->session->userdata('role_id');
          $menu = $ci->uri->segment(1);
          $queryMenu = $ci->db->get_where(
              'user_menu',
              ['menu' => $menu]
          )->row_array();
         $menu_id = $queryMenu['id'];

          $userAcces = $ci->db->get_where('user_access_menu',[
              'role_id' => $role_id,
              'menu_id' => $menu_id
          ]);
          if ($userAcces->num_rows() < 1) {
              redirect('auth/blocked');
          }
      }
}
function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function random_bytes($length = 6) 
{
    $characters = '0123456789';
    $characters_length = strlen($characters);
    $output = "";
    for ($i = 0; $i < $length; $i++) {
        $output = $characters[(rand(0, $characters_length -1))];
        return $output;
    }
}