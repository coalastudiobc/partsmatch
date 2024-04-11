{{-- @if (session()->has('status'))
    <div>
        <div class="alert alert-{{ $status == 'error' ? 'danger' : 'success' }} alert-dismissible fade show"
            role="alert">
            {!! $message !!}
            <button type="button" class="close btn-close" data-bs-dismiss="alert" aria-label="Close">
                @role('Administrator')
                @endrole
            </button>
        </div>
    </div>
@endif --}}
{{-- @if (session()->has('Message'))
    <div>
        <div class="alert alert-{{ $status == 'error' ? 'danger' : 'success' }} alert-dismissible fade show"
            role="alert">
            {!! $message !!}
            <button type="button" class="close btn-close" data-bs-dismiss="alert" aria-label="Close">
                @role('Administrator')
                  
                @endrole
            </button>
        </div>
    </div>
@endif --}}
@if (session()->has('message'))
    <div class="alert-container">
        <div class="container-box">
            <div class="alert alert-success" role="alert">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <span class="alert-icon "><i class="fas fa-info-circle"></i></span>
                        <h6>Message</h6>
                    </div>
                    <a class="alert-cross close" data-bs-dismiss="alert" aria-label="Close">
                        <svg width="7" height="7" viewBox="0 0 7 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.66033 0.947986C6.61823 0.906277 6.56822 0.873185 6.51316 0.850607C6.4581 0.828028 6.39907 0.816406 6.33946 0.816406C6.27985 0.816406 6.22083 0.828028 6.16577 0.850607C6.11071 0.873185 6.06069 0.906277 6.01859 0.947986L3.81264 3.12833L1.60668 0.947986C1.52158 0.863874 1.40616 0.81662 1.28581 0.81662C1.16546 0.81662 1.05004 0.863874 0.96494 0.947986C0.87984 1.0321 0.832031 1.14618 0.832031 1.26513C0.832031 1.38408 0.87984 1.49816 0.96494 1.58228L3.1709 3.76262L0.96494 5.94296C0.922803 5.98461 0.889378 6.03405 0.866573 6.08847C0.843769 6.14288 0.832031 6.20121 0.832031 6.26011C0.832031 6.31901 0.843769 6.37733 0.866573 6.43174C0.889378 6.48616 0.922803 6.5356 0.96494 6.57725C1.00708 6.6189 1.0571 6.65194 1.11216 6.67448C1.16721 6.69702 1.22622 6.70862 1.28581 6.70862C1.3454 6.70862 1.40441 6.69702 1.45946 6.67448C1.51452 6.65194 1.56454 6.6189 1.60668 6.57725L3.81264 4.39691L6.01859 6.57725C6.06073 6.6189 6.11075 6.65194 6.16581 6.67448C6.22086 6.69702 6.27987 6.70862 6.33946 6.70862C6.39905 6.70862 6.45806 6.69702 6.51311 6.67448C6.56817 6.65194 6.61819 6.6189 6.66033 6.57725C6.70247 6.5356 6.73589 6.48616 6.7587 6.43174C6.7815 6.37733 6.79324 6.31901 6.79324 6.26011C6.79324 6.20121 6.7815 6.14288 6.7587 6.08847C6.73589 6.03405 6.70247 5.98461 6.66033 5.94296L4.45438 3.76262L6.66033 1.58228C6.70253 1.54066 6.73601 1.49123 6.75885 1.43681C6.7817 1.38239 6.79346 1.32405 6.79346 1.26513C6.79346 1.20621 6.7817 1.14787 6.75885 1.09345C6.73601 1.03903 6.70253 0.9896 6.66033 0.947986Z"
                                fill="#898383" />
                        </svg>
                    </a>
                </div>
                <div class="alert-content">

                    <p>{{ session()->get('message') }}</p>
                </div>

            </div>
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert-container">
        <div class="container-box">
            <div class="alert alert-success" role="alert">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <span class="alert-icon "><i class="fas fa-info-circle"></i></span>
                        <h6>Success</h6>
                    </div>
                    <a class="alert-cross close" data-bs-dismiss="alert" aria-label="Close"><svg width="7"
                            height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.66033 0.947986C6.61823 0.906277 6.56822 0.873185 6.51316 0.850607C6.4581 0.828028 6.39907 0.816406 6.33946 0.816406C6.27985 0.816406 6.22083 0.828028 6.16577 0.850607C6.11071 0.873185 6.06069 0.906277 6.01859 0.947986L3.81264 3.12833L1.60668 0.947986C1.52158 0.863874 1.40616 0.81662 1.28581 0.81662C1.16546 0.81662 1.05004 0.863874 0.96494 0.947986C0.87984 1.0321 0.832031 1.14618 0.832031 1.26513C0.832031 1.38408 0.87984 1.49816 0.96494 1.58228L3.1709 3.76262L0.96494 5.94296C0.922803 5.98461 0.889378 6.03405 0.866573 6.08847C0.843769 6.14288 0.832031 6.20121 0.832031 6.26011C0.832031 6.31901 0.843769 6.37733 0.866573 6.43174C0.889378 6.48616 0.922803 6.5356 0.96494 6.57725C1.00708 6.6189 1.0571 6.65194 1.11216 6.67448C1.16721 6.69702 1.22622 6.70862 1.28581 6.70862C1.3454 6.70862 1.40441 6.69702 1.45946 6.67448C1.51452 6.65194 1.56454 6.6189 1.60668 6.57725L3.81264 4.39691L6.01859 6.57725C6.06073 6.6189 6.11075 6.65194 6.16581 6.67448C6.22086 6.69702 6.27987 6.70862 6.33946 6.70862C6.39905 6.70862 6.45806 6.69702 6.51311 6.67448C6.56817 6.65194 6.61819 6.6189 6.66033 6.57725C6.70247 6.5356 6.73589 6.48616 6.7587 6.43174C6.7815 6.37733 6.79324 6.31901 6.79324 6.26011C6.79324 6.20121 6.7815 6.14288 6.7587 6.08847C6.73589 6.03405 6.70247 5.98461 6.66033 5.94296L4.45438 3.76262L6.66033 1.58228C6.70253 1.54066 6.73601 1.49123 6.75885 1.43681C6.7817 1.38239 6.79346 1.32405 6.79346 1.26513C6.79346 1.20621 6.7817 1.14787 6.75885 1.09345C6.73601 1.03903 6.70253 0.9896 6.66033 0.947986Z"
                                fill="#898383" />
                        </svg>
                    </a>
                </div>
                <div class="alert-content">
                    <p>{{ session()->get('success') }}</p>
                </div>

            </div>
        </div>
    </div>
