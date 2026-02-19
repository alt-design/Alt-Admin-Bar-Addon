{!! $adminBarStyles !!}

<div id="alt-admin-bar" class="alt-admin-bar altadminbar:w-full altadminbar:p-0 altadminbar:flex altadminbar:bg-[#333333] altadminbar:text-sm altadminbar:fixed altadminbar:top-0 altadminbar:z-[500] altadminbar:justify-between">
    <div class="altadminbar:flex altadminbar:text-white altadminbar:items-center">

        <!-- Non Negotiables -->
        <a class="altadminbar:px-4 altadminbar:bg-gradient-to-r altadminbar:from-pink-500 altadminbar:via-yellow-400 altadminbar:to-blue-500
              altadminbar:bg-400 altadminbar:bg-clip-text altadminbar:text-transparent altadminbar:transition-all altadminbar:duration-500
              altadminbar:hover:animate-gradient-x altadminbar:font-bold" href="/">{{ config('app.name') }}</a>

        <a class="altadminbar:hover:bg-[#555555] altadminbar:px-4 altadminbar:py-2 altadminbar:flex" href="@antlers{{ cp_url }}@endantlers">
            <svg class="altadminbar:h-[18px] altadminbar:mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="7" cy="8.5" r="3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7 5v3.5h3.5M9 22.5a6.979 6.979 0 0 0 1.5-4m4.5 4a6.979 6.979 0 0 1-1.5-4m-6.001 4h9M.5 15.5h23"></path><rect width="23" height="17" x=".5" y="1.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" rx="1" ry="1"></rect><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.5 7 15 5l3 2.5 2.5-3m-1 8V11m-2 1.5v-2m-2 2v-3m-2 3V11"></path></svg>
            <span>
                Admin
            </span>
        </a>

        <a class="altadminbar:hover:bg-[#555555] altadminbar:px-4 altadminbar:py-2 altadminbar:flex" href="@antlers{{ edit_url }}@endantlers">
            <svg class="altadminbar:h-[18px] altadminbar:mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M19.479 8V2.5a2 2 0 0 0-2-2h-12a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h8l3 3v-3h1a2 2 0 0 0 1.721-.982"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M1.485 3.764A2 2 0 0 0 .479 5.5v16a2 2 0 0 0 2 2h8a2 2 0 0 0 1.712-.967M5.479 3.5h4m-2 4.5V3.5M15.7 7.221l-4.2-1.2 1.2 4.2 7.179 7.179a2.121 2.121 0 0 0 3-3zm3.279 9.279 3-3M12.7 10.221l3-3M12.479 3.5h4m-10 8h4m-4 3h6.5m-6.5 3h9"></path></svg>
            <span>
                Edit
            </span>
        </a>
        <!-- End -->

        @foreach($menuItems as $menuKey => $menuItem)
            <div class="altadminbar:group altadminbar:relative">
                <a class="altadminbar:hover:bg-[#555555] altadminbar:px-4 altadminbar:py-2 altadminbar:inline-block" href="{{ $menuItem->href ?? '#' }}">
                    {{ $menuItem->title }}
                </a>

                @if( $menuItem->hasChildren )
                    <div class="altadminbar:opacity-0 altadminbar:pointer-events-none  altadminbar:group-hover:opacity-100  altadminbar:group-hover:pointer-events-auto altadminbar:absolute altadminbar:top-full altadminbar:left-0 altadminbar:max-w-[400px] altadminbar:bg-[#333333] altadminbar:z-[500] altadminbar:transition-opacity altadminbar:duration-300">
                        @foreach($menuItem->children as $childKey => $child )
                            @if ($child->post)
                                <form method="POST" action="{{ $child->href }}">
                                    @csrf
                                    <button class="altadminbar:px-3 altadminbar:w-full altadminbar:text-left altadminbar:py-1.5 altadminbar:hover:bg-[#555555] altadminbar:whitespace-nowrap">{{ $child->title }}</button>
                                </form>
                            @else
                                <a class="altadminbar:px-3 altadminbar:w-full altadminbar:text-left altadminbar:py-1.5 altadminbar:hover:bg-[#555555] altadminbar:mb-2 altadminbar:inline-block altadminbar:whitespace-nowrap" href="{{ $child->href }}" >{{ $child->title }}</a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="altadminbar:flex altadminbar:text-white altadminbar:items-center">
        @if($revisionsEnabled)
        <div class="altadminbar:group altadminbar:relative">
            <a class="altadminbar:px-4 altadminbar:py-2 altadminbar:flex altadminbar:items-center altadminbar:hover:bg-[#555555]
            @if($activeEpoch)altadminbar:px-4 altadminbar:bg-gradient-to-r altadminbar:from-pink-500 altadminbar:via-yellow-400 altadminbar:to-blue-500
              altadminbar:bg-400 altadminbar:bg-clip-text altadminbar:text-transparent altadminbar:transition-all altadminbar:duration-500
              altadminbar:hover:animate-gradient-x @endif" href="{{ $profileUrl }}">
                Revisions
            </a>
            <div class="
                altadminbar:opacity-0
                altadminbar:px-2
                 altadminbar:group-hover:opacity-100
                altadminbar:absolute altadminbar:top-full
                altadminbar:right-0
                altadminbar:max-w-[400px]
                altadminbar:min-w-56
                altadminbar:py-1.5
                altadminbar:bg-[#333333]
                altadminbar:overflow-scroll
                altadminbar:max-h-64">
                <a href="{{
                        cp_route('alt-admin-bar.revision.set',
                        array_merge(
                            $revisionHrefData,
                            [ 'epoch' => null ]
                        )) }}">
                    <div @class([
                            'altadminbar:px-3',
                            'altadminbar:py-1.5',
                            'altadminbar:mb-2',
                            'altadminbar:w-full',
                            'altadminbar:min-w-36',
                            'altadminbar:inline-block',
                            'altadminbar:whitespace-nowrap',
                            'altadminbar:text-left',
                            'altadminbar:hover:bg-[#555555]',
                            'altadminbar:bg-white' => ! $activeEpoch,
                            'altadminbar:text-[#333333]' => ! $activeEpoch,
                            'altadminbar:hover:text-white' => ! $activeEpoch,
                            ])>
                        <div>Published Version</div>
                        <div class="altadminbar:text-xs">{{ now()->format('y/m/d H:i') }}</div>
                    </div>
                </a>
                @forelse($revisions as $epoch => $revision)
                    <a href="{{
                        cp_route('alt-admin-bar.revision.set',
                        array_merge(
                            $revisionHrefData,
                            [ 'epoch' => $epoch ]
                        )) }}">
                        <div @class([
                            'altadminbar:px-3',
                            'altadminbar:py-1.5',
                            'altadminbar:mb-2',
                            'altadminbar:w-full',
                            'altadminbar:min-w-36',
                            'altadminbar:inline-block',
                            'altadminbar:whitespace-nowrap',
                            'altadminbar:text-left',
                            'altadminbar:hover:bg-[#555555]',
                            'altadminbar:bg-white' => $epoch == $activeEpoch,
                            'altadminbar:text-[#333333]' => $epoch == $activeEpoch,
                            'altadminbar:hover:text-white' => $epoch == $activeEpoch,
                            ])>
                            <div>{{ $revision->message() }}</div>
                            <div class="altadminbar:text-xs">{{ \Carbon\Carbon::parse($epoch)->format('y/m/d H:i') }}</div>
                        </div>
                    </a>
                @empty
                    <div>No revisions for this page</div>
                @endforelse
            </div>
        </div>
        @endif
        <div class="altadminbar:group altadminbar:relative">
            <a class="altadminbar:px-4 altadminbar:py-2 altadminbar:flex altadminbar:items-center altadminbar:hover:bg-[#555555]" href="{{ $profileUrl }}">
                <span>Hey there {{ auth()->user()->name ?? '' }}!</span>
                <div class="altadminbar:bg-[#555555] altadminbar:uppercase altadminbar:ml-3 altadminbar:w-[22px] altadminbar:h-[22px] altadminbar:rounded-full altadminbar:flex altadminbar:items-center altadminbar:justify-center">
                    {{ $avatar }}
                </div>
            </a>
            <div class="altadminbar:opacity-0 altadminbar:pointer-events-none  altadminbar:group-hover:opacity-100  altadminbar:group-hover:pointer-events-auto altadminbar:absolute altadminbar:top-full altadminbar:right-0 altadminbar:max-w-[400px] altadminbar:py-1.5 altadminbar:bg-[#333333] altadminbar:transition-opacity altadminbar:duration-300">
                <a class="altadminbar:pl-3 altadminbar:pr-8 altadminbar:w-full altadminbar:text-left altadminbar:py-1.5 altadminbar:hover:bg-[#555555] altadminbar:mb-2 altadminbar:inline-block altadminbar:whitespace-nowrap" href="{{ $preferencesUrl }}">Preferences</a>
                <a class="altadminbar:pl-3 altadminbar:pr-8 altadminbar:w-full altadminbar:text-left altadminbar:py-1.5 altadminbar:hover:bg-[#555555] altadminbar:mb-2 altadminbar:inline-block altadminbar:whitespace-nowrap" href="{{ $profileUrl }}">Profile</a>
                <a class="altadminbar:pl-3 altadminbar:pr-8 altadminbar:w-full altadminbar:text-left altadminbar:py-1.5 altadminbar:hover:bg-[#555555] altadminbar:mb-2 altadminbar:inline-block altadminbar:whitespace-nowrap" href="{{ cp_route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>document.body.style.paddingTop = document.querySelector('#alt-admin-bar').offsetHeight + 'px'; document.body.classList.add('has-alt-admin-bar')</script>
