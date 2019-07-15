<?php

class Main extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('main_model');
        $this->load->library('form_validation');
    }
    public function index(){
        $username = $this->session->userdata('username');
        if(!is_null($username)){
            $this->dashboard();
        }
        else{
            $this->login_form();
        }
    }
    public function login_form() {
        $this->load->view('index');
    }
    public function dashboard(){
        $this->load->view('dashboard');
    }
    public function login_validation(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == true){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );
            $check = $this->main_model->can_login("users", $where)->num_rows();
            $this->main_model->update_status($username, 'Online');
            $check_name = $this->main_model->get_data($username, $password);
            $data = $check_name->row_array();
            if($check > 0){
                $session_data = array(
                    'username' => $username,
                    'name' => $data['nama'],
                    'status' => $data['status'],
                    'foto' => $data['foto']
                );
                $this->session->set_userdata($session_data);
                $this->enter();
            }else {
                $this->session->set_flashdata('msg', '<div class="alert
                alert-danger text-center">Invalid Username and Password !</div>');
                redirect($this->login_form());
            }
        }else {
            $this->session->set_flashdata('msg', '<div class="alert
            alert-danger text-center">Invalid Username and Password !</div>');
            redirect($this->login_form());
        }
    }
    public function enter(){
        if($this->session->userdata('username') != ''){
            redirect($this->dashboard());
        }else {
            redirect($this->login_form());
        }
    }
    public function logout(){
        $username = $this->session->userdata('username');
        $this->main_model->update_status($username, 'Offline');
        $this->session->sess_destroy();
        redirect($this->login_form());
    }

    //Restaurant, News, Culinary View Function

    public function restaurant(){
        $username = $this->session->userdata('username');
        if(!is_null($username)){
            $this->load->view('restaurant');
        }
        else{
            $this->login_form();
        }
    }

    public function news(){
        $username = $this->session->userdata('username');
        if(!is_null($username)){
            $this->load->view('news');
        }
        else{
            $this->login_form();
        }
    }

    public function culinary(){
        $username = $this->session->userdata('username');
        if(!is_null($username)){
            $this->load->view('culinary');
        }
        else{
            $this->login_form();
        }
    }

    //CRUD Restaurant Function

    public function random_code(){
        $chars = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );
        shuffle($chars);
        $num_chars = count($chars) - 1;
        $token = '';
        for($i = 0; $i < $num_chars; $i++){
            $token .= $chars[mt_rand(0, $num_chars)];
        }
        return $token;
    }

    public function create_restaurant(){
        $this->form_validation->set_rules('restaurant_name', 'restaurant_name', 'required');
        $this->form_validation->set_rules('restaurant_address', 'restaurant_address', 'required');
        $this->form_validation->set_rules('restaurant_phone_number', 'restaurant_phone_number', 'required');
        $this->form_validation->set_rules('restaurant_description', 'restaurant_description', 'required');
        if($this->form_validation->run() == true){
            $restaurant_name = ucwords(strtolower($this->input->post('restaurant_name')));
            $restaurant_address = ucwords(strtolower($this->input->post('restaurant_address')));
            $restaurant_phone_number = $this->input->post('restaurant_phone_number');
            $restaurant_description = ucwords(strtolower($this->input->post('restaurant_description')));
            $random_code = $this->random_code();
            $insert = $this->main_model->input_resto($random_code, $restaurant_name, $restaurant_address, $restaurant_phone_number, $restaurant_description);
            if($insert){
                $this->session->set_flashdata('msg', '<div class="alert
                alert-success text-center">Insert Successfully !</div>');
                redirect('main/restaurant_form');
            }else {
                $this->session->set_flashdata('msg', '<div class="alert
                alert-danger text-center">Insert Unsuccessfully !</div>');
                redirect('main/restaurant_form');
            }
        }
    }

    public function read_restaurant(){
        $this->main_model->restaurant_datatables();
    }

    public function update_restaurant($id){
        $where = array('id' => $id);
        $data['restaurant'] = $this->main_model->edit_restaurant($where, 'restaurant')->result();
        $this->load->view('restaurant_edit', $data);
    }

    public function delete_restaurant($id){
        $this->main_model->delete_resto($id);
        $this->session->set_flashdata('msg', '<div class="alert
        alert-success text-center">Delete Successfully !</div>');
        redirect('main/restaurant_list');
    }

    public function update_data(){
        $id = $this->input->post('id');
        $restaurant_name = ucwords(strtolower($this->input->post('restaurant_name')));
        $restaurant_address = ucwords(strtolower($this->input->post('restaurant_address')));
        $restaurant_phone_number = $this->input->post('restaurant_phone_number');
        $restaurant_description = ucwords(strtolower($this->input->post('restaurant_description')));
        $data = array(
            'nama_restaurant' => $restaurant_name,
            'alamat_restaurant' => $restaurant_address,
            'nomor_restaurant' => $restaurant_phone_number,
            'deskripsi_restaurant' => $restaurant_description
        );
        $where = array(
            'id' => $id
        );
        $this->main_model->update_data($where, $data, 'restaurant');
        redirect('main/restaurant_list');
    }

    //CRUD News Function

    public function create_news(){
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('author', 'author', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if($this->form_validation->run() == true){
            
            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "1080",
                'max_width' => "1920"
                );

            $this->load->library('upload', $config);

            if($this->upload->do_upload('image')){
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'author' => ucwords(strtolower($this->input->post('author'))),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'category' => ucwords(strtolower($this->input->post('category'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->main_model->input_news($data_content);
                if($insert == TRUE){
                    $response = array(
                        'status' => 'success',
                        'message' => 'News has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'News has been Inserted Unsuccessfully !'
                    );
                }
            }else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }      
        }else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }

    public function read_news(){
        $this->main_model->news_datatables();
    }

    //Culinary

    public function create_culinary(){
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('author', 'author', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if($this->form_validation->run() == true){
            
            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "1080",
                'max_width' => "1920"
                );

            $this->load->library('upload', $config);

            if($this->upload->do_upload('image')){
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'author' => ucwords(strtolower($this->input->post('author'))),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'category' => ucwords(strtolower($this->input->post('category'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->main_model->input_news($data_content);
                if($insert == TRUE){
                    $response = array(
                        'status' => 'success',
                        'message' => 'News has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'News has been Inserted Unsuccessfully !'
                    );
                }
            }else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }      
        }else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }

    public function read_culinary(){
        $this->main_model->culinary_datatables();
    }


}

?>