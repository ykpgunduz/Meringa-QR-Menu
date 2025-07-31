@extends('admin.layout')

@section('title', 'Kategoriler')
@section('page-title', 'Kategoriler')

@section('page-actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2 d-none d-md-inline"></i>
        <span class="d-none d-md-inline">Kategori Ekle</span>
        <i class="fas fa-plus d-md-none"></i>
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(count($data['categories']) > 0)
            <!-- Desktop Table -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Anahtar</th>
                            <th>Türkçe Adı</th>
                            <th>İngilizce Adı</th>
                            <th>Ürün Sayısı</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['categories'] as $category)
                            <tr>
                                <td><code>{{ $category['key'] }}</code></td>
                                <td>{{ $category['name_tr'] }}</td>
                                <td>{{ $category['name_en'] }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ isset($data['products'][$category['key']]) ? count($data['products'][$category['key']]) : 0 }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.categories.edit', $category['key']) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.categories.delete', $category['key']) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Bu kategoriyi ve içindeki tüm ürünleri silmek istediğinizden emin misiniz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="d-md-none">
                @foreach($data['categories'] as $category)
                    <div class="card mb-3 border">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ $category['name_tr'] }}</h6>
                                    <p class="text-muted small mb-1">{{ $category['name_en'] }}</p>
                                    <code class="small">{{ $category['key'] }}</code>
                                </div>
                                <span class="badge bg-primary">
                                    {{ isset($data['products'][$category['key']]) ? count($data['products'][$category['key']]) : 0 }} ürün
                                </span>
                            </div>
                            <div class="btn-group btn-group-sm w-100">
                                <a href="{{ route('admin.categories.edit', $category['key']) }}"
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i>Düzenle
                                </a>
                                <form method="POST" action="{{ route('admin.categories.delete', $category['key']) }}"
                                      class="d-inline flex-fill"
                                      onsubmit="return confirm('Bu kategoriyi ve içindeki tüm ürünleri silmek istediğinizden emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="fas fa-trash me-1"></i>Sil
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-list-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Henüz kategori eklenmemiş</h5>
                <p class="text-muted">İlk kategorinizi eklemek için yukarıdaki "Kategori Ekle" butonunu kullanın.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>İlk Kategorinizi Ekleyin
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
