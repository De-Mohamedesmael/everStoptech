<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\AddStockLine;
use App\Models\Brand;
use App\Models\Printer;
use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\ExpenseBeneficiary;
use App\Models\ExpenseCategory;
use App\Models\Product;
use App\Models\ProductDiscount;
use App\Models\ProductExpiryDamage;
use App\Models\ProductStore;
use App\Models\Size;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use App\Models\Tax;
use App\Models\Transaction;
use App\Models\Admin;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Lang;
use Illuminate\Support\Facades\Cache;
class ProductController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;
    protected $productUtil;
    protected $transactionUtil;

    /**
     * Constructor
     *
     * @param transactionUtil $transactionUtil
     * @param Util $commonUtil
     * @param ProductUtil $productUtil
     * @return void
     */
    public function __construct(Util $commonUtil, ProductUtil $productUtil, TransactionUtil $transactionUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->productUtil = $productUtil;
        $this->transactionUtil = $transactionUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductStocks(Request $request)
    {
        $categories = Category::whereNull('parent_id')->orderBy('name', 'asc')->pluck('name', 'id');
        $sub_categories = Category::whereNotNull('parent_id')->orderBy('name', 'asc')->pluck('name', 'id');
        $brands = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $colors = Color::orderBy('name', 'asc')->pluck('name', 'id');
        $sizes = Size::orderBy('name', 'asc')->pluck('name', 'id');
        $taxes = Tax::orderBy('name', 'asc')->pluck('name', 'id');
        $customers = Customer::orderBy('name', 'asc')->pluck('name', 'id');
        $customer_types = CustomerType::orderBy('name', 'asc')->pluck('name', 'id');
        $discount_customer_types = Customer::getCustomerTreeArray();
        $stores  = Store::getDropdown();
        $admins  = Admin::orderBy('name', 'asc')->pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        $page = 'product_stock';

        return view('back-end.products.index')->with(compact(
            'admins',
            'categories',
            'sub_categories',
            'brands',
            'colors',
            'sizes',
            'taxes',
            'customers',
            'customer_types',
            'discount_customer_types',
            'stores',
            'suppliers',
            'page'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $process_type = $request->process_type??null;
        if (request()->ajax()) {
            $products = Product::leftjoin('add_stock_lines', function ($join) {
                    $join->on('products.id', 'add_stock_lines.product_id')->where('add_stock_lines.expiry_date', '>=', date('Y-m-d'));
                })
                ->leftjoin('colors', 'products.color_id', 'colors.id')
                ->leftjoin('sizes', 'products.size_id', 'sizes.id')
                ->leftjoin('brands', 'products.brand_id', 'brands.id')
                ->leftjoin('supplier_products', 'products.id', 'supplier_products.product_id')
                ->leftjoin('admins', 'products.created_by', 'admins.id')
                ->leftjoin('admins as edited', 'products.edited_by', 'admins.id')
                ->leftjoin('taxes', 'products.tax_id', 'taxes.id')
                ->leftjoin('product_stores', 'products.id', 'product_stores.product_id');

            $store_id = $this->transactionUtil->getFilterOptionValues($request)['store_id'];

            $store_query = '';
            if (!empty($store_id)) {
                // $products->where('product_stores.store_id', $store_id);
                $store_query = 'AND store_id=' . $store_id;
            }

            if (!empty(request()->product_id)) {
                $products->where('products.id', request()->product_id);
            }
            if (!empty(request()->category_id) && request()->category_id[0] != null) {
                $products->wherehas('categories', function($q){
                    $q->wherein('categories.id', request()->category_id);
                });
            }

            if (!empty(request()->tax_id)) {
                $products->where('tax_id', request()->tax_id);
            }

            if (!empty(request()->brand_id)) {
                $products->where('products.brand_id', request()->brand_id);
            }

            if (!empty(request()->supplier_id)) {
                $products->where('supplier_products.supplier_id', request()->supplier_id);
            }

            if (!empty(request()->unit_id)) {
                $products->where('products.unit_id', request()->unit_id);
            }

            if (!empty(request()->color_id)) {
                $products->where('products.color_id', request()->color_id);
            }

            if (!empty(request()->size_id)) {
                $products->where('products.size_id', request()->size_id);
            }

            if (!empty(request()->grade_id)) {
                $products->where('products.grade_id', request()->grade_id);
            }

            if (!empty(request()->customer_type_id)) {
                $products->whereJsonContains('show_to_customer_types', request()->customer_type_id);
            }

            if (!empty(request()->created_by)) {
                $products->where('products.created_by', request()->created_by);
            }
            if (request()->active == '1' || request()->active == '0') {
                $products->where('products.active', request()->active);
            }
            if (request()->show_zero_stocks == '0') {
                $products->where('is_service', 0)->havingRaw('(SELECT SUM(product_stores.qty_available) FROM product_stores JOIN products as v ON product_stores.product_id=v.id WHERE v.id=products.id ' . $store_query . ') > ?', [0]);
            }


            $is_add_stock = request()->is_add_stock;
            $products = $products->select(
                'products.*',
                'add_stock_lines.batch_number',
                'brands.name as brand',
                'colors.name as color',
                'sizes.name as size',
                'taxes.name as tax',
                'add_stock_lines.expiry_date as exp_date',
                'add_stock_lines.manufacturing_date as manufacturing_date',
                'admins.name as created_by_name',
                'edited.name as edited_by_name',
                DB::raw('(SELECT SUM(product_stores.qty_available) FROM product_stores JOIN products as v ON product_stores.product_id=v.id WHERE v.id=products.id ' . $store_query . ') as current_stock'),
            )->with(['supplier'])->groupBy('products.id');

            //  return $products_;
            return DataTables::of($products)
                ->addColumn('show_at_the_main_pos_page', function ($row) {
                    if (!empty($row->show_at_the_main_pos_page)&& $row->show_at_the_main_pos_page=="yes"){
                        $checked='checked';
                    }else{
                        $checked='';
                    }
                    return ' <input id="show_at_the_main_pos_page'.$row->id.'" data-id='.$row->id.' name="show_at_the_main_pos_page" type="checkbox"
                    '. $checked .' value="1" class="show_at_the_main_pos_page">';
                })
                ->addColumn('image', function ($row) {
                    $image = $row->getFirstMediaUrl('products');
                    if (!empty($image)) {
                        return '<img src="' . $image . '" height="50px" width="50px">';
                    } else {
                        return '<img src="' . asset('/uploads/' . session('logo')) . '" height="50px" width="50px">';
                    }
                })
                ->editColumn('is_service',function ($row) {
                    return $row->is_service=='1'?'<span class="badge badge-danger">'.Lang::get('lang.is_have_service').'</span>':'';
                })
                ->addColumn('categories_names', function ($row){
                    $html='';
                    foreach ($row->categories as $key => $category) {
                        $html.= '<span class="category_name">'.( $key > 0 ?' - ':'').$category->name.'</span>';
                    }
                   return $html;
                })
                ->addColumn('purchase_history', function ($row) {
                    $html = '<a data-href="' . action('ProductController@getPurchaseHistory', $row->id) . '"
                    data-container=".view_modal" class="btn btn-modal">' . __('lang.view') . '</a>';
                    return $html;
                })
                ->editColumn('batch_number', '{{$batch_number}}')
                ->editColumn('default_sell_price', function ($row) {
                    $price= AddStockLine::where('product_id',$row->product_id)
                    ->whereHas('transaction', function ($query) {
                        $query->where('type', '!=', 'supplier_service');
                    })
                    ->latest()->first();
                    $price= $price? ($price->sell_price > 0 ? $price->sell_price : $row->default_sell_price):$row->default_sell_price;
                    return number_format($price,2);
                })//, '{{@num_format($default_sell_price)}}')
                ->editColumn('default_purchase_price', function ($row) {
                    $price= AddStockLine::where('product_id',$row->product_id)
                    ->whereHas('transaction', function ($query) {
                        $query->where('type', '!=', 'supplier_service');
                    })
                    ->latest()->first();
                    $price= $price? ($price->purchase_price > 0 ? $price->purchase_price : $row->default_purchase_price):$row->default_purchase_price;

                    return number_format($price,2);
                })
                ->addColumn('tax', '{{$tax}}')
                ->editColumn('brand', '{{$brand}}')
                ->editColumn('color', function ($row){
                    return  $row->color;

                })
                ->editColumn('size', function ($row){
                    return $row->size;
                })
                ->editColumn('current_stock', function ($row) {
                    if(!$row->is_service)
                        return $this->productUtil->num_f($row->current_stock ,false,null,true);
                    return 0;
                })
                ->addColumn('current_stock_value', function ($row) {
                    $price= AddStockLine::where('product_id',$row->product_id)
                    ->whereHas('transaction', function ($query) {
                        $query->where('type', '!=', 'supplier_service');
                    })
                    ->latest()->first();
                    $price= $price? ($price->purchase_price > 0 ? $price->purchase_price : $row->default_purchase_price):$row->default_purchase_price;
                    return $this->productUtil->num_f($row->current_stock * $price);
                })
                ->addColumn('customer_type', function ($row) {
                    return $row->customer_type;
                })
                ->editColumn('exp_date', '@if(!empty($exp_date)){{@format_date($exp_date)}}@endif')
                ->addColumn('manufacturing_date', '@if(!empty($manufacturing_date)){{@format_date($manufacturing_date)}}@endif')
                ->editColumn('discount',function ($row) {
                    $discount_text='';
                    $discounts= ProductDiscount::where('product_id',$row->id)->get();
                    foreach ($discounts as $k=>$discount){
                        if($k != 0){
                            $discount_text.=' - ';
                        }
                        $discount_text.= $discount->discount;
                    }
                    return $discount_text;
                })
                ->editColumn('active', function ($row) {
                    if ($row->active) {
                        return __('lang.yes');
                    } else {
                        return __('lang.no');
                    }
                })
                ->editColumn('created_by', '{{$created_by_name}}')
                ->editColumn('created_at', '{{@format_datetime($created_at)}}')
                ->editColumn('updated_at', '{{@format_datetime($updated_at)}}')
                ->addColumn('selection_checkbox', function ($row) use ($is_add_stock) {
                    if ($is_add_stock == 1 && $row->is_service == 1) {
                        $html = '<input type="checkbox" name="product_selected" disabled class="product_selected" value="' . $row->product_id . '" data-product_id="' . $row->id . '" />';

                    } else {
                        if ($row->current_stock >= 0 ) {
                            $html = '<input type="checkbox" name="product_selected" class="product_selected" value="' . $row->product_id . '" data-product_id="' . $row->id . '" />';
                        } else {
                            $html = '<input type="checkbox" name="product_selected" disabled class="product_selected" value="' . $row->product_id . '" data-product_id="' . $row->id . '" />';
                        }
                    }
                    return $html;

                })->addColumn('selection_checkbox_send', function ($row)  {
                    $html = '<input type="checkbox" name="product_selected_send" class="product_selected_send" value="' . $row->product_id . '" data-product_id="' . $row->id . '" />';

                    return $html;
                })
                ->addColumn('selection_checkbox_delete', function ($row)  {
                    $html = '<input type="checkbox" name="product_selected_delete" class="product_selected_delete" value="' . $row->product_id . '" data-product_id="' . $row->id . '" />';


                    return $html;
                })
                ->addColumn(
                    'action',
                    function ($row) {
                        if($row->parent_branch_id != null ){
                            return '';
                        }
                        $html =
                            '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">' . __('lang.action') .
                            '<span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">';

                        if (auth()->user()->can('product_module.products.view')) {
                            $html .=
                                '<li><a data-href="' . action('ProductController@show', $row->id) . '"
                                data-container=".view_modal" class="btn btn-modal"><i class="fa fa-eye"></i>
                                ' . __('lang.view') . '</a></li>';
                        }
//                        if (auth()->user()->can('product_module.products.remove_expiry')) {
                            $html .=
                                '<li><a target="_blank" href="' . action('ProductController@get_remove_expiry', $row->id) . '"
                                 class="btn"><i class="fa fa-hourglass-half"></i>
                                ' . __('lang.remove_expiry') . '</a></li>';
//                        }
//                        if (auth()->user()->can('product_module.products.remove_damage')) {
                            $html .=
                                '<li><a target="_blank" href="' . action('ProductController@get_remove_damage', $row->id) . '"
                                 class="btn"><i class="fa fa-filter"></i>
                                ' . __('lang.remove_damage') . '</a></li>';
//                        }
                        if (auth()->user()->can('product_module.products.create_and_edit')) {
                            $html .=
                                '<li><a href="' . action('ProductController@edit', $row->id) . '" class="btn"
                            target="_blank"><i class="dripicons-document-edit"></i> ' . __('lang.edit') . '</a></li>';
                        }
                        if (auth()->user()->can('stock.add_stock.create_and_edit')) {
                            $html .=
                                '<li><a target="_blank" href="' . action('AddStockController@create', ['product_id' => $row->product_id, 'product_id' => $row->id]) . '" class="btn"
                            target="_blank"><i class="fa fa-plus"></i> ' . __('lang.add_new_stock') . '</a></li>';
                        }
                        if (auth()->user()->can('product_module.products.delete')) {

                            $html .=
                                '<li>
                            <a data-href="' . action('ProductController@destroy', $row->id??0) . '"
                                data-check_password="' . action('AdminController@checkPassword', Auth::user()->id) . '"
                                class="btn text-red delete_product"><i class="fa fa-trash"></i>
                                ' . __('lang.delete') . '</a>
                        </li>';
                        }

                        $html .= '</ul></div>';

                        return $html;
                    }
                )

                ->setRowAttr([
                    'data-href' => function ($row) {
                        if (auth()->user()->can("products.view")) {
                            return  action('ProductController@show', [$row->id]);
                        } else {
                            return '';
                        }
                    }
                ])
                ->rawColumns([
                    'show_at_the_main_pos_page',
                    'selection_checkbox',
                    'selection_checkbox_send',
                    'selection_checkbox_delete',
                    'categories_names',
                    'default_purchase_price',
                    'image',
                    'sku',
                    'purchase_history',
                    'batch_number',
                    'sell_price',
                    'tax',
                    'brand',
                    'unit',
                    'color',
                    'size',
                    'grade',
                    'is_service',
                    'customer_type',
                    'expiry',
                    'manufacturing_date',
                    'discount',
                    'purchase_price',
                    'created_by',
                    'action',
                ])
                ->make(true);
        }
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $brands = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $colors = Color::orderBy('name', 'asc')->pluck('name', 'id');
        $sizes = Size::orderBy('name', 'asc')->pluck('name', 'id');
        $taxes = Tax::where('type', 'product_tax')
            ->orderBy('name', 'asc')->pluck('name', 'id');
        $customers = Customer::orderBy('name', 'asc')->pluck('name', 'id');
        $customer_types = CustomerType::orderBy('name', 'asc')->pluck('name', 'id');
        $discount_customer_types = Customer::getCustomerTreeArray();
        $suppliers = Supplier::pluck('name', 'id');

        $stores  = Store::getDropdown();
        $admins = Admin::pluck('name', 'id');

        return view('back-end.products.index')->with(compact(
            'categories',
            'brands',
            'colors',
            'sizes',
            'taxes',
            'customers',
            'customer_types',
            'discount_customer_types',
            'admins',
            'stores',
            'suppliers'
        ));
    }

    public function get_remove_damage(Request $request,$id){
        $product_damages = ProductExpiryDamage::where("product_id",$id)->where("status","damage")->get();
        $status = "damage";
        return view('back-end.product_expiry_damage.product_damage_index')->with(compact( 'product_damages', 'status' ,'id' ));
    }
    public function get_remove_expiry(Request $request,$id){
        $product_expires = ProductExpiryDamage::where("product_id",$id)->where("status","expiry")->get();
        $status = "expiry";
        return view('back-end.product_expiry_damage.product_expiry_index')->with(compact('product_expires','status','id'));
    }
    public function getDamageProduct(Request $request,$id){
        if (request()->ajax()) {
            $addStockLines = AddStockLine::
            where("add_stock_lines.product_id",$id)
                ->where("add_stock_lines.quantity",">",0 )
                ->leftjoin('products', function ($join) {
                    $join->on('add_stock_lines.product_id', 'products.id')->whereNull('products.deleted_at');
                });
            $store_id = $this->transactionUtil->getFilterOptionValues($request)['store_id'];
            $store_query = '';
            if (!empty($store_id)) {
                // $products_->where('product_stores.store_id', $store_id);
                $store_query = 'AND store_id=' . $store_id;
            }
            $addStockLines = $addStockLines->select(
                'add_stock_lines.*',
                'add_stock_lines.expiry_date as exp_date',
                'add_stock_lines.created_at as date_of_purchase_of_the_expired_stock_removed',
                'add_stock_lines.purchase_price as add_stock_line_purchase_price',
                'add_stock_lines.purchase_price as add_stock_line_avg_purchase_price',
                'products.sku',
                'products.name as product_name',
                DB::raw('(SELECT SUM(add_stock_lines.quantity)  FROM add_stock_lines  JOIN products as v ON add_stock_lines.product_id=v.id WHERE v.id=products.id ' . $store_query . '  ) as avail_current_stock'),
                DB::raw('(SELECT AVG(add_stock_lines.purchase_price) FROM add_stock_lines JOIN products as v ON add_stock_lines.product_id=v.id WHERE v.id=products.id ' . $store_query . ') as avg_purchase_price'),
                DB::raw('(add_stock_lines.quantity - add_stock_lines.quantity_sold) as expired_current_stock'),
            )->groupBy('add_stock_lines.id');

            return DataTables::of($addStockLines)
                ->addColumn('image', function ($row) {
                    $image = $row->product->getFirstMediaUrl('products');
                    if (!empty($image)) {
                        return '<img src="' . $image . '" height="50px" width="50px">';
                    } else {
                        return '<img src="' . asset('/uploads/' . session('logo')) . '" height="50px" width="50px">';
                    }
                })
                ->editColumn('product_name' , function ($row) {
                    if ($row->product->name != "Default"){
                        return  $row->product->name;
                    }else{
                        return  "Default";
                    }
                })
                ->editColumn('sub_sku', '{{$sub_sku}}')
                ->editColumn('avail_current_stock', '{{@num_format($avail_current_stock - $expired_current_stock)  }}')
                ->editColumn('expired_current_stock', '{{$expired_current_stock}}')
                ->editColumn('exp_date', '{{$exp_date}}')
                ->editColumn('avg_purchase_price', '{{@num_format($avg_purchase_price)}}')
                ->editColumn('date_of_purchase_of_the_expired_stock_removed', '{{$date_of_purchase_of_the_expired_stock_removed}}')
                ->editColumn('quantity_of_expired_stock_removed', '@if(isset($quantity_of_expired_stock_removed)){{$quantity_of_expired_stock_removed}} @else {{0}}@endif')
                ->editColumn('value_of_removed_stocks', '@if(isset($value_of_removed_stocks)){{$value_of_removed_stocks}} @else {{0}}@endif')
                ->addColumn('avg_purchase_price', '{{@num_format($avg_purchase_price)}}')
                ->addColumn('value_of_removed_stock', '{{0}}')
                ->rawColumns([
                    'image'
                ])->make(true);
        }
        return view("product_expiry_damage.add_damage_product");
    }
    public function storeStockDamaged(Request $request){
        foreach ($request->selected_data as $data){
            $stockRow = AddStockLine::find($data["id"]);
            $variation = Variation::find($data["variation_id"]);
            $stockRow->decrement("quantity",$data["quantity_to_be_removed"]);
            $store = ProductStore::where("variation_id",$variation->id)->where("product_id",$variation->product_id)->first();
            $this->productUtil->decreaseProductQuantity($variation->product_id,$variation->id,$store->store_id,$data["quantity_to_be_removed"]);
            $stockRow->increment("quantity_damaged",$data["quantity_to_be_removed"]);
            if ($data["quantity_to_be_removed"] > 0){
                $productExpiry = ProductExpiryDamage::query()->create([
                    "status" => $data["status"],
                    "product_id" =>$variation->product_id,
                    "variation_id" =>$variation->id,
                    "quantity_of_expired_stock_removed" =>$data["quantity_to_be_removed"],
                    "date_of_purchase_of_expired_stock_removed" => Carbon::parse($data["date_of_purchase_of_expired_stock_removed"])->toDateTimeString(),
                    "value_of_removed_stocks" => $data["value_of_removed_stocks"],
                    "added_by" => auth()->id(),
                ]);
                $expenses_category = ExpenseCategory::where('name','Damage')->orWhere('name','damage')->first();
                if(!$expenses_category){
                    $expenses_category = ExpenseCategory::create([
                        'name' => 'Damage',
                        'created_by' => 1
                    ]);
                }
                $expenses_beneficiary = ExpenseBeneficiary::where('name','expiry products_')->first();
                if(!$expenses_beneficiary){
                    $expenses_beneficiary = ExpenseBeneficiary::create([
                        'name' => 'damage products_',
                        'expense_category_id' => $expenses_category->id,
                        'created_by' => 1,
                    ]);
                }

                Transaction::create([
                    'grand_total' => $this->commonUtil->num_uf($request->total_shortage_value),
                    'final_total' => $this->commonUtil->num_uf($request->total_shortage_value),
                    'store_id' => $store->store_id,
                    'type' => 'expense',
                    'status' => 'final',
                    'invoice_no' => $this->productUtil->getNumberByType('expense'),
                    'transaction_date' =>$productExpiry->created_at,
                    'expense_category_id' => $expenses_category->id,
                    'expense_beneficiary_id' => $expenses_beneficiary->id,
                    'source_id' => 1,
                    'source_type' => 'store',
                    'created_by' => auth()->id(),
                ]);
            }

        }
    }
    public function addConvolution(Request $request,$id){
        if (request()->ajax()) {
            $addStockLines = AddStockLine::
            where("add_stock_lines.product_id",$id)
                ->where("add_stock_lines.expiry_date","<",date('Y-m-d'))
                ->where("add_stock_lines.quantity",">",0 )
                ->whereNotNull("add_stock_lines.expiry_date")
                ->leftjoin('variations', function ($join) {
                    $join->on('add_stock_lines.variation_id', 'variations.id')->whereNull('variations.deleted_at');
                });
            $store_id = $this->transactionUtil->getFilterOptionValues($request)['store_id'];
            $store_query = '';
            if (!empty($store_id)) {
                // $products_->where('product_stores.store_id', $store_id);
                $store_query = 'AND store_id=' . $store_id;
            }
            $addStockLines = $addStockLines->select(
                'add_stock_lines.*',
                'add_stock_lines.expiry_date as exp_date',
                'add_stock_lines.created_at as date_of_purchase_of_the_expired_stock_removed',
                'add_stock_lines.purchase_price as add_stock_line_purchase_price',
                'add_stock_lines.purchase_price as add_stock_line_avg_purchase_price',
                'variations.sub_sku',
                'variations.name as variation_name',
                DB::raw('(SELECT SUM(add_stock_lines.quantity)  FROM add_stock_lines  JOIN variations as v ON add_stock_lines.variation_id=v.id WHERE v.id=variations.id ' . $store_query . '  ) as avail_current_stock'),
                DB::raw('(SELECT AVG(add_stock_lines.purchase_price) FROM add_stock_lines JOIN variations as v ON add_stock_lines.variation_id=v.id WHERE v.id=variations.id ' . $store_query . ') as avg_purchase_price'),
                DB::raw('(add_stock_lines.quantity - add_stock_lines.quantity_sold) as expired_current_stock'),
            )->groupBy('add_stock_lines.id');

            return DataTables::of($addStockLines)
                ->addColumn('image', function ($row) {
                    $image = $row->product->getFirstMediaUrl('products');
                    if (!empty($image)) {
                        return '<img src="' . $image . '" height="50px" width="50px">';
                    } else {
                        return '<img src="' . asset('/uploads/' . session('logo')) . '" height="50px" width="50px">';
                    }
                })
                ->editColumn('variation_name' , function ($row) {
                    if ($row->variation->name != "Default"){
                        return  $row->variation->name;
                    }else{
                        return  "Default";
                    }
                })
                ->editColumn('sub_sku', '{{$sub_sku}}')
                ->editColumn('avail_current_stock', '{{@num_format($avail_current_stock - $expired_current_stock)  }}')
                ->editColumn('expired_current_stock', '{{$expired_current_stock}}')
                ->editColumn('exp_date', '{{$exp_date}}')
                ->editColumn('avg_purchase_price', '{{@num_format($avg_purchase_price)}}')
                ->editColumn('date_of_purchase_of_the_expired_stock_removed', '{{$date_of_purchase_of_the_expired_stock_removed}}')
                ->editColumn('quantity_of_expired_stock_removed', '@if(isset($quantity_of_expired_stock_removed)){{$quantity_of_expired_stock_removed}} @else {{0}}@endif')
                ->editColumn('value_of_removed_stocks', '@if(isset($value_of_removed_stocks)){{$value_of_removed_stocks}} @else {{0}}@endif')
                ->addColumn('avg_purchase_price', '{{@num_format($avg_purchase_price)}}')
                ->addColumn('value_of_removed_stock', '{{0}}')
                ->rawColumns([
                    'image'
                ])->make(true);
        }
        return view("product_expiry_damage.create");
    }
    public function storeStockRemoved(Request $request){
        foreach ($request->selected_data as $data){
            $stockRow = AddStockLine::find($data["id"]);
            $variation = Variation::find($data["variation_id"]);
           $stockRow->decrement("quantity",$data["quantity_to_be_removed"]);
           $store = ProductStore::where("variation_id",$variation->id)->where("product_id",$variation->product_id)->first();
           $this->productUtil->decreaseProductQuantity($variation->product_id,$variation->id,$store->store_id,$data["quantity_to_be_removed"]);
           if ($data["quantity_to_be_removed"] > 0){
               $productExpiry = ProductExpiryDamage::query()->create([
                   "status" => $data["status"],
                   "product_id" =>$variation->product_id,
                   "variation_id" =>$variation->id,
                   "quantity_of_expired_stock_removed" =>$data["quantity_to_be_removed"],
                   "date_of_purchase_of_expired_stock_removed" => Carbon::parse($data["date_of_purchase_of_expired_stock_removed"])->toDateTimeString(),
                   "value_of_removed_stocks" => $data["value_of_removed_stocks"],
                   "added_by" => auth()->id(),
               ]);
               $expenses_category = ExpenseCategory::where('name','Expiry')->orWhere('name','expiry')->first();
                if(!$expenses_category){
                    $expenses_category = ExpenseCategory::create([
                        'name' => 'Expiry',
                        'created_by' => 1
                    ]);
                }
                $expenses_beneficiary = ExpenseBeneficiary::where('name','expiry products_')->first();
                if(!$expenses_beneficiary){
                    $expenses_beneficiary = ExpenseBeneficiary::create([
                        'name' => 'expiry products_',
                        'expense_category_id' => $expenses_category->id,
                        'created_by' => 1,
                    ]);
                }

                Transaction::create([
                    'grand_total' => $this->commonUtil->num_uf($request->total_shortage_value),
                    'final_total' => $this->commonUtil->num_uf($request->total_shortage_value),
                    'store_id' => $store->store_id,
                    'type' => 'expense',
                    'status' => 'final',
                    'invoice_no' => $this->productUtil->getNumberByType('expense'),
                    'transaction_date' =>$productExpiry->created_at,
                    'expense_category_id' => $expenses_category->id,
                    'expense_beneficiary_id' => $expenses_beneficiary->id,
                    'source_id' => 1,
                    'source_type' => 'store',
                    'created_by' => auth()->id(),
                ]);
           }

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('product_module.products.create_and_edit')) {
            abort(403, translate('Unauthorized action.'));
        }

        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $brands = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $colors = Color::orderBy('name', 'asc')->pluck('name', 'id');
        $sizes = Size::orderBy('name', 'asc')->pluck('name', 'id');
        $taxes = Tax::where('type', 'product_tax')->orderBy('name', 'asc')->pluck('name', 'id');
        $customers = Customer::orderBy('name', 'asc')->pluck('name', 'id');
        $customer_types = CustomerType::orderBy('name', 'asc')->pluck('name', 'id');
        $discount_customer_types = CustomerType::pluck('name', 'id');
        $stores  = Store::all();
        $stores_select  = Store::getDropdown();
        $quick_add = request()->quick_add;
        $suppliers = Supplier::pluck('name', 'id');

        if ($quick_add) {
            return view('back-end.products.create_quick_add')->with(compact(
                'quick_add',
                'suppliers',
                'categories',
                'brands',
                'colors',
                'sizes',
                'stores_select',
                'taxes',
                'customers',
                'customer_types',
                'discount_customer_types',
                'stores'
            ));
        }

        return view('back-end.products.create')->with(compact(
            'suppliers',
            'categories',
            'brands',
            'colors',
            'sizes',
            'taxes',
            'stores_select',
            'customers',
            'customer_types',
            'discount_customer_types',
            'stores'
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

        if (!auth()->user()->can('product_module.products.create_and_edit')) {
            abort(403, translate('Unauthorized action.'));
        }
        $this->validate(
            $request,
            ['name' => ['required', 'max:255']],
            ['store_ids' => ['required']],
        );
        DB::beginTransaction();

        try {
            $product_data = [
                'name' => $request->name,
                'translations' => !empty($request->translations) ? $request->translations : [],
                'brand_id' => $request->brand_id,
                'sku' => !empty($request->sku) ? $request->sku : $this->productUtil->generateSku($request->name),
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'is_service' => !empty($request->is_service) ? 1 : 0,
                'barcode_type' => $request->barcode_type ?? 'C128',
                'alert_quantity' => $request->alert_quantity,
                'tax_id' => $request->tax_id,
                'tax_method' => $request->tax_method,
                'show_to_customer' => !empty($request->show_to_customer) ? 1 : 0,
                'show_to_customer_types' => $request->show_to_customer_types,
                'different_prices_for_stores' => !empty($request->different_prices_for_stores) ? 1 : 0,
                'automatic_consumption' => !empty($request->automatic_consumption) ? 1 : 0,
                'buy_from_supplier' =>  0,
                'active' => !empty($request->active) ? 1 : 0,
                'created_by' => Auth::user()->id,
                'show_at_the_main_pos_page' => !empty($request->show_at_the_main_pos_page) ? 'yes' : 'no',
                'weighing_scale_barcode' => !empty($request->weighing_scale_barcode) ? 1 : 0
            ];


            $product = Product::create($product_data);
            $index_discounts=[];
            if($request->has('discount_type')){
                if(count($request->discount_type)>0){
                    $index_discounts=array_keys($request->discount_type);
                }
            }


                foreach ($index_discounts as $index_discount){
                    $discount_customers = $this->getDiscountCustomerFromType($request->get('discount_customer_types_'.$index_discount));
                    $data_des=[
                        'product_id' => $product->id,
                        'discount_type' => $request->discount_type[$index_discount],
                        'discount_category' => $request->discount_category[$index_discount],
                        'is_discount_permenant'=>!empty($request->is_discount_permenant[$index_discount])? 1 : 0,
                        'discount_customer_types' => $request->get('discount_customer_types_'.$index_discount),
                        'discount_customers' => $discount_customers,
                        'discount' => $this->commonUtil->num_uf($request->discount[$index_discount]),
                        'discount_start_date' => !empty($request->discount_start_date[$index_discount]) ? $this->commonUtil->uf_date($request->discount_start_date[$index_discount]) : null,
                        'discount_end_date' => !empty($request->discount_end_date[$index_discount]) ? $this->commonUtil->uf_date($request->discount_end_date[$index_discount]) : null
                    ];

                    ProductDiscount::create($data_des);
                }

            if ($request->has("cropImages") && count($request->cropImages) > 0) {
                foreach ($request->cropImages as $imageData) {
                    $extention = explode(";",explode("/",$imageData)[1])[0];
                    $image = rand(1,1500)."_image.".$extention;
                    $filePath = public_path('uploads/' . $image);
                    $fp = file_put_contents($filePath,base64_decode(explode(",",$imageData)[1]));
                    $product->addMedia($filePath)->toMediaCollection('products');
                }
            }
            if (!empty($request->supplier_id)) {
                SupplierProduct::updateOrCreate(
                    ['product_id' => $product->id, 'supplier_id' => $request->supplier_id]
                );
            }


            if ($request->has('category_id')){
                $product->categories()->attach($request->category_id);
            }


            DB::commit();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return $output;
    }

    public function getDiscountCustomerFromType($customer_types)
    {

        $discount_customers = [];
        if (!empty($customer_types)) {
            $customers = Customer::whereIn('customer_type_id', $customer_types)->get();
            foreach ($customers as $customer) {
                $discount_customers[] = $customer->id;
            }
        }

        return $discount_customers;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('product_module.products.view')) {
            abort(403, translate('Unauthorized action.'));
        }

        $product = Product::find($id);

        $stock_detials = ProductStore::where('product_id', $id)->get();

        $add_stocks = Transaction::leftjoin('add_stock_lines', 'transactions.id', '=', 'add_stock_lines.transaction_id')
            ->where('transactions.type', '=', 'add_stock')
            ->where('add_stock_lines.product_id', '=', $id)
            ->whereNotNull('add_stock_lines.expiry_date')
            ->select(
                'transactions.*',
                'add_stock_lines.expiry_date',
                DB::raw('SUM(add_stock_lines.quantity - add_stock_lines.quantity_sold) as current_stock')
            )->groupBy('add_stock_lines.id')
            ->get();

        return view('back-end.products.show')->with(compact(
            'product',
            'stock_detials',
            'add_stocks',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('product_module.products.create_and_edit')) {
            abort(403, translate('Unauthorized action.'));
        }
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $brands = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $colors = Color::orderBy('name', 'asc')->pluck('name', 'id');
        $sizes = Size::orderBy('name', 'asc')->pluck('name', 'id');
        $taxes = Tax::where('type', 'product_tax')->orderBy('name', 'asc')->pluck('name', 'id');
        $customers = Customer::orderBy('name', 'asc')->pluck('name', 'id');
        $customer_types = CustomerType::orderBy('name', 'asc')->pluck('name', 'id');
        $discount_customer_types = CustomerType::pluck('name', 'id');
        $stores_select  = Store::getDropdown();

        $suppliers = Supplier::pluck('name', 'id');
        $stores_selected=$product->stores()->pluck( 'store_id')->toarray();
        $category_id_selected =$product->categories()->pluck( 'categories.id')->toarray();
        return view('back-end.products.edit')->with(compact(

            'product',
            'categories',
            'stores_select',
            'stores_selected',
            'category_id_selected',
            'brands',
            'colors',
            'sizes',
            'taxes',
            'customers',
            'customer_types',
            'discount_customer_types',
            'suppliers'
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

        if (!auth()->user()->can('product_module.products.create_and_edit')) {
            abort(403, translate('Unauthorized action.'));
        }

        $this->validate(
            $request,
            ['name' => ['required', 'max:255']],
            ['purchase_price' => ['required', 'max:25', 'decimal']],
            ['sell_price' => ['required', 'max:25', 'decimal']],
        );

        // try {
            $product_data = [
                'name' => $request->name,
                'translations' => !empty($request->translations) ? $request->translations : [],
                'product_class_id' => $request->product_class_id,
                'brand_id' => $request->brand_id,
                'sku' => $request->sku,
                'multiple_units' => $request->multiple_units,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'multiple_grades' => $request->multiple_grades,
                'is_service' => !empty($request->is_service) ? 1 : 0,
                'product_details' => $request->product_details,
                'barcode_type' => $request->barcode_type ?? 'C128',
                'alert_quantity' => $request->alert_quantity,
                'other_cost' => !empty($request->other_cost) ? $this->commonUtil->num_uf($request->other_cost) : 0,
                'purchase_price' => $this->commonUtil->num_uf($request->purchase_price),
                'sell_price' => $this->commonUtil->num_uf($request->sell_price),
                'tax_id' => $request->tax_id,
                'tax_method' => $request->tax_method,
                'discount_type' => null,
                'discount_customer_types' => null,
                'discount_customers' => null,
                'discount' => null,
                'discount_start_date' => null,
                'discount_end_date' =>  null,
                'show_to_customer' => !empty($request->show_to_customer) ? 1 : 0,
                'show_to_customer_types' => $request->show_to_customer_types,
                'different_prices_for_stores' => !empty($request->different_prices_for_stores) ? 1 : 0,
                'this_product_have_variant' => !empty($request->this_product_have_variant) ? 1 : 0,
                'price_based_on_raw_material' => !empty($request->price_based_on_raw_material) ? 1 : 0,
                'automatic_consumption' => !empty($request->automatic_consumption) ? 1 : 0,
                'buy_from_supplier' =>  0,
                'type' => !empty($request->this_product_have_variant) ? 'variable' : 'single',
                'active' => !empty($request->active) ? 1 : 0,
                'have_weight' => !empty($request->have_weight) ? 1 : 0,
                'edited_by' => Auth::user()->id,
                'show_at_the_main_pos_page' => !empty($request->show_at_the_main_pos_page) ? 'yes' : 'no',
                'weighing_scale_barcode' => !empty($request->weighing_scale_barcode) ? 1 : 0,
            ];


            DB::beginTransaction();
            $product = Product::find($id);
            $product->update($product_data);

            $this->productUtil->createOrUpdateVariations($product, $request);

            // $index_discounts=[];
            // $index_discounts_olds=[];
            // if($request->discount_type){
            //     if(count($request->discount_type)>0){
            //         $index_discounts=array_keys($request->discount_type);
            //         if($request->discount_ids != null ){
            //             $index_discounts_olds=array_keys($request->discount_ids);
            //             ProductDiscount::where('product_id',$products->id)->whereNotIn('id',$request->discount_ids)->delete();
            //         }else{
            //             ProductDiscount::where('product_id',$products->id)->delete();
            //         }
            //     }

            //     foreach ($index_discounts as $index_discount){
            //         $discount_customers = $this->getDiscountCustomerFromType($request->get('discount_customer_types_'.$index_discount));
            //         $data_des=[
            //             'product_id' => $products->id,
            //             'discount_type' => $request->discount_type[$index_discount],
            //             'discount_category' => $request->discount_category[$index_discount],
            //             'is_discount_permenant'=>!empty($request->is_discount_permenant[$index_discount])? 1 : 0,
            //             'discount_customer_types' => $request->get('discount_customer_types_'.$index_discount),
            //             'discount_customers' => $discount_customers,
            //             'discount' => $this->commonUtil->num_uf($request->discount[$index_discount]),
            //             'discount_start_date' => !empty($request->discount_start_date[$index_discount]) ? $this->commonUtil->uf_date($request->discount_start_date[$index_discount]) : null,
            //             'discount_end_date' => !empty($request->discount_end_date[$index_discount]) ? $this->commonUtil->uf_date($request->discount_end_date[$index_discount]) : null
            //         ];


            //         if(in_array($index_discount,$index_discounts_olds)){
            //             ProductDiscount::where('id',$request->discount_ids[$index_discount])->update($data_des);
            //         }else{
            //             ProductDiscount::create($data_des);
            //         }


            //     }



            // }else{
            //     ProductDiscount::where('product_id',$products->id)->delete();
            // }


            $index_discounts=[];
            ProductDiscount::where('product_id',$product->id)->delete();
            $index_discounts=[];
            if($request->has('discount_type')){
                if(count($request->discount_type)>0){
                    $index_discounts=array_keys($request->discount_type);
                }
            }


                foreach ($index_discounts as $index_discount){
                    $discount_customers = $this->getDiscountCustomerFromType($request->get('discount_customer_types_'.$index_discount));
                    $data_des=[
                        'product_id' => $product->id,
                        'discount_type' => $request->discount_type[$index_discount],
                        'discount_category' => $request->discount_category[$index_discount],
                        'is_discount_permenant'=>!empty($request->is_discount_permenant[$index_discount])? 1 : 0,
                        'discount_customer_types' => $request->get('discount_customer_types_'.$index_discount),
                        'discount_customers' => $discount_customers,
                        'discount' => $this->commonUtil->num_uf($request->discount[$index_discount]),
                        'discount_start_date' => !empty($request->discount_start_date[$index_discount]) ? $this->commonUtil->uf_date($request->discount_start_date[$index_discount]) : null,
                        'discount_end_date' => !empty($request->discount_end_date[$index_discount]) ? $this->commonUtil->uf_date($request->discount_end_date[$index_discount]) : null
                    ];

                    ProductDiscount::create($data_des);
                }



            if (!empty($request->consumption_details)) {
                $variations = $product->variations()->get();
                foreach ($variations as $variation) {
                    $this->productUtil->createOrUpdateRawMaterialToProduct($variation->id, $request->consumption_details);
                }
            }


            //////////////////////////
            if ($request->has("cropImages") && count($request->cropImages) > 0) {
                // Clear the media collection only once, before the loop
                $product->clearMediaCollection('products');

                foreach ($this->getCroppedImages($request->cropImages) as $imageData) {
                    $extention = explode(";", explode("/", $imageData)[1])[0];
                    $image = rand(1, 1500) . "_image." . $extention;
                    $filePath = public_path('uploads/' . $image);
                    $fp = file_put_contents($filePath, base64_decode(explode(",", $imageData)[1]));
                    $product->addMedia($filePath)->toMediaCollection('products');
                }
            }

            if (!isset($request->cropImages) || count($request->cropImages) == 0) {
                $product->clearMediaCollection('products');
            }
            //////////////////////////////////////
            //////////////////////////////////////
            if (!empty($request->supplier_id)) {
                SupplierProduct::updateOrCreate(
                    ['product_id' => $product->id],
                    ['supplier_id' => $request->supplier_id]
                );
            } else {
                SupplierProduct::where('product_id', $product->id)->delete();
            }


            DB::commit();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        // } catch (\Exception $e) {
        //     Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
        //     $output = [
        //         'success' => false,
        //         'msg' => __('lang.something_went_wrong')
        //     ];
        // }

        if ($request->ajax()) {
            return $output;
        } else {
            return redirect()->back()->with('status', $output);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('product_module.products.delete')) {
            abort(403, translate('Unauthorized action.'));
        }
        try {
            DB::beginTransaction();

            $product = Product::where('id', $id)->first();
            ProductStore::where('product_id', $id)->delete();
            $product->deleted_by= request()->user()->id;
            $product->save();
            $product->clearMediaCollection('products');
            $product->delete();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
            DB::commit();
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return $output;
    }

    public function getProducts()
    {
        if (request()->ajax()) {

            $term = request()->term;

            if (empty($term)) {
                return json_encode([]);
            }

            $q = Product::leftJoin(
                'variations',
                'products.id',
                '=',
                'variations.product_id'
            )
                ->where(function ($query) use ($term) {
                    $query->where('products.name', 'like', '%' . $term . '%');
                    $query->orWhere('sku', 'like', '%' . $term . '%');
                    $query->orWhere('sub_sku', 'like', '%' . $term . '%');
                })
                ->whereNull('variations.deleted_at')
                ->select(
                    'products.id as product_id',
                    'products.name',
                    'products.type',
                    // 'products.sku as sku',
                    'variations.id as variation_id',
                    'variations.name as variation',
                    'variations.sub_sku as sub_sku'
                );

            if (!empty(request()->store_id)) {
                $q->ForLocation(request()->store_id);
            }
            $products = $q->get();

            $products_array = [];
            foreach ($products as $product) {
                $products_array[$product->product_id]['name'] = $product->name;
                $products_array[$product->product_id]['sku'] = $product->sub_sku;
                $products_array[$product->product_id]['type'] = $product->type;
                $products_array[$product->product_id]['variations'][]
                    = [
                        'variation_id' => $product->variation_id,
                        'variation_name' => $product->variation,
                        'sub_sku' => $product->sub_sku
                    ];
            }

            $result = [];
            $i = 1;
            $no_of_records = $products->count();
            if (!empty($products_array)) {
                foreach ($products_array as $key => $value) {
                    if ($no_of_records > 1 && $value['type'] != 'single') {
                        $result[] = [
                            'id' => $i,
                            'text' => $value['name'] . ' - ' . $value['sku'],
                            'variation_id' => 0,
                            'product_id' => $key
                        ];
                    }
                    $name = $value['name'];
                    foreach ($value['variations'] as $variation) {
                        $text = $name;
                        if ($value['type'] == 'variable') {
                            if ($variation['variation_name'] != 'Default') {
                                $text = $text . ' (' . $variation['variation_name'] . ')';
                            }
                        }
                        $i++;
                        $result[] = [
                            'id' => $i,
                            'text' => $text . ' - ' . $variation['sub_sku'],
                            'product_id' => $key,
                            'variation_id' => $variation['variation_id'],
                        ];
                    }
                    $i++;
                }
            }

            return json_encode($result);
        }
    }

    /**
     * get the list of porduct purchases
     *
     * @param [type] $id
     * @return void
     */
    public function getPurchaseHistory($id)
    {
        $product = Product::find($id);
        $add_stocks = Transaction::leftjoin('add_stock_lines', 'transactions.id', 'add_stock_lines.transaction_id')
            ->where('add_stock_lines.product_id', $id)
            ->groupBy('transactions.id')
            ->select('transactions.*')
            ->get();

        return view('back-end.products.partial.purchase_history')->with(compact(
            'product',
            'add_stocks',
        ));
    }

    /**
     * get import page
     *
     */
    public function getImport()
    {

        return view('back-end.products.import');
    }

    /**
     * save import resource to stores
     *
     */
    public function saveImport(Request $request)
    {



        $this->validate($request, [
            'file' => 'required|mimes:csv,txt,xlsx'
        ]);
        try {
            DB::beginTransaction();
            Excel::import(new ProductImport($this->productUtil, $request), $request->file);
            DB::commit();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
/*            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
              return  $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }*/
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong') .' , '. __('lang.import_req')
            ];
        }

        return redirect()->back()->with('status', $output);
    }

    /**
     * check sku if already in use
     *
     * @param string $sku
     * @return array
     */
    public function checkSku($sku)
    {
        $product_sku = Product::where('sku', $sku)->first();

        if (!empty($product_sku)) {
            $output = [
                'success' => false,
                'msg' => __('lang.sku_already_in_use')
            ];
        } else {
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        }

        return $output;
    }

    /**
     * check name if already in use
     *
     * @param string $name
     * @return array
     */
    public function checkName(Request $request)
    {
        $query = Product::where('name', $request->name);
        $product_name = $query->first();

        if (!empty($product_name)) {
            $output = [
                'success' => false,
                'msg' => __('lang.name_already_in_use')
            ];
        } else {
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        }

        return $output;
    }

    public function deleteProductImage($id)
    {
        try {
            $product = Product::find($id);
            $product->clearMediaCollection('products');

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


 /**
     * get raw material row
     *
     * @return void
     */
    public function getRawDiscount()
    {
        $row_id = request()->row_id ?? 0;
        $discount_customer_types = CustomerType::pluck('name', 'id');

        return view('back-end.products.partial.raw_discount')->with(compact(
            'row_id',
            'discount_customer_types',
        ));
    }



    public function updateColumnVisibility(Request $request)
    {
        $columnVisibility = $request->input('columnVisibility');
        Cache::forever('key_' . auth()->id(), $columnVisibility);
        return response()->json(['success' => true]);
    }
    public function toggleAppearancePos($id,Request $request){
        $products_count=Product::where('show_at_the_main_pos_page','yes')->count();
        if(isset($products_count) && $products_count <40){
            $product=Product::find($id);
            if($product->show_at_the_main_pos_page=='no'){
                $product->show_at_the_main_pos_page='yes';
                $product->save();
            }else{
                $product->show_at_the_main_pos_page='no';
                $product->save();
            }
        }else{
            $product=Product::find($id);
                if($product->show_at_the_main_pos_page=='yes'){
                    $product->show_at_the_main_pos_page='no';
                    $product->save();
                }else{
                    if($request->check=="yes"){
                        return [
                            'success' => 'Failed!',
                            'msg' => __("lang.Cant_Add_More_Than_40_Products"),
                            'status'=>'error'
                        ];
                    }
                }
        }
    }
    public function multiDeleteRow(Request $request){
        if (!auth()->user()->can('product_module.products.delete')) {
            abort(403, translate('Unauthorized action.'));
        }

        try {
            DB::beginTransaction();
            foreach ($request->ids as $id){
                $variation = Variation::find($id);
                $variation_count = Variation::where('product_id', $variation->product_id)->count();
                if ($variation_count > 1) {
                    $variation->delete();
                    ProductStore::where('variation_id', $id)->delete();
                    $output = [
                        'success' => true,
                        'msg' => __('lang.deleted')
                    ];
                } else {
                    ProductStore::where('product_id', $variation->product_id)->delete();
                    $product = Product::where('id', $variation->product_id)->first();
                    $product->clearMediaCollection('products');
                    $product->delete();
                    $variation->delete();
                }
                $ENABLE_POS_Branch = env('ENABLE_POS_Branch', false);
                $POS_SYSTEM_URL = env('Branch_SYSTEM_URL', null);
                $POS_ACCESS_TOKEN = env('Branch_ACCESS_TOKEN', null);
                if($ENABLE_POS_Branch && $POS_SYSTEM_URL &&$POS_ACCESS_TOKEN ){
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
                    ])->post($POS_SYSTEM_URL . '/api/delete_product/'.$id, [])->json();

                }
            }
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];

            DB::commit();
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return $output;
    }
}
