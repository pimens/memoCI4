<table id="example3" class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>--</th>
            <th>Nomor</th>
            <th>Kepada</th>
            <th>Direktur</th>
            <th>Tanggal</th>
            <th>Perihal</th>
            <th>Deskripsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($brg as $c) {
            echo "<tr>";
            if ($c->status == 0) {
                echo "<td><p><span class='label label-success'>Pending</span></p></td>";
            } else if ($c->status == 1) {
                echo "<td><p><span class='label label-warning'>Approve X</span></p>$c->komentar</td>";
            } else if ($c->status == 2) {
                echo "<td><p><span class='label label-primary'>Approve XX</span></p>$c->komentar</td>";
            } else if ($c->status == 3) {
                echo "<td><p><span class='label label-danger'>Rejected X</span></p>$c->komentar</td>";
            } else {
                echo "<td><p><span class='label label-danger'>Rejected XX</span></p>$c->komentar</td>";
            }
            echo "<td>$c->nomor</td>										
                <td>$c->kepada</td>	
                <td>$c->direktur</td>			                                            		
                <td>$c->tanggal</td>		
                <td>$c->hal</td>		
                <td>$c->deskripsi</td>		
                <td>";
            echo "<a class='btn btn-info btn-sm' href='ad/barang/$c->id'>+</a>";
            echo "<a class='btn btn-info btn-sm' href='ad/pdf/$c->id'>PDF</a>";

            if ($c->status == 0) {
                echo "<a class='btn btn-primary btn-sm' href='ad/editPermohonan/$c->id'>Edit</a>";
                echo "<button class='btn btn-danger btn-sm' onclick='hapus($c->id)'>Hapus</button>";
            }
            echo "</td</tr>";
        }
        ?>
    </tbody>
</table>