@extends('admin.layout')

@section('title', 'Ürünler')
@section('page-title', 'Ürünler')

@section('page-actions')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2 d-none d-md-inline"></i>
        <span class="d-none d-md-inline">Ürün Ekle</span>
        <i class="fas fa-plus d-md-none"></i>
    </a>
@endsection

@section('content')
@if(count($data['categories']) == 0)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Ürün ekleyebilmek için önce kategori oluşturmalısınız.
        <a href="{{ route('admin.categories.create') }}" class="alert-link">Kategori eklemek için tıklayın.</a>
    </div>
@endif

@foreach($data['categories'] as $category)
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-2 mb-md-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-folder me-2"></i>{{ $category['name_tr'] }}
                        <small class="text-muted d-block d-md-inline">({{ $category['name_en'] }})</small>
                    </h5>
                </div>
                <span class="badge bg-primary">
                    {{ isset($data['products'][$category['key']]) ? count($data['products'][$category['key']]) : 0 }} ürün
                </span>
            </div>
        </div>
        <div class="card-body">
            @if(isset($data['products'][$category['key']]) && count($data['products'][$category['key']]) > 0)
                <!-- Desktop Table -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Resim</th>
                                <th>Ürün Adı</th>
                                <th>Açıklama</th>
                                <th>Fiyat</th>
                                <th style="width: 120px;">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['products'][$category['key']] as $product)
                                <tr>
                                    <td>
                                        @if(isset($product['image']))
                                            <img src="{{ asset('img/products/' . $product['image']) }}"
                                                 alt="{{ $product['name_tr'] }}"
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $product['name_tr'] }}</strong>
                                            <small class="text-muted d-block">{{ $product['name_en'] }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $product['desc_tr'] }}
                                            <small class="text-muted d-block">{{ $product['desc_en'] }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold">₺{{ $product['price'] }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.edit', [$category['key'], $product['id']]) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.delete', [$category['key'], $product['id']]) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">
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
                    @foreach($data['products'][$category['key']] as $product)
                        <div class="card mb-3 border">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        @if(isset($product['image']))
                                            <img src="{{ asset('img/products/' . $product['image']) }}"
                                                 alt="{{ $product['name_tr'] }}"
                                                 class="img-fluid rounded"
                                                 style="width: 100%; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                 style="width: 100%; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="mb-0 fw-bold">{{ $product['name_tr'] }}</h6>
                                            <span class="badge bg-success">₺{{ $product['price'] }}</span>
                                        </div>
                                        <p class="text-muted small mb-1">{{ $product['name_en'] }}</p>
                                        <p class="text-muted small mb-2">{{ $product['desc_tr'] }} ({{ $product['desc_en'] }})</p>
                                        <div class="btn-group btn-group-sm w-100">
                                            <a href="{{ route('admin.products.edit', [$category['key'], $product['id']]) }}"
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Düzenle
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.delete', [$category['key'], $product['id']]) }}"
                                                  class="d-inline flex-fill"
                                                  onsubmit="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                                    <i class="fas fa-trash me-1"></i>Sil
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-shopping-bag fa-2x text-muted mb-3"></i>
                    <p class="text-muted">Bu kategoride henüz ürün yok.</p>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>İlk Ürünü Ekle
                    </a>
                </div>
            @endif
        </div>
    </div>
@endforeach

@if(count($data['categories']) == 0)
    <div class="text-center py-5">
        <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">Henüz kategori oluşturulmamış</h5>
        <p class="text-muted">Ürün ekleyebilmek için önce kategoriler oluşturmalısınız.</p>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-list me-2"></i>İlk Kategorinizi Ekleyin
        </a>
    </div>
@endif

@endsection
