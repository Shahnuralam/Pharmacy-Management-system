<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('profile_model');
        $this->load->model('settings/settings_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['profile'] = $this->profile_model->getProfileById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('profile', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['profile'] = $this->profile_model->getProfileById($id);
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data);
            $this->load->view('profile', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
            );
            $username = $this->input->post('name');
            $ion_user_id = $this->ion_auth->get_user_id();
            $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->profile_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->profile_model->updateIonUser($username, $email, $password, $ion_user_id);
            if (!$this->ion_auth->in_group('admin')) {
                $this->profile_model->updateProfile($ion_user_id, $data, $group_name);
            }
            $this->session->set_flashdata('feedback', 'Updated');
            // Loading View
            redirect('profile');
        }
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
