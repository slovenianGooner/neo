<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

function word(string $key): array|string|null
{
    return Lang::get($key, locale: View::shared('locale'));
}

function local_route(string $name, array $parameters = [], bool $absolute = true): string
{
    return route($name . '.' . View::shared('locale'), $parameters, $absolute);
}

function local_route_is(string $name, array $parameters = []): bool
{
    return request()->routeIs($name . '.' . View::shared('locale'), $parameters);
}
