<style type="text/css">
    .position-absolute {
        padding-left: 240;
        padding-top: 60;
        padding-bottom: 50;
        position: fixed !important;
    }
</style>
<div class="position-absolute ">
    <?php
    $kode = $this->uri->segment(3) ?>
    <form action="<?php echo base_url('writeoff/editdetailwriteoff/' . $kode) ?>" method="post">
        <?php ?>
        <table style="margin:20px auto;">
            <tr>
                <td>Kode Writeoff</td>
                <td>
                    <input type="text" name="kode_writeoff" value="<?php echo $DetailWriteoff->kode_writeoff ?>">
                </td>
            </tr>

            <tr>
                <td>Kode Asset</td>
                <td>
                    <input type="text" name="kode_asset" value="<?php echo $DetailWriteoff->kode_asset ?>">
                </td>
            </tr>
            <tr>
                <td>Nama Asset</td>
                <td>
                    <input type="text" name="nama_asset" value="<?php echo $DetailWriteoff->nama_asset ?>">
                </td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td>
                    <input type="text" name="qty" value="<?php echo $DetailWriteoff->qty ?>">
                </td>
            </tr>
            <tr>
                <td>Harga Satuan</td>
                <td>
                    <input type="text" name="harga_satuan" value="<?php echo $DetailWriteoff->harga_satuan ?>">
                </td>
            </tr>
            <tr>
                <td>Harga Total</td>
                <td>
                    <input type="text" name="harga_total" value="<?php echo $DetailWriteoff->harga_total ?>">
                </td>
            </tr>


            <tr>
                <td></td>
                <td><input type="submit"> </td>
            </tr>
        </table>
    </form>

</div>