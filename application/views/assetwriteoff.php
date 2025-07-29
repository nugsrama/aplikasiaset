<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }
</style>

<?php
$page = "assetadjustment";

?>
<div class="position-absolute ">
    <center>
        <h1>Asset Writeoff</h1>
    </center>
    <div class="my-3 d-flex justify-content-end">
        <?php if ($this->session->userdata('access') != 'Admin') { ?>
            <a href="<?php echo base_url() . 'writeoff/tambahassetwriteoff'; ?>" class="btn btn-primary">+ Tambah </a>
        <?php } ?>
    </div>
    <table class="table table-bordered table-striped tabel-hover">
        <thead>
            <tr class="table-success">
                <th width="12%"> No </th>
                <th width="12%"> Kode Writeoff </th>
                <th width="12%"> Tanggal Writeoff</th>
                <th width="12%"> Total Qty</th>
                <th width="12%"> Total Harga</th>
                <th width="12%"> Keterangan </th>
                <th width="12%"> Status </th>
                <th width="12%"> User Realisasi</th>
                <th width="12%"> Tanggal Realisasi</th>
                <th width="12%"> User Input</th>
                <th width="12%"> Tanggal Input</th>
                <th width="12%"> Action</th>


            </tr>
        </thead>


        <body>
            <?php $no = 1;

            foreach ($data as $row) {
            ?>
                <tr>

                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->kode_writeoff; ?></td>
                    <td><?php echo $row->tgl_writeoff; ?></td>
                    <td><?php echo $row->total_qty; ?></td>
                    <td>
                        <?php echo ('Rp.') . number_format($row->total_harga, 0,  ',', '.') ?>
                    </td>
                    <td><?php echo $row->keterangan; ?></td>
                    <td><?php echo $row->status_writeoff; ?></td>
                    <td><?php echo $row->user_realisasi ?></td>
                    <td><?php echo $row->tgl_realisasi ?></td>
                    <td><?php echo $row->user_input ?></td>
                    <td><?php echo $row->tgl_input ?></td>
                    <td>

                        <a href="<?php echo base_url('writeoff/detailassetwriteoff/' . $row->kode_writeoff) ?> " class="btn btn-info"></button>detail</a>
                        <?php if ($this->session->userdata('access') != 'Admin') { ?>
                            <a href="<?php echo base_url('/writeoff/editWriteoff') ?>/<?php echo $row->id ?> " class=" btn btn-warning"></button>edit</a>
                        <?php } ?>

                        <?php
                        $role = $this->session->userdata('access');
                        $status = $row->status_writeoff;
                        if ($status == 'Process') { ?>


                            <?php if ($this->session->userdata('access') != 'User') { ?>
                                <?php if ($this->session->userdata('access') != 'Admin') { ?>
                                    <a href="<?php echo base_url() . "writeoff/deletewriteoff/" . $row->kode_writeoff; ?> " class=" btn btn-danger" onclick="return confirm('Apakah anda yakin ?');"></button>Batal</a>
                            <?php }
                            }
                            ?>
                            <?php if ($this->session->userdata('access') != 'User') { ?>
                                <a href="<?php echo base_url() . "writeoff/realisasiwriteoff/" . $row->kode_writeoff; ?> " class=" btn btn-danger"></button>Realisasi</a>
                            <?php } ?>

                        <?php } ?>

                    </td>


                </tr>
            <?php } ?>
    </table>




    </body>

</div>
</div>

</html>