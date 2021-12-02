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
		    $this->load->library('upload'); // load library upload
    }

    public function index()
    {
        $data["members"] = $this->M_member->getAll(); // mengambil data dari model dengan memanggil method M_member->getAll().
        $this->load->view("admin/member/list_member", $data); // view/menampilkan list dari data member
    }

    public function add() // menampilkan form add dan menyimpan data ke database
    {
       if ($this->input->method() === 'post') {
            $nama_member = $this->input->post('nama_member', TRUE);
            $tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
            $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
            $kewarganegaraan = $this->input->post('kewarganegaraan', TRUE);
            $email_member = $this->input->post('email_member', TRUE);
            $password = $this->input->post('password', TRUE);
            $deskripsi = $this->input->post('deskripsi', TRUE);
            $unit = $this->input->post('unit', TRUE);
            $config['upload_path']          = './assets/images/'; //tempat penyimpanan
            $config['allowed_types']        = 'gif|jpg|png|PNG'; //tipe yang ingin diinsert
            $config['max_size']             = 10000; //ukuran file maksimal
            $config['max_width']            = 10000; //lebar maksimal
            $config['max_height']           = 10000; //tinggi maksimal
            $config['file_name'] = $_FILES['foto_member']['name'];
            $this->upload->initialize($config);
            if (!empty($_FILES['foto_member']['name'])) {
                if ($this->upload->do_upload('foto_member')) {
                    $foto_member = $this->upload->data();
                    $data = array(
                        'foto_member' => $foto_member['file_name'],
                        'nama_member' => $nama_member,
                        'tanggal_lahir' => $tanggal_lahir,
                        'jenis_kelamin' => $jenis_kelamin,
                        'kewarganegaraan' => $kewarganegaraan,
                        'email_member' => $email_member,
                        'password' => $password,
                        'deskripsi' => $deskripsi,
                        'unit' => json_encode(implode(",", $unit)),
                    );
                    $this->db->insert('tb_member', $data);
                    $this->session->set_flashdata('success', ' Data berhasil disimpan');
                    redirect(site_url('admin/members'));
                } else {
                    die("Foto gagal diupload");
                }
            } else {
                echo "data tidak masuk";
            }
        } else {

            // $this->session->set_flashdata('success', ' Data tidak berhasil disimpan');
            $this->load->view("admin/member/add_member");
        }
    }

    // $id -> data yang akan diedit , 
    public function edit($id = null)
    {                    // dilakukan rederict ke route admin/members jika $id bernilai null
         if (!isset($id)) redirect('admin/members');
        $member = $this->M_member;
        $validation = $this->form_validation; // objek validation
        $validation->set_rules($member->rules());
        $data["member"] = $member->getById($id);

        if ($this->input->method() === 'post') {
            $id_member = $this->input->post('id', TRUE);
            $nama_member = $this->input->post('nama_member', TRUE);
            $tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
            $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
            $kewarganegaraan = $this->input->post('kewarganegaraan', TRUE);
            $email_member = $this->input->post('email_member', TRUE);
            $password = $this->input->post('password', TRUE);
            $deskripsi = $this->input->post('deskripsi', TRUE);
            $unit = $this->input->post('unit', TRUE);
            $path = './assets/image/';
            $condition = array('id_member' => $id_member);
            $config['upload_path']          = './assets/images/'; //tempat penyimpanan
            $config['allowed_types']        = 'gif|jpg|png|PNG'; //tipe yang ingin diinsert
            $config['max_size']             = 10000; //ukuran file maksimal
            $config['max_width']            = 10000; //lebar maksimal
            $config['max_height']           = 10000; //tinggi maksimal
            $config['file_name'] = $_FILES['foto_member']['name'];
            $this->upload->initialize($config);
            if (!empty($_FILES['foto_member']['name'])) {
                if ($this->upload->do_upload('foto_member')) {
                    $foto_member = $this->upload->data();
                    $data = array(
                        'foto_member' => $foto_member['file_name'],
                        'nama_member' => $nama_member,
                        'tanggal_lahir' => $tanggal_lahir,
                        'jenis_kelamin' => $jenis_kelamin,
                        'kewarganegaraan' => $kewarganegaraan,
                        'email_member' => $email_member,
                        'password' => $password,
                        'deskripsi' => $deskripsi,
                        'unit' => json_encode(implode(",", $unit)),
                    );
                    @unlink($path . $this->input->post('foto_lama'));

                    $this->db->update('tb_member', $data, $condition);
                    $this->session->set_flashdata('success', ' Data berhasil disimpan');
                    redirect(site_url('admin/members'));
                } else {
                    die("Foto gagal diupload");
                }
            } else {
                echo "data gagal diupdate";
            }
        } else {

            // $this->session->set_flashdata('success', ' Data tidak berhasil disimpan');
            $this->load->view("admin/member/edit_member", $data);
        }
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
