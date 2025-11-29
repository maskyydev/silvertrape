<?php

namespace App\Model;

use SilverStripe\ORM\DataObject;

class Product extends DataObject
{
    private static $db = [
        'Name' => 'Varchar(255)',
        'Price' => 'Decimal(10,2)',
    ];

    private static $summary_fields = [
        'Name' => 'Nama Produk',
        'Price' => 'Harga',
    ];
    
    // Opsional: tambahkan ini untuk mengelola produk dari antarmuka admin
    private static $table_name = 'Product';
}
