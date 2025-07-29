<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }

    .left {
        display: inline-block;
        text-align: right;
        font-size: 20px;
        line-height: 14px;
        position: start;
        top: 3px;
    }

    .right {
        display: inline-block;
        text-align: left;
        padding-left: 1033px;
        overflow: hidden;
        font-size: 12px;
        line-height: 14px;
    }
</style>

<?php

$kode = $this->uri->segment(3);
$detail = $this->db->query("SELECT dept_penerima, dept_pengirim , no_po FROM as_assetmasukheader GROUP BY kode_masuk ")->result();

?>

<div class="position-absolute ">
    <center>
        <h1>Detail Asset Masuk</h1>
    </center>

    <div class="right">
        <?php if ($this->session->userdata('access') != 'Admin') { ?>
            <a href=" <?php echo base_url('assetmasuk/tambahdetailassetmasuk/' . $kode) ?> " class=" btn btn-primary">+ Tambah </a>;
        <?php } ?>
    </div>
    <?php foreach ($detail as $a) ?>

    <p><?php echo 'penerima' . ':' . $a->dept_penerima ?>
        <?php echo 'no_po' . ':' . $a->no_po ?></p>
    <?php ?>

    <?php ?>
    <table class="table table-bordered table-striped tabel-hover">
        <thead>
            <tr class="table-success">
                <th width="12%"> No </th>
                <th width="12%"> Kode Masuk</th>
                <th width="12%"> Kode Asset</th>
                <th width="12%"> Nama Asset</th>
                <th width="12%"> Quantity</th>
                <th width="12%"> Harga Satuan </th>
                <th width="12%"> Harga Total</th>

                <th width="12%"> Action</th>


            </tr>
        </thead>


        <body>

            <?php
            $no = 1;



            foreach ($data as $row) {
                $hargatotal = $row->qty * $row->harga_satuan;



            ?>

                <tr>
                    <td><?php echo $no++; ?></td>


                    <td><?php echo $row->kode_masuk; ?></td>
                    <td><?php echo $row->kode_asset; ?></td>
                    <td><?php echo $row->nama_asset; ?></td>
                    <td><?php echo $row->qty; ?></td>
                    <td><?php echo 'Rp.' . number_format($row->harga_satuan, 0,  ',', '.'); ?></td>
                    <td><?php echo "Rp. " . number_format($hargatotal, 0,  ',', '.') ?></td>

                    <?php if ($this->session->userdata('access') != 'Admin') { ?>
                        <td> <a href="<?php echo base_url('/assetmasuk/editdetailmasuk') ?>/<?php echo $row->kode_masuk ?> " class=" btn btn-warning"></button>edit</a>
                            <br></br>


                            <a href="<?php echo base_url() . "assetmasuk/deletedetailassetmasuk/" . $row->kode_masuk . '/' . $row->kode_asset; ?> " class=" btn btn-danger" onclick="return confirm('Apakah anda yakin ?');"></button>Hapus</a>
                        <?php } ?>
                        </td>








                </tr>
        </body>

    <?php } ?>
    </table>


</div>
</div>

</html>