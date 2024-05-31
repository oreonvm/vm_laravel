<?php

use Illuminate\View\View;

class TestComposer
{
    public function compose(View $view)
    {
        $view->with('menu');
    }
}
