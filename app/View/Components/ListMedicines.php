<?php

namespace App\View\Components;

use App\Models\Discount;
use Closure;
use App\Models\Medicine;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ListMedicines extends Component
{
    /**
     * Create a new component instance.
     */

    public $medicines, $relatedDiscount;
    public function __construct()
    {
        $this->medicines = Medicine::with('unit', 'category')->paginate(6);

        foreach ($this->medicines as $medicine) {
            $discount = Discount::where('medicine_id', $medicine->id)->where('is_active', 1)->first();

            if ($discount) {
                $medicine->is_discount = true;
                $medicine->original_price = $medicine->price;
                $medicine->discount_price = $medicine->price - ($medicine->price * ($discount->discount_amount / 100));
            } else {
                $medicine->is_discount = false;
            }

        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-medicines', [
            'medicines' => $this->medicines,
        ]);
    }
}
