<?php

class MyClass {

    private $koneksi;

    public function __construct() {

        include '../config.php';

        $this->koneksi = $koneksi;


        $this->handleRequest();
    }

    private function handleRequest() {
        if ($_GET['halaman'] == "items") {
            $this->getItems();
        } elseif ($_GET['halaman'] == "category") {
            $this->getCategories();
        } elseif ($_GET['halaman'] == 'hapus_item' && isset($_GET['id'])) {
            $this->hapusItem($_GET['id']);
        } elseif ($_GET['halaman'] == "peminjaman") {
            $this->getPeminjaman();
        } elseif ($_GET['halaman'] == 'aksi_pinjam') {
            $this->aksiPinjam();
        }elseif ($_GET['halaman'] == 'tambah_category') {
            $this->tambahcategory();
        } elseif ($_GET['halaman'] == 'selesai' && isset($_GET['id'])) {
            $this->selesaiPeminjaman($_GET['id']);
        } 
        elseif ($_GET['halaman'] == "history") {
            $this->gethistory();
        }
        elseif ($_GET['halaman'] == 'hapus_category' && isset($_GET['id'])) {
            $this->hapus_category($_GET['id']);
        }
        elseif ($_GET['halaman'] == 'get_category' && isset($_GET['id'])) {
            $this->get_category($_GET['id']);
        }
        elseif ($_GET['halaman'] == 'edit_category') {
            $this->edit_category();
        }
    }

