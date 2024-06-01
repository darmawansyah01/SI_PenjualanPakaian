@extends('layouts.DashboardMaster')
@section('content')

<button type="button" class="btn btn-success mb-4 no-print" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah
</button>

<br>

<a href="/barang?print=true" class="btn btn-info no-print">Print</a>

@if (isset($_GET['print']))
    <script>
      window.print();
    </script>
@endif

<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Warna</th>
        <th scope="col">Ukuran</th>
        <th scope="col">Bahan</th>
        <th scope="col">Harga</th>
        <th scope="col" class="no-print">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($barangs as $barang)
      <tr>
        <th scope="row">{{ $loop->index + 1 }}</th>
        <td>{{ $barang->nama }}</td>
        <td>{{ $barang->warna }}</td>
        <td>{{ $barang->ukuran }}</td>
        <td>{{ $barang->bahan }}</td>
        <td>{{ $barang->harga }}</td>
        <td class="no-print">
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
            onclick="setData('{{ $barang->id }}', '{{ $barang->nama }}', '{{ $barang->warna }}', '{{ $barang->ukuran }}', '{{ $barang->bahan }}', '{{ $barang->harga }}')">
            Ubah
          </button>
          <form action="/barang/{{ $barang->id }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center no-print">
    {{ $barangs->links() }}
  </div>

  <!-- Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Modal</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/barang" method="post" id="tambahForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
              <label>Warna</label>
              <select name="warna" class="form-control">
                <option>Merah</option>
                <option>Kuning</option>
                <option>Hijau</option>
                <option>Hitam</option>
                <option>Putih</option>
              </select>
            </div>
            <div class="mb-3">
                <label>Ukuran</label>
                <select name="ukuran" class="form-control">
                  <option>M</option>
                  <option>L</option>
                  <option>XL</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Bahan</label>
                <select name="bahan" class="form-control">
                  <option>Katun</option>
                  <option>Linen</option>
                  <option>Denim</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" form="tambahForm">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Barang -->
  <div class="modal fade" id="ubahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ubahModalLabel">Ubah Barang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" id="ubahForm" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
              <label>Nama Barang</label>
              <input type="text" name="nama" id="uNama" class="form-control">
          </div>
          <div class="mb-3">
            <label>Warna</label>
            <select name="warna" id="uWarna" class="form-control">
              <option>Merah</option>
              <option>Kuning</option>
              <option>Hijau</option>
              <option>Hitam</option>
              <option>Putih</option>
            </select>
          </div>
          <div class="mb-3">
              <label>Ukuran</label>
              <select name="ukuran" id="uUkuran" class="form-control">
                <option>M</option>
                <option>L</option>
                <option>XL</option>
              </select>
          </div>
          <div class="mb-3">
              <label>Bahan</label>
              <select name="bahan" id="uBahan" class="form-control">
                <option>Katun</option>
                <option>Linen</option>
                <option>Denim</option>
              </select>
          </div>
          <div class="mb-3">
              <label>Harga</label>
              <input type="number" id="uHarga" name="harga" class="form-control">
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" form="ubahForm">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function setData(id, nama, warna, ukuran, bahan, harga) {
      ubahForm.action = '/barang/' + id;
      uNama.value = nama;
      uWarna.value = warna;
      uUkuran.value = ukuran;
      uBahan.value = bahan;
      uHarga.value = harga;
    }
  </script>
@endsection