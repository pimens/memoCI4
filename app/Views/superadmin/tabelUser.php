<table id="tabelMemo" class="table table-striped table-bordered tabel-earning">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $u = base_url();
        foreach ($user as $c) {
            echo "<tr></tr><td>$c->nama</td>										
            <td>$c->jabatan</td>	
            <td>";
            echo "<button class='btn btn-danger btn-sm' onclick='hapus($c->id)'> 
            <i class='fa fa-trash'></i></button></td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>