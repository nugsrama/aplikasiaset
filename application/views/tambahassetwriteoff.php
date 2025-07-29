<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
    }
</style>
<div class="position-absolute ">
    <h1>Form Tambah Writeoff</h1>
    <div class="container">
        <div row>
            <form action="<?php echo base_url() . 'writeoff/tambahdatawriteoff'; ?>" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Writeoff</label>
                    <input type="text" name="kode_writeoff" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp"> </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Writeoff</label>
                    <input type="date" name="tgl_writeoff" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Total Qty</label>
                        <input type="text" name="total_qty" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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