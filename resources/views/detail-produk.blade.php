@extends('default')

@section('breadcrumb')
<div class="m-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{url('')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container w-75">
    <div class="mt-5">
        <h1>Informasi Produk</h1>
        <div class="row">
            <div class="col-md-5">
                <div class="p-2  bg-secondary border rounded">
                    <div class="">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @forelse($produk->gallery as $key => $foto)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img style="width: 320px; height: 240px; object-fit: cover" class="d-block w-100" src="{{$foto->url()}}">
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
                        @if($produk->tersedia)
                        <li class="list-group-item">Tersedia &#177; {{$produk->jumlah_tersedia}} {{$produk->satuan_unit}}</li>
                        @else
                        <li class="list-group-item">Produk tidak tersedia.</li>
                        @endif
                        <li class="list-group-item">{{$produk->harga()}}/{{$produk->satuan_unit}}</li>
                        <li class="list-group-item">
                            <div>{{$produk->deskripsi()}}</div>
                            <div class="clearfix"></div>
                            @can('pembeli')
                            @if($produk->tersedia)
                            <div class="float-right"><a href="{{route('tambah.produk',[$produk->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i> Tambahkan Ke Keranjang</a></div>
                            @endif
                            @endcan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="mt-2">
        @if(!$penjual->produk->isEmpty())
        <h5 class="text-center">Produk Lainnya dari {{$penjual->user->nama}}</h5>
        @endif
        <div class="w-75 mx-auto mt-2">
            <div class="row">
                @forelse($penjual->produk as $item)
                <div class="col-md-3 my-2">
                    <div class="card">
                        <a href="{{route('lihat.produk',[$item->id])}}">
                            <img src="{{gambarDefaultProduk($item)}}" alt="" class="img-fluid mh-25">
                        </a>
                        <div class="card-body">
                            <p class="text-center">{{$item->nama_produk}}</p>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection