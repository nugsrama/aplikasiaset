<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }
</style>

<?php
$page = "assetkeluar";

?>
<div class="position-absolute ">
    <center>
        <h1>Detail Asset Adjustment</h1>
    </center>
    <div class="my-3 d-flex justify-content-end">
        <?php if ($this->session->userdata('access') != 'Admin') { ?>

            <?php
            $kode = $this->uri->segment(3) ?>
            <a href="<?php echo base_url('adjustment/tambahdetailassetadjustment/' . $kode) ?>" class="btn btn-primary">+ Tambah </a>
            <?php ?>
        <?php } ?>
    </div>
    <table class="table table-bordered table-striped tabel-hover">
        <thead>
            <tr class="table-success">
                <th width="12%"> No </th>
                <th width="12%"> Kode Adjustment</th>
                <th width="12%"> Kode Asset</th>
                <th width="12%"> Nama Asset</th>
                <th width="12%"> Quantity</th>
                <th width="12%"> Harga Satuan </th>
                <th width="12%"> Harga Total</th>
                <th width="12%"> User Input</th>
                <th width="12%"> Tanggal Input</th>
                <th width="12%"> Action</th>


            </tr>
        </thead>


        <body>
            <?php
            $no = 1;

            foreach ($data as $row) {

            ?>

                <tr>
                    <td><?php echo $no++; ?></td>


                    <td><?php echo $row->kode_adjustment; ?></td>
                    <td><?php echo $row->kode_asset; ?></td>
                    <td><?php echo $row->nama_asset; ?></td>
                    <td><?php echo $row->qty; ?></td>
                    <td><?php echo $row->harga_satuan; ?></td>
                    <td><?php echo 'Rp' . number_format($row->harga_total, 0,  ',', '.')  ?></td>
                    <td><?php echo $row->user_input; ?></td>
                    <td><?php echo $row->tgl_input; ?></td>
                    <?php if ($this->session->userdata('access') != 'Admin') { ?>
                        <td> <a href="<?php echo base_url('/adjustment/editAdjustmentDetail') ?>/<?php echo $row->kode_adjustment ?> " class=" btn btn-warning"></button>edit</a>
                            <br></br>


                            <a href="<?php echo base_url() . "adjustment/deletedetailassetadjustment/" . $row->kode_adjustment; ?> " class=" btn btn-danger" onclick="return confirm('Apakah anda yakin ?');"></button>Hapus</a>
                        <?php } ?>
                        </td>


                </tr>
        </body>
    <?php } ?>

    </table>


</div>
</div>

</html>