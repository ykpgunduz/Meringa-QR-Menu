@extends('admin.layout')

@section('title', 'Ürün Düzenle')
@section('page-title', 'Ürün Düzenle')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.update', [$category, $product['id']]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="category_display" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category_display"
                               value="@foreach($data['categories'] as $cat)@if($cat['key'] == $category){{ $cat['name_tr'] }} ({{ $cat['name_en'] }})@endif @endforeach"
                               readonly>
                        <div class="form-text">Kategori değiştirilemez. Ürünü silip yeniden ekleyebilirsiniz.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name_tr" class="form-label">Türkçe Adı <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name_tr" name="name_tr" value="{{ old('name_tr', $product['name_tr']) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">İngilizce Adı <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en', $product['name_en']) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="desc_tr" class="form-label">Türkçe Açıklama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="desc_tr" name="desc_tr" value="{{ old('desc_tr', $product['desc_tr']) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="desc_en" class="form-label">İngilizce Açıklama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="desc_en" name="desc_en" value="{{ old('desc_en', $product['desc_en']) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Fiyat (₺) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product['price']) }}" min="0" step="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ürün Resmi</label>
                        @if(isset($product['image']))
                            <div class="mb-2">
                                <img src="{{ asset('img/products/' . $product['image']) }}"
                                     alt="{{ $product['name_tr'] }}"
                                     class="img-thumbnail"
                                     style="max-width: 200px;">
                                <div class="form-text">Mevcut resim</div>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">
                            @if(isset($product['image']))
                                Yeni resim seçerseniz mevcut resim değiştirilecektir.
                            @else
                                JPG, PNG, GIF formatları desteklenir. Maksimum 2MB.
                            @endif
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Güncelle
                        </button>
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Geri Dön
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Ürün Bilgileri
                </h6>
            </div>
            <div class="card-body">
                <p class="small">
                    <strong>ID:</strong> {{ $product['id'] }}<br>
                    <strong>Kategori:</strong> {{ $category }}
                </p>
                <p class="small text-muted">
                    Ürün ID'si ve kategorisi değiştirilemez.
                </p>
            </div>
        </div>

        @if(isset($product['image']))
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-image me-2"></i>Mevcut Resim
                    </h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/products/' . $product['image']) }}"
                         alt="{{ $product['name_tr'] }}"
                         class="img-fluid rounded">
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
