<?php

class Menu extends CI_Controller
{
    // untuk memblokir akses langsung dari url
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                New Menu Added!
                </div>'
            );
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Model_menu', 'menu');
        $data['SubMenu'] = $this->Model_menu->getSubMenu();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    } else {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active'),
        ];

        $this->db->insert('user_sub_menu', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
        New Submenu Added!
        </div>'
        );
        redirect('menu/submenu');
    }
}
public function submenuedit()
{
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'Url', 'required');
    $this->form_validation->set_rules('icon', 'icon', 'required');

    if ($this->form_validation->run() == false) {
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">Chabge Failed</div>'
        );
        redirect('menu/submenu');
    } else {
        $data = array(
            'title'      =>  $_POST['title'],
            'menu_id'    =>  $_POST['menu_id'],
            'url'        =>  $_POST['url'],
            'icon'       =>  $_POST['icon'],
            'is_active'  =>  $_POST['is_active'],
        );

        $this->db->where('id', $_POST['id']);
        $this->db->update('user_sub_menu', $data);
        $this->sesion->set_flashdata(
            'message',
            '<div class="alert alert-succes" role="alert">
                New Submenu Added!
            </div>'
        );
        redirect('menu/submenu');
    }
}

public function hapus ($id)
{
    $this->db->where('id', $id);
    $this->db->delete('user_sub_menu');
    $this->session->set_flashdata(
        'message',
        '<div class="alert alert-danger" role="alert"> Sub Menu Deleted</div>'
    );
    redirect('menu/submenu');
}

public function menuedit()
{
    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if ($this->form_validation->run() == false) {
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">Chabge Failed</div>'
        );
        redirect('menu/index');
    } else {
        $data = array(
            'menu'      =>  $_POST['menu'],
        );

        $this->db->where('id', $_POST['id']);
        $this->db->update('user_menu', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
                New Submenu Added!
            </div>'
        );
        redirect('menu/index');
    }
}

public function hapusmenu($id)
{
    $this->db->where('id', $id);
    $this->db->delete('user_menu');
    $this->session->set_flashdata(
        'message',
        '<div class="alert alert-danger" role="alert"> Sub Menu Deleted</div>'
    );
    redirect('menu/index');
}
}
