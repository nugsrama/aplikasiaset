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
            <h1> Form Edit Asset Writeoff</h1>
            <form action="<?php echo base_url('writeoff/fungsiWriteoff') ?>" method="POST">


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Writeoff</label>
                    <input type="text" id="emailHelp" name="kode_writeoff" value="<?php echo $writeoffDetail->kode_writeoff ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Writeoff</label>
                    <input type="text" id="emailHelp" name="tgl_writeoff" value="<?php echo $writeoffDetail->tgl_writeoff ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Quantity</label>
                    <input type="text" id="emailHelp" name="total_qty" value="<?php echo $writeoffDetail->total_qty ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" id="emailHelp" name="keterangan" value="<?php echo $writeoffDetail->keterangan ?>" class="form-control" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>

            </form>

        </div>
    </div>

</div>