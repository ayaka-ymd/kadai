<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    public function show(Request $request) 
    {
        $company = new Company;
        $companies = $company->getLists();
        $searchWord = $request->input('searchWord');
        $company_id = $request->input('company_id');
        
        return view('searchproduct', [
            'companies' => $companies,
            'searchWord' => $searchWord,
            'company_id' => $company_id
            
        ]);
    }

    public function search(Request $request) 
    {
        $searchWord = $request->input('searchWord'); 
        $company_id = $request->input('company_id'); 
        $query = Product::query();
        
        if (isset($searchWord)) {
            $query->where('product_name', 'like', '%' . $searchWord. '%');
        }
        
        if (isset($company_id)) {
            $query->where('company_id', $company_id);
        }
        
        $products = $query->orderBy('company_id', 'asc')->get();

        
        $company = new Company;
        $companies = $company->getLists();
        

        return view('searchproduct', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            'company_id' => $company_id
        ]);
    }

 // 以下非同期検索結果
    // public function getProductsByProduct(Request $request) {
    //     $products = \DB::table('products');
    //     if ($request->product) {
    //         $products->where('products.product_name', 'LIKE', '%'.$request->product . '%');
    //     }
    //     if ($request->company) {
    //         $products->where('products.company_id', $request->company);
    //     }
    //     return response()->json($products);
    // }


    public function newregister(Request $request) 
    {
        return view('newregister', [
            'companies' => Company::all(),
        ]);
    }

    public function store(Request $request) 
    {
        $product = new product;
        $inputs = $request->all();
        $img = $request->file('images');
        \DB::beginTransaction();
        try {
            Product::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
        }
        \Session::flash('err_msg', '商品を登録しました');

        return redirect(route('searchproduct'));
    }

    public function detail($id) 
    {
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('searchproduct'));
        }

        return view('detail', ['product' => $product]);
    }

    public function edit($id) 
    {
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('searchproduct'));
        }

        return view('edit', ['companies' => Company::all()], ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = new product;
        $inputs = $request->all();
        $img = $request->file('images');
        \DB::beginTransaction();
        try {
            Product::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
        }
        \Session::flash('err_msg', '商品を更新しました');

        return redirect(route('searchproduct'));
    }

    public function destroy($id) 
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect(route('searchproduct'));
    }

    public function images(Request $request)
    {
        $img_path = Img_path::all();

      
        return view('searchproduct', $img_path);
    }
    
}