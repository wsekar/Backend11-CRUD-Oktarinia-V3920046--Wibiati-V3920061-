<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Members extends CI_Controller
{
    public function __construct() //  Method ini yang akan dieksekusi pertama kali saat Controller diakses.
    {
        parent::__construct();
        $this->load->model("M_member"); // load model member
        $this->load->library('form_validation'); //load library (form_validation)
        // Library form_validation akan digunakan untuk memvalidasi input pada method add() dan edit()
        $this->load->helper('tanggal'); // load helper tanggal
    }

    public function index()
    {
        $data["members"] = $this->M_member->getAll(); // mengambil data dari model dengan memanggil method M_member->getAll().
        $this->load->view("admin/member/list_member", $data); // view/menampilkan list dari data member
    }

    public function add() // menampilkan form add dan menyimpan data ke database
    {
        if ($this->input->method() === 'post') {
            $config['upload_path']          = './assets/images/'; //tempat penyimpanan
            $config['allowed_types']        = 'gif|jpg|png'; //tipe yang ingin diinsert
            $config['max_size']             = 10000; //ukuran file maksimal
            $config['max_width']            = 10000; //lebar maksimal
            $config['max_height']           = 10000; //tinggi maksimal

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_member')) { //jika gambar dalam form tidak ada
                $data['error'] = $this->upload->display_errors();
            } else {
                $foto_member = $this->upload->data(); // data upload foto
                $foto_member = $foto_member['file_name']; 
                $nama_member = $this->input->post('nama_member', TRUE); // inputan data nama_member
                $tanggal_lahir = $this->input->post('tanggal_lahir', TRUE); // inputan data tanggal_lahir
                $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE); // inputan data jenis_kelamin
                $kewarganegaraan = $this->input->post('kewarganegaraan', TRUE); // inputan data kewarganegaraan
                $email_member = $this->input->post('email_member', TRUE); // inputan data email_member
                $password = $this->input->post('password', TRUE); // inputan data password
                $deskripsi = $this->input->post('deskripsi', TRUE); // inputan data dekripsi
                $unit = $this->input->post('unit', TRUE); // inputan dataunit

                $data = array( // variable data yang akan menampung sekumpulan data hasil inputan tadi
                    'nama_member' => $nama_member,
                    'tanggal_lahir' => $tanggal_lahir,
                    'jenis_kelamin' => $jenis_kelamin,
                    'kewarganegaraan' => $kewarganegaraan,
                    'email_member' => $email_member,
                    'password' => $password,
                    'deskripsi' => $deskripsi,
                    'unit' => $unit,
                );
                // $member->save(); // simpan data ke database
                $this->db->insert('tb_member', $data);
                $this->session->set_flashdata('success', ' Data berhasil disimpan'); //notifikasi data berhasil disimpan
            }
            // menampilkan form add
            // $member = $this->M_member; // objek model
            // $validation = $this->form_validation; // objek form validation
            // $validation->set_rules($member->rules()); // terapkan rules
            // if ($validation->run()) { // melakukan validasi
            //     $member->save(); // simpan data ke database
            //     $this->session->set_flashdata('success', 'Data berhasil disimpan'); // pesan berhasil
            // }
            // $this->load->view("admin/member/add_member");
        }
        $this->load->view("admin/member/add_member");
    }

    // $id -> data yang akan diedit , 
    public function edit($id = null)
    {                    // dilakukan rederict ke route admin/members jika $id bernilai null
        if (!isset($id)) redirect('admin/members');

        $member = $this->M_member; // objek model
        $validation = $this->form_validation; // objek validation
        $validation->set_rules($member->rules()); //menerapkan rules

        if ($validation->run()) { // melakukan validasi
            $member->update(); // menyim[an data yang telah di edit
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }

        $data["member"] = $member->getById($id); // mengambil data untuk ditampilkan pada form edit
        if (!$data["member"]) show_404(); // apabila data tidak ada maka akan eror 404

        $this->load->view("admin/member/edit_member", $data); // menampilkan form edit
    }

    // $id untuk menentukkan data mana yang akan dihapus
    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->M_member->delete($id)) {
            redirect(site_url('admin/members')); // apabila berhasil akan menredirect ke halaman admin/members
        }
    }
}
