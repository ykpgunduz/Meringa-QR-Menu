@extends('admin.layout')

@section('title', 'Kategori Düzenle')
@section('page-title', 'Kategori Düzenle')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category['key']) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="key" class="form-label">Anahtar</label>
                        <input type="text" class="form-control" id="key" value="{{ $category['key'] }}" readonly>
                        <div class="form-text">Anahtar değiştirilemez.</div>
                    </div>

                    <div class="mb-3">
                        <label for="name_tr" class="form-label">Türkçe Adı <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name_tr" name="name_tr" value="{{ old('name_tr', $category['name_tr']) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="name_en" class="form-label">İngilizce Adı <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en', $category['name_en']) }}" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Güncelle
                        </button>
                        <a href="{{ route('admin.categories') }}" class="btn btn-secondary">
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
                    <i class="fas fa-info-circle me-2"></i>Kategori Bilgileri
                </h6>
            </div>
            <div class="card-body">
                <p class="small">
                    <strong>Anahtar:</strong> <code>{{ $category['key'] }}</code>
                </p>
                <p class="small text-muted">
                    Kategori anahtarı değiştirilemez. Sadece kategori adları güncellenebilir.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
