<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategoriProduk');

        // Apply filters
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $query->where('harga', '>=', $request->min_price);
        }

        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $query->where('harga', '<=', $request->max_price);
        }

        if ($request->has('stock_status') && is_array($request->stock_status)) {
            $stockConditions = [];
            if (in_array('available', $request->stock_status)) {
                $stockConditions[] = ['stok', '>', 5];
            }
            if (in_array('low', $request->stock_status)) {
                $stockConditions[] = ['stok', '>', 0, ['stok', '<=', 5]];
            }
            if (in_array('out', $request->stock_status)) {
                $stockConditions[] = ['stok', '=', 0];
            }
            if (!empty($stockConditions)) {
                $query->where(function ($q) use ($stockConditions) {
                    foreach ($stockConditions as $condition) {
                        if (count($condition) === 2) {
                            $q->orWhere($condition[0], $condition[1]);
                        } elseif (count($condition) === 4) {
                            $q->orWhere($condition[0], $condition[1], $condition[2])
                                ->where($condition[3][0], $condition[3][1], $condition[3][2]);
                        }
                    }
                });
            }
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price-low':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'price-high':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'name-asc':
                    $query->orderBy('nama', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('nama', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $produk = $query->paginate(12)->withQueryString();

        return view('pages.produk', compact('produk'));
    }

    public function show($slug)
    {
        $produk = Produk::where('slug', $slug)->with('kategoriProduk')->firstOrFail();

        // Get related products (same category, exclude current product)
        $produkLainnya = Produk::whereHas('kategoriProduk', function ($query) use ($produk) {
            $query->where('nama_kategori', $produk->kategori);
        })
            ->where('id', '!=', $produk->id)
            ->limit(4)
            ->get();

        return view('pages.detailProduk', compact('produk', 'produkLainnya'));
    }

    public function filter(Request $request)
    {
        $query = Produk::with('kategoriProduk');

        // Apply search
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Apply category
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->where('kategori', $request->category);
        }

        // Apply price range
        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $query->where('harga', '>=', $request->min_price);
        }
        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $query->where('harga', '<=', $request->max_price);
        }

        // Apply stock status
        if ($request->has('stock_status') && is_array($request->stock_status)) {
            $stockStatuses = $request->stock_status;
            $query->where(function ($q) use ($stockStatuses) {
                foreach ($stockStatuses as $status) {
                    switch ($status) {
                        case 'available':
                            $q->orWhere('stok', '>', 5);
                            break;
                        case 'low':
                            $q->orWhere(function ($sq) {
                                $sq->where('stok', '>', 0)->where('stok', '<=', 5);
                            });
                            break;
                        case 'out':
                            $q->orWhere('stok', '=', 0);
                            break;
                    }
                }
            });
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price-low':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'price-high':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'name-asc':
                    $query->orderBy('nama', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('nama', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $produk = $query->paginate(12)->withQueryString();

        // Return JSON response for AJAX
        if ($request->expectsJson()) {
            $html = view('partials.product-grid', compact('produk'))->render();
            return response()->json(['html' => $html]);
        }

        return view('pages.produk', compact('produk'));
    }
    public function showById($id)
{
    $produk = Produk::findOrFail($id);
    return view('pages.detailProduk', compact('produk'));
}

}
