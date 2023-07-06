<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name', 'user_id', 'slug', 'category_id', 'description', 'short_description', 'price', 'compare_price', 'image', 'status'
    ];

    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',

        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'Uncategories'
        ]);
    }

    public function cart()
    {
        return $this->belongsToMany(
            User::class,
            'carts',
            'product_id',
            'user_id',
            'id',
            'id'
             ) //اعطيته اسم الجدول الوسيط كارتس ليكسر العلاقة وبعطيه fk 
            ->withPivot(['quantity'])
            ->withTimestamps()
            ->using(Cart::class);
    }


    public static function booted()
    {
        static::addGlobalScope('owner', function ($query) {
            $query->where('user_id', '=', Auth::id());
            //  Auth::user()->id OR 
        });
    }


    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return "https://placehold.co/100x100";
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    public function getPriceFormattedAttribute()
    {
        // 'en' = config('app.local') يقرا الللغة حسب لغة الابلكيشن 
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'USD');
    }
    public function getComparePriceFormattedAttribute()
    {
        // 'en' = config('app.local') يقرا الللغة حسب لغة الابلكيشن 
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->compare_price, 'USD');
    }

    public static function scopeActive(Builder $query)
    {
        $query->where('status', '=', 'active');
    }
    public static function scopeStatus(Builder $query, $status)
    {
        $query->where('status', '=', $status);
    }

    //Builder $query المنتجات الموجودة في المودل الي بدي اعمل عليها سيرتش 
    //array $filters الريكوستات الي جاي من السيرتش و السعر والستاتس
    //$request->search , function() بستخدم هذه العملية في حال كان واحد ريكوست الي جايني 
    public function scopeFilter(Builder $query, array $filters)
    {
         
        // $filters['search'] اسم الحقل هوا key  لل التابع  array 
        $query
            ->when($filters['search'] ?? false, function ($query, $value) {
                $query->Where(function ($query) use ($value) {
                    $query->where('products.name', 'LIKE', "%{$value}%")
                        ->orWhere('products.description', 'LIKE', "%{$value}%");
                });
            })
            ->when($filters['status'] ?? false, function ($query, $value) {
                $query->where('products.status', '=', $value);
            })
            ->when($filters['category_id'] ?? false, function ($query, $value) {
                $query->where('products.category_id', '=', $value);
            })
            ->when($filters['price_min'] ?? false, function ($query, $value) {
                $query->where('products.price', '>=', $value);
            })
            ->when($filters['price_max'] ?? false, function ($query, $value) {
                $query->where('products.price', '<=', $value);
            });
    }
}