@endif


@if (session()->has('status') && session()->get('status') == 'false')
    <div class="alert-container">
        <div class="container-box">
            <div class="alert alert-success" role="alert">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <span class="alert-icon "><i class="fas fa-info-circle"></i></span>
                        <h6>Message</h6>
                    </div>
                    <a class="alert-cross close" data-bs-dismiss="alert" aria-label="Close">
                        <svg width="7" height="7" viewBox="0 0 7 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.66033 0.947986C6.61823 0.906277 6.56822 0.873185 6.51316 0.850607C6.4581 0.828028 6.39907 0.816406 6.33946 0.816406C6.27985 0.816406 6.22083 0.828028 6.16577 0.850607C6.11071 0.873185 6.06069 0.906277 6.01859 0.947986L3.81264 3.12833L1.60668 0.947986C1.52158 0.863874 1.40616 0.81662 1.28581 0.81662C1.16546 0.81662 1.05004 0.863874 0.96494 0.947986C0.87984 1.0321 0.832031 1.14618 0.832031 1.26513C0.832031 1.38408 0.87984 1.49816 0.96494 1.58228L3.1709 3.76262L0.96494 5.94296C0.922803 5.98461 0.889378 6.03405 0.866573 6.08847C0.843769 6.14288 0.832031 6.20121 0.832031 6.26011C0.832031 6.31901 0.843769 6.37733 0.866573 6.43174C0.889378 6.48616 0.922803 6.5356 0.96494 6.57725C1.00708 6.6189 1.0571 6.65194 1.11216 6.67448C1.16721 6.69702 1.22622 6.70862 1.28581 6.70862C1.3454 6.70862 1.40441 6.69702 1.45946 6.67448C1.51452 6.65194 1.56454 6.6189 1.60668 6.57725L3.81264 4.39691L6.01859 6.57725C6.06073 6.6189 6.11075 6.65194 6.16581 6.67448C6.22086 6.69702 6.27987 6.70862 6.33946 6.70862C6.39905 6.70862 6.45806 6.69702 6.51311 6.67448C6.56817 6.65194 6.61819 6.6189 6.66033 6.57725C6.70247 6.5356 6.73589 6.48616 6.7587 6.43174C6.7815 6.37733 6.79324 6.31901 6.79324 6.26011C6.79324 6.20121 6.7815 6.14288 6.7587 6.08847C6.73589 6.03405 6.70247 5.98461 6.66033 5.94296L4.45438 3.76262L6.66033 1.58228C6.70253 1.54066 6.73601 1.49123 6.75885 1.43681C6.7817 1.38239 6.79346 1.32405 6.79346 1.26513C6.79346 1.20621 6.7817 1.14787 6.75885 1.09345C6.73601 1.03903 6.70253 0.9896 6.66033 0.947986Z"
                                fill="#898383" />
                        </svg>
                    </a>
                </div>
                <div class="alert-content">
                    @foreach (session()->get('msg') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endif
