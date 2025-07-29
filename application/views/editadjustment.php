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
            <h1> Form Edit Asset Adjustment</h1>
            <form action="<?php echo base_url('Adjustment/fungsiAdjustment') ?>" method="post">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Id Asset</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $adjustmentDetail->id ?>" id=" exampleInputEmail1" aria-describedby="emailHelp" readonly>
                    </input>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Adjustment</label>
                    <input type="text" name="kode_adjustment" class="form-control" value="<?php echo $adjustmentDetail->kode_adjustment ?>" id=" exampleInputEmail1" aria-describedby="emailHelp" readonly>
                    </input>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Adjustment</label>
                    <input type="date" name="keterangan" class="form-control" value="<?php echo $adjustmentDetail->tgl_adjustment ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tottal Quantity</label>
                    <input type="text" name="total_qty" class="form-control" value="<?php echo $adjustmentDetail->total_qty ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="<?php echo $adjustmentDetail->keterangan ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>


            </form>
        </div>
    </div>


</div>