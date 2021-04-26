<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

class InvoiceController extends BaseController
{
    protected $model, $modelDetail;

    /**
     * Constructor
     */
    public function __construct() {
        $this->model = new Invoice();
        $this->modelDetail = new InvoiceDetail();
        helper(['form', 'number']);
    }

    /**
     * Display List Invoice
     *
     * @return void
     */
    public function index()
    {
        $invoice = $this->model->asObject();
        $data = [
            'headerTitle' => 'Invoice',
            'invoice' => $invoice->paginate(10, 'invoice'),
            'pager' => $invoice->pager,
            'nomor' => nomor($this->request->getVar('page_invoice'), 10),
        ];
        return view('invoice/index', $data);
    }

    /**
     * Redirect To Invoice Create Page
     *
     * @return void
     */
    public function create()
    {
        $data = [
            'headerTitle' => 'Buat Invoice',
            "validation" => \Config\Services::validation(),
        ];

        return view('invoice/form', $data);
    }

    /**
     * Store New Invoice
     *
     * @return void
     */
    public function store()
    {
        // dd($this->request->getPost());
        if (!$this->validate(
            [
                'transaction_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal transaksi harus diisi',
                    ]
                ],
                'note' => [
                    'rules' => 'permit_empty|alpha_numeric_punct',
                ],
                'item.product_name.*' => [
                    'rules' => 'permit_empty|alpha_numeric_space',
                    'errors' => [
                        'alpha_numeric_space' => 'Nama Barang hanya boleh diisi huruf, angka, dan spasi',
                    ]
                ],
                'item.qty.*' => [
                    'rules' => 'permit_empty|numeric',
                    'errors' => [
                        'numeric' => 'Jumlah Barang hanya boleh diisi angka',
                    ]
                ],
                'item.price.*' => [
                    'rules' => 'permit_empty|numeric',
                    'errors' => [
                        'numeric' => 'Harga Barang hanya boleh diisi angka',
                    ]
                ],
                'item.discount.*' => [
                    'rules' => 'permit_empty|numeric',
                    'errors' => [
                        'numeric' => 'Diskon hanya boleh diisi angka',
                    ]
                ],
            ]
        )){
            $validation = \Config\Services::validation();
            return redirect()->to('/invoice/add')->withInput()->with('validation', $validation);
        }
        // dd($this->request->getVar("item[product_name][" . 0 . "]"));
        $insert = $this->model->insert(
            [
                'transaction_date' => $this->request->getVar('transaction_date'),
                'note' => $this->request->getVar('note'),
            ]
        );
        
        if ($insert) {
            $grandtotal = 0;
            for ($i=0; $i < count($this->request->getVar('item[product_name]')); $i++) { 
                $subtotal = ( $this->request->getVar("item[qty][" . $i . "]") * $this->request->getVar("item[price][" . $i . "]") ) - $this->request->getVar("item[discount][" . $i . "]");
                $this->modelDetail->insert(
                    [
                        'invoice_id' => $insert,
                        'product_name' => $this->request->getVar("item[product_name][" . $i . "]"),
                        'qty' => $this->request->getVar("item[qty][" . $i . "]"),
                        'price' => $this->request->getVar("item[price][" . $i . "]"),
                        'discount' => $this->request->getVar("item[discount][" . $i . "]"),
                        'subtotal' => $subtotal,
                    ]
                );
                $grandtotal += $subtotal;
            }
            $this->model->update($insert, ['grandtotal' => $grandtotal]);
        }

    }
}
