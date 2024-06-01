@extends('layouts.DashboardMaster')
@section('content')

<button type="button" class="btn btn-success mb-4 no-print" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah
</button>

<br>

<a href="/supplier?print=true" class="btn btn-info no-print">Print</a>

@if (isset($_GET['print']))
    <script>
      window.print();
    </script>
@endif

<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Supplier</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Alamat</th>
        <th scope="col">Harga</th>
        <th scope="col" class="no-print">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($suppliers as $supplier)
      <tr>
        <th scope="row">{{ $loop->index + 1 }}</th>
        <td>{{ $supplier->nama }}</td>
        <td>{{ $supplier->barang->nama }}</td>
        <td>{{ $supplier->alamat }}</td>
        <td>{{ $supplier->harga }}</td>
        <td class="no-print">
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
            onclick="setData('{{ $supplier->id }}', '{{ $supplier->nama }}', '{{ $supplier->alamat }}', '{{ $supplier->harga }}')">
            Ubah
          </button>
          <form action="/supplier/{{ $supplier->id }}" method="post" class="d-inline">
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
    {{ $suppliers->links() }}
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
          <form action="/supplier" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
                <label>Nama Supplier</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
              <label>Barang</label><br>
              <select name="barang_id" class="form-control select2Tambah" style="width: 100%;">
                @foreach ($barangs as $barang)
                  <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
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

  <!-- Modal -->
  <div class="modal fade" id="ubahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ubahModalLabel">Ubah Modal</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" id="ubahForm">
            @csrf
            @method('put')
            <div class="mb-3">
                <label>Nama Supplier</label>
                <input type="text" name="nama" id="uNama" class="form-control">
            </div>
            <div class="mb-3">
              <label>Barang</label><br>
              <select name="barang_id" id="uBarangID" class="form-control select2Ubah" style="width: 100%;">
                @foreach ($barangs as $barang)
                  <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" id="uAlamat" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" id="uHarga" class="form-control">
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
    function setData(id, nama, alamat, harga) {
      ubahForm.action = '/supplier/' + id;
      uNama.value = nama;
      uAlamat.value = alamat;
      uHarga.value = harga;
      console.log(uBarangID);
    }
  </script>
@endsection