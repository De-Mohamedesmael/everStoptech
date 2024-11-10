<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductClass;
use App\Models\ProductStore;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('back-end.products.categories.index')->with(compact(
            'categories'
        ));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategories()
    {
        $categories = Category::whereNotNull('parent_id')->get();

        return view('back-end.products.categories.sub_categories')->with(compact(
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $quick_add = $request->quick_add ?? null;
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        return view('back-end.products.categories.create')->with(compact(
            'quick_add',
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            ['name' => ['required', 'max:255']]
        );

        $category_exist = Category::where('name', $request->name)->exists();


        if ($category_exist) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => translate('There are incorect values in the form!'),
                    'msg' => translate('Category name already taken')
                ));
            }
        }
        try {
            $data = $request->except('_token', 'quick_add');
            $data['translations'] = !empty($data['translations']) ? $data['translations'] : [];

            DB::beginTransaction();
            $category = Category::create($data);

            if ($request->has("cropImages") && count($request->cropImages) > 0) {
                foreach ($request->cropImages as $imageData) {
                    $extention = explode(";",explode("/",$imageData)[1])[0];
                    $image = rand(1,1500)."_image.".$extention;
                    $filePath = public_path('uploads/' . $image);
                    $fp = file_put_contents($filePath,base64_decode(explode(",",$imageData)[1]));
                    $category->addMedia($filePath)->toMediaCollection('category');

                }
            }
            $category_id = $category->id;
            DB::commit();
            $output = [
                'success' => true,
                'category_id' => $category_id,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }


        if ($request->quick_add) {
            return $output;
        }

        return redirect()->back()->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $type = request()->type ?? null;
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $product_classes = ProductClass::orderBy('name', 'asc')->pluck('name', 'id');

        return view('back-end.products.categories.edit')->with(compact(
            'category',
            'type',
            'categories',
            'product_classes'
        ));
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
        $this->validate(
            $request,
            ['name' => ['required', 'max:255']]
        );

        try {
            $data = $request->except('_token', '_method');
            $data['translations'] = !empty($data['translations']) ? $data['translations'] : [];
            DB::beginTransaction();
            $category = Category::find($id);

            $category->update($data);
            if ($request->has("cropImages") && count($request->cropImages) > 0) {
                foreach ($this->getCroppedImages($request->cropImages) as $imageData) {
                    $category->clearMediaCollection('category');
                    $extention = explode(";",explode("/",$imageData)[1])[0];
                    $image = rand(1,1500)."_image.".$extention;
                    $filePath = public_path('uploads/' . $image);
                    $fp = file_put_contents($filePath,base64_decode(explode(",",$imageData)[1]));
                    $category->addMedia($filePath)->toMediaCollection('category');
                }
            }

            DB::commit();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return redirect()->back()->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Category::find($id)->delete();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return $output;
    }

    public function getDropdown()
    {

        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $categories_dp = $this->commonUtil->createDropdownHtml($categories);

        return $categories_dp;
    }




}
