<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3>
            Daftar BPJS Kesehatan
            <a href="<?php echo site_url('admin/bpjs/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>

        <form action="<?php echo site_url('admin/bpjs/multiple'); ?>" method="post">
            <select name="action">
                <option value="null">Pilih Action</option>
                <option value="delete">Delete</option>
                <option value="printPdf">Print</option>
            </select>
            <input type="submit" name="submit" value="Action">          
            <!-- Indicates a successful or positive action -->


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th>
                            <th class="controls" align="center">NIK</th>
                            <th class="controls" align="center">NOKA</th>
                            <th class="controls" align="center">NAMA</th>
                            <th class="controls" align="center">HUB KELUARGA</th>
                            <th class="controls" align="center">FASKES</th>                        
                            <th class="controls" align="center">AKSI</th>
                        </tr>
                    </thead>
                    <?php
                    if (!empty($bpjs)) {
                        foreach ($bpjs as $row) {
                            ?>
                            <tbody>
                               <tr>
                               <td><input type="checkbox" class="checkbox" name="msg[]" value="<?php echo $row['bpjs_id']; ?>"></td>                           
                                    <td ><?php echo $row['bpjs_npp']; ?></td>
                                    <td ><?php echo $row['bpjs_noka']; ?></td>
                                    <td ><?php echo $row['bpjs_name']; ?></td>
                                    <td ><?php echo $row['bpjs_hub']; ?></td>
                                    <td ><?php echo $row['bpjs_faskes']; ?></td>                                
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning btn-xs" href="<?php echo site_url('admin/bpjs/detail/' . $row['bpjs_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-xs" href="<?php echo site_url('admin/bpjs/edit/' . $row['bpjs_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Print Surat" class="btn btn-danger btn-xs" href="<?php echo site_url('admin/bpjs/printPdf/' . $row['bpjs_id']) ?>"target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                        }
                    } else {
                        ?>
                        <tbody>
                        </form>
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

<script>
    $(document).ready(function() {
        $("#selectall").change(function() {
            $(".checkbox").prop('checked', $(this).prop("checked"));
        });
    });
</script>