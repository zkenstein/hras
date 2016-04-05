<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3>
            Daftar Surat Tanda Lulus
            <a href="<?php echo site_url('admin/set/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>

        <!-- Indicates a successful or positive action -->

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="controls" align="center">NO. SURAT</th>
                        <th class="controls" align="center">NIK</th>
                        <th class="controls" align="center">NAMA KARYAWAN</th>
                        <th class="controls" align="center">PERIODE STUDI</th>
                        <th class="controls" align="center">BATCH</th>                        
                        <th class="controls" align="center">AKSI</th>
                    </tr>
                </thead>
                <?php
                if (!empty($set)) {
                    foreach ($set as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td ><?php echo $row['set_number']; ?></td>
                                <td ><?php echo $row['set_employe_nik']; ?></td>
                                <td ><?php echo $row['set_employe_name']; ?></td>
                                <td ><?php echo pretty_date($row['set_date'], 'd F Y', false); ?></td>
                                <td ><?php echo $row['set_batch']; ?></td>                                                          
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning btn-xs" href="<?php echo site_url('admin/set/detail/' . $row['set_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-xs" href="<?php echo site_url('admin/set/edit/' . $row['set_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                    <a data-toggle="tooltip" data-placement="top" title="Print Surat" class="btn btn-danger btn-xs" href="<?php echo site_url('admin/set/printPdf/' . $row['set_id']) ?>"target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    ?>
                    <tbody>
                        <tr id="row">
                            <td colspan="6" align="center">Data Kosong</td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>   
            </table>
        </div>
        <div >
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>