<?php
class database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "sekolah"; 
    private $conn;

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }    

    public function tampil_data_siswa() {
        $query = "SELECT 
            s.idsiswa,
            s.nisn,
            s.nama,
            s.jeniskelamin,
            (select namajurusan from jurusan j where j.kodejurusan=s.kodejurusan) as namajurusan,
            s.kelas,
            s.alamat,
           (select agama from agama a where a.kodeagama=s.kodeagama) as agama,
            s.nohp
            FROM siswa s";

        $result = mysqli_query($this->koneksi, $query);

        if (!$result) {
            die("Error dalam query: " . mysqli_error($this->koneksi));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

        public function tampil_data_guru() {
            $query = "SELECT 
                g.idguru,
                g.nip,
                g.nama,
                g.kodegolongan, 
                g.jeniskelamin,
                g.alamat,
                g.nohp,
                (select agama from agama a where a.kodeagama=g.kodeagama) as agama,
                (SELECT golongan FROM golonganguru gg WHERE gg.kodegolongan = g.kodegolongan) AS golongan
            FROM guru g";

            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die("Error dalam query: " . mysqli_error($this->koneksi));
            }

            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            return $data;
        }

        public function tampil_data_jurusan() {
            $query = "SELECT * FROM jurusan";

            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die("Error dalam query: " . mysqli_error($this->koneksi));
            }

            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            return $data;
    }
    public function tampil_data_agama() {
        $query = "SELECT * FROM agama";

        $result = mysqli_query($this->koneksi, $query);

        if (!$result) {
            die("Error dalam query: " . mysqli_error($this->koneksi));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function tambah_siswa($nisn, $nama, $jeniskelamin, $kodejurusan, $kelas, $alamat, $kodeagama, $nohp) {
        // Cek apakah NISN/Nama/NoHP udah dipake
        $cekQuery = "SELECT * FROM siswa WHERE nisn = ? OR nama = ? OR nohp = ?";
        $stmt = mysqli_prepare($this->koneksi, $cekQuery);
        mysqli_stmt_bind_param($stmt, "sss", $nisn, $nama, $nohp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            return false; // Ada yang dobel
        }
        mysqli_stmt_close($stmt);

        // Lanjut insert
        $insertQuery = "INSERT INTO siswa (nisn, nama, jeniskelamin, kodejurusan, kelas, alamat, kodeagama, nohp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->koneksi, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssssssss", $nisn, $nama, $jeniskelamin, $kodejurusan, $kelas, $alamat, $kodeagama, $nohp);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $result;
    }

    public function tambah_guru($nip, $nama, $jeniskelamin, $alamat, $kodegolongan, $kodeagama, $nohp) {
        // Cek apakah NIP/Nama/NoHP udah dipake
        $cekQuery = "SELECT * FROM guru WHERE nip = ? OR nama = ? OR nohp = ?";
        $stmt = mysqli_prepare($this->koneksi, $cekQuery);
        mysqli_stmt_bind_param($stmt, "sss", $nip, $nama, $nohp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            return false; // Ada yang dobel
        }
        mysqli_stmt_close($stmt);

        // Lanjut insert ke tabel guru
        $insertQuery = "INSERT INTO guru (nip, nama, jeniskelamin, alamat, kodegolongan, kodeagama, nohp) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->koneksi, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sssssss", $nip, $nama, $jeniskelamin, $alamat, $kodegolongan, $kodeagama, $nohp);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $result;
    }

    public function tambah_agama($agama) {
        $stmt_cek = $this->koneksi->prepare("SELECT 1 FROM agama WHERE agama = ?");
        $stmt_cek->bind_param("s", $agama);
        $stmt_cek->execute();
        $stmt_cek->store_result();
        $is_exists = $stmt_cek->num_rows > 0;
        $stmt_cek->close();

         if ($is_exists) return false;

        $stmt = $this->koneksi->prepare("INSERT INTO agama (agama) VALUES (?)");
        $stmt->bind_param("s", $agama);
        $sukses = $stmt->execute();
        $stmt->close();

        return $sukses;
    }

    public function tambah_jurusan($namajurusan) {
        $stmt_cek = $this->koneksi->prepare("SELECT 1 FROM jurusan WHERE namajurusan = ?");
        $stmt_cek->bind_param("s", $namajurusan);
        $stmt_cek->execute();
        $stmt_cek->store_result();
        $is_exists = $stmt_cek->num_rows > 0;
        $stmt_cek->close();

         if ($is_exists) return false;

        $stmt = $this->koneksi->prepare("INSERT INTO jurusan (namajurusan) VALUES (?)");
        $stmt->bind_param("s", $namajurusan);
        $sukses = $stmt->execute();
        $stmt->close();

        return $sukses;
    }

    public function getSiswaByNISN($nisn) {
        // Sanitasi input untuk mencegah SQL injection
        $nisn = $this->koneksi->real_escape_string($nisn);
        
        // Query untuk mengambil data siswa beserta data jurusan dan agama
        $query = $this->koneksi->query("SELECT 
            siswa.*, 
            jurusan.namajurusan, 
            agama.agama 
        FROM 
            siswa 
        LEFT JOIN 
            jurusan ON siswa.kodejurusan = jurusan.kodejurusan 
        LEFT JOIN 
            agama ON siswa.kodeagama = agama.kodeagama 
        WHERE 
            siswa.nisn = '$nisn'");

        return $query->fetch_assoc();

        if ($query && $query->num_rows > 0) {
            return $query->fetch_assoc();
        } else {
            return null;
        }
        
    }
    
    // 3. Fungsi untuk mengupdate data siswa
    public function updateSiswa($nisn, $data) {
        // Sanitasi semua input untuk mencegah SQL injection
        $nisn = $this->koneksi->real_escape_string($nisn);
        $nama = $this->koneksi->real_escape_string($data['nama']);
        $alamat = $this->koneksi->real_escape_string($data['alamat']);
        $nohp = $this->koneksi->real_escape_string($data['nohp']);
        $agama = $this->koneksi->real_escape_string($data['agama']);
        $jurusan = $this->koneksi->real_escape_string($data['jurusan']);
        $kelas = $this->koneksi->real_escape_string($data['kelas']);
        $jeniskelamin = $this->koneksi->real_escape_string($data['jeniskelamin']);
        
        // Query untuk mengupdate data siswa menggunakan prepared statement
        $query = $this->koneksi->prepare("UPDATE siswa SET 
            nama = ?, 
            alamat = ?, 
            nohp = ?, 
            kodeagama = ?, 
            kodejurusan = ?, 
            kelas = ?, 
            jeniskelamin = ? 
            WHERE nisn = ?");
        
        // Bind parameter
        $query->bind_param("ssssssss", $nama, $alamat, $nohp, $agama, $jurusan, $kelas, $jeniskelamin, $nisn);
        
        // Execute query
        $result = $query->execute();
        
        // Return result of the execution
        return $result;
    }
    
    
    // 4. Fungsi untuk mengambil semua data jurusan
    public function getAllJurusan() {
        $query = $this->koneksi->query("SELECT * FROM jurusan ORDER BY namajurusan");
        $result = [];
        
        while ($row = $query->fetch_assoc()) {
            $result[] = $row;
        }
        
        return $result;
    }
    
    // 5. Fungsi untuk mengambil semua data agama
    public function getAllAgama() {
        $query = $this->koneksi->query("SELECT * FROM agama ORDER BY agama");
        $result = [];
        
        while ($row = $query->fetch_assoc()) {
            $result[] = $row;
        }
        
        return $result;
    }
    public function hapussiswa($nisn) {
        // Asumsi koneksi database sudah ada di $this->conn
        $query = "DELETE FROM siswa WHERE nisn = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        if (!$stmt) {
            return false; // Gagal prepare
        }
    
        $stmt->bind_param("s", $nisn);
    
        if ($stmt->execute()) {
            return true; // Berhasil hapus
        } else {
            return false; // Gagal hapus
        }
    }
    public function hapusguru($nip) {
        // Asumsi koneksi database sudah ada di $this->conn
        $query = "DELETE FROM guru WHERE nip = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        if (!$stmt) {
            return false; // Gagal prepare
        }
    
        $stmt->bind_param("s", $nip);
    
        if ($stmt->execute()) {
            return true; // Berhasil hapus
        } else {
            return false; // Gagal hapus
        }
    }

    public function getAgamaByKode($kodeagama) {
        $query = "SELECT * FROM agama WHERE kodeagama = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
    
        mysqli_stmt_bind_param($stmt, "i", $kodeagama);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
    
        mysqli_stmt_close($stmt);
        return $data;
    }
    public function getJurusanByKode($kodejurusan) {
        $query = "SELECT * FROM jurusan WHERE kodejurusan = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
    
        mysqli_stmt_bind_param($stmt, "i", $kodejurusan);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
    
        mysqli_stmt_close($stmt);
        return $data;
    }
    
    public function updateagama($kodeagama, $data) {
        if (!isset($data['agama'])) {
            echo "Agama tidak dikirim!<br>";
            return false;
        }

        $agama = trim($data['agama']); // buang spasi
        $query = $this->koneksi->prepare("UPDATE agama SET agama = ? WHERE kodeagama = ?");

        if (!$query) {
            echo "Gagal prepare: " . $this->koneksi->error . "<br>";
            return false;
        }

        $query->bind_param("ss", $agama, $kodeagama);

        if (!$query->execute()) {
            echo "Gagal eksekusi: " . $query->error . "<br>";
            return false;
        }

        echo "Query berhasil dieksekusi. Baris berubah: " . $query->affected_rows . "<br>";

        return true;
    }
