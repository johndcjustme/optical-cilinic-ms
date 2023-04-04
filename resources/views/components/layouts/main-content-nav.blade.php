<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid" style="padding-left:0; padding-right:0;">


        <div style="margin-right:3em">
            <div class="pagetitle">
                <h1 style="font-size: 1.6rem;">{{ $pageTitle }}</h1>
                {{-- <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav> --}}
            </div>
        </div>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="main-page-title collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                
                {{ $slot }}
             
            </ul>
        </div>

    </div>
  </nav>