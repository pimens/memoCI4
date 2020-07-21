<table id="tabelMemo" class="table table-striped table-bordered table-earning">
    <thead>
        <tr>
            <th>Jenis</th>
            <th>--</th>
            <th>Nomor</th>
            <th>Dari</th>
            <th>Approval 1</th>
            <th>Direktur</th>
            <th>Tanggal</th>
            <th>Perihal</th>
            <th>Deskripsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($permohonan as $c) {
            echo "<tr>";
            if ($c->jenis == 0) {
                echo "<td>Memo</td>";
            } else {
                echo "<td>Barang</td>";
            }
            if ($c->status == 0) {
                echo "<td><p> <span class='badge badge-info'>Pending</span></p></td>";
            } else if ($c->status == 1) {
                echo "<td><p> <span class='badge badge-warning'>Approve X</span></p>$c->komentar</td>";
            } else if ($c->status == 2) {
                echo "<td><p> <span class='badge badge-primary'>Approve XX</span></p>$c->komentar</td>";
            } else if ($c->status == 3) {
                echo "<td><p> <span class='badge badge-danger'>Rejected X</span></p>$c->komentar</td>";
            } else {
                echo "<td><p> <span class='badge badge-danger'>Rejected XX</span></p>$c->komentar</td>";
            }
            echo "<td>$c->nomor</td>										
            <td>$c->dari</td>		
            <td>$c->kepada</td>		
            <td>$c->direktur</td>			
            <td>$c->tanggal</td>		
            <td>$c->hal</td>		
            <td>$c->deskripsi</td><td>";
            if ($c->jenis == 0) {
                echo "<a class='btn btn-warning btn-sm' href='direksi/viewMemo/$c->id'> <i class='fa fa-clipboard'></i></a>";
            } else {
                echo "<a class='btn btn-warning btn-sm' href='direksi/viewBarang/$c->id'> <i class='fa fa-clipboard'></i></a>";
            }
            echo "</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Jenis</th>
            <th>--</th>
            <th>Nomor</th>
            <th>Dari</th>
            <th>Approval 1</th>
            <th>Direktur</th>
            <th>Tanggal</th>
            <th>Perihal</th>
            <th>Deskripsi</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>