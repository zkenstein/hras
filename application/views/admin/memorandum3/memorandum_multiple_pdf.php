<html>
<head>
    <style type="text/css">
        .upper { text-transform: uppercase; }
        .lower { text-transform: lowercase; }
        .cap   { text-transform: capitalize; }
        .small { font-variant:   small-caps; }
    </style>
    <style type="text/css">
        @page {
            margin-top: 0.1em;
            margin-bottom: 0.1em;
        } .style12 {font-size: 10px}
    </style>
</head>
<body>
    <?php foreach ($memorandum as $row): ?>
        <div style="padding:0px 0px;">
            <div align="left">              
                <p><strong><img width="200" height="90" src="<?php echo media_url() ?>/images/logo.png" alt=""></strong></p>        
            </div>
            <table width="1089" border="0">
                <tr>
                    <td width="48" scope="col"><div align="left">Nomor</div></td>
                    <td width="10" scope="col"><div align="left">:</div></td>
                    <td width="277" scope="col"><?php echo $row['memorandum_number'] ?>/SAT-IR/<?php $this->load->helper('tanggal');
                        $namaBulan = konversiBulan(pretty_date($row['memorandum_date_sent'], 'm', false));
                        echo $namaBulan; ?>/<?php echo pretty_date($row['memorandum_date_sent'], 'Y', false) ?></td>
                        <td width="277" scope="col"><span class="cap"><?php echo $setting_city['setting_value'] ?></span>, <?php echo pretty_date($row['memorandum_date_sent'], 'd F Y', false) ?></td>

                        <td width="277" scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td>Pemberitahuan</td>
                    </tr>
                </table> <br>             
                <p align="justify">Kepada Yth,</p>
                <table width="531" border="0">
                    <tr>
                        <td width="78" scope="col">Nama</td>
                        <td width="10" scope="col">:</td>
                        <td width="752" scope="col"><span class="cap"><?php echo $row['memorandum_employe_name'] ?></span></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td><?php echo $row['memorandum_employe_nik'] ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?php echo $row['memorandum_employe_position'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $row['memorandum_employe_address'] ?></span></td>
                    </tr>
                </table><br>
                <p>Dengan Hormat,</p>
                <p align="justify">Menindaklanjuti Surat Panggilan ke-I (satu) No: <?php echo $row['memorandum1_number'] ?>/SAT-IR/<?php $this->load->helper('tanggal');
                    $namaBulan = konversiBulan(pretty_date($row['memorandum1_date_sent'], 'm', false));
                    echo $namaBulan; ?>/<?php echo pretty_date($row['memorandum1_date_sent'], 'Y', false) ?> dan Surat Panggilan ke-II (dua) No: <?php echo $row['memorandum2_number'] ?>/SAT-IR/<?php $this->load->helper('tanggal');
                    $namaBulan = konversiBulan(pretty_date($row['memorandum2_date_sent'], 'm', false));
                    echo $namaBulan; ?>/<?php echo pretty_date($row['memorandum2_date_sent'], 'Y', false) ?> yang sudah kami kirimkan kepada Sdr/i dan belum mendapatkan tanggapan, maka sesuai Pasal 168 Ayat 1 (satu) Undang-undang Nomor 13 Tahun 2003
                    tentang Ketenagakerjaan, jo Pasal 43 Ayat 3 (tiga) Peraturan Perusahaan PT Sumber Alfaria Trijaya Tbk. Tahun 2013-2015 Sdr/i Akan dikualifikasikan mengundurkan diri.</p>
                    <p align="justify">Dengan demikian maka terhitung mulai <?php echo pretty_date($row['memorandum1_absent_date'], 'd F Y', false) ?> hubungan kerja dengan Sdr/i dinyatakan berakhir. Sehubungan dengan hal tersebut diatas maka dengan ini kami meminta kehadiran Sdr.i untuk hadir pada :</p>


                    <table width="669" border="0">
                        <tr>
                            <td width="88" scope="col">Hari, Tanggal </td>
                            <td width="10" scope="col">:</td>
                            <td width="557" scope="col"><?php echo pretty_date($row['memorandum_call_date'], 'l, d F Y', false) ?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td>08.00 WIB Sampai dengan 11.00 WIB </td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td>PT. Sumber Alfaria Trijaya, Tbk </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><span class="cap"><?php echo $setting_address['setting_value'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Keperluan</td>
                            <td>:</td>
                            <td>1. Menghadap Ke Personalia (<span class="cap"><?php echo $setting_pic['setting_value'] ?></span>)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>2. Memberikan keterangan dan menyerahkan bukti yang sah atas ketidakhadiran Sdr/i </td>
                        </tr>
                    </table><br>

                    <p align="justify">Demikian panggilan ini kami sampaikan, atas perhatiannya kami ucapkan terima kasih.</p>
                    <table border="0">
                        <tbody>
                            <tr>
                                <td>Hormat Kami, </td>
                                <td></td>                        
                            </tr>
                            <tr>
                                <td><strong>PT. Sumber Alfaria Trijaya, Tbk</strong></td>
                                <td></td>                        
                            </tr>
                        </tbody></table>        

                        <br>
                        <br>
                        <br>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <td><u><strong>( <span class="upper"><?php echo $setting_employe_name['setting_value'] ?></span> )</strong></u></td>
                                    <td></td>                        
                                </tr>
                                <tr>
                                    <td><em><strong><span class="cap"><?php echo $setting_employe_position['setting_value'] ?></span></strong></em></td>
                                    <td></td>                        
                                </tr>
                            </tbody></table>

                            <p>Tembusan : <br>
                                1. Atasan (Manager)<br>
                                2. People Development Manager<br>
                            </p>
                        <?php endforeach; ?>
                    </body>
                    </html>