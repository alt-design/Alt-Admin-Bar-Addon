
<div class="alt-admin-bar">
    {!! $adminBarStyles !!}
    <div class="alt-admin-bar-main">
        <div class="alt-admin-bar-left">
            <div class="flex items-center justify-center mx-2">
                <a href="https://statamic.com/sellers/alt-design" class="group h-full flex items-center justify-center overflow-hidden">
                    <img src="{{ $logo }}" class="h-10 group-hover:h-16 transition-all aspect-square"/>
                </a>
            </div>

            <a class="group alt-admin-bar-item alt-bg  hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]"
               href="/cp">
                <!-- Button -->
                <div class="flex h-full items-center justify-center">
                    Control Panel
                </div>
            </a>

            <a class="group alt-admin-bar-item alt-bg  hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]"
               href="/cp">
                <!-- Button -->
                <div class="flex h-full items-center justify-center">
                    Edit Page
                </div>
            </a>

            <div class="group alt-admin-bar-item alt-bg  hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]">
                <!-- Button -->
                <div class="flex h-full items-center justify-center">
                    Settings
                </div>

                <!-- Dropdown Menu -->
                <div class="alt-dropdown-menu">
                    <a href="#" class="block px-4 py-2 alt-bg hover:text-alt-grey transition-none hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]">Profile</a>
                    <a href="#" class="block px-4 py-2 alt-bg hover:text-alt-grey transition-none hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]">Account</a>
                    <a href="#" class="block px-4 py-2 alt-bg hover:text-alt-grey transition-none hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]">Logout</a>
                </div>
            </div>

            @foreach( $menuItems as $menuKey => $menuItem )
                <div class="group alt-admin-bar-item alt-bg  hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]">
                    <!-- Button -->
                    @if( $menuItem->href )
                        <a href="{{ $menuItem->href }}" class="flex h-full items-center justify-center">
                            {{ $menuItem->title }}
                        </a>
                    @else
                        <div class="flex h-full items-center justify-center">
                            {{ $menuItem->title }}
                        </div>
                    @endif

                    @if( $menuItem->hasChildren )
                        <!-- Dropdown Menu -->
                        <div class="alt-dropdown-menu">
                            @foreach($menuItem->children as $childKey => $child )
                            <a href="{{ $child->href }}" class="{{ $child->style }}">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

        </div>


        <div class="alt-admin-bar-right">
            <div class="alt-admin-avatar-container alt-admin-bar-item">
                <a href="{{ $profileUrl }}" class="alt-admin-avatar">{{ $avatar }}</a>
            </div>
        </div>
    </div>
</div>
