@extends("users.admin.include.admin-navbar")

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('admin.dashboard')}}" class="breadcrumb-item">Dashboard</a>
            <span class="breadcrumb-item active">Manajemen Penjual</span>
        </nav>
    </div>
@endsection

@section("content")
    <div class="container">
        <div class="table-responsive my-5">
            <div class="float-right">
                <div class="pb-2 text-right">
                    Verifikasi Akun - <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                </div>
                <div class="pb-2 text-right">
                    Batalkan Verifikasi - <button class="btn btn-sm btn-danger"><i class="far fa-window-close"></i></button>
                </div>
            </div>
            <h3>Daftar Penjual</h3>
            <form action="" method="GET">
                <div class="form-group">
                    <label for="nama"></label>
                    <div class="input-group w-25">
                        <input placeholder="Nama Penjual" type="text" id="nama" name="nama" value="{{request('nama','')}}" class="form-control" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- <div class="clearfix"></div> -->
            <table class="table table-striped">
                <thead>
                    
                    @php $i = $users->firstItem(); @endphp
                    
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Tanggal Daftar</th>
                    <th>E-Mail</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$user->nama}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->tanggalDaftar()}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <button data-url="{{route('verif.penjual',[$user->penjual->id])}}" class="btn btn-verif {{$user->penjual['telah_diverifikasi'] ? 'btn-danger' : 'btn-success'}}"><i class="{{$user->penjual['telah_diverifikasi'] ? 'far fa-window-close' : 'fa fa-check'}}"></i></button>
                            <a href="{{route('edit.penjual',[$user->penjual->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    @php $i++; @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="hidden">
                <form id="verification" method="POST" action="">
                    @csrf
                </form>
            </div>
            <div class="float-right">
                {{$users->links()}}
            </div>
            <div class="clearfix"></div>
        </div>    
    </div>
@endsection
@section('js')
    <script>
        $('.btn-verif').click(function(){
            url = $(this).data('url');
            $('#verification').attr('action',url) ;
            $('#verification').submit();
        });
    </script>
@endsection