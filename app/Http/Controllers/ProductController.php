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
        DB::beginTransaction();
            try{
                $product = new product;
                $product->product_id = $request->product_id;
                $product->product_name = $request->product_name;
                $product->price = $request->price;
                $product->stock = $request->stock;
                $product->comment = $request->comment;
                $product->img_path = $request->img_path;
                $product->product->save();
                DB::commit();
            }catch (Throwable $e) {
                DB::rollBack();
            }
        
        return view('newregister', [
            'companies' => Company::all(),
        ]);
    }

    

    public function detail($id) 
    {
        $product = Product::find($id);

        return view('detail', compact('product'));
    }

    public function edit($id) 
    {
        DB::beginTransaction();
            try{
                $product = Product::find($id);
                $product->product_id = Auth::id();
                $product->product_name = $request->input('product_name');
                $product->price = $request->input('prise');
                $product->stock = $request->input('stock');
                $product->comment = $request->input('comment');
                $product->img_path = $request->input('img_path');
                $producte->save();
                DB::commit();
            }catch (Throwable $e) {
                DB::rollBack();
            }
        
        return view('edit', ['companies' => Company::all()], compact('product'));
    }

    public function destroy($id) 
    {
        try{
            $product = Product::find($id);
            $product->product_id = Auth::id();
            $product->delete();
            DB::commit();
        }catch (Throwable $e) {
            DB::rollBack();
        }
        
        return redirect()->route('searchproduct');
    }

    public function images(Request $request)
    {
        $img_path = Img_path::all();

      
        return view('searchproduct', compact('image'));
    }
    
}
