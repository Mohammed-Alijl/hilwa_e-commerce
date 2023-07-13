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
            'units.view',
            'units.add',
            'units.edit',
            'units.delete',

            //Store
            'stores.view',
            'stores.add',
            'stores.edit',
            'stores.delete',

            //Setting
            'settings.view',
            'settings.add',
            'settings.edit',
            'settings.delete',

            //Timeslot
            'timeslots.view',
            'timeslots.add',
            'timeslots.edit',
            'timeslots.delete',

            //Users
            'users.view',
            'users.add',
            'users.edit',
            'users.delete',

            //Roles
            'Roles.view',
            'Roles.add',
            'Roles.edit',
            'Roles.delete',

            //Zones
            'zones.view',
            'zones.add',
            'zones.edit',
            'zones.delete',

            //Logs
            'logs.view',
            'logs.add',
            'logs.edit',
            'logs.delete',

            //Rewards
            'rewards.view',
            'rewards.add',
            'rewards.edit',
            'rewards.delete',

            //Cms Pages
            'cms-pages.view',
            'cms-pages.add',
            'cms-pages.edit',
            'cms-pages.delete',

            //Holidays
            'holidays.view',
            'holidays.add',
            'holidays.edit',
            'holidays.delete',

            //Chats
            'chats.view',

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
