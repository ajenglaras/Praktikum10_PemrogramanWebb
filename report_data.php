<?php 
//mengoneksikan database dan dompdf
include('koneksi2.php'); 
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf; 
$dompdf = new Dompdf(); 
//perintah query untuk mengambil data dari database kemudian mencetak data di file pdf
$query = mysqli_query($koneksi,"select * from pendaftaran"); 
$html = '<center><h3>DATA PENDAFTARAN PESERTA DIDIK</h3></center><hr/><br/>'; 
$html .= '<table border="1" width="100%"> 
<tr>
<th>No</th>
<th>Jenis Pendaftaran</th>
<th>Tanggal Masuk Sekolah</th>
<th>NIS</th>
<th>Nomor Peserta Ujian</th>
<th>Pernah PAUD</th>
<th>Pernah TK</th>
<th>No Seri SKHUN</th>
<th>No Seri Ijazah</th>
<th>Hobi</th>
<th>Cita-cita</th>
<th>Nama Lengkap</th>
<th>Jenis Kelamin</th>
<th>NISN</th>
<th>NIK</th>
</tr>'; 
$no = 1; 
//untuk mencetak data dari database pada tabel file pdf
while($row = mysqli_fetch_array($query))
{
$html .= "<tr> 
<td>".$no."</td> 
<td>".$row['jenis_pendaftaran']."</td>
<td>".$row['tanggal_masuk_sekolah']."</td>
<td>".$row['nis']."</td>
<td>".$row['nomor_peserta_ujian']."</td>
<td>".$row['pernah_paud']."</td>
<td>".$row['pernah_tk']."</td>
<td>".$row['no_seri_skhun']."</td>
<td>".$row['no_seri_ijazah']."</td>
<td>".$row['hobi']."</td>
<td>".$row['cita_cita']."</td>
<td>".$row['nama_lengkap']."</td>
<td>".$row['jenis_kelamin']."</td>
<td>".$row['nisn']."</td>
<td>".$row['nik']."</td>
</tr>";
$no++;
}
$html .= "</html>"; 
$dompdf ->loadHtml($html); 
// Setting ukuran dan orientasi kertas 
$dompdf->setPaper('A4', 'landscape'); 
// Rendering dari HTML Ke PDF 
$dompdf->render();
//Melakukan output file pdf 
$dompdf->stream('pendaftaran_peserta_didik.pdf');
?>