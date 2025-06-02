<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;

class ProductCategory extends BaseController
{
    protected $categoryproduct;
    function __construct()
    {
        $this->categoryproduct = new ProductCategoryModel();
    }
    public function index()
    {
        $categoryproduk = $this->categoryproduct->findAll();
        $data['product_category'] = $categoryproduk;

        return view('v_categoryproduk', $data);
    }
    public function create()
    {
        $dataForm = [
            'category_name' => $this->request->getPost('category_name'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $this->categoryproduct->insert($dataForm);

        return redirect('produk-kategori')->with('success', 'Data Berhasil Ditambah');
    }
    public function edit($id)
    {
        $dataForm = [
            'category_name' => $this->request->getPost('category_name'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->categoryproduct->update($id, $dataForm);

        return redirect('produk-kategori')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->categoryproduct->find($id);

        $this->categoryproduct->delete($id);

        return redirect('produk-kategori')->with('success', 'Data Berhasil Dihapus');
    }
}
