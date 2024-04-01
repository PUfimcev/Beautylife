<div class="container">
    @if (session('status'))
        <div id="notifications">
            <div id="notifications__cancel_button" class="navbar__cancel-icon"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg></div>
            <div class="note alert alert-success" role="alert">
                <h2>{{ __(session('status')) }}</h2>
                @if (session('status2'))
                    <h2>{{ __(session('status2')) }}</h2>
                @endif
            </div>
        </div>
    @endif
</div>
