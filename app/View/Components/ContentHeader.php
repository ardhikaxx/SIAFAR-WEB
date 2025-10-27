<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentHeader extends Component
{
    /**
     * Create a new component instance.
     */

    public $titleHeader;
    public $titles = [
        'admin.index' => 'Dashboard',
        'admin.users.index' => 'User',
        'admin.users.create' => 'Tambah User',
        'admin.users.edit' => 'Edit User',
        'admin.products.index' => 'Obat',
        'admin.products.create' => 'Tambah Obat',
        'admin.products.edit' => 'Edit Obat',
        'admin.categories.index' => 'Kategori',
        'admin.categories.create' => 'Tambah Kategori',
        'admin.categories.edit' => 'Edit Kategori',
        'admin.transactions.index' => 'Transaksi',
        'admin.transaction_details.index' => 'Detail Transaksi',
    ];
    // public $breadcrumb = [
    //     '/' => 'Dashboard',
    //     'User' => 'User',
    //     'Tambah User' => 'Tambah User',
    //     'Edit User' => 'Edit User',
    //     'Obat' => 'Obat',
    //     'Tambah Obat' => 'Tambah Obat',
    //     'Edit Obat' => 'Edit Obat',
    //     'Kategori' => 'Kategori',
    //     'Tambah Kategori' => 'Tambah Kategori',
    //     'Edit Kategori' => 'Edit Kategori',
    //     'Transaksi' => 'Transaksi',
    //     'Detail Transaksi' => 'Detail Transaksi'
    // ];
    public function __construct()
    {
        $currentRouteName = request()->route()->getName();
        $this->titleHeader = $this->titles[$currentRouteName] ?? '';
        // $this->breadcrumb = $breadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-header');
    }
}
