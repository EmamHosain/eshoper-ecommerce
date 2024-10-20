<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products_groups = [
            'product_menu',
            'product_create',
            'product_edit',
            'product_read',
            'product_delete',
        ];

        foreach ($products_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Product',
            ]);
        }

        // Category permissions
        $category_groups = [
            'category_menu',
            'category_create',
            'category_edit',
            'category_read',
            'category_delete',
        ];

        foreach ($category_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Category',
            ]);
        }


        // Brand permissions
        $brand_groups = [
            'brand_menu',
            'brand_create',
            'brand_edit',
            'brand_read',
            'brand_delete',
        ];

        foreach ($brand_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Brand',
            ]);
        }

        // Category Slider permissions
        $category_slider_groups = [
            'category_slider_menu',
            'category_slider_create',
            'category_slider_edit',
            'category_slider_read',
            'category_slider_delete',
        ];

        foreach ($category_slider_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Category Slider',
            ]);
        }



        // Color permissions
        $color_groups = [
            'color_menu',
            'color_create',
            'color_edit',
            'color_read',
            'color_delete',
        ];

        foreach ($color_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Color',
            ]);
        }


        // Size permissions
        $size_groups = [
            'size_menu',
            'size_create',
            'size_edit',
            'size_read',
            'size_delete',
        ];

        foreach ($size_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Size',
            ]);
        }


        // Shipping permissions
        $shipping_groups = [
            'shipping_menu',
            'shipping_create',
            'shipping_edit',
            'shipping_read',
            'shipping_delete',
        ];

        foreach ($shipping_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Shipping',
            ]);
        }


        // Customer permissions
        $customer_groups = [
            'customer_menu',
            'customer_create',
            'customer_edit',
            'customer_read',
            'customer_delete',
        ];

        foreach ($customer_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Customer',
            ]);
        }



        // Order permissions
        $order_groups = [
            'order_menu',
            'order_edit',
            'order_read',
            'order_delete',
        ];

        foreach ($order_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Order',
            ]);
        }


        // Offer permissions
        $offer_groups = [
            'offer_menu',
            'offer_create',
            'offer_edit',
            'offer_read',
            'offer_delete',
        ];

        foreach ($offer_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Offer',
            ]);
        }


        // Page Options permissions
        $page_options_groups = [
            'page_options_menu',
            'about_page_edit',
            'contact_page_edit',
            'edit_footer',
        ];

        foreach ($page_options_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Page Options',
            ]);
        }


        // Contact permissions
        $contact_groups = [
            'contact_menu',
            'contact_create',
            'contact_edit',
            'contact_read',
            'contact_delete',
        ];

        foreach ($contact_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Contact',
            ]);
        }


        // Subscriber User permissions
        $subscriber_user_groups = [
            'subscriber_user_menu',
            'subscriber_user_create',
            'subscriber_user_edit',
            'subscriber_user_read',
            'subscriber_user_delete',
        ];

        foreach ($subscriber_user_groups as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'admin',
                'group_name' => 'Subscriber User',
            ]);
        }




    }
}
