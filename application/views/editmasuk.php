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
        <div row>
            <h1> Form Edit Asset Masuk</h1>
            <form action="<?php echo base_url('assetmasuk/fungsiMasuk') ?>" method="post">


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Id Asset</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $masukDetail->id ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departemen Pengirim</label>
                    <input type="text" id="emailHelp" name="dept_pengirim" value="<?php echo $masukDetail->dept_pengirim ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departemen Penerima</label>
                    <input type="text" id="emailHelp" name="dept_penerima" value="<?php echo $masukDetail->dept_penerima ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Masuk</label>
                    <input type="text" id="emailHelp" name="kode_masuk" value="<?php echo $masukDetail->kode_masuk ?>" class="form-control" aria-describedby="emailHelp" readonly>
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Qty</label>
                    <input type="text" id="emailHelp" name="total_qty" value="<?php echo $masukDetail->total_qty ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">No Po</label>
                    <input type="text" id="emailHelp" name="no_po" value="<?php echo $masukDetail->no_po ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" value="<?php echo $masukDetail->keterangan ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>

            </form>
        </div>
    </div>
</div>