    private function getItems() {
        $sql = "SELECT * FROM items JOIN category ON items.id_category = category.id_category";
        $result = $this->koneksi->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function getCategories() {
        $sql = "SELECT category.*, COUNT(items.id_category) AS num_item FROM category
                LEFT JOIN items ON category.id_category = items.id_category
                GROUP BY category.id_category";

        $result = $this->koneksi->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function hapusItem($id) {
        $delete_query = "DELETE FROM items WHERE id_item = $id";
        $result = $this->koneksi->query($delete_query);
    }
    

    private function getPeminjaman() {
        $sql = "SELECT * FROM peminjaman JOIN items ON peminjaman.id_item = items.id_item JOIN category ON items.id_category = category.id_category";

        $result = $this->koneksi->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function gethistory() {
        $sql = "SELECT * FROM history";

        $result = $this->koneksi->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function aksiPinjam() {

        $id_peminjam = $_POST['id_peminjam'];
        $nama = $_POST['nama'];
        $jumlah = $_POST['jumlah'];
        $id_barang = $_POST['id_barang'];
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $status = "Active";
        $id_category = $_POST['id_category'];

        

          $category = "SELECT * FROM category WHERE id_category = $id_category";
            $result_category = $this->koneksi->query($category);
            $row = $result_category->fetch_assoc();
            $nama_item = $row['nama_category'];




            if ($row['stock'] < 1 || $jumlah <= 0 || $jumlah > $row['stock']) {
                echo "<script>alert('loan failed stock item kosong');</script>";
                echo "<script>location='index.php?halaman=peminjaman';</script>";
                echo $row['stock'];
            }
            else
            {
                $sql = "INSERT INTO peminjaman (id_peminjam, nama_peminjam, id_item, jumlah_peminjaman, tanggal_pinjam, tanggal_kembali, status_peminjaman) VALUES ('$id_peminjam', '$nama', '$id_barang', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', '$status')";
                $update_query = "UPDATE category SET stock = stock - $jumlah WHERE id_category = $id_category";
                $result_update = $this->koneksi->query($update_query);

    
        $result = $this->koneksi->query($sql);
        if ($result) {
            $currentTime = date("Y-m-d H:i:s");
            $history = "INSERT INTO history (waktu, Activity) VALUES ('$currentTime', '$nama $id_peminjam Loans $nama_item')";
            $result_history = $this->koneksi->query($history);
    
            if ($result_update) {
                echo "Peminjaman berhasil disimpan.";
            } else {
                echo "Error updating stock: " . mysqli_error($koneksi);
            }
        } else {
            echo "Error inserting peminjaman record: " . mysqli_error($koneksi);
        }
            }
    
        
        
        
    }
    private function tambahcategory() {

        $nama_category = $_POST['nama_category'];
        $category = $_POST['category'];

      
    
        $sql = "INSERT INTO category (nama_category , category) VALUES ('$nama_category', '$category')";
    
        $result = $this->koneksi->query($sql);
        if ($result) {
            $currentTime = date("Y-m-d H:i:s");
           
            $history = "INSERT INTO history (waktu, Activity) VALUES ('$currentTime', 'Add Category $nama_category')";
            $result_history = $this->koneksi->query($history);

            if ($result_history) {
                echo "<script>alert('Success Add Category');</script>";
                echo "<script>location='index.php?halaman=category';</script>";
            } else {
                echo "Error updating stock: " . mysqli_error($koneksi);
            }
    
            
        } else {
            echo "Error inserting peminjaman record: " . mysqli_error($koneksi);
        }
    
    }
    private function hapus_category($id) {

        $currentTime = date("Y-m-d H:i:s");

            $sql = "SELECT * FROM category WHERE id_category = $id";
            $result = $this->koneksi->query($sql);
            $row = $result->fetch_assoc();
            $nama_category = $row['nama_category'];
        
            $history = "INSERT INTO history (waktu, Activity) VALUES ('$currentTime', 'Delete Category $nama_category')";
            $result_history = $this->koneksi->query($history);

            if ($result_history) {
                $delete_query = "DELETE FROM category WHERE id_category = $id";
                $result = $this->koneksi->query($delete_query);
                echo "<script>alert('Success Delete Category');</script>";
                echo "<script>location='index.php?halaman=category';</script>";
            } else {
                echo "Error updating stock: " . mysqli_error($koneksi);
            }
    }

    private function edit_category () {

        $nama_category = $_POST['nama_category'];
        $category = $_POST['category'];
        $id = $_POST['id'];

        
        $sql = "UPDATE category SET nama_category = '$nama_category', category = '$category' WHERE id_category = $id";

        $result = $this->koneksi->query($sql);
        if ($result) {
            $currentTime = date("Y-m-d H:i:s");
           
            $history = "INSERT INTO history (waktu, Activity) VALUES ('$currentTime', 'Update Category  $nama_category')";
            $result_history = $this->koneksi->query($history);

            if ($result_history) {
                echo "<script>alert('Success Update Category');</script>";
                echo "<script>location='index.php?halaman=category';</script>";
            } else {
                echo "Error updating stock: " . mysqli_error($koneksi);
            }
    
            
        } else {
            echo "Error inserting peminjaman record: " . mysqli_error($koneksi);
        }
    
    }

    private function get_category($id) {
    
        $sql = "SELECT * FROM category WHERE id_category = $id";
        $result = $this->koneksi->query($sql);
        $row = $result->fetch_assoc();

        header('Content-Type: application/json');
        echo json_encode($row);
    
    }

    

    private function selesaiPeminjaman($id) {
        $sql = "SELECT * FROM peminjaman JOIN items ON peminjaman.id_item = items.id_item JOIN category ON items.id_category = category.id_category WHERE id_peminjaman=$id ";
        $result_id = $this->koneksi->query($sql);
        $row = $result_id->fetch_assoc();
        $nama = $row['nama_peminjam'];
        $nama_item = $row['nama_item'];
        $id_barang = $row['id_item'];
        $id_category = $row['id_category'];

        $jumlah_peminjaman = $row['jumlah_peminjaman'];
        $update_query = "UPDATE peminjaman SET status_peminjaman = 'Returned'  WHERE id_peminjaman  = $id";
        $result = $this->koneksi->query($update_query);

        $update_query = "UPDATE category SET stock = stock + $jumlah_peminjaman WHERE id_category = $id_category";
        $result_update = $this->koneksi->query($update_query);

        $currentTime = date("Y-m-d H:i:s");
        $history = "INSERT INTO history (waktu, Activity) VALUES ('$currentTime', '$nama Return $nama_item')";
        $result_history = $this->koneksi->query($history);

        echo "<script>alert('Peminjaman berhasil dikembalikan');</script>";
        echo "<script>location='index.php?halaman=item_logs';</script>";
    }
}

$myClass = new MyClass();

?>