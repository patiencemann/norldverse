{{-- <div> @if (Auth::check() && !hasWritterRequest()) <become-writter /> @endif </div> --}}
<header class="site-header border border-x-0 border-t-0 border-gray-200" style="background-image: url('/img/green-tech.png')">
    <div class="container">
        <div class="header-inner flex justify-space-between dark:bg-deep-green-800 border border-gray-200 dark:border-none">
            <div class="flex items-center">

                <x-navbar.mobile-navbar />

                {{-- Large screen Nav-bar --}}
                <div class="flex justify-between items-center">
                    <a href="/" class="flex" data-tooltip-target="tooltip-logo-1">
                        <div class="cursor-pointer w-20">
                            <img src="/img/logos/logo-black.png"
                                alt="Norldverse logo">
                        </div>
                        <div class="app-logo self-center text-gray-600 text-3xl font-bold whitespace-nowrap dark:text-white ml-4">
                            NORLDVERSE
                        </div>
                    </a>
                    <div id="tooltip-logo-1" role="tooltip"
                        class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
                        data-popper-placement="top"
                        style="font-size: 15px; position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1186px, -64px);">
                        Norldverse Logo
                        <div class="tooltip-arrow" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(99px, 0px);"></div>
                    </div>
                </div>
            </div>

            {{-- Search bar --}}
            <div><search-bar /></div>

            {{-- Large screen navbar --}}
            <x-navbar.large-navbar />

        </div>
    </div>
    <profile-card user="{{ json_encode(authUser()) }}" />
</header>
