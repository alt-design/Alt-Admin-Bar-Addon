{!! $adminBarStyles !!}

<div id="alt-admin-bar" class="alt-admin-bar alt-admin-bar-w-full alt-admin-bar-p-0 alt-admin-bar-flex alt-admin-bar-bg-[#333333] alt-admin-bar-text-sm alt-admin-bar-fixed alt-admin-bar-top-0 alt-admin-bar-justify-between">
    <div class="alt-admin-bar-flex alt-admin-bar-text-white alt-admin-bar-items-center">

        <!-- Non Negotiables -->
        <a class="alt-admin-bar-px-4 alt-admin-bar-bg-gradient-to-r alt-admin-bar-from-pink-500 alt-admin-bar-via-yellow-400 alt-admin-bar-to-blue-500
              alt-admin-bar-bg-400 alt-admin-bar-bg-clip-text alt-admin-bar-text-transparent alt-admin-bar-transition-all alt-admin-bar-duration-500
              hover:alt-admin-bar-animate-gradient-x alt-admin-bar-font-bold" href="/">{{ config('app.name') }}</a>

        <a class="hover:alt-admin-bar-bg-[#555555] alt-admin-bar-px-4 alt-admin-bar-py-2 alt-admin-bar-flex" href="@antlers{{ cp_url }}@endantlers">
            <svg class="alt-admin-bar-h-[18px] alt-admin-bar-mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="7" cy="8.5" r="3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7 5v3.5h3.5M9 22.5a6.979 6.979 0 0 0 1.5-4m4.5 4a6.979 6.979 0 0 1-1.5-4m-6.001 4h9M.5 15.5h23"></path><rect width="23" height="17" x=".5" y="1.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" rx="1" ry="1"></rect><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.5 7 15 5l3 2.5 2.5-3m-1 8V11m-2 1.5v-2m-2 2v-3m-2 3V11"></path></svg>
            <span>
                Admin
            </span>
        </a>

        <a class="hover:alt-admin-bar-bg-[#555555] alt-admin-bar-px-4 alt-admin-bar-py-2 alt-admin-bar-flex" href="@antlers{{ edit_url }}@endantlers">
            <svg class="alt-admin-bar-h-[18px] alt-admin-bar-mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M19.479 8V2.5a2 2 0 0 0-2-2h-12a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h8l3 3v-3h1a2 2 0 0 0 1.721-.982"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M1.485 3.764A2 2 0 0 0 .479 5.5v16a2 2 0 0 0 2 2h8a2 2 0 0 0 1.712-.967M5.479 3.5h4m-2 4.5V3.5M15.7 7.221l-4.2-1.2 1.2 4.2 7.179 7.179a2.121 2.121 0 0 0 3-3zm3.279 9.279 3-3M12.7 10.221l3-3M12.479 3.5h4m-10 8h4m-4 3h6.5m-6.5 3h9"></path></svg>
            <span>
                Edit
            </span>
        </a>
        <!-- End -->

        @foreach( $menuItems as $menuKey => $menuItem )
            <div class="alt-admin-bar-group alt-admin-bar-relative">
                <a class="hover:alt-admin-bar-bg-[#555555] alt-admin-bar-px-4 alt-admin-bar-py-2 alt-admin-bar-inline-block" href="{{ $menuItem->href ?? '#' }}">
                    {{ $menuItem->title }}
                </a>

                @if( $menuItem->hasChildren )
                    <div class="alt-admin-bar-opacity-0 group-hover:alt-admin-bar-opacity-100 alt-admin-bar-absolute alt-admin-bar-top-full alt-admin-bar-left-0 alt-admin-bar-max-w-[400px] alt-admin-bar-bg-[#333333]">
                        @foreach($menuItem->children as $childKey => $child )
                            @if ($child->post)
                                <form method="POST" action="{{ $child->href }}">
                                    @csrf
                                    <button class="alt-admin-bar-px-3 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1.5 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-whitespace-nowrap">{{ $child->title }}</button>
                                </form>
                            @else
                                <a class="alt-admin-bar-px-3 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1.5 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $child->href }}" >{{ $child->title }}</a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="alt-admin-bar-flex alt-admin-bar-text-white alt-admin-bar-items-center">
        <div class="alt-admin-bar-group alt-admin-bar-relative">
            <a class="alt-admin-bar-px-4 alt-admin-bar-py-2 alt-admin-bar-flex alt-admin-bar-items-center hover:alt-admin-bar-bg-[#555555]" href="{{ $profileUrl }}">
                <span>Hey there {{ auth()->user()->name ?? '' }}!</span>
                <div class="alt-admin-bar-bg-[#555555] alt-admin-bar-uppercase alt-admin-bar-ml-3 alt-admin-bar-w-[22px] alt-admin-bar-h-[22px] alt-admin-bar-rounded-full alt-admin-bar-flex alt-admin-bar-items-center alt-admin-bar-justify-center">
                    {{ $avatar }}
                </div>
            </a>
            <div class="alt-admin-bar-opacity-0 group-hover:alt-admin-bar-opacity-100 alt-admin-bar-absolute alt-admin-bar-top-full alt-admin-bar-right-0 alt-admin-bar-max-w-[400px] alt-admin-bar-py-1.5 alt-admin-bar-bg-[#333333]">
                <a class="alt-admin-bar-pl-3 alt-admin-bar-pr-8 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1.5 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $preferencesUrl }}">Preferences</a>
                <a class="alt-admin-bar-pl-3 alt-admin-bar-pr-8 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1.5 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $profileUrl }}">Profile</a>
                <a class="alt-admin-bar-pl-3 alt-admin-bar-pr-8 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1.5 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ cp_route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>document.body.style.paddingTop = document.querySelector('#alt-admin-bar').offsetHeight + 'px';</script>
