@extends('layouts.DashboardMaster')
@section('content')

<button type="button" class="btn btn-success mb-4 no-print" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah
</button>

<br>

<a href="/transaksi?print=true" class="btn btn-info no-print">Print</a>

@if (isset($_GET['print']))
    <script>
      window.print();
    </script>
@endif

<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Pembeli</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Nama Supplier</th>
        <th scope="col">Harga</th>
        <th scope="col">Qty</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Tanggal Pembelian</th>
        <th scope="col" class="no-print">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transaksis as $t)
        <tr>
          <th scope="row">{{ $loop->index + 1 }}</th>
          <td>{{ $t->nama_pembeli }}</td>
          <td>{{ $t->barang->nama }}</td>
          <td>{!! (isset($t->barang->supplier->nama)) ? $t->barang->supplier->nama : '<p class="btn btn-danger m-0">belum dibuat</p>' !!}</td>
          <td>{{ $t->barang->harga }}</td>
          <td>{{ $t->qty }}</td>
          <td>{{ $t->total_harga }}</td>
          <td>{{ $t->created_at }}</td>
          <td class="no-print">
            <form action="/transaksi/{{ $t->id }}" method="post" class="d-inline">
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
    {{ $transaksis->links() }}
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
          <form action="/transaksi" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Nama Pembeli</label>
              <input type="text" name="nama_pembeli" class="form-control">
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
              <label>Qty</label>
              <input type="number" name="qty" class="form-control">
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
@endsection