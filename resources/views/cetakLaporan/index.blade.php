@extends('layouts.template')
<!-- START DATA -->
@section('konten')

<div class="my-3 p-3 bg-body rounded shadow-sm">
     
      <!-- FORM PENCARIAN -->
      @csrf
      <div class="pb-4">
          <div class="container-xl d-flex justify-content-center m-2 pb-2 fs-4"><h1>Cetak Laporan Presensi</h1></div>
        <form class="d-flex" action="{{ url('laporan') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" 
            placeholder="Cari Nama / NIM" aria-label="Search">
            <button class="btn btn-secondary btn-md" type="submit">Search</button>
        </form>
      </div>

      <!-- TOMBOL TAMBAH DATA -->
      <script>
        $('.datepicker').datepicker({
        inline: true
        });
      </script>

      <div class="pb-3 d-inline d-flex justify-content-end">
        {{-- <a href='{{ url('presensi_asisten/create') }}' class="btn btn-success">+ Tambah Data</a> --}}
        {{-- <input id="datepicker" width="276"/> --}}
      </div>

            <div class="col-md-12 d-flex justify-content-end d-inline">
                
                <form method="GET" action="{{ url('/laporan') }}">

                    <div class="form-group d-flex justify-content-end-flex justify-content-end">
                        {{-- <label for="tanggal_presensi">Pilih Tanggal:</label> --}}
                        {{-- <input type="date" class="form-control" name="tanggal_presensi" id="tanggal_presensi" required> --}}
                        <input class="form-control d-inline" name="tanggal_presensi" id="datepicker" width="276"/>
                        <script>
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap4'
                            });
                        </script>

                        <button type="submit" class="btn btn-primary d-inline ml-2">Pilih Tanggal</button>

                    </div>

                </form>

            </div>

      {{-- <div class="pb-3 d-flex justify-content-end d-inline">
        ppp
      </div> --}}

      <table id="" class="table table-striped">
          <thead>
              <tr>
                  <th class="col-md-1">No</th>
                  <th class="col-md-2">NIM</th>
                  <th class="col-md-2">Nama</th>
                  <th class="col-md-2">Jam Masuk</th>
                  <th class="col-md-2">Jam Keluar</th>
                  <th class="col-md-1">Status</th>
                  <th class="col-md-2">Action</th>
              </tr>
          </thead>
          <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_keluar }}</td>
                <td>{{ $item->status }}</td>
                <td>

                    <a href="{{ route('presensi_asisten.edit', ['idPresensi' => $item->tanggal_presensi, 'idNIM' => $item->nim]) }}" class="btn btn-warning btn-sm d-inline">Edit</a>

                      <!-- Button trigger modal -->
                    @if (Auth::check())
                    <button type="submit" class="btn btn-danger btn-sm d-inline" name="submit" data-toggle="modal" 
                    data-target="#deleteModal{{ $item->tanggal_presensi }}{{ $item->nim }}">Delete</button>
                    @endif
                  </td>
              </tr>
              <?php $i++ ?>
              @endforeach
               
            <!-- Modal Delete -->
            @foreach ($data as $item)
                   <div class="modal fade" id="deleteModal{{ $item->tanggal_presensi }}{{ $item->nim }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data?</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body"> 
                            <p>Apakah Anda Yakin Untuk Menghapus Entry Data Ini?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary animate__bounceOutDown" data-bs-dismiss="modal">Close</button>
                            {{-- <form class="d-inline" action="{{ route('presensi.destroy', ['presensi' => $item->id]) }}" method="POST"> --}}
                            <form class="d-inline" action="{{ route('presensi_asisten.destroy', [$item->tanggal_presensi, $item->nim]) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">{{ $item->nim }}</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
              @endforeach
          </tbody>
      </table>
             
      {{ $data->withQueryString()->links() }}
     
</div>
<!-- AKHIR DATA -->
@endsection




