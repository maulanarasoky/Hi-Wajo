<?php

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_Model', 'model');
        $this->load->library('form_validation');
        $this->load->database();
    }
    public function index()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->dashboard();
        } else {
            $this->login_form();
        }
    }
    public function login_form()
    {
        $this->load->view('index');
    }
    public function dashboard()
    {
        $this->load->view('dashboard');
    }
    public function login_validation()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );
            $check = $this->model->can_login("admin", $where)->num_rows();
            $this->model->update_status($username, 'Online');
            $check_name = $this->model->get_data($username, $password);
            $data = $check_name->row_array();
            if ($check > 0) {
                $news = $this->model->count_data('news');
                $culinary = $this->model->count_data('culinary');
                $education = $this->model->count_data('education');
                $entertainment = $this->model->count_data('entertainment');
                $housing = $this->model->count_data('housing');
                $market = $this->model->count_data('market');
                $restaurant = $this->model->count_data('restaurant');
                $session_data = array(
                    'username' => $username,
                    'name' => $data['nama'],
                    'status' => $data['status'],
                    'foto' => $data['foto'],
                    'news' => $news,
                    'culinary' => $culinary,
                    'education' => $education,
                    'entertainment' => $entertainment,
                    'housing' => $housing,
                    'market' => $market,
                    'restaurant' => $restaurant
                );
                $this->session->set_userdata($session_data);
                $this->enter();
            } else {
                $this->session->set_flashdata('msg', '<div class="alert
                alert-danger text-center">Invalid Username and Password !</div>');
                redirect($this->login_form());
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert
            alert-danger text-center">Invalid Username and Password !</div>');
            redirect($this->login_form());
        }
    }

    public function enter()
    {
        if ($this->session->userdata('username') != '') {
            redirect($this->dashboard());
        } else {
            redirect($this->login_form());
        }
    }
    public function logout()
    {
        $username = $this->session->userdata('username');
        $this->model->update_status($username, 'Offline');
        $this->session->sess_destroy();
        redirect($this->login_form());
    }

    public function random_code()
    {
        $chars = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );
        shuffle($chars);
        $num_chars = count($chars) - 1;
        $token = '';
        for ($i = 0; $i < $num_chars; $i++) {
            $token .= $chars[mt_rand(0, $num_chars)];
        }
        return $token;
    }

    //CRUD Restaurant Function

    public function restaurant()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('restaurant');
        } else {
            $this->login_form();
        }
    }

    public function create_restaurant()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_restaurant($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_restaurant()
    {
        $list = $this->model->read_restaurant();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_restaurant(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_restaurant(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_restaurant(),
            "recordsFiltered" => $this->model->count_filtered_restaurant(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function restaurant_api()
    {
        $query = $this->model->api_restaurant();
        echo json_encode($query);
    }

    public function edit_restaurant($id)
    {
        $data = $this->model->get_by_restaurant($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_restaurant()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_restaurant(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_restaurant($id)
    {
        $this->model->delete_restaurant($id);
        echo json_encode(array("status" => TRUE));
    }

    public function news()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('news');
        } else {
            $this->login_form();
        }
    }

    public function create_news()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('author', 'author', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'url' => $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'author' => ucwords(strtolower($this->input->post('author'))),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'category' => ucwords(strtolower($this->input->post('category'))),
                    'content' => ucwords(strtolower($this->input->post('description'))),
                );
                $insert = $this->model->create_news($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_news()
    {
        $list = $this->model->read_news();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() .  $data->url . "'></img></center>";
            $row[] = character_limiter($data->title, 20);
            $row[] = $data->author;
            $row[] = character_limiter($data->date, 10);
            $row[] = $data->location;
            $row[] = $data->category;
            $row[] = character_limiter($data->content, 20);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_news(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_news(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_news(),
            "recordsFiltered" => $this->model->count_filtered_news(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function news_api()
    {
        $query = $this->model->api_news();
        $response = array(
            'result' => $query
        );
        echo json_encode($response);
    }

    public function edit_news($id)
    {
        $data = $this->model->get_by_news($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_news()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_news(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_news($id)
    {
        $this->model->delete_news($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Culinary

    public function culinary()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('culinary');
        } else {
            $this->login_form();
        }
    }

    public function create_culinary()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_culinary($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_culinary()
    {
        $list = $this->model->read_culinary();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_culinary(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_culinary(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_culinary(),
            "recordsFiltered" => $this->model->count_filtered_culinary(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function culinary_api()
    {
        $query = $this->model->api_culinary();
        echo json_encode($query);
    }

    public function edit_culinary($id)
    {
        $data = $this->model->get_by_culinary($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_culinary()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_culinary(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_culinary($id)
    {
        $this->model->delete_culinary($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Housing

    public function housing()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('housing');
        } else {
            $this->login_form();
        }
    }

    public function create_housing()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "1080",
                'max_width' => "1920"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_housing($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_housing()
    {
        $list = $this->model->read_housing();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_housing(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_housing(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_housing(),
            "recordsFiltered" => $this->model->count_filtered_housing(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function housing_api()
    {
        $query = $this->model->api_housing();
        echo json_encode($query);
    }

    public function edit_housing($id)
    {
        $data = $this->model->get_by_housing($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_housing()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_housing(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_housing($id)
    {
        $this->model->delete_housing($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Entertainment

    public function entertainment()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('entertainment');
        } else {
            $this->login_form();
        }
    }

    public function create_entertainment()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_entertainment($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_entertainment()
    {
        $list = $this->model->read_entertainment();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_entertainment(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_entertainment(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_entertainment(),
            "recordsFiltered" => $this->model->count_filtered_entertainment(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function entertainment_api()
    {
        $query = $this->model->api_entertainment();
        echo json_encode($query);
    }

    public function edit_entertainment($id)
    {
        $data = $this->model->get_by_entertainment($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_entertainment()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_entertainment(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_entertainment($id)
    {
        $this->model->delete_entertainment($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Market

    public function market()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('market');
        } else {
            $this->login_form();
        }
    }

    public function create_market()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_market($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_market()
    {
        $list = $this->model->read_market();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_market(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_market(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_market(),
            "recordsFiltered" => $this->model->count_filtered_market(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function market_api()
    {
        $query = $this->model->api_market();
        echo json_encode($query);
    }

    public function edit_market($id)
    {
        $data = $this->model->get_by_market($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_market()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_market(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_market($id)
    {
        $this->model->delete_market($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Education

    public function education()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('education');
        } else {
            $this->login_form();
        }
    }

    public function create_education()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_education($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_education()
    {
        $list = $this->model->read_education();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_education(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_education(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_education(),
            "recordsFiltered" => $this->model->count_filtered_education(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function education_api()
    {
        $query = $this->model->api_education();
        echo json_encode($query);
    }

    public function edit_education($id)
    {
        $data = $this->model->get_by_education($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_education()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_education(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_education($id)
    {
        $this->model->delete_education($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Health

    public function health()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('health');
        } else {
            $this->login_form();
        }
    }

    public function create_health()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_health($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_health()
    {
        $list = $this->model->read_health();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_health(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_health(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_health(),
            "recordsFiltered" => $this->model->count_filtered_health(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function health_api()
    {
        $query = $this->model->api_health();
        echo json_encode($query);
    }

    public function edit_health($id)
    {
        $data = $this->model->get_by_health($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_health()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_health(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_health($id)
    {
        $this->model->delete_health($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Cafe

    public function cafe()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('cafe');
        } else {
            $this->login_form();
        }
    }

    public function create_cafe()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_cafe($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_cafe()
    {
        $list = $this->model->read_cafe();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = character_limiter($data->description, 20);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cafe(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_cafe(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_cafe(),
            "recordsFiltered" => $this->model->count_filtered_cafe(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function cafe_api()
    {
        $query = $this->model->api_cafe();
        echo json_encode($query);
    }

    public function edit_cafe($id)
    {
        $data = $this->model->get_by_cafe($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_cafe()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_cafe(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_cafe($id)
    {
        $this->model->delete_cafe($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Tourism Function

    public function tourism()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('tourism');
        } else {
            $this->login_form();
        }
    }

    public function create_tourism()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_tourism($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_tourism()
    {
        $list = $this->model->read_tourism();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = word_limiter($data->description, 6);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tourism(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_tourism(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_tourism(),
            "recordsFiltered" => $this->model->count_filtered_tourism(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function tourism_api()
    {
        $query = $this->model->api_tourism();
        echo json_encode($query);
    }

    public function edit_tourism($id)
    {
        $data = $this->model->get_by_tourism($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_tourism()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_tourism(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_tourism($id)
    {
        $this->model->delete_tourism($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Sports Function

    public function sports()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('sports');
        } else {
            $this->login_form();
        }
    }

    public function create_sports()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_sports($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_sports()
    {
        $list = $this->model->read_sports();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = word_limiter($data->description, 6);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_sports(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_sports(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_sports(),
            "recordsFiltered" => $this->model->count_filtered_sports(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function sports_api()
    {
        $query = $this->model->api_sports();
        echo json_encode($query);
    }

    public function edit_sports($id)
    {
        $data = $this->model->get_by_sports($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_sports()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_sports(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_sports($id)
    {
        $this->model->delete_sports($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Bank and Finance Function

    public function bank_finance()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('bank_finance');
        } else {
            $this->login_form();
        }
    }

    public function create_bank_finance()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_bank_finance($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_bank_finance()
    {
        $list = $this->model->read_bank_finance();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = character_limiter($data->description, 20);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_bank_finance(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_bank_finance(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_bank_finance(),
            "recordsFiltered" => $this->model->count_filtered_bank_finance(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function bank_finance_api()
    {
        $query = $this->model->api_bank_finance();
        echo json_encode($query);
    }

    public function edit_bank_finance($id)
    {
        $data = $this->model->get_by_bank_finance($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_bank_finance()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_bank_finance(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_bank_finance($id)
    {
        $this->model->delete_bank_finance($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Travel and Transportation

    public function travel_transportation()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('travel_transportation');
        } else {
            $this->login_form();
        }
    }

    public function create_travel_transportation()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_travel_transportation($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_travel_transportation()
    {
        $list = $this->model->read_travel_transportation();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_travel_transportation(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_travel_transportation(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_travel_transportation(),
            "recordsFiltered" => $this->model->count_filtered_travel_transportation(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function travel_transportation_api()
    {
        $query = $this->model->api_travel_transportation();
        echo json_encode($query);
    }

    public function edit_travel_transportation($id)
    {
        $data = $this->model->get_by_travel_transportation($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_travel_transportation()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_travel_transportation(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_travel_transportation($id)
    {
        $this->model->delete_travel_transportation($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Government

    public function government()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('government');
        } else {
            $this->login_form();
        }
    }

    public function create_government()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $random_code = $this->random_code();
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'code' => $random_code,
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->create_government($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_government()
    {
        $list = $this->model->read_government();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->code;
            $row[] = $data->name;
            $row[] = $data->address;
            $row[] = $data->phone_number;
            $row[] = $data->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_government(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_government(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_government(),
            "recordsFiltered" => $this->model->count_filtered_government(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function government_api()
    {
        $query = $this->model->api_government();
        echo json_encode($query);
    }

    public function edit_government($id)
    {
        $data = $this->model->get_by_government($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_government()
    {
        // $this->form_validation->set_rules('image', 'image', 'callback_file_check');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'address' => ucwords(strtolower($this->input->post('address'))),
                    'phone_number' => ucwords(strtolower($this->input->post('phone_number'))),
                    'description' => ucwords(strtolower($this->input->post('description')))
                );
                $insert = $this->model->update_government(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_government($id)
    {
        $this->model->delete_government($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Event

    public function event()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('event');
        } else {
            $this->login_form();
        }
    }

    public function create_event()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('ticket', 'ticket', 'required');
        $this->form_validation->set_rules('organizer', 'organizer', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'poster' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'date' => $this->input->post('date'),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'ticket' => ucwords(strtolower($this->input->post('ticket'))),
                    'organizer' => ucwords(strtolower($this->input->post('organizer'))),
                    'description' => ucwords(strtolower($this->input->post('description'))),
                    'status' => 'Konfirmasi',
                    'id_user' => 0
                );
                $insert = $this->model->create_event($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function create_event_users()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('ticket', 'ticket', 'required');
        $this->form_validation->set_rules('organizer', 'organizer', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'poster' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'date' => $this->input->post('date'),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'ticket' => ucwords(strtolower($this->input->post('ticket'))),
                    'organizer' => ucwords(strtolower($this->input->post('organizer'))),
                    'description' => ucwords(strtolower($this->input->post('description'))),
                    'status' => 'Pending',
                    'id_user' => $this->model->get_data_id_user_event($this->session->userdata('username'))
                );
                $insert = $this->model->create_event($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_event()
    {
        $list = $this->model->read_event();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->poster . "'></img></center>";
            $row[] = $data->title;
            $row[] = $data->date;
            $row[] = $data->location;
            $row[] = "Rp. " . $data->ticket;
            $row[] = $data->organizer;
            $row[] = character_limiter($data->description, 20);
            $row[] = $data->status;
            if ($data->id_user <> 0) {
                $check_name = $this->model->get_data_username_user_event($data->id_user)->row_array();
                $row[] = $check_name['username'];
            } else {
                $row[] = "Admin";
            }
            
            if($data->status == "Pending"){
                $row[] = '<button class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="confirm_event(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Konfirmasi</button>';
            }else if($data->status == "Konfirmasi" && $data->id_user == 0){
                $row[] = '<button class="btn btn-sm btn-primary" href="javascript:void(0)" title="Hapus" onclick="edit_event(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Edit</button>
                <button class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_event(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>';
            }else if($data->status == "Konfirmasi" && $data->id_user <> 0){
                $row[] = '<button class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="get_data_delete_event(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>';
            }
            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_event(),
            "recordsFiltered" => $this->model->count_filtered_event(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit_event_confirm($id)
    {
        $change = array(
            'status' => 'Konfirmasi'
        );
        $data = $this->model->edit_event_confirm(array('id' => $id), $change);
        echo json_encode($data);
    }

    public function event_api()
    {
        $query = $this->model->api_event();
        $response = array(
            'result' => $query
        );
        echo json_encode($response);
    }

    public function edit_event($id)
    {
        $data = $this->model->get_by_event($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function update_event()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('ticket', 'ticket', 'required');
        $this->form_validation->set_rules('organizer', 'organizer', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'poster' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'date' => $this->input->post('date'),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'ticket' => ucwords(strtolower($this->input->post('ticket'))),
                    'organizer' => ucwords(strtolower($this->input->post('organizer'))),
                    'description' => ucwords(strtolower($this->input->post('description'))),
                    'status' => 'Confirm'
                );
                $insert = $this->model->update_event(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function delete_event($id)
    {
        $this->model->delete_event($id);
        echo json_encode(array("status" => TRUE));
    }

    //CRUD Event

    public function complaint()
    {
        $username = $this->session->userdata('username');
        if (!is_null($username)) {
            $this->load->view('complaint');
        } else {
            $this->login_form();
        }
    }

    public function create_complaint_users()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('finishedDescription', 'finishedDescription', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'location' => ucwords(strtolower($this->input->post('location'))),
                    'category' => ucwords(strtolower($this->input->post('category'))),
                    'description' => ucwords(strtolower($this->input->post('description'))),
                    'status' => 'Pending',
                    'confirm_status' => 'Belum dikonfirmasi',
                    'id_user' => $this->model->get_data_id_user_complaint($this->session->userdata('username'))
                );
                $insert = $this->model->create_complaint($data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function read_complaint()
    {
        $list = $this->model->read_complaint();
        $allData = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = "<center><img width='100px' height='60px' src='" . base_url() . $data->image . "'></img></center>";
            $row[] = $data->title;
            $row[] = $data->date;
            $row[] = $data->location;
            $row[] = $data->category;
            $row[] = character_limiter($data->description, 20);
            $row[] = $data->status;
            if ($data->id_user <> 0) {
                $check_name = $this->model->get_data_username_user_complaint($data->id_user)->row_array();
                $row[] = $check_name['username'];
            } else {
                $row[] = "Admin";
            }
            if ($data->confirm_status == "Belum dikonfirmasi") {
                $row[] = '<button class="btn btn-sm btn-warning" href="javascript:void(0)" title="Konfirmasi" onclick="edit_complaint_confirm(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Konfirmasi</button>
                <button class="btn btn-sm btn-danger" href="javascript:void(0)" title="Konfirmasi" onclick="get_data_delete_complaint(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Hapus</button>';
            } elseif ($data->confirm_status == "Dikonfirmasi" && $data->status <> "Finish") {
                $row[] = '<button class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_status_complaint(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Status</button>';
            }elseif ($data->confirm_status === "Dikonfirmasi" && $data->status === "Finish" && $data->finished_description <> null && $data->finished_image <> null) {
                $row[] = '<button class="btn btn-sm btn-secondary" href="javascript:void(0)" disabled title="Edit" onclick="edit_finish_complaint(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Selesai</button>';
            }elseif ($data->confirm_status === "Dikonfirmasi" && $data->status === "Finish") {
                $row[] = '<button class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit" onclick="edit_finish_complaint(' . "'" . $data->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Bukti</button>';
            }

            //add html for action

            $allData[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all_complaint(),
            "recordsFiltered" => $this->model->count_filtered_complaint(),
            "data" => $allData,
        );
        //output to json format
        echo json_encode($output);
    }

    public function complaint_api()
    {
        $query = $this->model->api_complaint();
        $response = array(
            'result' => $query
        );
        echo json_encode($response);
    }

    public function edit_complaint_confirm($id)
    {
        $change = array(
            'confirm_status' => 'Dikonfirmasi',
            'status' => 'Pending'
        );
        $data = $this->model->edit_complaint_confirm(array('id' => $id), $change);
        echo json_encode($data);
    }

    public function get_edit_status_complaint($id)
    {
        $data = $this->model->get_by_complaint($id);
        echo json_encode($data);
    }

    public function update_complaint_status()
    {
        $change = array(
            'status' => $this->input->post('status')
        );
        $data = $this->model->update_complaint_status(array('id' => $this->input->post('id')), $change);
        if ($data == TRUE) {
            $response = array(
                'status' => 'success status',
                'message' => 'Update status success'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function get_edit_finish_complaint($id)
    {
        $data = $this->model->get_by_complaint($id);
        echo json_encode($data);
    }

    public function update_complaint_finished()
    {
        $this->form_validation->set_rules('description', 'description', 'required');
        // print_r($_FILES);
        if ($this->form_validation->run() == true) {

            $config = array(
                'upload_path' => "./assets/foto/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "5000",
                'max_width' => "5000"
            );

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = array('upload_image' => $this->upload->data());
                $data_content = array(
                    'finished_image' => 'assets/foto/' . $data_image['upload_image']['file_name'],
                    'finished_description' => $this->input->post('description')
                );
                $insert = $this->model->update_complaint_finished(array('id' => $this->input->post('id')), $data_content);
                if ($insert == TRUE) {
                    $response = array(
                        'status' => 'success finish',
                        'message' => 'Place has been Inserted Successfully !'
                    );
                } else {
                    $response = array(
                        'status' => 'errors',
                        'message' => 'Place has been Inserted Unsuccessfully !'
                    );
                }
            } else {
                $response = array(
                    'status' => 'errors',
                    'message' => $this->upload->display_errors()
                );
            }
        } else {
            $response = array(
                'status' => 'errors',
                'message' => validation_errors()
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function edit_complaint($id)
    {
        $data = $this->model->get_by_complaint($id);
        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function delete_complaint($id)
    {
        $this->model->delete_complaint($id);
        echo json_encode(array("status" => TRUE));
    }

    public function upload(){
        $this->load->view('upload');
    }
}
