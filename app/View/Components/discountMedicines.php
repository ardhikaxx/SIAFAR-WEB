<?php

namespace App\View\Components;

use Closure;
use App\Models\Discount;
use App\Models\Medicine;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class discountMedicines extends Component
{
    /**
     * Create a new component instance.
     */

    public $medicines, $discounts;
    public function __construct()
    {
        $this->medicines = Medicine::with('unit', 'category')->paginate(6);

        $this->discounts = Discount::with('medicine')->where('is_active', 1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            'components.discount-medicines',
            [
                'medicines' => $this->medicines,
                'discounts' => $this->discounts
            ]
        );
    }
}
