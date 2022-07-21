<?php
/*********** make link active depends on get request   *********************************/

<a class=" {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('home') }}"></a>


/*******************************             *******************************************/
