<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;
use App\Models\Medicine;
use App\Models\TransactionIn;
use App\Models\TransactionOut;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public $transactionIn, $transactionOut, $medicines, $users, $feedbacks;
    public function __construct()
    {
        $this->transactionIn = TransactionIn::count();
        $this->transactionOut = TransactionOut::count();
        $this->medicines = Medicine::count();
        $this->users = User::count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card', [
            'transactionIn' => $this->transactionIn,
            'transactionOut' => $this->transactionOut,
            'medicines' => $this->medicines,
            'users' => $this->users,
        ]);
    }
}
