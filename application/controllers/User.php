<?php

class User extends CI_Controller
{
    // untuk memblokir akses langsung dari url
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

public function edit()
{
    $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

       if ($this->form_validation->run() == false) {
           $this->load->view('templates/header', $data);
           $this->load->view('templates/sidebar', $data);
           $this->load->view('templates/topbar', $data);
           $this->load->view('user/edit', $data);
           $this->load->view('templates/footer');
       } else {
           $name = $this->input->post('name');
           $email = $this->input->post('email');
           // jika ada gambar yang diupload
           $upload_image = $_FILES['image']['name'];
           if ($upload_image) {
               $config['allowed_types'] = 'gif|jpg|png';
               $config['max_size'] = '2048';
               $config['upload_path'] = './assets/img/profile';
               $this->load->library('upload', $config);

               if ($this->upload->do_upload('image')) {
                   $old_image = $data['user']['image'];
                   if ($old_image != 'default.jpg') {
                   }
                   unlink(FCPATH . 'assets/img/profile/' . $old_image);
                   $now_image = $this->upload->data('file_name');
                   $this->db->set('image', $new_image);
               } else {
                   echo $this->upload->display_errors();
               }
            }
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Your Profile has been update!</div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password     = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Wrong Current Password</div>');
                redirect('user/changepassword');
            } else {
                // password sudah ada
                $password = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');

                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert></div>'
                );
                redirect('user/changepassword');
            }
        }
    }
}