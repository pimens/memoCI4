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
           </tr>";
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
        </tr>
    </tfoot>
</table>
Total : <?= $total; ?>