<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Token;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Discount;
use App\Models\Medicine;
use App\Models\PromoCode;
use Illuminate\Support\Str;
use App\Events\NotifyPusher;
use App\Models\ApotekRating;
use Illuminate\Http\Request;
use app\models\MedicineRating;
use App\Models\TransactionOut;
use App\Models\ShippingAddress;
use App\Models\TransactionOutDetail;
use Illuminate\Support\Facades\Auth;

class TransactionOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function index(Request $request)
    {
        if (Auth::user()->role == 'customer') {
            $search = $request->input('search', '');
            $transaction_out_status = $request->input('transaction_out_status', '');
            // $queue_status = $request->input('queue_status', '');


            $transactions = TransactionOut::with('user')
                ->where('user_id', Auth::id())
                ->where(function ($query) use ($search, $transaction_out_status) {
                    $query->where('transaction_out_code', 'like', '%' . $search . '%')
                        ->orWhere('payment_method', 'like', '%' . $search . '%');

                })
                ->when($transaction_out_status, function ($query) use ($transaction_out_status) {
                    $query->where('transaction_out_status', 'like', '%' . $transaction_out_status . '%');
                })
                // ->when($queue_status, function ($query) use ($queue_status) {
                //     $query->where('queue_status', 'like', '%' . $queue_status . '%');
                // })
                ->orderBy('id', 'desc')->paginate(10);


            // $startOfToday = now()->startOfDay();
            // $endOfToday = now()->endOfDay();

            // TransactionOut::where('transaction_out_status', "Menunggu")
            //     ->where('created_at', '<', $startOfToday)
            //     ->update(['transaction_out_status' => 'Expired']);

            // Update expired jika
            // status pesan masih menunggu dan siap di ambil

            // boleh update nomor antri jika
            // status antri expired dan status pesan masih menunggu dan siap diambil


            // TransactionOut::where('queue_status', "Aktif")
            //     ->where('created_at', '<', Carbon::today())
            //     ->whereIn('transaction_out_status', ['Menunggu', 'Siap diambil'])
            //     ->update(['queue_status' => 'Expired']);



            return view('customer.transactionOuts.index', compact('transactions', 'search'));
        } else if (Auth::user()->role == 'admin') {
            // $statuses = $request->input('status', []);
            // $transactionOuts = TransactionOut::with('user')
            //     ->when(!empty($statuses), function ($query) use ($statuses) {
            //         $query->whereIn('transaction_out_status', $statuses);
            //     })
            //     ->orderBy("id", "desc")
            //     ->get();
            $transactionOutStatuses = TransactionOut::with('user', 'payment')->orderBy("id", "desc")->get();
            // foreach ($transactionOutStatuses as $transactionOut) {
            //     if ($transactionOut->transaction_out_status == "Sudah diambil" || $transactionOut->transaction_out_status == "Dibatalkan") {
            //         $transactionOut->queue_status = "Expired";
            //         $transactionOut->save();
            //     }
            // }

            TransactionOut::with('user', 'payment')->orderBy("id", "desc")->get();
            $transaction_out_status = $request->input('transaction_out_status', '');
            // $queue_status = $request->input('queue_status', '');
            $startDate = Carbon::parse($request->input('start_date', ''))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date', ''))->endOfDay();

            if ($transaction_out_status && $startDate && $endDate) {
                $transactionOuts = TransactionOut::with('user', 'payment')
                    ->when($transaction_out_status, function ($query, $transaction_out_status) {
                        $query->where('transaction_out_status', 'like', '%' . $transaction_out_status . '%');
                    })
                    // ->when($queue_status, function ($query, $queue_status) {
                    //     $query->where('queue_status', 'like', '%' . $queue_status . '%');
                    // })
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    }, function ($query) {
                        $query->whereNotNull('created_at');
                    })
                    ->orderBy("id", "desc")
                    ->get();
            } else {
                $transactionOuts = TransactionOut::with('user', 'payment')->orderBy("id", "desc")->get();
            }
            return view('admin.transactionOuts.index', compact('transactionOuts'));
        } else if (Auth::user()->role == 'apoteker') {
            // $statuses = $request->input('status', []);
            // $transactionOuts = TransactionOut::with('user')
            //     ->when(!empty($statuses), function ($query) use ($statuses) {
            //         $query->whereIn('transaction_out_status', $statuses);
            //     })
            //     ->orderBy("id", "desc")
            //     ->get();
            $transactionOutStatuses = TransactionOut::with('user', 'payment')->orderBy("id", "desc")->get();
            // foreach ($transactionOutStatuses as $transactionOut) {
            //     if ($transactionOut->transaction_out_status == "Sudah diambil" || $transactionOut->transaction_out_status == "Dibatalkan") {
            //         $transactionOut->queue_status = "Expired";
            //         $transactionOut->save();
            //     }
            // }
            $transaction_out_status = $request->input('transaction_out_status', '');
            // $queue_status = $request->input('queue_status', '');
            $startDate = Carbon::parse($request->input('start_date', ''))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date', ''))->endOfDay();

            if ($transaction_out_status && $startDate && $endDate) {
                $transactionOuts = TransactionOut::with('user', 'payment')
                    ->when($transaction_out_status, function ($query, $transaction_out_status) {
                        $query->where('transaction_out_status', 'like', '%' . $transaction_out_status . '%');
                    })
                    // ->when($queue_status, function ($query, $queue_status) {
                    //     $query->where('queue_status', 'like', '%' . $queue_status . '%');
                    // })
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    }, function ($query) {
                        $query->whereNotNull('created_at');
                    })
                    ->orderBy("id", "desc")
                    ->get();
            } else {
                $transactionOuts = TransactionOut::with('user', 'payment')->orderBy("id", "desc")->get();
            }
            return view('apoteker.transactionOuts.index', compact('transactionOuts'));
        }
    }

    public function generateTransactionCode()
    {
        return 'TRX-' . Str::upper(Str::random(10));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'payment_method' => 'required',
            'payment_id' => 'required',
            'shipping_address_id' => 'required',
            'shipping_method_id' => 'required',
            'shipping_cost' => 'required',
            'grand_total_amount' => 'required',
        ]);
        $paymentName = Payment::find($request->payment_id)->payment_name;

        if ($request->payment_method === 'Cash' && $paymentName !== 'Cash') {
            return redirect()->back()->withErrors(['payment_id' => 'Jika memilih metode Cash, pembayaran harus melalui Cash.']);
        }

        if ($request->payment_method === 'Transfer' && $paymentName === 'Cash') {
            return redirect()->back()->withErrors(['payment_id' => 'Jika memilih metode Transfer, pembayaran tidak boleh melalui Cash.']);
        }

        $carts = Cart::with('medicine')->where('user_id', Auth::user()->id)->get();

        $startOfToday = Carbon::now()->startOfDay();
        $endOfToday = Carbon::now()->endOfDay();


        // Update expired jika
        // status pesan masih menunggu dan siap di ambil

        // boleh update nomor antri jika
        // status antri expired dan status pesan masih menunggu dan siap diambil


        // $lastQueueNumberToday = TransactionOut::where('queue_status', 'Aktif')->whereBetween('created_at', [$startOfToday, $endOfToday])
        //     ->max('queue_number');

        // $newQueueNumber = $lastQueueNumberToday ? $lastQueueNumberToday + 1 : 1;

        // $newQueueNumberFormatted = str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);

        // $promoCode = PromoCode::where('promo_code', $request->promo_code)
        //     ->where('is_active', 0)
        //     ->where('start_date', '>=', now())
        //     ->where('end_date', '<=', now())
        //     ->first();

        // if (!$promoCode) {
        //     return redirect()->back()->with('error', 'Kode promo' . $request->promo_code . 'tidak valid atau sudah kadaluarsa');
        // }

        // $alreadyUsed = TransactionOut::where('promo_code_id', $promoCode->id)
        //     ->where('user_id', Auth::user()->id)
        //     ->exists();

        // if ($alreadyUsed) {
        //     return redirect()->back()->with('error', 'Kode Promo' . $request->promo_code . 'sudah digunakan sebelumnya');
        // }


        $transactionOut = TransactionOut::create([
            'user_id' => Auth::user()->id,
            'transaction_out_code' => $this->generateTransactionCode(),
            'transaction_out_date' => now(),
            'payment_method' => $request->payment_method,
            'payment_id' => $request->payment_id,
            'shipping_address_id' => $request->shipping_address_id,
            'shipping_method_id' => $request->shipping_method_id,
            'shipping_cost' => $request->shipping_cost,
            // 'queue_number' => $newQueueNumberFormatted,
            // 'promo_code_id' => $request->promo_code_id,
            'grand_total_amount' => $request->grand_total_amount,
        ]);

        if ($request->hasFile('proof_of_payment')) {

            if ($transactionOut->payment_method === "Transfer") {
                $request->validate([
                    'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                $path = $request->file('proof_of_payment')->store('proof_of_payment', 'public');

                $transactionOut->proof_of_payment = $path;
                $transactionOut->save();
            }
        } else {
            $path = "Tidak terjadi apa apa";
        }

        foreach ($carts as $cart) {
            $discount = Discount::where('medicine_id', $cart->medicine_id)->where('is_active', 1)->first();
            if ($discount) {
                $discountAmount = $discount->discount_amount;
                $cartPrice = $cart->medicine->price - ($cart->medicine->price * ($discount->discount_amount / 100));
            } else {
                $discountAmount = 0;
                $cartPrice = $cart->medicine->price;
            }
            TransactionOutDetail::create([
                'transaction_out_id' => $transactionOut->id,
                'medicine_id' => $cart->medicine_id,
                'quantity' => $cart->quantity,
                'price' => $cart->medicine->price ?? 0,
                'discount_amount' => $discountAmount,
                'total_amount' => $cartPrice * $cart->quantity,
            ]);
        }

        foreach ($carts as $cart) {
            $medicine = Medicine::find($cart->medicine_id);
            $medicine->stock = $medicine->stock - $cart->quantity;
            $medicine->save();
        }

        // Hapus keranjang setelah checkout
        Cart::where('user_id', Auth::user()->id)->delete();



        return redirect()->route('customer.ratings.create', $transactionOut->id)->with('success', 'Transaksi berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transactionOut = TransactionOut::with(['user', 'payment', 'transactionOutDetails', 'shipping_address', 'shipping_method'])->findOrFail($id);
        $transactionOutDetails = TransactionOutDetail::where('transaction_out_id', $transactionOut->id)->get();
        $payment = Payment::find($transactionOut->payment_id);

        $totalDiscount = 0;
        foreach ($transactionOutDetails as $value) {
            $priceTotal = $value->price * $value->quantity;
            $calculateDiscount = $priceTotal * ($value->discount_amount / 100);
            $totalDiscount += $calculateDiscount;

            $shippingFee = $transactionOut->shipping_cost;
            $grandTotal = $priceTotal - $calculateDiscount;
        }


        if (Auth::user()->role == 'customer') {
            // TransactionOut::where('queue_status', "Aktif")
            //     ->where('created_at', '<', Carbon::today())
            //     ->whereIn('transaction_out_status', ['Menunggu', 'Siap diambil'])
            //     ->update(['queue_status' => 'Expired']);



            return view('customer.transactionOuts.show', compact('transactionOut', 'transactionOutDetails', 'payment', 'totalDiscount', 'grandTotal', 'shippingFee'));
        } else if (Auth::user()->role == 'admin') {

            // if ($transactionOut->transaction_out_status == "Sudah diambil" || $transactionOut->transaction_out_status == "Dibatalkan") {
            //     $transactionOut->queue_status = "Expired";
            //     $transactionOut->save();
            // }

            if ($transactionOut->payment_status == "Ditolak") {
                foreach ($transactionOutDetails as $transactionOutDetail) {
                    $medicine = Medicine::find($transactionOutDetail->medicine_id);
                    $medicine->stock = $medicine->stock + $transactionOutDetail->quantity;
                    $medicine->save();
                }

                $transactionOut->transaction_out_status = "Dibatalkan";
                $transactionOut->save();
            }

            return view('admin.transactionOuts.show', compact('transactionOut', 'transactionOutDetails', 'payment', 'totalDiscount', 'shippingFee'));
        } else {
            return view('apoteker.transactionOuts.show', compact('transactionOut', 'transactionOutDetails', 'payment', 'totalDiscount', 'shippingFee'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionOut $transactionOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transactionOut = TransactionOut::findOrFail($id);


        if (Auth::user()->role == 'admin') {
            $transactionOut->update([
                'payment_status' => $request->payment_status,
            ]);

            return redirect()->route('admin.transactionOuts.show', $transactionOut->id)
                ->with('success', 'Pembayaran berhasil diapprove');
        }


        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('proof_of_payment')) {
            $path = $request->file('proof_of_payment')->store('proof_of_payment', 'public');

            $transactionOut->proof_of_payment = $path;
            $transactionOut->save();

            return redirect()->route('customer.transactionOuts.show', $transactionOut->id)
                ->with('success', 'Bukti Pembayaran berhasil diupload');
        }



        return redirect()->back()->with('error', 'Gagal mengupload bukti pembayaran');
    }


    public function updateStatusOut(Request $request, $id)
    {

        if (Auth::user()->role == "admin") {
            $transactionOut = TransactionOut::findOrFail($id);
            if ($transactionOut->payment_status == "Lunas") {
                $request->validate([
                    'transaction_out_status' => 'required'
                ]);

                $transactionOut->update([
                    'transaction_out_status' => $request->transaction_out_status,
                ]);

                // return back()->with('success', 'Berhasil mengubah status antrian!');
                return redirect()->route('admin.transactionOuts.show', $transactionOut->id)->with('success', 'Berhasil mengubah status antrian!');
            }
        }
    }


    // public function updateQueueNumber($id = null)
    // {
    //     $startOfToday = Carbon::now()->startOfDay();
    //     $endOfToday = Carbon::now()->endOfDay();

    //     if ($id) {
    //         // Update untuk transaksi tertentu
    //         $transaction = TransactionOut::find($id);
    //         if (
    //             $transaction &&
    //             $transaction->queue_status == 'Expired' &&
    //             in_array($transaction->transaction_out_status, ['Menunggu', 'Siap diambil'])
    //         ) {
    //             // Cari nomor antrian terakhir hari ini jika belum ada no antrian hari ini
    //             $lastQueueNumber = TransactionOut::where('queue_status', 'Aktif')
    //                 ->whereBetween('created_at', [$startOfToday, $endOfToday])
    //                 ->max('queue_number');
    //             // nextQueueNumber ditemukan ? maka buat penambahan increment + 1, jika tidak maka buat 001
    //             $nextQueueNumber = $lastQueueNumber ? str_pad((int) $lastQueueNumber + 1, 3, '0', STR_PAD_LEFT) : '001';

    //             $transaction->queue_number = $nextQueueNumber;
    //             $transaction->queue_status = 'Aktif';
    //             $transaction->transaction_out_status = 'Menunggu';
    //             $transaction->created_at = now();
    //             $transaction->transaction_out_date = now();
    //             $transaction->save();
    //         }
    //     } else {
    //         // Update semua transaksi expired untuk hari ini
    //         $expiredTransactions = TransactionOut::where('queue_status', 'Expired')
    //             ->whereIn('transaction_out_status', ['Menunggu', 'Siap diambil'])
    //             ->orderBy('created_at', 'asc')
    //             ->get();

    //         $lastQueueNumber = TransactionOut::where('queue_status', 'Aktif')
    //             ->whereBetween('created_at', [$startOfToday, $endOfToday])
    //             ->max('queue_number');

    //         $queueNumber = $lastQueueNumber ? (int) $lastQueueNumber + 1 : 1;

    //         foreach ($expiredTransactions as $transaction) {
    //             $transaction->queue_number = str_pad($queueNumber, 3, '0', STR_PAD_LEFT);
    //             $transaction->queue_status = 'Aktif';
    //             $transaction->transaction_out_status = 'Menunggu';
    //             $transaction->created_at = now();
    //             $transaction->transaction_out_date = now();
    //             $transaction->save();

    //             $queueNumber++;
    //         }
    //     }

    //     return redirect()->route('customer.transactionOuts.index')->with('success', 'Berhasil mengaktifkan status antrian!');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionOut $transactionOut)
    {
        //
    }


    public function print(TransactionOut $transactionOut)
    {
        $transactionOutDetails = TransactionOutDetail::where('transaction_out_id', $transactionOut->id)->get();
        $payment = Payment::find($transactionOut->payment_id);
        $totalDiscount = 0;
        foreach ($transactionOutDetails as $value) {
            $priceTotal = $value->price * $value->quantity;
            $calculateDiscount = $priceTotal * ($value->discount_amount / 100);
            $totalDiscount += $calculateDiscount;

            $shippingFee = $transactionOut->shipping_cost;
            $grandTotal = $priceTotal - $calculateDiscount;
        }

        if (Auth::user()->role == 'admin') {
            return view('admin.transactionOuts.print', compact('transactionOut', 'transactionOutDetails', 'payment', 'totalDiscount', 'shippingFee'));
        } else if (Auth::user()->role == 'apoteker') {
            return view('apoteker.transactionOuts.print', compact('transactionOut', 'transactionOutDetails', 'payment', 'totalDiscount', 'shippingFee'));
        } else if (Auth::user()->role == 'customer') {
            return view('customer.transactionOuts.print', compact('transactionOut', 'transactionOutDetails', 'payment', 'totalDiscount', 'shippingFee'));
        }
    }


    public function whatsapp(Request $request, $id)
    {

        $transactionOut = TransactionOut::with(['user', 'payment'])->findOrFail($id);

        function listObat($id)
        {

            $transactionOut = TransactionOut::with(['user', 'payment'])->findOrFail($id);


            $transactionOutDetails = TransactionOutDetail::where('transaction_out_id', $transactionOut->id)->get();
            $totalDiscount = 0;
            $priceDiscount = 0;
            foreach ($transactionOutDetails as $value) {
                $priceTotal = $value->price * $value->quantity;
                $calculateDiscount = $priceTotal * ($value->discount_amount / 100);

                $totalDiscount += $calculateDiscount;
                $priceDiscount += $priceTotal - ($priceTotal * ($value->discount_amount / 100));

                // $list = [];
                // if ($value->discount_amount > 0) {
                //     foreach ($transactionOutDetails as $value) {
                //         $list[] = "Nama Obat: {$value->medicine->name} x {$value->quantity}" . "|" . "Diskon: {$value->discount_amount}%" . "\n" . "Harga Normal: Rp. ~" .
                //             number_format($value->price, 0, ',', '.') . "~\n" . "Harga Diskon: Rp." .
                //             number_format($value->total_amount, 0, ',', '.');
                //     }
                // } else {
                //     foreach ($transactionOutDetails as $value) {
                //         $list[] = "Nama Obat: {$value->medicine->name} x {$value->quantity}" . "|" . "Diskon: {$value->discount_amount}%" . "\n" . "Harga Normal: Rp. " .
                //             number_format($value->price, 0, ',', '.') . "\n" . "Harga Diskon: Rp." .
                //             number_format(0, 0, ',', '.');
                //     }
                // }
                $list = [];
                $allDiscounted = true; // Flag untuk mengecek apakah semua item diskon

                // Cek apakah semua barang memiliki diskon
                foreach ($transactionOutDetails as $value) {
                    if ($value->discount_amount <= 0) {
                        $allDiscounted = false;
                        break;
                    }
                }

                // Loop untuk menambahkan detail item ke dalam list
                foreach ($transactionOutDetails as $value) {
                    if ($value->discount_amount > 0) {
                        // Jika barang memiliki diskon
                        $normalPrice = $allDiscounted
                            ? "Rp. ~" . number_format($value->price, 0, ',', '.') . "~"
                            : "Rp. ~" . number_format($value->price, 0, ',', '.') . "~"; // Dicoret hanya jika diskon
                        $list[] = "Nama Obat: {$value->medicine->name} x {$value->quantity}"
                            . " | Diskon: {$value->discount_amount}%"
                            . "\nHarga Normal: {$normalPrice}"
                            . "\nHarga Diskon: Rp. " . number_format($value->total_amount, 0, ',', '.');
                    } else {
                        // Jika barang tidak memiliki diskon
                        $list[] = "Nama Obat: {$value->medicine->name} x {$value->quantity}"
                            . " | Diskon: {$value->discount_amount}%"
                            . "\nHarga Normal: Rp. " . number_format($value->price, 0, ',', '.')
                            . "\nHarga Diskon: Rp. " . number_format(0, 0, ',', '.');
                    }
                }

                // Output list untuk debugging
                foreach ($list as $item) {
                    echo $item . "\n";
                }

            }
            return $list;
        }


        $transactionOutDetails = TransactionOutDetail::where('transaction_out_id', $transactionOut->id)->get();
        $totalDiscount = 0;
        foreach ($transactionOutDetails as $value) {
            $priceTotal = $value->price * $value->quantity;
            $calculateDiscount = $priceTotal * ($value->discount_amount / 100);
            $totalDiscount += $calculateDiscount;

            $getColumnDataTransaction = [
                'Kode Transaksi: ' . $transactionOut->transaction_out_code,
                'Tanggal Transaksi: ' . $transactionOut->transaction_out_date,
                'Nama Pengguna: ' . $transactionOut->user->name,
                'Metode Pembayaran: ' . $transactionOut->payment_method,
                'Nama Pembayaran: ' . $transactionOut->payment->payment_name,
                'Status Pembayaran: ' . ($transactionOut->payment_status == 1 ? "Lunas" : "Menunggu Approve"),
                'Alamat Pengiriman: ' . $transactionOut->shipping_address->address,
                $transactionOut->shipping_address->city,
                $transactionOut->shipping_address->province,
                $transactionOut->shipping_address->postal_code,
                'Metode Pengiriman: ' . $transactionOut->shipping_method->name . "| Rp." . $transactionOut->shipping_cost,
                'Status Pemesanan: ' . $transactionOut->transaction_out_status,

                '----------------------------------------------------------------',
                'List Obat yang dibeli : ',
                implode("\n", listObat($id)),
                '----------------------------------------------------------------',
                // 'Kode Promo: ' . ($transactionOut->promoCode ? $transactionOut->promoCode->promo_code : '-'),
                'Shipping Fee: Rp. ' . number_format($transactionOut->shipping_cost, 0, ',', '.'),
                'Total Diskon: Rp. ' . number_format($totalDiscount, 0, ',', '.'),
                'Grand Total: Rp. ' . number_format($transactionOut->grand_total_amount, 0, ',', '.')
            ];
        }
        $message = implode("\n", $getColumnDataTransaction);

        $token = Token::first();

        $getNumberToken = $token->number_token;



        $target = $request->phone;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => $message,
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $getNumberToken
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }
        echo $response;


        return back()->with('success', 'Berhasil mengirim whatsapp');
    }


}
