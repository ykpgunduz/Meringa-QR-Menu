@extends('admin.layout')

@section('title', 'Kategori Ekle')
@section('page-title', 'Kategori Ekle')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="key" class="form-label">Anahtar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="key" name="key" value="{{ old('key') }}" required>
                        <div class="form-text">URL'de kullanılacak anahtar (örn: sicak-kahveler). Sadece küçük harf, rakam ve tire kullanın.</div>
                    </div>

                    <div class="mb-3">
                        <label for="name_tr" class="form-label">Türkçe Adı <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name_tr" name="name_tr" value="{{ old('name_tr') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="name_en" class="form-label">İngilizce Adı <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Kategori Ekle
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
                    <i class="fas fa-info-circle me-2"></i>Bilgilendirme
                </h6>
            </div>
            <div class="card-body">
                <p class="small text-muted">
                    <strong>Anahtar:</strong> Bu kategori için benzersiz bir tanımlayıcı olmalıdır. URL'lerde kullanılacağı için sadece küçük harf, rakam ve tire (-) karakterleri kullanın.
                </p>
                <p class="small text-muted">
                    <strong>Örnekler:</strong><br>
                    • sicak-kahveler<br>
                    • soguk-icecekler<br>
                    • tatlilar<br>
                    • ekmekler
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('name_tr').addEventListener('input', function() {
    const nametr = this.value;
    const key = nametr
        .toLowerCase()
        .replace(/ğ/g, 'g')
        .replace(/ü/g, 'u')
        .replace(/ş/g, 's')
        .replace(/ı/g, 'i')
        .replace(/ö/g, 'o')
        .replace(/ç/g, 'c')
        .replace(/[^a-z0-9]/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');

    document.getElementById('key').value = key;
});
</script>
@endsection
