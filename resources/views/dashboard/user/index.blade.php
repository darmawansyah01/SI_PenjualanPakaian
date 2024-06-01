@extends('layouts.DashboardMaster')
@section('content')

<button type="button" class="btn btn-success mb-4 no-print" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah
</button>

<br>

<a href="/user?print=true" class="btn btn-info no-print">Print</a>

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
        <th scope="col">Alamat</th>
        <th scope="col">Gender</th>
        <th scope="col">Tanggal Daftar</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col" class="no-print">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $loop->index + 1 }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->alamat }}</td>
          <td>{{ $user->gender }}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->password }}</td>
          <td class="no-print">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal" 
              onclick="setData('{{ $user->id }}', '{{ $user->name }}', '{{ $user->alamat }}', '{{ $user->gender }}', '{{ $user->email }}')">
              Ubah
            </button>
            <form action="/user/{{ $user->id }}" method="post" class="d-inline">
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
    {{ $users->links() }}
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
          <form action="/user" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" form="tambahForm">Understood</button>
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
                <label>Nama</label>
                <input type="text" name="name" class="form-control" id="uName">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" id="uAlamat"></textarea>
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control" id="uGender">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="uEmail">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="uPassword">
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
    function setData(id, name, alamat, gender, email) {
      ubahForm.action = '/user/' + id;
      uName.value = name;
      uAlamat.value = alamat;
      uGender.value = gender;
      uEmail.value = email;
    }
  </script>
@endsection