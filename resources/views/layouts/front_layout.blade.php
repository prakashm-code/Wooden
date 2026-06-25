<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <x-front.header title="{{ $title }}" page={{ $page }} />
</head>

<body>
    <x-front.bodyheader :settings="$settings ?? []" />

    @include($page)

    <x-front.bodyfooter :settings="$settings ?? []" />
    <x-front.footer :js="$js ?? []" />
</body>

</html>
