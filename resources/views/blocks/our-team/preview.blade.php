@php
    $page = $component->getRecord();
    $page->load('media');
@endphp
<div>
    <h2>{{ $title }}</h2>
    <div style="margin-top: 1rem;">{{ $content }}</div>
    <div style="display: grid; margin-top: 2rem; grid-template-columns: repeat(3, minmax(0, 1fr)); grid-column-gap: 1rem">
        @foreach($team_members as $member)
            <div class="border border-dashed p-4">
                <div class="font-bold">{{ $member['name'] }}</div>
                <div class="text-xs">{{ $member['position'] }}</div>
                @if ($image = $page->getMedia('default', ['repeater_id' => $member['id']])->first())
                    <img style="margin-top: 1rem;" src="{{ $image->getUrl() }}" alt="{{ $member['id'] }}" />
                @endif
                @if (isset($member['social_links']) and count($member['social_links']))
                    <div class="text-xs" style="margin-top: 1rem;">{{ count($member['social_links']) }} social link(s)</div>
                @endif
            </div>
        @endforeach
    </div>
</div>
