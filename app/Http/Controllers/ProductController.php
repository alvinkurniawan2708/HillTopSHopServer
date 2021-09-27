<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return Products::all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'rating' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors(),400]);
        }

        $products = Products::create($request->all());

        return response()->json([
            'message' => ' Product upload success',
            'products' => $products
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        return Products::findOrFail($id);;
        // try{
        //     $checkProduct = Product::find($id);
        //     if(!$checkProduct){
        //         return response()->json([
        //             'message' => 'Product Not Found',
        //         ],400);
        //     }
        //     return $checkProduct;
        // }
        // catch(\Exception $err){
        //     return response()->json([
        //         'message' => 'Server Error',
        //     ],500);
        // }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
