<br>
<table id="tabelMemo" class="table table-borderless table-striped table-earning">

    <thead>
        <tr>
            <th>No.</th>
            <th>Desa</th>
            <th>Setoran</th>
            <th>Fee</th>
            <th>Nomor Rekening</th>
            <th>Bendahara</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $total = 0;
        foreach ($memo as $c) {
            $i++;
            $total = $total + $c->setoran;
            echo "<tr>
            <td>$i</td>										
            <td>$c->desa</td>										
            <td>$c->setoran</td>			
            <td>$c->fee</td>		
            <td>$c->norekening</td>		
            <td>$c->bendahara</td>		
            <td>";
            if ($permohonan->status == 0) {
                echo "<button class='btn btn-primary btn-sm' onclick='detail($c->id)'> <i class='fa fa-pencil'></i></button>";
                echo "<button class='btn btn-danger btn-sm' onclick='hapus($c->id)'><span class='fa fa-trash'></span></button>";
            } else {
                echo "-";
            }

            echo "</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>No.</th>
            <th>Desa</th>
            <th>Setoran</th>
            <th>Fee</th>
            <th>Nomor Rekening</th>
            <th>Bendahara</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>