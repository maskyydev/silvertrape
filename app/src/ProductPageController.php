<?php

namespace App\Page;

use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use App\Model\Product;
use SilverStripe\View\Requirements;

class ProductPageController extends PageController
{
    private static $allowed_actions = [
        'ProductForm',
        'submitProduct',
        'refreshTable',
    ];

    public function init()
    {
        parent::init();
        // Memuat jQuery dan file JS kustom untuk AJAX
        Requirements::javascript('code.jquery.com');
        Requirements::javascript('app/client/dist/js/ajax-submit.js');
    }

    public function ProductForm()
    {
        $fields = FieldList::create(
            TextField::create('Name', 'Nama'),
            NumericField::create('Price', 'Harga')
        );

        $actions = FieldList::create(
            FormAction::create('submitProduct', 'Tambah Produk')
                ->setUse	(true) // Menggunakan AJAX
        );

        $validator = RequiredFields::create(['Name', 'Price']);

        $form = Form::create($this, __FUNCTION__, $fields, $actions, $validator);
        $form->setFormAction($this->Link('submitProduct'));
        return $form;
    }

    public function submitProduct(array $data, Form $form, HTTPRequest $request)
    {
        if ($request->isAjax()) {
            $product = Product::create();
            $product->Name = $data['Name'];
            $product->Price = $data['Price'];
            $product->write();

            // Mengembalikan respons sukses atau merender tabel parsial
            return $this->refreshTable($request);
        }
        
        // Respons fallback untuk non-AJAX
        return $this->redirectBack();
    }

    public function refreshTable(HTTPRequest $request)
    {
        // Memastikan hanya merender bagian tabel untuk permintaan AJAX
        if ($request->isAjax()) {
            return $this->renderWith('App\\Page\\Includes\\ProductTable');
        }
        return $this->redirectBack();
    }

    public function Products()
    {
        return Product::get();
    }
}
