<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    public function searchproduct(Request $request) 
    {
        $products = Product::all();
        $company = new Company;
        $companies = $company->getList();
        $searchWord = $request->input('searchWord'); 
        $company_id = $request->input('company_id');
        $minprice = $request->input('minprice');
        $maxprice = $request->input('maxprice');
        $minstock = $request->input('minstock');
        $maxstock = $request->input('maxstock');
        $query = Product::query();
        
        if (isset($searchWord)) {
            $query->where('product_name', 'like', '%'.$searchWord.'%');
        }
        if (isset($company_id)) {
            $query->where('company_id', '=', $company_id);
        }
        if (isset($minprice)){
            $query->where('price', '>=', $minprice);
        }
        if (isset($maxprice)){
            $query->where('price', '<=', $maxprice);
        }
        if (isset($minstock)){
            $query->where('stock', '>=', $minstock);
        }
        if (isset($maxstock)){
            $query->where('stock', '<=', $maxstock);
        }
        
        
        $products = Product::sortable()->get();
        
        
        // 以下非同期検索結果
        //$products = \DB::table('products');
        //if ($request->product) {
           //$products->where('products.product_name', 'LIKE', '%'.$request->product . '%');
        //}
        //if ($request->company) {
            //$products->where('products.company_id', $request->company);
        //}
        //return response()->json($products);

        return view('searchproduct', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            'company_id' => $company_id,
            'minprice' => $minprice,
            'maxprice' => $maxprice,
            'minstock' => $minstock,
            'maxstock' => $maxstock
        ]);
    }

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
        $companies = $company->getLists();

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