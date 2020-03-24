<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;   
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
    	try{
	        $data["count"] = Product::count();
	        $product = array();

	        foreach (Product::all() as $p) {
	            $item = [
	                "id"            => $p->id,
	                "product_title" => $p->product_title,
	                "description"   => $p->description,
	                "category" 	    => $p->category,
	                "picture" 	    => $p->picture,
	                "created_at"    => $p->created_at,
	                "updated_at"    => $p->updated_at
	            ];

	            array_push($product, $item);
	        }
	        $data["product"] = $product;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function getAll($limit = 10, $offset = 0)
    {
    	try{
	        $data["count"] = Product::count();
	        $product = array();

	        foreach (Product::take($limit)->skip($offset)->get() as $p) {
	            $item = [
	                "id"            => $p->id,
	                "product_title" => $p->product_title,
	                "description"   => $p->description,
	                "category" 	    => $p->category,
	                "picture" 	    => $p->picture,
	                "created_at"    => $p->created_at,
	                "updated_at"    => $p->updated_at
	            ];

	            array_push($product, $item);
	        }
	        $data["product"] = $product;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
    			'product_title' => 'required|string|max:255',
				'description'   => 'required|string|max:255',
                'category'	    => 'required',
                'picture'       => 'string',
    		]);

    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
    		}

    		$data = new Product();
	        $data->product_title = $request->input('product_title');
	        $data->description = $request->input('description');
	        $data->category = $request->input('category');
	        $data->picture = $request->input('picture');
	        $data->save();

    		return response()->json([
    			'status'	=> '1',
    			'message'	=> 'Data Produk berhasil ditambahkan!'
    		], 201);

      } catch(\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
  	}


    public function update(Request $request, $id)
    {
      try {
      	$validator = Validator::make($request->all(), [
			'product_title' => 'required|string|max:255',
			'description'   => 'required|string|max:255',
            'category'	    => 'required',
            'picture'       => 'string',
		]);

      	if($validator->fails()){
      		return response()->json([
      			'status'	=> '0',
      			'message'	=> $validator->errors()
      		]);
      	}

      	//proses update data
      	$data = Product::where('id', $id)->first();
        $data->product_title = $request->input('product_title');
        $data->description = $request->input('description');
        $data->category = $request->input('category');
        $data->picture = $request->input('picture');
        $data->save();

      	return response()->json([
      		'status'	=> '1',
      		'message'	=> 'Data produk berhasil diubah'
      	]);
        
      } catch(\Exception $e){
          return response()->json([
              'status' => '0',
              'message' => $e->getMessage()
          ]);
      }
    }

    public function delete($id)
    {
        try{

            $delete = Product::where("id", $id)->delete();

            if($delete){
              return response([
              	"status"	=> 1,
                  "message"   => "Data produk berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data produk gagal dihapus."
              ]);
            }
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }

}
