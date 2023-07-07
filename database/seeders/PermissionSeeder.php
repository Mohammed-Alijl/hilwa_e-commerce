<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            //Dashboards
            'dashboards.view',

            //Orders
            'orders.view',
            'orders.add',
            'orders.edit',

            //Customers
            'customers.view',
            'customers.add',
            'customers.edit',
            'customers.delete',

            //Drivers
            'drivers.view',
            'drivers.add',
            'drivers.edit',
            'drivers.delete',

            //Contact Request
            'contact-request.view',
            'contact-request.add',
            'contact-request.edit',
            'contact-request.delete',

            //Review
            'review.view',
            'review.add',
            'review.edit',
            'review.delete',

            //Category
            'category.view',
            'category.add',
            'category.edit',
            'category.delete',

            //Product
            'product.view',
            'product.add',
            'product.edit',
            'product.delete',

            //Attribute
            'attribute.view',
            'attribute.add',
            'attribute.edit',
            'attribute.delete',

            //Returns
            'returns.view',
            'returns.add',
            'returns.edit',
            'returns.delete',

            //Comment
            'comment.view',

            //Advertisement
            'advertisement.view',
            'advertisement.add',
            'advertisement.edit',
            'advertisement.delete',

            //Marketing
            'marketing.view',
            'marketing.add',
            'marketing.edit',
            'marketing.delete',

            //Coupons
            'coupons.view',
            'coupons.add',
            'coupons.edit',
            'coupons.delete',

            //Unit
            'unit.view',
            'unit.add',
            'unit.edit',
            'unit.delete',

            //Store
            'store.view',
            'store.add',
            'store.edit',
            'store.delete',

            //Setting
            'settings.view',
            'settings.add',
            'settings.edit',
            'settings.delete',

            //Driver Timeslot
            'driver-timeslots.view',
            'driver-timeslots.add',
            'driver-timeslots.edit',
            'driver-timeslots.delete',

            //Users
            'users.view',
            'users.add',
            'users.edit',
            'users.delete',

            //Zone
            'zone.view',
            'zone.add',
            'zone.edit',
            'zone.delete',

            //Driver Order
            'driver-order.view',
            'driver-order.add',
            'driver-order.edit',
            'driver-order.delete',

            //Log
            'log.view',
            'log.add',
            'log.edit',
            'log.delete',

            //Reward
            'reward.view',
            'reward.add',
            'reward.edit',
            'reward.delete',

            //Cms Pages
            'cms-pages.view',
            'cms-pages.add',
            'cms-pages.edit',
            'cms-pages.delete',

            //Holiday
            'holiday.view',
            'holiday.add',
            'holiday.edit',
            'holiday.delete',

            //Chat
            'chat.view',

            //Order Status
            'order-status.view',

            //Pre Sales Customer
            'pre-sales-customer.view',
            'pre-sales-customer.add',
            'pre-sales-customer.edit',
            'pre-sales-customer.delete',

            //Payment Services
            'payment-services.view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
