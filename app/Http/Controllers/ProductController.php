<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\FormatResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();

        if ($data) {
            return FormatResponse::createAPI(200, 'success', $data);
        } else {
            return FormatResponse::createAPI(400, 'failed');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Schema
        $rules = [
            'image' => 'string',
            'name' => 'string',
            'price' => 'integer',
            'type' => 'string',
            'rating' => 'integer',
            'transaction' => 'integer',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }

        $createProduct = Product::create($data);

        return FormatResponse::createAPI(201, 'success', $createProduct);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showProducts = Product::where('id', '=', $id)->get();

        if ($showProducts) {
            return FormatResponse::createAPI(200, 'success', $showProducts);
        } else {
            return FormatResponse::createAPI(400, 'failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Schema
        $rules = [
            'image' => 'string',
            'name' => 'string',
            'price' => 'integer',
            'type' => 'string',
            'rating' => 'integer',
            'transaction' => 'integer',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }

        $product = Product::find($id);
        
        if (!$product) {
            return FormatResponse::createAPI(404, 'unknown');
        }

        $product->update($data);

        return FormatResponse::createAPI(200, 'success', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return FormatResponse::createAPI(404, 'unknown');
        }

        $product->delete($id);

        return FormatResponse::createAPI(204, 'deleted');
    }
}
