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
            <h1>Form Edit Master Asset</h1>
            <form action="<?php echo base_url('home/fungsiEdit') ?>" method="post">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Id Asset</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $masterDetail->id ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Asset</label>
                    <input type="text" name="nama_asset" class="form-control" value="<?php echo $masterDetail->nama_asset ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="<?php echo $masterDetail->keterangan ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Harga Peroleh</label>
                    <input type="text" name="hrg_peroleh" class="form-control" value="<?php echo $masterDetail->hrg_peroleh ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Status Asset</label>
                    <input type="text" name="status_asset" class="form-control" value="<?php echo $masterDetail->status_asset ?>" id=" exampleInputEmail1" aria-describedby="emailHelp">
                    </input>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>

            </form>

        </div>
    </div>

</div>