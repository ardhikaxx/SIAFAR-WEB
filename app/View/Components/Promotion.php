<?php

namespace App\View\Components;

use App\Models\PromoCode;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Promotion extends Component
{
    /**
     * Create a new component instance.
     */

    public $promoCodes;
    public function __construct()
    {
        $this->promoCodes = PromoCode::where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.promotion', [
            'promoCodes' => $this->promoCodes
        ]);
    }
}
