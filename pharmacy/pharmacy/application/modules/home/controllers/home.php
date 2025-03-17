<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('medicine/medicine_model');
        $this->load->model('finance/finance_model');
        $this->load->model('settings/settings_model');
        $this->load->model('home_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh'); 
        }
    }

    public function index() {
        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->finance_model->getPayment();
        $data['expenses'] = $this->finance_model->getExpense();
        $data['today_sales_amount'] = $this->finance_model->todaySalesAmount();
        $data['today_expenses_amount'] = $this->finance_model->todayExpensesAmount();
        $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
        $this->load->view('dashboard', $data); // just the header file
        $this->load->view('home', $data);
        $this->load->view('footer');
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
