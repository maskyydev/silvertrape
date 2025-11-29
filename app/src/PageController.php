<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\ORM\ArrayList;
    use SilverStripe\View\ArrayData;

    /**
     * @template T of Page
     * @extends ContentController<T>
     */
    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();
            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
        }

        public function getUsersList()
        {
            // Data array PHP mentah Anda
            $usersArray = [
                ["name" => "John", "age" => 22],
                ["name" => "Anna", "age" => 25],
                ["name" => "Mike", "age" => 30]
            ];

            // Bungkus data ke dalam ArrayList yang berisi ArrayData
            $userList = ArrayList::create();
            foreach ($usersArray as $userData) {
                $userList->push(ArrayData::create($userData));
            }

            return $userList;
        }

        public function calculateDiscount($price, $percent)
        {
            // Formula: harga_akhir = harga - (harga * persen / 100)
            $discountAmount = ($price * $percent) / 100;
            $finalPrice = $price - $discountAmount;

            return $finalPrice;
        }
    }
}
