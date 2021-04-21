<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    protected $productModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productModel = new Product();
        helper('form');
    }

    /**
     * Display Product Page
     *
     * @return void
     */
    public function index()
    {
        $product = $this->productModel;

        if ($this->request->getGet("search")) {
            $product = $product->like('name', $this->request->getGet("search"), "both");
        }
        
        $product = $product->asObject();
        
        $data = [
            'headerTitle' => 'Daftar Barang',
            'product' => $product->paginate(10, "product"),
            'pager' => $product->pager,
            'nomor' => nomor($this->request->getVar('page_product'), 10),
        ];

        return view('products/index', $data);
    }

    /**
     * Display Recycle Bin Page
     *
     * @return void
     */
    public function indexRecycle()
    {
        $product = $this->productModel->onlyDeleted()->asObject();
        $data = [
            'headerTitle' => 'Daftar Barang Non Aktif',
            'product' => $product->paginate(10, "activate"),
            'pager' => $product->pager,
            'nomor' => nomor($this->request->getVar('page_activate'), 10),
        ];

        return view('products/activated', $data);
    }

    /**
     * Redirect To Product Create Page
     *
     * @return void
     */
    public function create()
    {
        $data = [
            'headerTitle' => 'Tambah Barang',
        ];
        return view('products/add', $data);
    }

    /**
     * Store new Products to DB
     *
     * @return void
     */
    public function store()
    {
        $data = $this->request->getPost();
        
        if ($this->productModel->save($data)) {
            $session = session();
            $session->setFlashdata('status', 'Barang berhasil ditambahkan.');
            return redirect()->to(base_url('products'));
        }
        $errors = $this->productModel->errors();
        return view('products/add', [
            'errors' =>  $errors,
            'headerTitle' => 'Tambah Barang',
        ]);
    }

    /**
     * Redirect to Product Edit page
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $model = $this->productModel->find($id);
        $data = [
            'headerTitle' => 'Ubah data Barang',
            'product' => $model,
        ];
        return view('products/add', $data);
    }

    /**
     * Update Product Data
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $data['id'] ?? '';
        $data['name'] = $data['name'] ?? '';
        $data['qty'] = $data['qty'] ?? 0;
        $data['purchase_price'] = $data['purchase_price'] ?? 0;
        $data['selling_price'] = $data['selling_price'] ?? 0;
        $data['description'] = $data['description'] ?? '';
        
        if ($this->productModel->save($data)) {
            $session = session();
            $session->setFlashdata('status', 'Data Barang telah diubah');
            return redirect()->to(base_url('products'));
        } else {
            $session = session();
            $session->setFlashdata('status', 'Data Barang gagal diubah');
            return redirect()->back();
        }
    }

    /**
     * Delete Product
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $delete = $this->productModel->delete($id);
        if ($delete == true) {
            $session = session();
            $session->setFlashdata('status', 'Barang telah dinonaktifkan');
            return redirect()->to(base_url('products'));
        }
    }

    /**
     * Restore / Reactivate Deleted Product
     *
     * @param [type] $id
     * @return void
     */
    public function activate($id)
    {
        $query = "UPDATE products SET deleted_at = null WHERE id = ".$id;

        $this->productModel->query($query);
        
        if ($query) {
            $session = session();
            $session->setFlashdata('status', 'Barang berhasil diaktifkan lagi');
            return redirect()->to(base_url('products'));
        } else {
            $session = session();
            $session->setFlashdata('status', 'Barang gagal diaktifkan');
            return redirect()->back();
        }
    }
}
