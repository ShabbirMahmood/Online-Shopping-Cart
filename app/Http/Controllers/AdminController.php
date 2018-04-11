<?php
/**
 * Created by PhpStorm.
 * User: Shabbir Mahmood
 * Date: 08-Apr-18
 * Time: 7:41 PM
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;

class AdminController extends Controller
{
    public function AddProduct(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1',
            'fileToUpload' => 'required|image|mimes:jpeg,jpg,png|max:2500',
        ]);

        $file = $request->file('fileToUpload');

        $destinationPath="images/uploads";
        $fileName= time().'.'.$file->getClientOriginalExtension();
        $uploadSuccess = $file->move($destinationPath, $fileName);
        if($uploadSuccess){

            $dbVar = new Product();
            $dbVar->title = $request->title;
            $dbVar->description = $request->description;
            $dbVar->price = $request->price;
            $dbVar->code = time();
            $dbVar->stock = $request->stock;
            $dbVar->category = $request->category;
            $dbVar->imagePath = $fileName;

            $dbVar->save();

            return redirect()->route('product.index');
        }


        //Here just send a flush message for for someting wrong for storing picture
        $request->session()->flash('wrong', 'Something Went Wrong. Please Try Latter');
        return redirect()->back();
        return $request->all();
    }

    public function AddProductShow()
    {
        $dbVar = Category::all();
        return view('Admin.NewProduct')->with('Categories',$dbVar);
    }

    public function DeleteProduct($id)
    {
        $dbVar = Product::find($id);
        $dbVar->Delete();
        return redirect()->route('product.index');

    }

    public function AddCategoryShow()
    {
        $dbVar = Category::all();
        return view('Admin.category')->with('Categories',$dbVar);
    }

    public function AddCategory(Request $request)
    {
        $this->validate( $request,[
            'category' => 'required|string|max:145|unique:categories',
        ]);
        $dbVar = new category();
        $dbVar->category = $request->category;
        $dbVar->save();
        return redirect(route('AddCategory'));
    }

    public function AllOrder()
    {
        $dbvar = Order::with('user')->get();

        $dbvar2 = $dbvar->map(function($i) {
            $i->cart = unserialize($i->cart);
            return $i;
        });

        //return $dbvar2;

        return view('Admin.order')->with('shipments',$dbvar2);
    }

    public function ShipmentProduct($id)
    {
        $dbVar = Order::find($id);
        $dbVar->Delete();
        return redirect()->route('AllOrder');

    }
}