<br>
<table id="tabelMemo" class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Unit</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $total = 0;
        foreach ($barang as $c) {
            $i++;
            $j = 0;
            $j = $c->unit * $c->harga;
            $total = $total + $j;
            echo "<tr>
            <td>$i</td>										
            <td>$c->nama_barang</td>										
            <td>$c->unit/$c->satuan</td>			
            <td>$c->harga</td>		
            <td>$j</td>		
            <td>$c->keterangan</td>		
            <td>";
            if ($permohonan->status == 0) {
                echo "<button class='btn btn-primary btn-sm' onclick='detail($c->id)'> <i class='fa fa-pencil'></i></button>";
                echo "<button class='btn btn-danger btn-sm' onclick='hapus($c->id)'><span class='fa fa-trash'></span></button>";
            } else {
                echo "-";
            }

            echo "</td> </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Unit</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
Total : <?= $total; ?>