<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
    }
</style>
<div class="position-absolute ">
    <h1>Form Tambah Asset Keluar</h1>
    <div class="container">
        <div row>
            <form action="<?= base_url('assetkeluar/tambahdatakeluar') ?>" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Keluar</label>
                    <input type="date" name="tgl_keluar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp"> </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Dpertemen Pengirim</label>
                    <input type="tetx" name="dept_pengirim" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Departemen Penerima</label>
                        <input type="text" name="dept_penerima" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No Po</label>
                        <input type="text" name="no_po" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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