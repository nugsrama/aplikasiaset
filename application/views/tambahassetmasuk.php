<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
    }
</style>
<div class="position-absolute ">
    <h1>Form Tambah Asset Masuk</h1>
    <div class="container">
        <div row>

            <form action="<?php echo base_url() . 'assetmasuk/tambahdatamasuk'; ?>" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tgl_masuk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp"> </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departemen Pengirim</label>
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

                    <!-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Total Quantity</label>
                        <input type="text" name="total_qty" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>

                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Total Harga</label>
                        <input type="text" name="total_harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">


                    </div> -->



                    <!-- <div class="mb-3">

                        <label for="status" class="form-label">Pilih Status:</label>
                        <select class="form-select" id="sel1" name="status_masuk">
                            <option>Process</option>
                            <option>Realisasi</option>
                            <option>Batal</option>

                        </select>
                    </div> -->
                    <!-- 
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Realisasi</label>
                        <input type="text" name="user_realisasi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Realisasi</label>
                        <input type="date" name="tgl_realisasi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Input</label>
                        <input type="text" name="user_input" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Input</label>
                        <input type="date" name="tgl_input" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div> -->








                    <div class="mt-3">
                        <button class="btn btn-success" type="submit">Tambah</button>
                    </div>

            </form>

        </div>

    </div>

</div>
</body>



</div>