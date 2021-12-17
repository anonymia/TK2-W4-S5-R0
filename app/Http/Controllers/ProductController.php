<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();

        return view('product.index', ['products' => $products]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255', 'unique'],
            'buying_price' => ['required', 'integer', 'min:0'],
            'selling_price' => ['required', 'integer', 'min:0'],
            'picture' => ['required', 'file', 'image', 'max:1024']
        ]);

        $picture = $request->file('picture');

        try {
            DB::table('products')->insert(
                array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'buying_price' => $request->buying_price,
                    'selling_price' => $request->selling_price,
                    'picture' => 'data:'.$picture->getMimeType().';base64,'.base64_encode(file_get_contents($picture)),
                )
            );
        }
        catch (QueryException $e) {
            switch ($e->errorInfo[1]) {
                default:
                    Log::channel('stderr')->error($e->getMessage());
                    break;
            }
        }

        return redirect()->route('product');
    }

    public function get(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        return view('product.get', ['product' => $product]);
    }

    public function put(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255', 'unique'],
            'buying_price' => ['required', 'integer', 'min:0'],
            'selling_price' => ['required', 'integer', 'min:0'],
            'picture' => ['nullable', 'file', 'image', 'max:1024']
        ]);

        $body = array(
            'name' => $request->name,
            'description' => $request->description,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price
        );

        $picture = $request->file('picture');
        if (!empty($picture) && $picture->isValid()) {
            $body['picture'] = 'data:'.$picture->getMimeType().';base64,'.base64_encode(file_get_contents($picture));
        }

        try {
            DB::table('products')->where('id', $id)->update($body);
        }
        catch (QueryException $e) {
            switch ($e->errorInfo[1]) {
                default:
                    Log::channel('stderr')->error($e->getMessage());
                    break;
            }
        }

        return redirect()->route('product');
    }

    public function delete(Request $request, $id)
    {
        DB::table('products')->delete($id);

        return redirect()->route('product');
    }
}
