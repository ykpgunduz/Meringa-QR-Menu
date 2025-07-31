@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-3">
    <div class="col-lg-3 col-md-6">
        <div class="card border-start border-primary border-4 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold text-primary text-uppercase mb-1">
                            Toplam Kategori
                        </div>
                        <div class="h4 mb-0 fw-bold text-dark">
                            {{ count($data['categories']) }}
                        </div>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-list fa-2x text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-start border-success border-4 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold text-success text-uppercase mb-1">
                            Toplam Ürün
                        </div>
                        <div class="h4 mb-0 fw-bold text-dark">
                            @php
                                $totalProducts = 0;
                                foreach($data['products'] as $category => $products) {
                                    $totalProducts += count($products);
                                }
                            @endphp
                            {{ $totalProducts }}
                        </div>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-shopping-bag fa-2x text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-start border-info border-4 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold text-info text-uppercase mb-1">
                            Ortalama Fiyat
                        </div>
                        <div class="h4 mb-0 fw-bold text-dark">
                            @php
                                $totalPrice = 0;
                                $productCount = 0;
                                foreach($data['products'] as $category => $products) {
                                    foreach($products as $product) {
                                        $totalPrice += $product['price'];
                                        $productCount++;
                                    }
                                }
                                $averagePrice = $productCount > 0 ? round($totalPrice / $productCount) : 0;
                            @endphp
                            ₺{{ $averagePrice }}
                        </div>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-lira-sign fa-2x text-info opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-start border-warning border-4 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold text-warning text-uppercase mb-1">
                            En Yüksek Fiyat
                        </div>
                        <div class="h4 mb-0 fw-bold text-dark">
                            @php
                                $maxPrice = 0;
                                foreach($data['products'] as $category => $products) {
                                    foreach($products as $product) {
                                        if($product['price'] > $maxPrice) {
                                            $maxPrice = $product['price'];
                                        }
                                    }
                                }
                            @endphp
                            ₺{{ $maxPrice }}
                        </div>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-arrow-up fa-2x text-warning opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-2">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white border-bottom">
                <h6 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-list me-2"></i>Kategoriler
                </h6>
            </div>
            <div class="card-body">
                @if(count($data['categories']) > 0)
                    <div class="d-flex flex-column gap-2">
                        @foreach($data['categories'] as $category)
                            <div class="d-flex justify-content-between align-items-center p-2 border rounded">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $category['name_tr'] }}</div>
                                    <small class="text-muted">{{ $category['name_en'] }}</small>
                                </div>
                                <span class="badge bg-primary">
                                    {{ isset($data['products'][$category['key']]) ? count($data['products'][$category['key']]) : 0 }} ürün
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-list-alt fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Henüz kategori eklenmemiş.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white border-bottom">
                <h6 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-rocket me-2"></i>Hızlı İşlemler
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary w-100 py-3">
                            <i class="fas fa-plus d-block mb-1"></i>
                            <small>Kategori Ekle</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success w-100 py-3">
                            <i class="fas fa-plus d-block mb-1"></i>
                            <small>Ürün Ekle</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.categories') }}" class="btn btn-info w-100 py-3">
                            <i class="fas fa-list d-block mb-1"></i>
                            <small>Kategorileri Yönet</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.products') }}" class="btn btn-warning w-100 py-3">
                            <i class="fas fa-shopping-bag d-block mb-1"></i>
                            <small>Ürünleri Yönet</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
