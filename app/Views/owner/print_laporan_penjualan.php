<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Laporan Penjualan</title>
  <style>
  @page {
    size: auto;
    margin: 0mm;
  }
  </style>
</head>

<body>

  <div class="container">
    <div class="card">
      <div class="card-head text-center">
        <h2>LAPORAN PENJUALAN</h2>
      </div>
      <div class="card-body .table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Customer</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Total Harga</th>
              <th scope="col">Waktu</th>
              <th scope="col">Kuantitas Produk</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($data as $item) : ?>
            <tr>
              <th><?= $i++; ?></th>
              <td><?= $item['fullname']; ?></td>
              <td><?= $item['nama_produk']; ?></td>
              <td>Rp. <?= $item['total_harga']; ?></td>
              <td><?= $item['transaksi_datetime']; ?></td>
              <td><?= $item['qty_transaksi']; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <script>
  window.onload = function() {
    window.print();
  }
  </script>
</body>

</html>