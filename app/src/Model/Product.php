<?php

namespace App\Model;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CurrencyField;

class Product extends DataObject
{
    private static $db = [
        'Name' => 'Varchar(255)',
        'Price' => 'Currency',
    ];

    private static $summary_fields = [
        'Name' => 'Nama Produk',
        'Price.Nice' => 'Harga',
    ];

    private static $table_name = 'Product';

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Name', 'Nama Produk'),
            CurrencyField::create('Price', 'Harga')
        );
        return $fields;
    }
}
