<div class="overlay overlay-simplegenie">
    <button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>
    <nav>
        <ul>
            <li><a href="{{ route('file.index') }}">Catalog</a></li>
            <li><a href="{{ route('upload.form') }}">Upload</a></li>

            @if (auth()->check())
                <li><a href="{{ route('file.me') }}">My Files</a></li>
            @endif
            <li><a href="{{ route('page.rule') }}">Terms &amp; Conditions</a></li>
        </ul>
    </nav>
</div>
<section class="header-w3ls">
    <button id="trigger-overlay" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
    <div class="bottons-agileits-w3layouts">
        @if (!auth()->check())
            <a class="page-scroll" href="#myModal2" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a>.
            <a class="page-scroll" href="#myModal3" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Register</a>
        @else
            <a class="page-scroll" href="{{ route('upload.form') }}"><i class="fa fa-upload" aria-hidden="true"></i>Upload</a>
            <a class="page-scroll" href="{{ route('logout') }}"><i class="fa fa-lock" aria-hidden="true"></i>Logout</a>
        @endif
    </div>
    <div class="clearfix"> </div>
</section>
