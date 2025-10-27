<?php

namespace App\View\Components;

use App\Models\ApotekRating;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class scrollComment extends Component
{
    /**
     * Create a new component instance.
     */

    public $ratings;
    public function __construct()
    {
        $this->ratings = ApotekRating::with('user')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.scrollComment', [
            'ratings' => $this->ratings,
        ]);
    }
}
