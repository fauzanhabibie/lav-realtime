<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>

  <body>
    <h1>Data Karyawan</h1>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered" id="produk-table">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Karyawan</th>
                            <th>Alamat</th>
                            <th>company</th>
                            <th>Departemen</th>
                            <th>Jabatan</th>
                            <th>aksi</th>
                           
                        </tr>
                    </thead>
                    <tbody id="content">
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee['nik'] }}</td>
                            <td>{{ $employee['nama'] }}</td>
                            <td>{{ $employee['alamat'] }}</td>
                            <td>
                                @foreach ($dataCompany as $company)
                                    @if ($company['id'] == $employee['company_id'])
                                        {{ $company['nama_company'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($dataDepartemen as $departemen)
                                    @if ($departemen['id'] == $employee['departemen_id'])
                                        {{ $departemen['nama_departemen'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($dataJabatan as $jabatan)
                                    @if ($jabatan['id'] == $employee['jabatan_id'])
                                        {{ $jabatan['nama_jabatan'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ url('/api/karyawan/' . $employee['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
          // Fungsi untuk menambahkan karyawan baru ke dalam tabel
          function addEmployee(data) {
            
          }
  
          // Ketika form create disubmit
          $("#create-form").submit(function(event) {
              event.preventDefault();
  
              // Ambil data dari form
              var nik = $("#nik").val();
              var nama = $("#nama").val();
              var alamat = $("#alamat").val();
  
              // Kirim data ke server menggunakan Ajax
              $.ajax({
                  url: "/store-employee", // Ganti dengan URL endpoint yang sesuai
                  type: "POST",
                  data: {
                      nik: nik,
                      nama: nama,
                      alamat: alamat
                  },
                  success: function(response) {
                      // Jika sukses, tambahkan karyawan ke tabel
                      addEmployee(response.data);
  
                     
                  },
                  error: function(xhr, status, error) {
                      // Tangani kesalahan jika terjadi
                      console.error(xhr.responseText);
                  }
                
                  $("#content").append(
                      `<tr>
                          <td>${data.nik}</td>
                          <td>${data.nama}</td>
                          <td>${data.alamat}</td>
                      </tr>`
                  );
              });
          });
      });
  </script>
  
  

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>