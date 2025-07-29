<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }

    .alert {
        color: green;
        size: 10px;
        font-size: 15px;
    }
</style>


<div class="position-absolute ">
    <center>
        <h1>Asset Masuk</h1>
    </center>
    <div class="my-3 d-flex justify-content-end">
        <!-- <div class="alert-regis">
            <?php echo $this->session->flashdata('pesan'); ?>
        </div> -->


        <?php if ($this->session->userdata('access') != 'Admin') { ?>

            <a href="<?php echo base_url() . 'assetmasuk/tambahassetmasuk'; ?>" class="btn btn-primary">+ Tambah</a>
        <?php } ?>
    </div>
    <table class="table table-bordered table-striped tabel-hover">
        <thead>
            <tr class="table-success">
                <th width="12%"> No </th>
                <th width="12%"> Kode Masuk </th>
                <th width="12%"> Tanggal Masuk</th>
                <th width="12%"> Dept Pengirim</th>
                <th width="12%"> Dept Penerima</th>
                <th width="12%"> No Po </th>
                <th width="12%"> Total Qty</th>
                <th width="12%"> Total Harga</th>
                <th width="12%"> Keterangan</th>
                <th width="12%"> Status</th>
                <!-- <th width="12%"> User Realisasi</th>
                <th width="12%"> Tanggal Realisasi</th>
                <th width="12%"> User Input</th>
                <th width="12%"> Tanggal Input</th> -->

                <th width="12%"> Action </th>



            </tr>
        </thead>


        <body>
            <?php $no = 1;


            foreach ($data as $row) {




            ?>
                <tr>

                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->kode_masuk; ?></td>
                    <td><?php echo $row->tgl_masuk; ?></td>
                    <td><?php echo $row->dept_pengirim; ?></td>
                    <td><?php echo $row->dept_penerima; ?></td>
                    <td><?php echo $row->no_po; ?></td>
                    <td><?php echo $row->total_qty; ?></td>
                    <td><?php echo ('Rp.') . number_format($row->total_harga, 0,  ',', '.')   ?></td>
                    <td><?php echo $row->keterangan ?></td>
                    <td><?php echo $row->status_masuk ?></td>
                    <!-- <td><?php echo $row->user_realisasi ?></td>
                    <td><?php echo $row->tgl_realisasi ?></td>
                    <td><?php echo $row->user_input ?></td> -->
                    <!-- <td><?php echo $row->tgl_input ?></td> -->

                    </td>

                    <td>
                        <a href="<?php echo base_url('assetmasuk/detailassetmasuk/' . $row->kode_masuk) ?> " class="btn btn-info"></button>detail</a>
                        <?php if ($this->session->userdata('access') != 'Admin') { ?>
                            <a href="<?php echo base_url('/assetmasuk/editMasuk') ?>/<?php echo $row->id ?> " class=" btn btn-warning"></button>edit</a>
                        <?php } ?>
                        <?php
                        $role = $this->session->userdata('access');
                        $status = $row->status_masuk;
                        if ($status == 'Process') { ?>



                            <?php if ($this->session->userdata('access') != 'User') { ?>
                                <?php if ($this->session->userdata('access') != 'Admin') { ?>
                                    <a href="<?php echo base_url() . "assetmasuk/deletemasuk/" . $row->kode_masuk; ?> " class=" btn btn-danger" onclick="return confirm('Apakah anda yakin ?');"></button>Hapus</a>


                                <?php  } ?>
                            <?php  } ?>

                            <?php if ($this->session->userdata('access') != 'User') { ?>

                                <a href="<?php echo base_url() . "assetmasuk/realisasimasuk/" . $row->kode_masuk; ?> " class=" btn btn-danger"></button>Realisasi</a>

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