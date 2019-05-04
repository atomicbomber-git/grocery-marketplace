@extends('default')
@section('breadcrumb')
<div class="m-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('dashboard')}}" class="breadcrumb-item" aria-current="page">Home</a>
            <span class="breadcrumb-item active">Tambah Item Keranjang</span>
        </ol>
    </nav>
</div>
@endsection


@section('content')
<div class="container w-75">
        @include('users.pembeli.include.alerts')
        <div class="row mt-2">
            <div class="col-md-5">
                <div class="p-2  bg-secondary border rounded">
                    <div class="">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @forelse($produk->gallery as $key => $foto)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img style="width: 320px; height: 240px; object-fit: cover" class="d-block w-100" src="{{displayUrl($foto)}}">
                                </div>
                                @empty
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{gambarDefaultProduk()}}">
                                </div>
                                @endforelse
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="border">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>{{$produk->nama_produk}}</strong></li>
                        <li class="list-group-item">Tersedia &#177; {{$produk->jumlah_tersedia}} {{$produk->satuan_unit}}</li>
                        <li class="list-group-item">{{$produk->harga()}}/{{$produk->satuan_unit}}</li>
                        <li class="list-group-item">
                            <div>{{$produk->deskripsi()}}</div>
                        </li>
                        <li class="list-group-item">
                            <form action="" method="POST">
                                @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" id="btn-minus" class="btn btn-outline-danger"><i class="fas fa-minus"></i></button>
                                </div>
                                <input value="{{old('jumlah') ?? '0'}}" name="jumlah" id="input-number" type="text" class="form-control">
                                <div class="input-group-append">
                                    <button type="button" id="btn-plus" class="btn btn-outline-success"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary float-right mt-2"><i class="fas fa-cart-plus"></i> Tambah</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container my-4">
            <hr>
            <div class="row">
                <h5 class="text-center text-info m-4">
                    <a href="{{route('keranjang')}}">Produk di keranjang Anda</a>
                </h5>
            </div>
            <div class="row">
            @forelse($belanjaan as $item)
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{$item->nama_produk}}</strong>
                        </div>
                        <div class="card-body">
                                <p>{{$item->harga."/".ucfirst($item->satuan_unit)}}</p>
                                <p>{{$item->sub_total}}</p>
                            </ul>
                        </div>
        
                        <button class="btn btn-sm btn-primary float-right"><i class="fas fa-pencil-alt"></i></button>
                    </div>
                </div>
            @empty
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>Daftar Belanjaan</strong>
                    </div>
                    <div class="card-body">Anda belum memiliki daftar belanja.</div>
                </div>
            </div>
            @endforelse
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#btn-plus').click(function(){
            value = $('#input-number').val();
            value++;
            $('#input-number').val(value);
        });
        $('#btn-minus').click(function(){
            value = $('#input-number').val();
            if(value > 0){
                value--;
                $('#input-number').val(value);
            }
        });
        $('#input-number').keypress(function(event){
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault(); //stop character from entering input
            }
        });

    </script>
@endsection