<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
    }
</style>
<?php


get_instance()->load->helper('code_helper');
?>
<!-- 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" /> -->

<div class="position-absolute ">
    <h1>Form Tambah Master</h1>
    <div class="container">
        <div row>

            <form action="<?php echo base_url() . 'home/tambahmaster'; ?>" method="POST" enctype="multipart/form-data">


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Asset</label>
                    <input type="text" name="nama_asset" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp"> </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Peroleh</label>
                    <input type="date" name="tgl_peroleh" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Harga Proleh</label>
                    <input type="text" name="hrg_peroleh" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>



                <div class="mb-3">

                    <label for="status" class="form-label">Pilih Status:</label>
                    <select class="form-select" id="sel1" name="status_asset">
                        <option>Y</option>
                        <option>N</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">


                </div>


                <div class="mb-3">
                    <label for="image">Tambah Gambar</label>
                    <input type="file" name="foto_asset" id="foto_asset" class="form-control">

                </div>


                <div class="mt-3">
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>

                <!-- <div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h4 class="modal-title">Crop &amp; Resize Upload Image in PHP with Ajax</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8 text-center">
                                            <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px;">
                                            <br />
                                            <br />
                                            <br />
                                            <button class="btn btn-success crop_image">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> -->

            </form>

        </div>

    </div>

</div>
</body>



</div>
<script>
    // $(document).ready(function() {
    //     $image_crop = $('#image_demo').croppie({
    //         enableExif: true,
    //         viewport: {
    //             width: 200,
    //             height: 200,
    //             type: 'square' //circle
    //         },
    //         boundary: {
    //             width: 300,
    //             height: 300
    //         }
    //     });
    //     $('#').on('change', function() {
    //         var reader = new FileReader();
    //         reader.onload = function(event) {
    //             $image_crop.croppie('bind', {
    //                 url: event.target.result
    //             }).then(function() {
    //                 console.log('jQuery bind complete');
    //             });
    //         }
    //         reader.readAsDataURL(this.files[0]);
    //         $('#imageModel').modal('show');
    //     });
    //     $('.crop_image').click(function(event) {
    //         $image_crop.croppie('result', {
    //             type: 'canvas',
    //             size: 'viewport'
    //         }).then(function(response) {
    //             $.ajax({
    //                 // url:  ?>",
    //                 type: 'POST',
    //                 data: {
    //                     "image": response
    //                 },
    //                 success: function(data) {
    //                     $('#imageModel').modal('hide');
    //                     alert('Crop image has been uploaded');
    //                 }
    //             })
    //         });
    //     });
    // });
</script>