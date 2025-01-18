@foreach ($produk as $item)
<div class="grid-item">
    <input type="hidden" name="id" value="{{ encrypt($item->id) }}">
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
        <h4>Harga: Rp{{ number_format($item->harga, 0, ',', '.') }}
        </h4>
        <div class="btn-group">
            <a href="" class="btn btn-primary" style="border-radius: 0;">Pesan</a>
        </div>
    </div>
</div>
@endforeach
