<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Comment;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\Slide;
use App\Models\BillDetail;
use App\Models\User;

class PageController extends Controller
{   
    public function getIndex()
    {
        $slide = Slide::all();
        $new_product=Product::where('new',1)->paginate(4);
        $promotion_product=Product::where('promotion_price','<>',0)->paginate(8);
        return view('page.trangchu', compact('slide', 'new_product', 'promotion_product'));

}

    public function getLoaiSP($type)
    {
        $sp_theoloai = Product::where("id_type",$type)->get();
        $type_product = TypeProduct::all();
        $sp_khac = Product::where("id_type",'<>',$type)->paginate(3);
        return view('page.loai_sanpham', compact('sp_theoloai','type_product','sp_khac'));

    }

    public function getDetail(Request $request)
    {
        $sanpham = Product::where('id', $request->id)->first();
        $splienquan = Product::where('id', '<>', $sanpham->id, 'and', 'id_type', '=', $sanpham->id_type,)->paginate(3);
        $new_product  = Product::where('new', 1)
                            ->inRandomOrder() 
                            ->paginate(4);

        $bestseller = Product::where('best_seller', 1)
                        ->inRandomOrder() 
                        ->paginate(4);
        $comments = Comment::where('id_product', $request->id)->get();
        return view('page.chitiet_sanpham', compact('sanpham','splienquan', 'comments', 'bestseller', 'new_product'));
    }

    public function getContact() 
    {
        return view('page.lienhe');
    }

    public function getAbout() 
    {
        return view('page.about');
    }

    public function getIndexAdmin() 
    {
        $products = Product::all();
        return view('pageadmin.admin')->with(['products'=>$products, 'sumSold'=>count(BillDetail::all())]);
    }

    public function getAdminAdd() 
    {
        return view('pageadmin.formAdd');
    }
    
    public function postAdminAdd(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName('inputImage');
            $file->move('source/image/product', $fileName);
        }
        $file_name = null;
        if ($request->file('inputImage') != null) {
            $file_name = $request->file('inputImage')->getClientOriginalName();
        }

        $product->name = $request->inputName;
        $product->image = $file_name;
        $product->description = $request->inputDescription;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputPromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new = $request->inputNew;
        $product->id_type = $request->inputType;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function getAdminEdit($id)
    {
        $product = Product::find($id);
        return view('pageadmin.formEdit')->with('product',$product);
    }

    public function postAdminEdit(Request $request)
    {
        $id = $request->editId;

        $product = Product::find($id);
        if ($request->hasFile('editImage')) {
            $file = $request->file('editImage');
            $fileName = $file->getClientOriginalName('editImage');
            $file->move('source/image/product', $fileName);
        }
        
        if ($request->file('editImage') != null) {
            $product->image = $fileName;
        }

        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function postAdminDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->getIndexAdmin();
    }

   
    public function postSearch(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', "%$query%")
                            ->orWhere('description', 'like', "%$query%")
                            ->paginate(4);
        return view('page.search', compact('products'));
    }

}
