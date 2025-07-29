<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
    }
</style>
<div class="position-absolute ">
    <h1>Form Tambah Detail Asset Keluar</h1>
    <div class="container">
        <div row>

            <form action="<?php echo base_url() . 'assetkeluar/tambahdetailkeluar'; ?>" method="POST">


                <?php
                $kode = $this->uri->segment(3) ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Keluar</label>
                    <input type="text" value="<?php echo $kode ?>" name="kode_keluar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp"> </div>
                </div>
                <?php ?>

                <?php

                $asset = $this->db->query("SELECT kode_asset, ( SUM(masuk)   - SUM(keluar)) AS sisastock , nama_asset FROM cekstock GROUP BY kode_asset ")->result();

                ?>
                <label for="status" class="form-label">Pilih Asset:</label>
                <select class="form-select" id="sel1" name="kode_asset">

                    <?php
                    foreach ($asset as $as) { ?>
                        <?php
                        if ($asset[0]->sisastock > 0) {  ?>

                            <option value="<?php echo $as->kode_asset ?>"><?php echo $as->kode_asset . '-' . $as->nama_asset  . '' . '(' . $as->sisastock . ')' ?></option>

                        <?php } else {
                            '';
                        } ?>


                    <?php

                    }
                    ?>

                </select>




                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">qty</label>
                    <input type="text" name="qty" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>


                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>

            </form>

        </div>

    </div>

</div>
</body>



</div>