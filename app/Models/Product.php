<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'products';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'name', 'qty', 'purchase_price', 'selling_price', 'description', 'deleted_at'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|alpha_numeric_space|max_length[255]',
        'qty' => 'required|numeric',
        'purchase_price' => 'required|numeric',
        'selling_price' => 'required|numeric',
        'description' => 'permit_empty|alpha_numeric_space|max_length[255]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Nama barang tidak boleh kosong',
            'alpha_numeric_space' => 'Nama barang tidak boleh berisi karakter selain alfabet, angka, dan spasi',
            'max_length' => 'Nama barang maksimal 255 karakter',
        ],
        'qty' => [
            'required' => 'Jumlah barang tidak boleh kosong',
            'numeric' => 'Jumlah barang hanya boleh diisi angka',
        ],
        'purchase_price' => [
            'required' => 'Harga Beli tidak boleh kosong',
            'numeric' => 'Harga Beli hanya boleh diisi angka',
        ],
        'selling_price' => [
            'required' => 'Harga Jual tidak boleh kosong',
            'numeric' => 'Harga Jual hanya boleh diisi angka',
        ],
        'description' => [
            'alpha_numeric_space' => 'Deskripsi barang tidak boleh berisi karakter selain alfabet, angka, dan spasi',
            'max_length' => 'Deskripsi barang maksimal 255 karakter',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
}
