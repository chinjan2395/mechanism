<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductPriceRequest;
use App\Http\Requests\ProductQuantityRequest;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductImage;
use App\ProductPrice;
use App\ProductQuantity;
use App\User;
use Intervention\Image\Facades\Image;
use Sentinel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use Validator;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $product = new Product;
        $product = $product->all();
        return view('backEnd.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Sentinel::getUser();
        if ($user->inRole('admin')) {
            return view('backEnd.product.create', compact('user'));
        }
        return view('backEnd.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProductRequest $request, ProductPriceRequest $request, ProductQuantityRequest $request)
    {
        $product = new Product;
        $product = $product->create($request->all());

        $product_price = new ProductPrice;
        $product_price->create([
                'product_id' => $product->id,
                'amount' => $request->get('amount'),
            ]
        );

        $product_quantity = new ProductQuantity;
        $product_quantity->create([
                'product_id' => $product->id,
                'quantity' => $request->get('quantity'),
            ]
        );

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $path = public_path() . '/images/upload/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);

            $product_images = new ProductImage;
            $product_images->create([
                    'product_id' => $product->id,
                    'img_1' => $filename
                ]
            );
        }

        Session::flash('message', 'Product added!');
        Session::flash('status', 'success');

        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('backEnd.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product_details = $product->getAll();

        return view('backEnd.product.edit', compact(['product', 'product_details']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id, ProductRequest $request, ProductPriceRequest $request, ProductQuantityRequest $request)
    {
        $product = new Product;
        $product = $product->findOrFail($id);
        $product->update($request->all());


        $product_price = $product->getPrice();
        $product_price->update(['amount' => $request->get('amount')]);

        $product_quantity = $product->getQuantity();
        $product_quantity->update(['quantity' => $request->get('quantity')]);

        Session::flash('message', 'Product updated!');
        Session::flash('status', 'success');
        /*if(!is_dir($request->get('name'))){
            $directory = public_path(). '/images/upload/'.$request->get('name');
            mkdir($directory);
        }*/
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $path = public_path() . '/images/upload/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);

            $product_images = $product->getImages();
            $product_images->update(['img_1' => $filename]);
        }

//        die;
        // open an image file
//        $src = public_path().'/images/'.$filename;
//        $img = Image::make($src);
//        $img->crop($request->get('w'), $request->get('h'),$request->get('x'), $request->get('y'));
//        $img->save(public_path().'/bar.jpg');
//        unlink($src);
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        Session::flash('message', 'Product deleted!');
        Session::flash('status', 'success');

        return redirect('admin/product');
    }

}
