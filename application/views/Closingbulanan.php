<style type="text/css">
    .position-absolute {
        padding-left: 260;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;

    }

    .position-absolute .h1 {
        position: center;
    }
</style>

<div class="position-absolute ">

    <h1 style="position: center;">Closing Bulanan</h1>
    <div class="alert">
        <?php echo $this->session->flashdata('pesan1'); ?>
        <?php echo $this->session->flashdata('pesan2'); ?>
        <?php echo $this->session->flashdata('pesan3'); ?>
        <?php echo $this->session->flashdata('pesan4'); ?>
        <?php echo $this->session->flashdata('closing'); ?>
        <?php echo $this->session->flashdata('pesan5'); ?>
        <?php echo $this->session->flashdata('pesan6'); ?>
    </div>
    <!-- <div class="alert">
    </div> -->


    <?php

    use PhpParser\Node\Stmt\Echo_;

    $asset = $this->db->query('SELECT bulan_closing , tahun_closing  FROM `as_closingbulananho`')->result();
    ?>

    <form method="post" action="<?php echo base_url("closingbulanan/tambahclosing"); ?> ">
        <div class="row mt-3 ">
            <div class="col-lg-3">
                <div class="card-data booking">
                    <div class="row">
                        <?php
                        $closing = $this->db->query("SELECT bulan_closing , tahun_closing , status_closing FROM as_closingbulananho ")->result();

                        $keluar = $this->db->query("SELECT status_keluar from as_assetkeluarheader ")->result();
                        $masuk = $this->db->query("SELECT status_masuk from as_assetmasukheader ")->result();



                        ?>

                        <label for="bulan_closing" class="form-label">Bulan Closing</label>
                        <select class="form-select" id="sel1" name="bulan_closing" placeholder="Bulan Closing">>
                            <div id="emailHelp"> </div>
                            <?php

                            foreach ($closing as $as)

                            //     $m = $as->bulan_closing;
                            // $months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'); 

                            { ?>


                                <option value="<?php echo  $as->bulan_closing; ?>"><?php echo  $as->bulan_closing; ?></option>

                            <?php } ?>
                        </select>

                    </div>
                </div>
            </div>

            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;

            <div class="col-lg-3 ">
                <div class="card-data booking">
                    <div class="row">
                        <?php foreach ($asset as $as) ?>

                        <label for="exampleInputEmail1" class="form-label">Tahun Closing</label>
                        <input type="text" name="tahun_closing" value="<?php echo $as->tahun_closing ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                        <div id="emailHelp"> </div>
                    </div>
                </div>
            </div>

            <?php

            ?>

            <div class="mt-3">
                <button class="btn btn-success" type="submit">Closing</button>

            </div>




        </div>
    </form>


</div>







</div>