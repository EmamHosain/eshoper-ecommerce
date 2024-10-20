<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link--> <a href="{{ route('admin.admin_dasboard') }}" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
            <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->


    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                </li>

                {{-- brand --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Brand
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_brand') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Brand</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_brand') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Brand</p>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- category --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Category
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_category') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_category') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Category</p>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- category slider--}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Category Slider
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_category_slider') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Category Slider</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_category_slider') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Category Slider</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- color start --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Product Color
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_color') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Color</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_color') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Color</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- product size start --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Product Size
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_size') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Size</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_size') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Size</p>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- product --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Product
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_product') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Product</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_product') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Product</p>
                            </a>
                        </li>

                    </ul>
                </li>



                {{-- coupon --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Coupon
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_coupon') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Coupon</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.add_coupon') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Coupon</p>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- shipping manage --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Shipping Manage
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_shipping') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Shipping</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.add_shipping') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Shipping</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- customer manage --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Customer Manage
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_customer') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.add_customer') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Customer</p>
                            </a>
                        </li>

                    </ul>
                </li>



                {{-- all order --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Order Manage
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_order') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Order</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- offer --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Offer
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.all_offer') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>All Offer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.add_offer') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Offer</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Page Options
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.about_us') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Edit about page</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.edit_contact_page') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Edit contact page info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Edit footer</p>
                            </a>
                        </li>

                    </ul>
                </li>



                <li class="nav-item">
                    <a href="{{ route('admin.all_contact') }}" class="nav-link"> <i
                            class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            All Contact

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.get_all_subscriber_user') }}" class="nav-link"> <i
                            class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            All Subscriber User
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link"> <i
                            class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                            Logout

                        </p>
                    </a>
                </li>




            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->