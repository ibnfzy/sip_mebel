<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $item['nama_laporan']; ?></title>
</head>

<body>
  <embed type="application/pdf" src="<?= base_url('uploads/' . $item['nama_file']); ?>"></embed>
</body>

</html>