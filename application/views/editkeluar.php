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
            <h1>Form Edit Asset Keluar</h1>
            <form action="<?php echo base_url('assetkeluar/fungsiKeluar') ?>" method="post">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Id Asset</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $keluarDetail->id ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departemen Pengirim</label>
                    <input type="text" name="dept_pengirim" class="form-control" value="<?php echo $keluarDetail->dept_pengirim ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departemen Penerima</label>
                    <input type="text" name="dept_penerima" class="form-control" value="<?php echo $keluarDetail->dept_penerima ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="<?php echo $keluarDetail->keterangan ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Keluar</label>
                    <input type="text" name="kode_keluar" class="form-control" value="<?php echo $keluarDetail->kode_keluar ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Quantity</label>
                    <input type="text" name="total_qty" class="form-control" value="<?php echo $keluarDetail->total_qty ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>





            </form>

        </div>
    </div>


</div>