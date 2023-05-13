<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Laporan Produk</title>
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
        <h2>LAPORAN PRODUK</h2>
      </div>
      <div class="card-body .table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Total Transaksi</th>
              <th scope="col">Waktu Transaksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($data as $item) : ?>
              <?php $db = \Config\Database::connect();
              $getProduk = $db->table('produk')->where('id_produk', $item['id_produk'])->get(1)->getRow();
              // dd($item['id_produk']);
              ?>
              <tr>
                <th><?= $i++; ?></th>
                <td><?= $getProduk->nama_produk; ?></td>
                <td><?= $item['total_transaksi']; ?></td>
                <td><?= $item['transaksi_datetime']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <script>
    window.onload = function() {
      window.print();
    }
  </script>
</body>

</html>