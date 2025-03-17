<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayment($data) {
        $this->db->insert('payment', $data);
    }

    function getPayment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }


    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    function deletePayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment');
    }

    function insertExpense($data) {
        $this->db->insert('expense', $data);
    }

    function getExpense() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('expense');
        return $query->result();
    }

    function getExpenseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense');
        return $query->row();
    }

    function updateExpense($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense', $data);
    }

    function insertExpenseCategory($data) {
        $this->db->insert('expense_category', $data);
    }

    function getExpenseCategory() {
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    function getExpenseCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense_category');
        return $query->row();
    }

    function updateExpenseCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense_category', $data);
    }

    function deleteExpense($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense');
    }

    function deleteExpenseCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_category');
    }

    function getDiscountType() {
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }

    function getPaymentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getExpenseByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function amountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('payment', $data);
    }
    
    function todaySalesAmount(){
         if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->getPaymentByDate($today,$today_last);

        foreach($data['payments'] as $sales){
            $sales_amount[] = $sales->gross_total;
        }
        if(!empty($sales_amount)){
            return array_sum($sales_amount);
        }
        else{
            return 0;
        }
    }
    
    function todayExpensesAmount(){
         if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['payments'] = $this->getExpenseByDate($today,$today_last);

        foreach($data['payments'] as $expenses){
            $expenses_amount[] = $expenses->amount;
        }
        if(!empty($expenses_amount)){
            return array_sum($expenses_amount);
        }
        else{
            return 0;
        }
    }

}
