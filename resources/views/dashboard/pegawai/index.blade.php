@extends('layouts.DashboardMaster')
@section('content')

<button type="button" class="btn btn-success mb-4 no-print" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah
</button>

<br>

<a href="/pegawai?print=true" class="btn btn-info no-print">Print</a>

@if (isset($_GET['print']))
    <script>
      window.print();
    </script>
@endif

<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Umur</th>
        <th scope="col">Alamat</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col" class="no-print">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pegawais as $pegawai)
      <tr>
        <th scope="row">{{ $loop->index + 1 }}</th>
        <td>{{ $pegawai->user->name }}</td>
        <td>{{ $pegawai->umur }}</td>
        <td>{{ $pegawai->user->alamat }}</td>
        <td>{{ $pegawai->user->email }}</td>
        <td>{{ $pegawai->user->password }}</td>
        <td class="no-print">
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
            onclick="setData('{{ $pegawai->id }}', '{{ $pegawai->user->id }}', '{{ $pegawai->umur }}')">
            Ubah
          </button>
          <form action="/pegawai/{{ $pegawai->id }}" method="post" class="d-inline">
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
    {{ $pegawais->links() }}
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
          <form action="/pegawai" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>User</label><br>
              <select name="user_id" class="form-control select2Tambah" style="width: 100%;">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Umur</label>
              <input type="number" name="umur" class="form-control">
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
              <label>User</label><br>
              <select name="user_id" class="form-control select2Ubah" id="uUserID" style="width: 100%;">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Umur</label>
              <input type="number" name="umur" class="form-control" id="uUmur">
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
    function setData(id, userID, umur) {
      ubahForm.action = '/pegawai/' + id,
      uUserID.value = userID;
      uUmur.value = umur;
    }
  </script>
@endsection