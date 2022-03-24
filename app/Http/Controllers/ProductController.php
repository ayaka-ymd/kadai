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
        $companyId = $request->input('companyId');
        
        return view('searchproduct', [
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
            
        ]);
    }

    public function search(Request $request) 
    {
        $searchWord = $request->input('searchWord'); 
        $companyId = $request->input('companyId'); 
        $query = Product::query();
        
        if (isset($searchWord)) {
            $query->where('product_name', 'like', '%' . $searchWord. '%');
        }
        
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }
        
        $products = $query->orderBy('company_id', 'asc')->get();

        
        $company = new Company;
        $companies = $company->getLists();
        

        return view('searchproduct', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
        ]);
    }

    public static function escapeLike($str) 
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
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
        $product->product_id = $request->product_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;
        $product->product->save();

        return redirect('/')->to('newregister');
    }

    public function detail($id) 
    {
        $product = Product::find($id);

        return view('detail', compact('product'));
    }

    public function edit($id) 
    {
        $product = Product::find($id);

        return view('edit', ['companies' => Company::all()], compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_id = Auth::id();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('prise');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        $product->img_path = $request->input('img_path');
        $producte->save();

        return redirect('/')->with('success', '更新しました');
    }

    public function destroy($id) 
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect()->route('searchproduct');
    }

    public function images(Request $request)
    {
        $img_path = Img_path::all();

      
        return view('searchproduct', compact('image'));
    }
    
}
