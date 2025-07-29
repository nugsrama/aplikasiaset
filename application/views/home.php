<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

</head>

<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }
</style>


<div class="position-absolute ">

    <center>
        <h1>Master Asset</h1>
    </center>
    <div class="my-3 d-flex justify-content-end">

        <a href="<?php echo base_url() . 'home/tambahasset'; ?>" class="btn btn-primary">+ Tambah </a>

    </div>

    <table class="table table-bordered table-striped tabel-hover">
        <thead style=" background-color: aqua;">
            <tr class="table-success">

                <th width="12%"> No</th>
                <th width="12%"> Kode Asset </th>
                <th width="12%"> Nama Asset </th>
                <th width="12%"> Tanggal Peroleh</th>
                <th width="12%"> Harga Peroleh</th>
                <th width="12%"> Status</th>
                <th width="12%"> Keterangan </th>
                <th width="12%"> Barcode</th>
                <th width="12%"> Qr Code</th>
                <th width="12%"> Foto Asset</th>
                <th width="12%"> User Input</th>
                <th width="15%"> Tanggal Input</th>
                <th width="15%"> action</th>


            </tr>
        </thead>




        <body>
            <?php $no = 1;

            foreach ($data as $row) {
                $kode = $row->kode_asset;
                $nama = $row->nama_asset;
                $path = 'image/';
                $file = $path .  $kode . ".png";
                $text = $kode . '-' . $nama;
                QRcode::png($text, $file);


                $kode = $row->kode_asset;

                // $this->load->library('Zend');
                // $this->zend->load('Zend/Barcode');
                // $kode = $row->kode_asset;
                // $nama = $row->nama_asset;
                // $path = 'image/';
                // $file = $path .  $kode . ".png";
                // $text = $kode . '-' . $nama;
                // Zend_Barcode::render('code128', 'image', array('text' => 'greg'), array());







            ?>
                <tr>

                    <td><?php echo $no++; ?></td>
                    <td width="15%"><?php echo $row->kode_asset; ?></td>
                    <td width="15%"><?php echo $row->nama_asset; ?></td>
                    <td width="15%"> <?php echo $row->tgl_peroleh; ?></td>
                    <td width="15%"> <?php echo ('Rp.') . number_format($row->hrg_peroleh, 0,  ',', '.')  ?></td>
                    <td width="15%"><?php echo $row->status_asset; ?></td>
                    <td width="15%"><?php echo $row->keterangan; ?></td>
                    <td width="15%"><img src="<?php echo site_url() . "home/barcode" ?>" alt="Barcode"></td>
                    <td><img style="width: 200px;" src="image/<?= $row->kode_asset . '.png' ?> ">
                        <br></br>
                        <p><?php echo $row->qr_code ?></p>
                    </td>
                    <td><img style="width: 200px;" src="<?php echo $row->foto_asset; ?>"></td>
                    <td width="15%"><?php echo $row->user_input; ?></td>
                    <td width="15%"><?php echo $row->tgl_input; ?></td>


                    <td> <a href="<?php echo base_url('/home/halaman_edit') ?>/<?php echo $row->id ?>" class=" btn btn-warning"></button>Edit</a>
                        <br></br>
                        <?php if ($this->session->userdata('access') != 'User') { ?>
                            <a href="<?php echo base_url() . "home/delete/" . $row->id; ?> " class=" btn btn-danger" onclick="return confirm('Apakah anda yakin ?');"></button>Hapus</a>
                        <?php } ?>

                    </td>



                </tr>
        </body>

    <?php } ?>

    </table>









</div>
</div>

</html>