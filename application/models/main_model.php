<?php

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function count_data($table)
    {
        $query = $this->db->query("SELECT id FROM $table");
        return $query->num_rows();
    }

    public function can_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_status($username, $status)
    {
        return $this->db->query("UPDATE users SET status = '$status' WHERE username = '$username' LIMIT 1");
    }

    public function get_data($username, $password)
    {
        return $this->db->query("SELECT nama, status, foto FROM admin WHERE username = '$username' AND password = MD5('$password') LIMIT 1");
    }

    //CRUD Restaurant

    public function create_restaurant($data)
    {
        return $this->db->insert('restaurant', $data);
    }

    private function _get_restaurant_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('restaurant');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_restaurant()
    {
        $this->_get_restaurant_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_restaurant()
    {
        $this->_get_restaurant_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_restaurant()
    {
        $this->db->from('restaurant');
        return $this->db->count_all_results();
    }

    public function api_restaurant(){
        $query = $this->db->get('restaurant')->result();
        return $query;
    }

    public function get_by_restaurant($id)
    {
        $this->db->from('restaurant');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_restaurant($data)
    {
        $this->db->insert('restaurant', $data);
        return $this->db->insert_id();
    }

    public function update_restaurant($where, $data)
    {
        $this->db->update('restaurant', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_restaurant($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('restaurant');
    }

    //CRUD Bank and Finance
    public function create_news($data)
    {
        return $this->db->insert('news', $data);
    }
    private function _get_news_query()
    {
        $column_order = array('id', 'image', 'title', 'author', 'date', 'location', 'category', 'description'); //set column field database for datatable orderable
        $column_search = array('title', 'date', 'location'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('news');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_news()
    {
        $this->_get_news_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_news()
    {
        $this->_get_news_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_news()
    {
        $this->db->from('news');
        return $this->db->count_all_results();
    }

    public function api_news(){
        $query = $this->db->get('news')->result();
        return $query;
    }

    public function get_by_news($id)
    {
        $this->db->from('news');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_news($data)
    {
        $this->db->insert('news', $data);
        return $this->db->insert_id();
    }

    public function update_news($where, $data)
    {
        $this->db->update('news', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_news($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }

    //CRUD Culinary

    public function create_culinary($data)
    {
        return $this->db->insert('culinary', $data);
    }
    private function _get_culinary_query()
    {
        $column_order = array('id', 'url', 'name', 'address', 'phone_number', 'content'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('culinary');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_culinary()
    {
        $this->_get_culinary_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_culinary()
    {
        $this->_get_culinary_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_culinary()
    {
        $this->db->from('culinary');
        return $this->db->count_all_results();
    }

    public function api_culinary(){
        $query = $this->db->get('culinary')->result();
        return $query;
    }

    public function get_by_culinary($id)
    {
        $this->db->from('culinary');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_culinary($data)
    {
        $this->db->insert('culinary', $data);
        return $this->db->insert_id();
    }

    public function update_culinary($where, $data)
    {
        $this->db->update('culinary', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_culinary($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('culinary');
    }

    //CRUD Housing
    public function create_housing($data)
    {
        return $this->db->insert('housing', $data);
    }
    private function _get_housing_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('housing');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_housing()
    {
        $this->_get_housing_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_housing()
    {
        $this->_get_housing_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_housing()
    {
        $this->db->from('housing');
        return $this->db->count_all_results();
    }

    public function api_housing(){
        $query = $this->db->get('housing')->result();
        return $query;
    }

    public function get_by_housing($id)
    {
        $this->db->from('housing');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_housing($data)
    {
        $this->db->insert('housing', $data);
        return $this->db->insert_id();
    }

    public function update_housing($where, $data)
    {
        $this->db->update('housing', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_housing($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('housing');
    }

    //CRUD Entertainment
    public function create_entertainment($data)
    {
        return $this->db->insert('entertainment', $data);
    }
    private function _get_entertainment_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('entertainment');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_entertainment()
    {
        $this->_get_entertainment_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_entertainment()
    {
        $this->_get_entertainment_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_entertainment()
    {
        $this->db->from('entertainment');
        return $this->db->count_all_results();
    }

    public function api_entertainment(){
        $query = $this->db->get('entertainment')->result();
        return $query;
    }

    public function get_by_entertainment($id)
    {
        $this->db->from('entertainment');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_entertainment($data)
    {
        $this->db->insert('entertainment', $data);
        return $this->db->insert_id();
    }

    public function update_entertainment($where, $data)
    {
        $this->db->update('entertainment', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_entertainment($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('entertainment');
    }

    //CRUD Market
    public function create_market($data)
    {
        return $this->db->insert('market', $data);
    }
    private function _get_market_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('market');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_market()
    {
        $this->_get_market_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_market()
    {
        $this->_get_market_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_market()
    {
        $this->db->from('market');
        return $this->db->count_all_results();
    }

    public function api_market(){
        $query = $this->db->get('market')->result();
        return $query;
    }

    public function get_by_market($id)
    {
        $this->db->from('market');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_market($data)
    {
        $this->db->insert('market', $data);
        return $this->db->insert_id();
    }

    public function update_market($where, $data)
    {
        $this->db->update('market', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_market($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('market');
    }

    //CRUD Education
    public function create_education($data)
    {
        return $this->db->insert('education', $data);
    }
    private function _get_education_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('education');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_education()
    {
        $this->_get_education_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_education()
    {
        $this->_get_education_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_education()
    {
        $this->db->from('education');
        return $this->db->count_all_results();
    }

    public function api_education(){
        $query = $this->db->get('education')->result();
        return $query;
    }

    public function get_by_education($id)
    {
        $this->db->from('education');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_education($data)
    {
        $this->db->insert('education', $data);
        return $this->db->insert_id();
    }

    public function update_education($where, $data)
    {
        $this->db->update('education', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_education($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('education');
    }

    //CRUD Health
    public function create_health($data)
    {
        return $this->db->insert('health', $data);
    }
    private function _get_health_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('health');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_health()
    {
        $this->_get_health_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_health()
    {
        $this->_get_health_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_health()
    {
        $this->db->from('health');
        return $this->db->count_all_results();
    }

    public function api_health(){
        $query = $this->db->get('health')->result();
        return $query;
    }

    public function get_by_health($id)
    {
        $this->db->from('health');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_health($data)
    {
        $this->db->insert('health', $data);
        return $this->db->insert_id();
    }

    public function update_health($where, $data)
    {
        $this->db->update('health', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_health($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('health');
    }

    //CRUD Cafe
    public function create_cafe($data)
    {
        return $this->db->insert('cafe', $data);
    }
    private function _get_cafe_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('cafe');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_cafe()
    {
        $this->_get_cafe_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_cafe()
    {
        $this->_get_cafe_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_cafe()
    {
        $this->db->from('cafe');
        return $this->db->count_all_results();
    }

    public function api_cafe(){
        $query = $this->db->get('cafe')->result();
        return $query;
    }

    public function get_by_cafe($id)
    {
        $this->db->from('cafe');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_cafe($data)
    {
        $this->db->insert('cafe', $data);
        return $this->db->insert_id();
    }

    public function update_cafe($where, $data)
    {
        $this->db->update('cafe', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_cafe($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('cafe');
    }

    //CRUD Tourism
    public function create_tourism($data)
    {
        return $this->db->insert('tourism', $data);
    }
    private function _get_tourism_query()
    {
        $column_order = array('id', 'code', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('tourism');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_tourism()
    {
        $this->_get_tourism_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_tourism()
    {
        $this->_get_tourism_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_tourism()
    {
        $this->db->from('tourism');
        return $this->db->count_all_results();
    }

    public function api_tourism(){
        $query = $this->db->get('tourism')->result();
        return $query;
    }

    public function get_by_tourism($id)
    {
        $this->db->from('tourism');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_tourism($data)
    {
        $this->db->insert('tourism', $data);
        return $this->db->insert_id();
    }

    public function update_tourism($where, $data)
    {
        $this->db->update('tourism', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_tourism($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tourism');
    }

    //CRUD Sports
    public function create_sports($data)
    {
        return $this->db->insert('sports', $data);
    }
    private function _get_sports_query()
    {
        $column_order = array('id', 'code', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('sports');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_sports()
    {
        $this->_get_sports_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_sports()
    {
        $this->_get_sports_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_sports()
    {
        $this->db->from('sports');
        return $this->db->count_all_results();
    }

    public function api_sports(){
        $query = $this->db->get('sports')->result();
        return $query;
    }

    public function get_by_sports($id)
    {
        $this->db->from('sports');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_sports($data)
    {
        $this->db->insert('sports', $data);
        return $this->db->insert_id();
    }

    public function update_sports($where, $data)
    {
        $this->db->update('sports', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_sports($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sports');
    }

    //CRUD Bank and Finance
    public function create_bank_finance($data)
    {
        return $this->db->insert('bank_finance', $data);
    }
    private function _get_bank_finance_query()
    {
        $column_order = array('id', 'code', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('bank_finance');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_bank_finance()
    {
        $this->_get_bank_finance_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_bank_finance()
    {
        $this->_get_bank_finance_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_bank_finance()
    {
        $this->db->from('bank_finance');
        return $this->db->count_all_results();
    }

    public function api_bank_finance(){
        $query = $this->db->get('bank_finance')->result();
        return $query;
    }

    public function get_by_bank_finance($id)
    {
        $this->db->from('bank_finance');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_bank_finance($data)
    {
        $this->db->insert('bank_finance', $data);
        return $this->db->insert_id();
    }

    public function update_bank_finance($where, $data)
    {
        $this->db->update('bank_finance', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_bank_finance($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bank_finance');
    }

    //CRUD Travel and Transportation

    public function create_travel_transportation($data)
    {
        return $this->db->insert('travel_transportation', $data);
    }
    private function _get_travel_transportation_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('travel_transportation');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_travel_transportation()
    {
        $this->_get_travel_transportation_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_travel_transportation()
    {
        $this->_get_travel_transportation_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_travel_transportation()
    {
        $this->db->from('travel_transportation');
        return $this->db->count_all_results();
    }

    public function api_travel_transportation(){
        $query = $this->db->get('travel_transportation')->result();
        return $query;
    }

    public function get_by_travel_transportation($id)
    {
        $this->db->from('travel_transportation');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_travel_transportation($data)
    {
        $this->db->insert('travel_transportation', $data);
        return $this->db->insert_id();
    }

    public function update_travel_transportation($where, $data)
    {
        $this->db->update('travel_transportation', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_travel_transportation($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('travel_transportation');
    }

    //CRUD Government

    public function create_government($data)
    {
        return $this->db->insert('government', $data);
    }
    private function _get_government_query()
    {
        $column_order = array('id', 'image', 'name', 'address', 'phone_number', 'description'); //set column field database for datatable orderable
        $column_search = array('name', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('government');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_government()
    {
        $this->_get_government_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_government()
    {
        $this->_get_government_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_government()
    {
        $this->db->from('government');
        return $this->db->count_all_results();
    }

    public function api_government(){
        $query = $this->db->get('government')->result();
        return $query;
    }

    public function get_by_government($id)
    {
        $this->db->from('government');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_government($data)
    {
        $this->db->insert('government', $data);
        return $this->db->insert_id();
    }

    public function update_government($where, $data)
    {
        $this->db->update('government', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_government($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('government');
    }

    //CRUD Government

    public function create_event($data)
    {
        return $this->db->insert('event', $data);
    }
    private function _get_event_query()
    {
        $column_order = array('id', 'poster', 'title', 'date', 'location', 'ticket', 'organizer', 'description', 'status', 'id_user'); //set column field database for datatable orderable
        $column_search = array('title', 'date', 'location', 'organizer', 'status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('id' => 'desc'); // default order 

        $this->db->from('event');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orders = $order;
            $this->db->order_by(key($orders), $orders[key($orders)]);
        }
    }

    function read_event()
    {
        $this->_get_event_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_username_user_event($id){
        return $this->db->query("SELECT username FROM users WHERE id_user = '$id' LIMIT 1");
    }

    function get_data_id_user_event($username){
        return $this->db->query("SELECT id FROM users WHERE username = '$username' LIMIT 1");
    }

    function count_filtered_event()
    {
        $this->_get_event_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_event()
    {
        $this->db->from('event');
        return $this->db->count_all_results();
    }

    public function api_event(){
        $query = $this->db->get('event')->result();
        return $query;
    }

    public function get_by_event($id)
    {
        $this->db->from('event');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_event($data)
    {
        $this->db->insert('event', $data);
        return $this->db->insert_id();
    }

    public function update_event($where, $data)
    {
        $this->db->update('event', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_event($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('event');
    }

}
