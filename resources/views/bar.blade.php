{!! $adminBarStyles !!}

<div id="alt-admin-bar" class="alt-admin-bar alt-admin-bar-w-full alt-admin-bar-p-0 alt-admin-bar-flex alt-admin-bar-bg-[#333333] alt-admin-bar-text-sm alt-admin-bar-fixed alt-admin-bar-top-0 alt-admin-bar-justify-between">
    <div class="alt-admin-bar-flex alt-admin-bar-text-white alt-admin-bar-items-center">

        <a class="alt-admin-bar-px-4" href="/">{{ config('app.name') }}</a>

        @foreach( $menuItems as $menuKey => $menuItem )
            <div class="alt-admin-bar-group alt-admin-bar-relative">
                <a class="hover:alt-admin-bar-bg-[#555555] alt-admin-bar-px-4 alt-admin-bar-py-2 alt-admin-bar-inline-block" href="{{ $menuItem->href ?? '#' }}">
                    {{ $menuItem->title }}
                </a>

                @if( $menuItem->hasChildren )
                    <div class="alt-admin-bar-opacity-0 group-hover:alt-admin-bar-opacity-100 alt-admin-bar-absolute alt-admin-bar-top-full alt-admin-bar-left-0 alt-admin-bar-max-w-[400px] alt-admin-bar-py-1 alt-admin-bar-bg-[#333333]">
                        @foreach($menuItem->children as $childKey => $child )
                            @if ($child->post)
                                <form method="POST" action="{{ $child->href }}">
                                    @csrf
                                    <button class="alt-admin-bar-px-3 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-whitespace-nowrap">{{ $child->title }}</button>
                                </form>
                            @else
                                <a class="alt-admin-bar-px-3 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $child->href }}" >{{ $child->title }}</a>
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
                <div class="alt-admin-bar-bg-[#555555] alt-admin-bar-ml-3 alt-admin-bar-w-[22px] alt-admin-bar-h-[22px] alt-admin-bar-rounded-full alt-admin-bar-flex alt-admin-bar-items-center alt-admin-bar-justify-center">
                    {{ $avatar }}
                </div>
            </a>
            <div class="alt-admin-bar-opacity-0 group-hover:alt-admin-bar-opacity-100 alt-admin-bar-absolute alt-admin-bar-top-full alt-admin-bar-right-0 alt-admin-bar-max-w-[400px] alt-admin-bar-py-1 alt-admin-bar-bg-[#333333]">
                <a class="alt-admin-bar-pl-3 alt-admin-bar-pr-8 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $preferencesUrl }}">Preferences</a>
                <a class="alt-admin-bar-pl-3 alt-admin-bar-pr-8 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $profileUrl }}">Profile</a>
                <a class="alt-admin-bar-pl-3 alt-admin-bar-pr-8 alt-admin-bar-w-full alt-admin-bar-text-left alt-admin-bar-py-1 hover:alt-admin-bar-bg-[#555555] alt-admin-bar-mb-2 alt-admin-bar-inline-block alt-admin-bar-whitespace-nowrap" href="{{ $logoutUrl }}">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>document.body.style.paddingTop = document.querySelector('#alt-admin-bar').offsetHeight + 'px';</script>
