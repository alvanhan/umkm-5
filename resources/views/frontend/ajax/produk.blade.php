@foreach ($produk as $item)
<div class="grid-item">
    @if(isset($item->gambar[0]))
        <img class="img-responsive" alt="{{ $item->nama }}" src="{{ asset($item->gambar[0]) }}">
    @endif
    <a href="#" class="project-description">
        <div class="project-text-holder">
            <h4>{{ @$item->deskripsi }}</h4>
        </div>
    </a>
    <div class="project-text-inner">
        <h3>{{ @$item->nama }}</h3>
        <h5 id="tersedia">Tersedia: {{ $item->stok }}</h5>
        <h5>Harga: Rp{{ number_format($item->harga, 0, ',', '.') }}
        </h5>
        <div class="btn-group">
            <a class="btn btn-primary" name="{{ $item->id }}" id="btn-pesan" style="border-radius: 0;">Pesan</a>
        </div>
    </div>
</div>
@endforeach
