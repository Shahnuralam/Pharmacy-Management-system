<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('settings_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $discount = $this->input->post('discount');
        $buyer = $this->input->post('buyer');
        $p_code = $this->input->post('p_code');

        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            // Validating Password Field
            $this->form_validation->set_rules('title', 'Title', 'rtrim|required|min_length[5]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            // Validating Address Field   
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('discount', 'Discount', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('settings', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {

                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'system_vendor' => $name,
                    'title' => $title,
                    'address' => $address,
                    'phone' => $phone,
                    'email' => $email,
                    'currency' => $currency,
                    'discount' => $discount,
                    'codec_username' => $buyer,
                    'codec_purchase_code' => $p_code
                );
                $this->settings_model->updateSettings($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                // Loading View
                redirect('settings');
            }
        } else {
            $this->session->set_flashdata('feedback', 'Email Required!');
            redirect('settings', 'refresh');
        }
    }

}

/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */


