<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use CodeIgniter\HTTP\ResponseInterface;

class PembelianController extends BaseController
{
    protected $transaksimodel;
    protected $transaksidetailmodel;
    public function __construct()
    {
        helper(['number']);
        $this->transaksimodel = new TransactionModel();
        $this->transaksidetailmodel = new TransactionDetailModel();
    }

    public function index()
    {
        $transaksidetail = $this->transaksidetailmodel->findAll();
        $transaction = $this->transaksimodel->findAll();
        $data['transaction'] = $transaction;
        $data2['transaction_detail'] = $transaksidetail;

        return view('v_pembelian', $data, $data2);

    }
    public function edit($id)
    {
        $transaction = $this->transaksimodel->find($id);
        $statusbaru = $transaction['status'] == 0 ? 1 : 0;
        $this->transaksimodel->update($id, [
            'status' => $statusbaru,
        ]);
        return redirect('pembelian')->with('success', 'status berhasil diubah');
    }

}
