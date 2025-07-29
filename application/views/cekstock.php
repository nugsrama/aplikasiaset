<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }
</style>

<?php
$page = "cekstock";

?>
<div class="position-absolute ">
    <center>
        <h1>Cek Stock</h1>
    </center>
    <br></br>

    <table class="table table-bordered table-striped tabel-hover">
        <thead style=" background-color: aqua;">
            <tr class="table-success">



                <th width="12%"> Tanggal Stock </th>
                <th width="12%"> Kode Departemen </th>
                <th width="12%"> Kode Asset </th>
                <th width="12%"> Nama Asset </th>
                <th width="12%"> No urut</th>
                <th width="12%"> Jenis Asset</th>
                <th width="12%"> Kode Transaksi</th>
                <th width="12%"> Jenis Transaksi</th>
                <th width="12%"> Masuk </th>
                <th width="12%"> Keluar</th>
                <th width="12%"> Sisa</th>
                <th width="12%"> Satuan</th>
                <th width="12%"> Harga Satuan</th>
                <th width="15%"> Harga Total</th>
                <th width="15%"> Keterangan</th>
                <th width="15%"> Waktu Input</th>
                <th width="15%"> User Input</th>


            </tr>
        </thead>


        <body>

            <?php


            foreach ($data as $row) {



            ?>



                <tr>


                    <td width="15%"><?php echo $row->tgl_stock ?></td>
                    <td width="15%"><?php echo $row->kode_dept ?></td>
                    <td width="15%"><?php echo $row->kode_asset ?></td>
                    <td width="15%"><?php echo $row->nama_asset ?></td>
                    <td width="15%"> <?php echo $row->no_urut ?></td>
                    <td width="15%"><?php echo $row->jenis_asset ?></td>
                    <td width="15%"><?php echo $row->kode_transaksi ?></td>
                    <td width="15%"><?php echo $row->jenis_transaksi ?></td>
                    <td width="15%"><?php echo $row->masuk ?></td>
                    <td width="15%"><?php echo $row->keluar ?></td>
                    <td width="15%"><?php echo $row->sisa ?></td>
                    <td width="15%"><?php echo $row->satuan ?></td>
                    <td width="15%"><?php echo ('Rp.') . number_format($row->harga_satuan, 0,  ',', '.')  ?></td>
                    <td width="15%"><?php echo ('Rp.') . number_format($row->harga_total, 0,  ',', '.') ?></td>
                    <td width="15%"><?php echo $row->keterangan ?></td>
                    <td width="15%"><?php echo $row->waktu_input ?></td>
                    <td width="15%"><?php echo $row->user_input ?></td>



                </tr>
        </body>


    <?php } ?>
    </table>









</div>
</div>

</html>