public function updatejurusan($kodejurusan, $data) {
    if (!isset($data['namajurusan'])) {
        echo "Jurusan tidak dikirim!<br>";
        return false;
    }

    $namajurusan = trim($data['namajurusan']); // GANTI variabelnya sesuai yg dibutuhkan

    $query = $this->koneksi->prepare("UPDATE jurusan SET namajurusan = ? WHERE kodejurusan = ?");

    if (!$query) {
        echo "Gagal prepare: " . $this->koneksi->error . "<br>";
        return false;
    }

    $query->bind_param("ss", $namajurusan, $kodejurusan);

    if (!$query->execute()) {
        echo "Gagal eksekusi: " . $query->error . "<br>";
        return false;
    }

    echo "Query berhasil dieksekusi. Baris berubah: " . $query->affected_rows . "<br>";

    return true;
}


public function hapusAgama($kodeagama) {
    // Query hapus dengan prepared statement
    $query = "DELETE FROM agama WHERE kodeagama = ?";
    $stmt = mysqli_prepare($this->koneksi, $query);

    if (!$stmt) {
        return false; // Gagal prepare
    }

    // Bind param, asumsikan kodeagama tipe INT, kalau string ganti "s"
    $stmt->bind_param("i", $kodeagama);

    if ($stmt->execute()) {
        return true; // Berhasil hapus
    } else {
        return false; // Gagal hapus
    }
}
public function hitungJumlahAgama() {
    $query = "SELECT COUNT(*) AS total FROM agama";
    $result = $this->koneksi->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}

