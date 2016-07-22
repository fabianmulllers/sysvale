
{{--<notification-user></notification-user>--}}
{{--<li>
    <a href="#">
        <div>
            <strong>prueba1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
        </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
    </a>
</li>
<li class="divider"></li>
<li>
    <a href="#">
        <div>
            <strong>prueba1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
        </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
    </a>
</li>
<li class="divider"></li>
<li>
    <a href="#">
        <div>
            <strong>Jprueba1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
        </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
    </a>
</li>
<li class="divider"></li>
<li>
    <a class="text-center" href="#">
        <strong>Read All Messages</strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>--}}

<template id="notification_tpl">
    <li>
        <a href="#">
            <div>
                <strong>@{{name}}</strong>
                                    <span class="pull-right text-muted">
                                        <em>@{{date}}</em>
                                    </span>
            </div>
            <div>@{{ message  }}</div>
        </a>
    </li>
    <li class="divider"></li>
</template>