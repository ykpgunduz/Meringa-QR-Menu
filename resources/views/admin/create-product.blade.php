@extends('admin.layout')

@section('title', 'Ürün Ekle')
@section('page-title', 'Ürün Ekle')

@section('content')
@if(count($data['categories']) == 0)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Ürün ekleyebilmek için önce kategori oluşturmalısınız.
        <a href="{{ route('admin.categories.create') }}" class="alert-link">Kategori eklemek için tıklayın.</a>
    </div>
@else
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-plus me-2"></i>Yeni Ürün Ekle
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Kategori seçin...</option>
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category['key'] }}" {{ old('category') == $category['key'] ? 'selected' : '' }}>
                                        {{ $category['name_tr'] }} ({{ $category['name_en'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_tr" class="form-label">Türkçe Adı <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name_tr" name="name_tr" value="{{ old('name_tr') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_en" class="form-label">İngilizce Adı <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="desc_tr" class="form-label">Türkçe Açıklama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="desc_tr" name="desc_tr" value="{{ old('desc_tr') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="desc_en" class="form-label">İngilizce Açıklama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="desc_en" name="desc_en" value="{{ old('desc_en') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Fiyat (₺) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" min="0" step="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Ürün Resmi</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="form-text">JPG, PNG, GIF formatları desteklenir. Maksimum 2MB.</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Ürün Ekle
                            </button>
                            <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Geri Dön
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Ürün Ekleme Rehberi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="small">
                        <div class="mb-3">
                            <strong class="text-primary">Kategori:</strong>
                            <p class="text-muted mb-0">Ürünün hangi kategoriye ait olduğunu belirtin.</p>
                        </div>
                        <div class="mb-3">
                            <strong class="text-primary">Ürün Adları:</strong>
                            <p class="text-muted mb-0">Hem Türkçe hem de İngilizce ürün adlarını girin.</p>
                        </div>
                        <div class="mb-3">
                            <strong class="text-primary">Açıklamalar:</strong>
                            <p class="text-muted mb-0">Ürün boyutu, miktarı veya özelliklerini belirtin (örn: "Adet", "200 gr").</p>
                        </div>
                        <div class="mb-3">
                            <strong class="text-primary">Fiyat:</strong>
                            <p class="text-muted mb-0">Sadece sayı girin. ₺ sembolü otomatik eklenecektir.</p>
                        </div>
                        <div class="mb-0">
                            <strong class="text-primary">Resim:</strong>
                            <p class="text-muted mb-0">Ürün için görsel eklemek isteğe bağlıdır.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Örnek Değerler
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small">
                        <strong>Türkçe Ad:</strong> Cappuccino<br>
                        <strong>İngilizce Ad:</strong> Cappuccino<br>
                        <strong>Türkçe Açıklama:</strong> Adet<br>
                        <strong>İngilizce Açıklama:</strong> Piece<br>
                        <strong>Fiyat:</strong> 160
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
