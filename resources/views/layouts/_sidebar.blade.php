<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li style="background: #E34724">
            <a style="font-size:20px; text-align:center; font-weight:bold" href="{{ url('backend/dashboard') }}">Easy
                Dokan</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="{{ url('public/assets/images/users/avatar.jpg') }}" alt="Chal Ghuri" />
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="{{ url('upload/dokanlogo.png') }}" alt="Chalghuri" />
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">Easy Dokan</div>
                    <div class="profile-data-title">Manage Smarter, Grow Faster</div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>
        <li class="xn-title">Business</li>
        <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <a href="{{ url('backend/dashboard') }}"><span class="fa fa-desktop"></span> <span
                    class="xn-text">ড্যাশবোর্ড</span></a>
        </li>

        <li class="">
            <a href="{{ url('backend/dashboard') }}"><span class="fa fa-plus-square-o"></span> <span
                    class="xn-text">ক্রয়</span></a>
        </li>
        <li class="">
            <a href="{{ url('backend/dashboard') }}"><span class="fa fa-shopping-cart"></span> <span
                    class="xn-text">বিক্রয়</span></a>
        </li>


        <li class="xn-openable">
            <a href="#"><span class="fa fa-gift"></span> <span class="xn-text">প্রোডাক্ট</span></a>
            <ul>
                <li><a href="{{ url('products/add') }}"><span class="fa fa-plus"></span> এড প্রোডাক্ট</a></li>
                <li><a href="{{ url('products/list') }}"><span class="fa fa-bars"></span> প্রোডাক্ট লিস্ট</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-cubes"></span> <span class="xn-text">স্টক</span></a>
            <ul>
                <li><a href="{{ url('products/add') }}"><span class="fa fa-plus"></span> এড প্রোডাক্ট</a></li>
                <li><a href="{{ url('products/list') }}"><span class="fa fa-bars"></span> প্রোডাক্ট লিস্ট</a></li>
            </ul>
        </li>




        {{-- <li class="xn-openable">
            <a href="#"><span class="fa fa-gift"></span> <span class="xn-text">Assets</span></a>
            <ul>
                <li><a href="{{ url('asset/add') }}"><span class="fa fa-plus"></span> Add Asset</a></li>
                <li><a href="{{ url('asset/list') }}"><span class="fa fa-bars"></span> Asset List</a></li>
            </ul>
        </li> --}}


        <li class="xn-title">Adminirtation</li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-user"></span> <span class="xn-text">এডমিন</span></a>
            <ul>
                <li><a href="{{ url('admins/add') }}"><span class="fa fa-plus"></span> Add Admin</a></li>
                <li><a href="{{ url('admins/list') }}"><span class="fa fa-bars"></span> Admin List</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">কর্মকর্তা/কর্মচারী</span></a>
            <ul>
                <li><a href="{{ url('employee/add') }}"><span class="fa fa-plus"></span> Add Employee</a></li>
                <li><a href="{{ url('employee/list') }}"><span class="fa fa-bars"></span> Employee List</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">গ্রাহক</span></a>
            <ul>
                <li><a href="{{ url('employee/add') }}"><span class="fa fa-plus"></span> এড সাপ্লাইয়ার</a></li>
                <li><a href="{{ url('employee/list') }}"><span class="fa fa-bars"></span> সাপ্লাইয়ার লিস্ট</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">সাপ্লাইয়ার</span></a>
            <ul>
                <li><a href="{{ url('supplier/add') }}"><span class="fa fa-plus"></span> এড সাপ্লাইয়ার</a></li>
                <li><a href="{{ url('supplier/list') }}"><span class="fa fa-bars"></span> সাপ্লাইয়ার লিস্ট</a></li>
            </ul>
        </li>


        <li class="xn-title">Settings</li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-user"></span> <span class="xn-text">এডমিন</span></a>
            <ul>
                <li><a href="{{ url('admins/add') }}"><span class="fa fa-plus"></span> Add Admin</a></li>
                <li><a href="{{ url('admins/list') }}"><span class="fa fa-bars"></span> Admin List</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">কর্মকর্তা/কর্মচারী</span></a>
            <ul>
                <li><a href="{{ url('employee/add') }}"><span class="fa fa-plus"></span> Add Employee</a></li>
                <li><a href="{{ url('employee/list') }}"><span class="fa fa-bars"></span> Employee List</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">গ্রাহক</span></a>
            <ul>
                <li><a href="{{ url('employee/add') }}"><span class="fa fa-plus"></span> এড সাপ্লাইয়ার</a></li>
                <li><a href="{{ url('employee/list') }}"><span class="fa fa-bars"></span> সাপ্লাইয়ার লিস্ট</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">সাপ্লাইয়ার</span></a>
            <ul>
                <li><a href="{{ url('supplier/add') }}"><span class="fa fa-plus"></span> Add Customer</a></li>
                <li><a href="{{ url('supplier/list') }}"><span class="fa fa-bars"></span> Customer List</a></li>
            </ul>
        </li>


    </ul>

</div>
