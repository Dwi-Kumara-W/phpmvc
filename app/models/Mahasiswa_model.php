<?php

class Mahasiswa_model{
    // private $mhs = [
    //     [
    //         "nama" => "Dwi Kumara Widyatna",
    //         "nim" => "18410100192",
    //         "email" => "18410100192@dinamika.ac.id",
    //         "jurusan" => "S1 Sistem Informasi"
    //     ],
    //     [
    //         "nama" => "Farouq An Najaby",
    //         "nim" => "18410100125",
    //         "email" => "18410100125@dinamika.ac.id",
    //         "jurusan" => "S1 Sistem Informasi"
    //     ]
    // ];

    private $table = 'tb_mahasiswa'; 
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMahasiswa(){

        // $this->stmt = $this->dbh->prepare('SELECT * FROM tb_mahasiswa');
        // $this->stmt->execute();
        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();

    }

    public function getMahasiswaById($id){

        $this->db->query('SELECT * FROM '.$this->table. ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();

    }

    public function tambahDataMahasiswa($data){

        $query = "INSERT INTO tb_mahasiswa VALUES (null, :nama, :nim, :email, :jurusan)";

        $this->db->query($query);

        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();

    }

    public function hapusDataMahasiswa($id){

        $query = 'DELETE FROM '.$this->table. ' WHERE id=:id';

        $this->db->query($query);

        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();

    }

    public function ubahDataMahasiswa($data){

        $query = "UPDATE tb_mahasiswa SET 
                    nama = :nama, 
                    nim = :nim,
                    email = :email,
                    jurusan = :jurusan
                    WHERE id = :id";

        $this->db->query($query);

        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();

    }

    public function cariDataMahasiswa(){

        $keyword = $_POST['keyword'];
        $query = 'SELECT * FROM '.$this->table. ' WHERE nama LIKE :keyword';

        $this->db->query($query);

        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();

    }
}