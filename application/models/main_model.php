<?php

    class Main_model extends CI_Model{
        var $table = 'restaurant'; //nama tabel dari database
        var $column_order = array(null, 'kode_restaurant','nama_restaurant','alamat_restaurant', 'nomor_restaurant'); //field yang ada di table user
        var $column_search = array('kode_restaurant','nama_restaurant','alamat_restaurant'); //field yang diizin untuk pencarian 
        var $order = array('id' => 'asc'); // default order 

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function can_login($table, $where){
            return $this->db->get_where($table, $where);
        }

        public function update_status($username,$status){
            return $this->db->query("UPDATE users SET status = '$status' WHERE username = '$username' LIMIT 1");
        }

        public function input_resto($code, $restaurant_name, $restaurant_address, $restaurant_phone_number, $restaurant_description){
            $data = array(
                'kode_restaurant' => $code,
                'nama_restaurant' => $restaurant_name,
                'alamat_restaurant' => $restaurant_address,
                'nomor_restaurant' => $restaurant_phone_number,
                'deskripsi_restaurant' => $restaurant_description
            );
            return $this->db->insert('restaurant', $data);
        }

        public function show_all_resto(){
            $query = $this->db->order_by('id', 'ASC')->get('restaurant');
            return $query->result();
        }

        public function restaurant_datatables(){
            $this->load->library('datatables');
            $this->datatables->select('id, code, image, name, address, phone_number, description');
            $this->datatables->add_column('delete', anchor('main/delete_resto/$1', 'Hapus', array('class' => 'btn btn-danger btn-sm')), 'id');
            $this->datatables->add_column('edit', anchor('main/edit_resto/$1', 'Edit', array('class' => 'btn btn-warning btn-sm')), 'id');
            $this->datatables->from('restaurant');
            return print_r($this->datatables->generate());
        }

        public function news_datatables(){
            $this->load->library('datatables');
            $this->datatables->select('id, image, title, author, date, location, category, description');
            $this->datatables->add_column('image', "<center><img width='100px' src='".base_url()."assets/foto/$1'></img></center>", 'image');
            $this->datatables->add_column('delete', anchor('main/delete_resto/$1', 'Hapus', array('class' => 'btn btn-danger btn-sm')), 'id');
            $this->datatables->add_column('edit', anchor('main/edit_resto/$1', 'Edit', array('class' => 'btn btn-warning btn-sm')), 'id');
            $this->datatables->from('news');
            return print_r($this->datatables->generate());
        }

        public function culinary_datatables(){
            $this->load->library('datatables');
            $this->datatables->select('id, code, image, name, address, phone_number, description');
            $this->datatables->add_column('image', "<center><img width='100px' src='".base_url()."assets/foto/$1'></img></center>", 'image');
            $this->datatables->add_column('delete', anchor('main/delete_resto/$1', 'Hapus', array('class' => 'btn btn-danger btn-sm')), 'id');
            $this->datatables->add_column('edit', anchor('main/edit_resto/$1', 'Edit', array('class' => 'btn btn-warning btn-sm')), 'id');
            $this->datatables->from('culinary');
            return print_r($this->datatables->generate());
        }

        public function delete_resto($id){
            return $this->db->delete('restaurant', array('id' => $id));
        }

        public function get_data($username, $password){
            return $this->db->query("SELECT nama, status, foto FROM users WHERE username = '$username' AND password = MD5('$password') LIMIT 1");
        }

        function edit_restaurant($where, $table){
            return $this->db->get_where($table, $where);
        }

        function update_data($where, $data, $table){
            $this->db->where($where);
            $this->db->update($table, $data);
        }

        public function input_news($data){
            return $this->db->insert('news', $data);
        }
    }

?>