<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Rules\MatchPassword;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $validationRules;
    public function __construct()
    {
        $this->validationRules = [
            "nombre" => ['required','string','min: 3','max:50'],
            "precio_compra" => ['required','numeric','min:1'],
            "precio_venta" => ['required','numeric','min:1'],
            "existencias" => ['required','numeric','min:1, max:100'],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products.productsList', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.newProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        $productData = $request->except('_token');
        Product::create($productData);
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.productEdit',compact(['product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //Validando la nueva informacion
        $request->validate($this->validationRules);
        //Recolectando la informacion del request
        $productData = $request->except(['_token','_method']);

        //Actualizando la informacion de la mascota
        Product::where('id','=',$product->id)->update($productData);
        return redirect()->route('product.index',$product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Product $product)
    {
        print("test");
         //Validando que la contrasenia sea la correcta
         $request->validate([
            'password' => ['required', new MatchPassword]
        ]);

        //Eliminando el registro del producto con el ID correspondiente
        Product::destroy($product->id);
        return redirect()->route('product.index');
    }
}
