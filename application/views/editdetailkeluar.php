<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }
</style>
<div class="position-absolute ">
    <div class="container">
        <h1>Form Edit Detail Keluar</h1>
        <?php
        $kode = $this->uri->segment(3) ?>
        <form action="<?php echo base_url('assetkeluar/editdetailassetkeluar/' . $kode) ?>" method="post">
            <?php ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kode Keluar</label>
                <input type="text" name="kode_keluar" class="form-control" value="<?php echo $DetailKeluar->kode_keluar ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                </input>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kode Asset</label>
                <input type="text" name="kode_asset" class="form-control" value="<?php echo $DetailKeluar->kode_asset ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                </input>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Asset</label>
                <input type="text" name="nama_asset" class="form-control" value="<?php echo $DetailKeluar->nama_asset ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                </input>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Quantity</label>
                <input type="text" name="qty" class="form-control" value="<?php echo $DetailKeluar->qty ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                </input>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Harga Satuan</label>
                <input type="text" name="harga_satuan" class="form-control" value="<?php echo $DetailKeluar->harga_satuan ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                </input>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Harga Total</label>
                <input type="text" name="harga_total" class="form-control" value="<?php echo $DetailKeluar->harga_total ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                </input>
            </div>

            <div class="mt-3">
                <button class="btn btn-success" type="submit">Edit</button>
            </div>

        </form>
    </div>
</div>

</div>