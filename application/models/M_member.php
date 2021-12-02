<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_member extends CI_Model
{    //pada $_table diberikan modifer private karena hanya akan digunakan pada class ini saja
    private $_table = "tb_member"; //nama tabel
    //nama atribut dibawah ini harus sesuai dengan nama atribut pada database yang telah dibuat melalui MySql
    public $id_member;
    public $nama_member;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $kewarganegaraan;
    public $email_member;
    public $password;
    public $unit;
    public $foto_member;

    public function rules()
    {
        //akan digunakan untuk mengembalikan nilai arry yang berisi rules saat validasi proses input
        // rules => required artinya pada form harus wajib diisi
        return [
            [
                'field' => 'nama_member',
                'label' => 'Nama Asli',
                'rules' => 'required'
            ],
            [
                'field' => 'tanggal_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'date'
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'required'
            ],
            [
                'field' => 'kewarganegaraan',
                'label' => 'Kewarganegaraan',
                'rules' => 'required'
            ],

            [
                'field' => 'unit',
                'label' => 'Sub Unit',
                // 'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {                 // result : berfungsi untuk mengambil semua data hasil query
        return $this->db->get($this->_table)->result();
        // sama artinya dg :
        // SLECT * FROM tb_album
        // method ini akan mengembalikkan sebuah array yang berisi dari object row
    }

    public function getById($id)
    { // row : mengambil satu data dari hasil query
        return $this->db->get_where($this->_table, ["id_member" => $id])->row();
        // sama dengan :
        // SELECT * FROM tb_albums WHERE Id_albums = $id 
    }

    public function save()
    {
        $post = $this->input->post(); //mengambil data dari form
        $this->nama_member = $post["nama_member"]; // isi field nama asli
        $this->tanggal_lahir = $post["tanggal_lahir"]; // isi field tanggal lahir
        $this->jenis_kelamin = $post["jenis_kelamin"]; // isi field jenis kelamin
        $this->kewarganegaraan = $post["kewarganegaraan"]; // isi field kewarganegaraan
        $this->email_member = $post["email_member"]; // isi field email
        $this->password = $post["password"]; // isi field password
        $this->unit = $post["unit"]; // isi field sub unit
        $this->foto_member = $post["foto_member"];

        $this->deskripsi = $post["deskripsi"];
        return $this->db->insert($this->_table, $this); // simpan database
        // $this -> data yang akan disimpan
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_member = $post["id"]; //kita mengisi $this->id_member dengan id yang didapatkan dari form ($post['id'])
        $this->nama_member = $post["nama_member"];
        $this->tanggal_lahir = $post["tanggal_lahir"];
        $this->jenis_kelamin = $post["jenis_kelamin"];
        $this->kewarganegaraan = $post["kewarganegaraan"];
        $this->email_member = $post["email_member"];
        $this->password = $post["password"];
        $this->unit = $post["unit"];
        $this->foto_member = $post["foto_member"];
        $this->deskripsi = $post["deskripsi"];
        return $this->db->update($this->_table, $this, array('id_member' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_member" => $id));
    }
}