public function hapusJurusan($kodejurusan) {
    // Query hapus dengan prepared statement
    $query = "DELETE FROM jurusan WHERE kodejurusan = ?";
    $stmt = mysqli_prepare($this->koneksi, $query);

    if (!$stmt) {
        return false; // Gagal prepare
    }

    // Bind param, asumsikan kodeagama tipe INT, kalau string ganti "s"
    $stmt->bind_param("i", $kodejurusan);

    if ($stmt->execute()) {
        return true; // Berhasil hapus
    } else {
        return false; // Gagal hapus
    }
}
public function hitungJumlahSiswa() {
    $query = "SELECT COUNT(*) AS total FROM siswa";
    $result = $this->koneksi->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}
public function hitungJumlahJurusan() {
    $query = "SELECT COUNT(*) AS total FROM jurusan";
    $result = $this->koneksi->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}
public function hitungJumlahGuru() {
    $query = "SELECT COUNT(*) AS total FROM guru";
    $result = $this->koneksi->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}

public function getGuruById($idguru) {
    $idguru = $this->koneksi->real_escape_string($idguru);

    $query = $this->koneksi->query("SELECT 
        guru.*, 
        golonganguru.golongan, 
        agama.agama 
    FROM guru 
    LEFT JOIN golonganguru ON guru.kodegolongan = golonganguru.kodegolongan 
    LEFT JOIN agama ON guru.kodeagama = agama.kodeagama 
    WHERE guru.idguru = '$idguru'");

    return $query && $query->num_rows > 0 ? $query->fetch_assoc() : null;
}


public function updateGuru($idguru, $data) {
    $idguru = $this->koneksi->real_escape_string($idguru);
    $nip = $this->koneksi->real_escape_string($data['nip']);
    $nama = $this->koneksi->real_escape_string($data['nama']);
    $alamat = $this->koneksi->real_escape_string($data['alamat']);
    $nohp = $this->koneksi->real_escape_string($data['nohp']);
    $agama = $this->koneksi->real_escape_string($data['agama']);
    $golongan = $this->koneksi->real_escape_string($data['golongan']);
    $jeniskelamin = $this->koneksi->real_escape_string($data['jeniskelamin']);

    $cekQuery = "SELECT * FROM guru WHERE (nip = ? OR nama = ? OR nohp = ?) AND idguru != ?";
    $stmt = $this->koneksi->prepare($cekQuery);
    $stmt->bind_param("sssi", $nip, $nama, $nohp, $idguru);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return false;
    }

    $stmt->close();

    $query = $this->koneksi->prepare("UPDATE guru SET 
        nip = ?, nama = ?, alamat = ?, nohp = ?, kodeagama = ?, kodegolongan = ?, jeniskelamin = ? 
        WHERE idguru = ?");
    $query->bind_param("sssssssi", $nip, $nama, $alamat, $nohp, $agama, $golongan, $jeniskelamin, $idguru);
    return $query->execute();
}

public function getJumlahSiswaPerJurusan() {
    $query = "SELECT j.namajurusan, COUNT(s.idsiswa) as jumlah 
              FROM siswa s 
              JOIN jurusan j ON s.kodejurusan = j.kodejurusan 
              GROUP BY j.namajurusan";
    $result = mysqli_query($this->koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    return $data;
}

public function getDistribusiAgamaSiswa() {
    $query = "SELECT a.agama, COUNT(s.idsiswa) as jumlah 
              FROM siswa s 
              JOIN agama a ON s.kodeagama = a.kodeagama 
              GROUP BY a.agama";
    $result = mysqli_query($this->koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    return $data;
}

public function getPertumbuhanSiswa5TahunTerakhir() {
    $query = "SELECT YEAR(tanggal_daftar) as tahun, COUNT(idsiswa) as jumlah 
              FROM siswa 
              WHERE tanggal_daftar >= DATE_SUB(CURDATE(), INTERVAL 5 YEAR) 
              GROUP BY YEAR(tanggal_daftar) 
              ORDER BY tahun ASC";
    $result = mysqli_query($this->koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    // Pastikan ada data untuk 5 tahun terakhir
    $currentYear = date('Y');
    $years = [];
    for ($i = 4; $i >= 0; $i--) {
        $year = $currentYear - $i;
        $years[$year] = 0;
    }
    
    foreach ($data as $row) {
        $years[$row['tahun']] = $row['jumlah'];
    }
    
    $finalData = [];
    foreach ($years as $year => $jumlah) {
        $finalData[] = ['tahun' => $year, 'jumlah' => $jumlah];
    }
    
    return $finalData;
}

public function getJumlahSiswaPerKelas() {
    $query = "SELECT kelas, COUNT(idsiswa) as jumlah 
              FROM siswa 
              GROUP BY kelas 
              ORDER BY kelas";
    $result = mysqli_query($this->koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    return $data;
}

public function getJenisKelaminSiswa() {
    $query = "SELECT jeniskelamin, COUNT(idsiswa) as jumlah 
              FROM siswa 
              GROUP BY jeniskelamin";
    $result = mysqli_query($this->koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    return $data;
}

public function getJumlahGuruPerGolongan() {
    $query = "SELECT g.golongan, COUNT(gr.idguru) as jumlah 
              FROM guru gr 
              JOIN golonganguru g ON gr.kodegolongan = g.kodegolongan 
              GROUP BY g.golongan";
    $result = mysqli_query($this->koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    return $data;
}

}
?>