<div class="not-prose mt-10">
    <div>
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $title }}</h2>
        <div class="mt-6 prose max-w-none">
            <p>{{ $content }}</p>
        </div>
    </div>
    <ul role="list"
        class="mx-auto mt-10 grid grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach($team_members as $member)
            <li>
                @if ($image = app('modelInstance')->getFirstMedia('default', ['repeater_id' => $member['id']]))
                    <img class="aspect-[3/2] w-full rounded-2xl object-cover"
                         src="{{ $image->getUrl() }}"
                         alt="">
                @endif
                <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">{{ $member['name'] }}</h3>
                <p class="text-base leading-7 text-gray-600">{{ $member['position'] }}</p>
                @if (isset($member['social_links']) and count($member['social_links']))
                    <ul role="list" class="mt-6 flex gap-x-6">
                        @foreach($member['social_links'] as $link)
                            <li>
                                <a href="{{ $link['url'] }}" target="_blank" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">X</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path
                                            d="M11.4678 8.77491L17.2961 2H15.915L10.8543 7.88256L6.81232 2H2.15039L8.26263 10.8955L2.15039 18H3.53159L8.87581 11.7878L13.1444 18H17.8063L11.4675 8.77491H11.4678ZM9.57608 10.9738L8.95678 10.0881L4.02925 3.03974H6.15068L10.1273 8.72795L10.7466 9.61374L15.9156 17.0075H13.7942L9.57608 10.9742V10.9738Z"/>
                                    </svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

</div>
