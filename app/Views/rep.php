<?php
//ini header
$u = base_url();
$konten = "";
$header = '		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Memo</b><br>
		<img src="http://localhost/memoCI4/public/data/garis.png"></img><br>
		<table>
			<tr>
				<td width="150" align="left" >
					Dari
					
				</td>
				<td width="150" align="left" >
					Kepada
				</td>
				<td width="250" align="left" >
					Nomor : ' . $permohonan->nomor . '
				</td>		
			</tr>

			<tr>
				<td width="150" align="left" >
					<b>' . $permohonan->dari . '</b>
				</td>
				<td width="150" align="left" >
					<b>' . $permohonan->kepada . '</b>
				</td>
				<td width="250" align="left">
				</td>		
			</tr>
			


			<tr>
				<td width="150" align="left" >
					' . $permohonan->fromJabatan . '
					
				</td>
				<td width="150" align="left" >
				' . $permohonan->toJabatan . '

				</td>
				<td width="250" align="left" >
					Perihal : ' . $permohonan->hal . '
				</td>		
			</tr>
			<tr>
				<td width="150" align="left" >
					' . $permohonan->fromEmail . '
				</td>
				<td width="150" align="left" >
					' . $permohonan->toEmail . '
				</td>
				<td width="250" align="left" >
					Tanggal : ' . $permohonan->tanggal . '
				</td>		
			</tr>
			<tr>
				<td width="150" align="left" >
					' . $permohonan->fromLokasi . '
				</td>
				<td width="150" align="left" >
					' . $permohonan->toLokasi . '
				</td>
				<td width="250" align="left" >
				</td>		
			</tr>
		 </table><br><br>
		<img src="http://localhost/memoCI4/public/data/garis.png"></img><br>
		<table>
			<tr>
				<td align="center">
					<span><img src="http://localhost/memoCI4/public/data/bismillah.jpg"></img><br>
				</td>
			</tr>
		</table>
		<img src="http://localhost/memoCI4/public/data/garis.png"></img><br><br>';

//ini pembuka
//pembuka kalau tanpa tabel bakalan ke replace sama deskripsi
$pembuka = 'Dengan ini menyatakan<br><br>';
//ini tabel
$tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <table border="1">
    <tr>
        <td align="center" width="35"> No.</td>
        <td align="center" width="100"> Nama Barang</td>
        <td align="center" width="50"> Unit</td>
        <td align="center" width="50"> Harga</td>
        <td align="center" width="60"> Total</td>
        <td align="center" width="150"> Keterangan</td>
    </tr>';
$i = 0;
$total = 0;
foreach ($barang as $c) {
	$i++;
	$j = 0;
	$j = $c->unit * $c->harga;
	$total = $total + $j;
	$tab = $tab . '<tr>
            <td align="center">';
	$tab = $tab . "$i</td>										
            <td> $c->nama_barang</td>										
            <td> $c->unit/$c->satuan</td>			
            <td> $c->harga</td>		
            <td> $j</td>		
            <td> $c->keterangan</td>
        </tr>";
}
$tab = $tab . '
        <tr>
            <td colspan="4" align="center">Total</td>
            <td> ' . $total . '</td>
        </tr></table>
    ';

//ini kata penutup
//penutup tanpa atau dengan tabel sama (template)
$penutup = '<br><br>		
    Demikian surat ini
    <br><br>
    <table>
    <tr>
        <td width="150" align="center" >
            ' . $permohonan->toJabatan . '				
        </td>
        <td width="150" align="left" >
            
        </td>
        <td width="180" align="center" >
            Pemohon
        </td>		
    </tr>
    </table><br><br><br><br>
    <table>
    <tr>
        <td width="150" align="center" >
        ' . $permohonan->kepada . '				
        </td>
        <td width="150" align="left" >
            
        </td>
        <td width="180" align="center" >
        ' . $permohonan->dari . '				
        </td>		
    </tr>
	</table>	';
if (sizeof($barang) == 0) {
	$konten = $header . $permohonan->deskripsi . $penutup;
} else {
	$konten = $header . $permohonan->deskripsi . "<br><br>" . $tab . $penutup;
}
// $konten = $header . $permohonan->deskripsi . "<br><br>" . $tab . $penutup;
// echo $konten;
$pdf->writeHTML($konten);
$x =  $pdf->Output('report100.pdf', 'S');
echo $x;
