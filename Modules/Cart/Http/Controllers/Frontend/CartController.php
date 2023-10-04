<?php

namespace Modules\Cart\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use Modules\Cart\Helpers\Cart ;;
// use App\Http\Controllers\Controller ;
use Illuminate\Routing\Controller;




class CartController extends Controller
{


    public function addToCart(Product $product)
    {

        if (Cart::has($product)) {
            if (Cart::count($product) < $product->inventory) {
                Cart::update($product, 1);
            }
        } else {
            Cart::put(
                [
                    'quantity' => 1,
                ],
                $product
            );
        }

        return redirect(route('cart'));
    }



    public function cart()
    {
        return view('cart::frontend.cart');
    }


    public function quantityChange(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required' ,
            'id' => 'required' , 
            'cart' => 'required'
        ]);

        $cart = Cart::instance($data['cart']);

        if($cart->has($data['id'])){


            $cart->update($data['id'] ,[
                'quantity' => $data['quantity']
            ]);
        }

        return response(['status' => 'error'] , 404);

    } 
    // public function quantityChange(Request $request)
    // {

        
    //     $data = $request->validate([
    //         'quantity' => 'required',
    //         'id' => 'required',
    //         'cart' => 'required'
    //     ]);

    //     $product = Cart::get($data['id'])['product'];

    //     if (Cart::has($data['id']) && !$data['quantity'] > $product->inventory) {

    //         Cart::update($data['id'], [
    //             'quantity' => $data['quantity']
    //         ]);

    //         return response(['status' => 'success']);
    //     }

    //     return response(['status' => 'error'], 404);
    // }




    public function deleteFromCart($id)
    {

        Cart::delete($id) ;
        return back();
    }
}
