<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    private $jsonPath;

    public function __construct()
    {
        $this->jsonPath = public_path('js/products.json');
    }

    public function index()
    {
        $data = $this->getProductsData();
        return view('admin.dashboard', compact('data'));
    }

    public function products()
    {
        $data = $this->getProductsData();
        return view('admin.products', compact('data'));
    }

    public function categories()
    {
        $data = $this->getProductsData();
        return view('admin.categories', compact('data'));
    }

    public function createProduct()
    {
        $data = $this->getProductsData();
        return view('admin.create-product', compact('data'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name_tr' => 'required',
            'name_en' => 'required',
            'desc_tr' => 'required',
            'desc_en' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $this->getProductsData();

        // Yeni ID oluştur
        $newId = $this->getNextProductId($data);

        $productData = [
            'id' => $newId,
            'name_tr' => $request->name_tr,
            'name_en' => $request->name_en,
            'desc_tr' => $request->desc_tr,
            'desc_en' => $request->desc_en,
            'price' => (int) $request->price
        ];

        // Resim yükle
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/products'), $imageName);
            $productData['image'] = $imageName;
        }

        // Kategori varsa ürünü ekle
        if (isset($data['products'][$request->category])) {
            $data['products'][$request->category][] = $productData;
        } else {
            $data['products'][$request->category] = [$productData];
        }

        $this->saveProductsData($data);

        return redirect()->route('admin.products')->with('success', 'Ürün başarıyla eklendi!');
    }

    public function editProduct($category, $productId)
    {
        $data = $this->getProductsData();
        $product = null;

        if (isset($data['products'][$category])) {
            foreach ($data['products'][$category] as $p) {
                if ($p['id'] == $productId) {
                    $product = $p;
                    break;
                }
            }
        }

        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Ürün bulunamadı!');
        }

        return view('admin.edit-product', compact('data', 'product', 'category'));
    }

    public function updateProduct(Request $request, $category, $productId)
    {
        $request->validate([
            'name_tr' => 'required',
            'name_en' => 'required',
            'desc_tr' => 'required',
            'desc_en' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $this->getProductsData();
        $productIndex = null;

        if (isset($data['products'][$category])) {
            foreach ($data['products'][$category] as $index => $p) {
                if ($p['id'] == $productId) {
                    $productIndex = $index;
                    break;
                }
            }
        }

        if ($productIndex === null) {
            return redirect()->route('admin.products')->with('error', 'Ürün bulunamadı!');
        }

        $productData = [
            'id' => (int) $productId,
            'name_tr' => $request->name_tr,
            'name_en' => $request->name_en,
            'desc_tr' => $request->desc_tr,
            'desc_en' => $request->desc_en,
            'price' => (int) $request->price
        ];

        // Mevcut resmi koru
        if (isset($data['products'][$category][$productIndex]['image'])) {
            $productData['image'] = $data['products'][$category][$productIndex]['image'];
        }

        // Yeni resim yükle
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/products'), $imageName);
            $productData['image'] = $imageName;
        }

        $data['products'][$category][$productIndex] = $productData;
        $this->saveProductsData($data);

        return redirect()->route('admin.products')->with('success', 'Ürün başarıyla güncellendi!');
    }

    public function deleteProduct($category, $productId)
    {
        $data = $this->getProductsData();

        if (isset($data['products'][$category])) {
            foreach ($data['products'][$category] as $index => $p) {
                if ($p['id'] == $productId) {
                    unset($data['products'][$category][$index]);
                    $data['products'][$category] = array_values($data['products'][$category]);
                    break;
                }
            }
        }

        $this->saveProductsData($data);

        return redirect()->route('admin.products')->with('success', 'Ürün başarıyla silindi!');
    }

    public function createCategory()
    {
        return view('admin.create-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'key' => 'required|unique_category_key',
            'name_tr' => 'required',
            'name_en' => 'required'
        ]);

        $data = $this->getProductsData();

        $categoryData = [
            'key' => $request->key,
            'name_tr' => $request->name_tr,
            'name_en' => $request->name_en
        ];

        $data['categories'][] = $categoryData;
        $data['products'][$request->key] = [];

        $this->saveProductsData($data);

        return redirect()->route('admin.categories')->with('success', 'Kategori başarıyla eklendi!');
    }

    public function editCategory($key)
    {
        $data = $this->getProductsData();
        $category = null;

        foreach ($data['categories'] as $cat) {
            if ($cat['key'] === $key) {
                $category = $cat;
                break;
            }
        }

        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Kategori bulunamadı!');
        }

        return view('admin.edit-category', compact('category'));
    }

    public function updateCategory(Request $request, $key)
    {
        $request->validate([
            'name_tr' => 'required',
            'name_en' => 'required'
        ]);

        $data = $this->getProductsData();

        foreach ($data['categories'] as $index => $cat) {
            if ($cat['key'] === $key) {
                $data['categories'][$index]['name_tr'] = $request->name_tr;
                $data['categories'][$index]['name_en'] = $request->name_en;
                break;
            }
        }

        $this->saveProductsData($data);

        return redirect()->route('admin.categories')->with('success', 'Kategori başarıyla güncellendi!');
    }

    public function deleteCategory($key)
    {
        $data = $this->getProductsData();

        // Kategoriyi listeden sil
        foreach ($data['categories'] as $index => $cat) {
            if ($cat['key'] === $key) {
                unset($data['categories'][$index]);
                break;
            }
        }

        // Array'i yeniden indeksle
        $data['categories'] = array_values($data['categories']);

        // Kategorideki ürünleri de sil
        if (isset($data['products'][$key])) {
            unset($data['products'][$key]);
        }

        $this->saveProductsData($data);

        return redirect()->route('admin.categories')->with('success', 'Kategori ve içindeki ürünler başarıyla silindi!');
    }

    private function getProductsData()
    {
        if (!File::exists($this->jsonPath)) {
            return ['categories' => [], 'products' => []];
        }

        $jsonContent = File::get($this->jsonPath);
        return json_decode($jsonContent, true);
    }

    private function saveProductsData($data)
    {
        File::put($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function getNextProductId($data)
    {
        $maxId = 0;
        foreach ($data['products'] as $category => $products) {
            foreach ($products as $product) {
                if ($product['id'] > $maxId) {
                    $maxId = $product['id'];
                }
            }
        }
        return $maxId + 1;
    }
}
