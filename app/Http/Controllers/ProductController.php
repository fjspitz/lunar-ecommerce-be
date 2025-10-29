<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $page = $request->query('page', 1);
        $items = [];
        $total = 0;
        $per_page = 0;
        $current_page = 0;

        //info($page);

        //$data = [];
        $response = Http::acceptJson()->withToken($this->getUserToken())
            ->get($this->getBaseUrl() . '/products', [
                'customer_group' => Auth::user()->customer_group_handle,
                'page' => $page,
            ]);

        if ($response->successful()) {
            //$data = $response->json('data');
            $items = new Collection($response->json('data'));
            $total = $response->json('total');
            $per_page = $response->json('per_page');
            $current_page = $response->json('current_page');

            $paginator = new LengthAwarePaginator($items, $total, $per_page, $current_page, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        } else {
            //info("Otra cosa: {$response->body()}");
            //info(Auth::user()->customer_group_handle);
        }

        return view('products.index', [
            //'products' => $products,
            //'data' => $response->json(),
            'items' => $paginator,
        ]);
    }

    public function new(): View
    {
        $brands = [];
        $response = Http::withToken($this->getUserToken())
            ->get($this->getBaseUrl() . '/brands');

        if ($response->successful()) {
            $brands = $response->json('data');
        }

        $categories = [];
        $response = Http::withToken($this->getUserToken())
            ->get($this->getBaseUrl() . '/categories');

        if ($response->successful()) {
            $categories = $response->json('data');
        }

        return view('products.new', [
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    public function create(CreateProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $file = $request->file('image');

        $response = Http::withToken($this->getUserToken())
            ->attach(
                'image',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )
            ->post($this->getBaseUrl() . '/products', [
                'name' => $validated['name'],
                'description' => $validated['description'],
                'brand_id' => $validated['brand_id'],
                'product_type_id' => $validated['product_type_id'],
                'sku' => $validated['sku'],
                'stock' => $validated['stock'],
                'price' => $validated['price'],
                'customer_group_handle' => Auth::user()->customer_group_handle,
            ]);

        if ($response->successful()) {
            Log::info("Producto creado: {$validated['name']}");
        } else {
            Log::error("Error: {$response->body()}");
        }

        return redirect()->route('product.index')
            ->with('message', 'Producto creado.');
    }

    private function getBaseUrl(): string
    {
        return config('app.lunar.url');
    }

    private function getUserToken(): string
    {
        return config('app.lunar.token');
    }
}
