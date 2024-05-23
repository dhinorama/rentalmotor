<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <style>
    .ini {  
            outline: auto;
            width: 620px;
            padding: 8px 16px;
            max-width: 900px;
              margin: 0 auto;
              float:
        }
</style>
    </head>
<body>


    <div class="card">
    <center><h1>Rental Motor</h1></center>
    <center>
    <form method="post" action="">
        <table>
            <tr>
                <td><label for="nama">Nama Pelanggan</label></td>
                <td>:</td>
                <td><input type="text" name="nama" autocomplete='off'></td>
            </tr>
            <tr>
                <td><label for="waktu">Lama Waktu Rental (per hari)</label></td>
                <td>:</td>
                <td><input type="number" name="waktu" autocomplete='off'></td>
            </tr>
            <tr>
                <td><label for="jenis">Jenis Motor</label></td>
                <td>:</td>
                <td><select name="tipe" id="tipe">
                <option value="scooter">Scooter</option>
                <option value="harley">harley</option>
                <option value="aerox">Aerox</option>
                </select></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="submit"></td>
            </tr>
        </table>
    </form><br>
    <?php
    class Rental {
        public $member = ["bintang", "mayra", "desti"];

        public function pajak(){
            return 10000;
        }
        public function disc($waktu, $nama) {
            if ($waktu > 0 && in_array($nama, $this->member)) {
                return 5;
            }
            return 0;
        }

        public function hitung_total($nama, $waktu, $tipe) {
            $harga_perhari = $this->harga_rental($tipe);
            $disc = $this->disc($waktu, $nama);
            $total_sebelum_disc = $harga_perhari * $waktu;
            $total_disc = ($total_sebelum_disc * $disc) / 100;
            $total_setelah_disc = $total_sebelum_disc - $total_disc;
            $pajak = $this->pajak();
            $total_biaya = $total_setelah_disc + $pajak;

            // Memanggil metode tampilkan_bukti untuk menampilkan hasil perhitungan
            $this->tampilkan_bukti($nama, $waktu, $tipe, $disc, $harga_perhari, $total_biaya);
        }

        public function tampilkan_bukti($nama, $waktu, $tipe, $disc, $harga_perhari, $total_biaya) {
           echo "<div class='ini'>";
            echo $nama . " berstatus sebagai " . (in_array($nama, $this->member) ? "Member" : "Non-Member"). " ";
            echo (in_array($nama, $this->member) ? "mendapatkan diskon sebesar " . $disc . "%" : "mendapatkan diskon sebesar 0%") . "<br>";
            echo "Jenis motor yang di rental adalah " . $tipe . " selama " . $waktu . " hari<br>";
            echo "Harga rental per harinya: Rp. " . number_format($harga_perhari, 0, ',', '.') . "<br><br>";
            echo "Besar yang harus di bayarkan adalah :<b> Rp. " . number_format($total_biaya, 0, ',', '.') . "</b>";
 echo"</div>";
        }

        public function harga_rental($tipe) {
            $harga_perhari = 0;

            switch ($tipe) {
                case 'scooter':
                    $harga_perhari = 50000;
                    break;
                case 'harley':
                    $harga_perhari = 90000;
                    break;
                case 'aerox':
                    $harga_perhari = 80000;
                    break;
            }

            return $harga_perhari;
        }
    }

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $waktu = intval($_POST['waktu']);
        $tipe = $_POST['tipe'];

        $rental = new Rental();
        $rental->hitung_total($nama, $waktu, $tipe);
    }
    ?>
    </div>
    </center>
</body>
</html>