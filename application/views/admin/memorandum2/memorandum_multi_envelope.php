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
    margin-top: 5cm;
    margin-bottom: 5cm;
    margin-left: 7cm;
    margin-right: 3cm;
  } </style>
</head>
<body>
  <?php foreach ($memorandum as $row): ?>
  <p> Kepada Yth :</p>
  <table width="406" border="0">
    <tr>
      <td width="242"><strong><?php echo $row['memorandum_employe_name'] ?></strong></td>
      <td width="154">Surat Panggilan Ke-2 </td>
    </tr>
    <tr>
      <td colspan="2"><?php echo $row['memorandum_employe_address'] ?></td>
    </tr><br>
</table>
  <table width="406" border="0">
    <tr>
      <td width="66">TLP/HP : </td>
      <td width="330"><?php echo $row['memorandum_employe_phone'] ?></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <p>&nbsp; </p><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br>
  <?php endforeach; ?>
</body>
</html>