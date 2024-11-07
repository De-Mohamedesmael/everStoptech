<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, \Staudenmeir\EloquentJsonRelations\HasJsonRelationships,SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_to_customer_types' => 'array',
        'translations' => 'array',

    ];

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }
    public function scopeNotActive($query)
    {
        $query->where('active', 0);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault(['name' => '']);
    }
    public function tax()
    {
        return $this->belongsTo(Tax::class)->withDefault(['name' => '']);
    }


    public function product_stores()
    {
        return $this->hasMany(ProductStore::class);
    }
    public function stock_lines()
    {
        return $this->hasMany(AddStockLine::class);
    }
    public function alert_quantity_unit()
    {
        return $this->belongsTo(Unit::class, 'alert_quantity_unit_id');
    }

    public function colors()
    {
        return $this->hasManyThrough(Color::class, Variation::class, 'product_id', 'id', 'id', 'color_id');
    }
    public function sizes()
    {
        return $this->hasManyThrough(Size::class, Variation::class, 'product_id', 'id', 'id', 'size_id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id')->withDefault(['name' => '']);
    }
    public function edited_by_user()
    {
        return $this->belongsTo(Admin::class, 'edited_by', 'id')->withDefault(['name' => '']);
    }

    public function consumption_products()
    {
        return $this->hasMany(ConsumptionProduct::class, 'raw_material_id', 'id');
    }


    public function getNameAttribute($name)
    {
        $translations = !empty($this->translations['name']) ? $this->translations['name'] : [];
        if (!empty($translations)) {
            $lang = session('language');
            if (!empty($translations[$lang])) {
                return $translations[$lang];
            }
        }
        return $name;
    }

    public function translated_name($id, $lang)
    {
        $product = Product::find($id);
        $name = $product->name;
        $translations = !empty($product->translations['name']) ? $product->translations['name'] : [];
        if (!empty($translations)) {
            if (!empty($translations[$lang])) {
                return $translations[$lang];
            }
        }
        return $name;
    }

    public function supplier()
    {
        return $this->hasOneThrough(Supplier::class, SupplierProduct::class, 'product_id', 'id', 'id', 'supplier_id');
    }
    public function product_discounts()
    {
        return $this->hasMany(ProductDiscount::class,'product_id','id');
    }
}
