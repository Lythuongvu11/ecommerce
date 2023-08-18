<div class="sidebar">
    <div class="sidebar__inner">
        <div class="profile">
            <div class="img">
                <img src="{{asset('admin/images/ảnh thẻ.jpg')}}" alt="Image">
            </div>
            <div class="profile_info">
                <p>Welcome</p>
                <p class="profile_name">Thuong Vu</p>
            </div>
        </div>
        <ul>
            <li>
                <a  href="{{route('dashboard')}}" class="{{request()->routeIs('dashboard')? 'active' :''}} ">
                    <span class="icon"><i class="fas fa-dice-d6"></i></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('roles.index')}}" class="{{request()->routeIs('roles.*')? 'active' :''}}">
                    <span class="icon"><i class="fab fa-delicious"></i></span>
                    <span class="title">Roles</span>
                </a>
            </li>
            <li>
                <a href="{{route('users.index')}}" class="{{request()->routeIs('users.*')? 'active' :''}}">
                    <span class="icon"><i class="fab fa-elementor"></i></span>
                    <span class="title">User</span>
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="{{route('products.index')}}" class="{{request()->routeIs('products.*')? 'active' :''}}">--}}
{{--                    <span class="icon"><i class="fas fa-chart-pie"></i></span>--}}
{{--                    <span class="title">Product</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="{{route('categories.index')}}" class="{{request()->routeIs('categories.*')? 'active' :''}}">
                    <span class="icon"><i class="fas fa-border-all"></i></span>
                    <span class="title">Category</span>
                </a>
            </li>
        </ul>
    </div>
</div>
