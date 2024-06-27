@props(['statusField' => false, 'nameField' => true, 'dateField' => true])
<div class="card-header-form">
    <form id="listing-search">
        <div class="form-row justify-content-end ">
            @if ($statusField)
                {{-- dropdown  --}}
                <div class="col-md-2">
                    <select name="filter_by_status" class="form-control selectric" tabindex="-1">
                        <option value="">Filter by</option>
                        <option {{ request()->filter_by_status == '1' ? 'selected' : '' }} value="1">Active</option>
                        <option value="0" {{ request()->filter_by_status == '0' ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                </div>
            @endif
            {{--  --}}
            @if ($dateField)
                <div class="input-group col-md-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text append-icon daterange-appply-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                    <input type="text" autocomplete="off" class="form-control daterange-cus pre-icon" name="dates"
                        placeholder="Select dates">
                </div>
            @endif

            @if ($nameField)
                <div class="input-group col-md-2">
                    <input type="text" autocomplete="off" class="form-control" placeholder="Search"
                        name="filter_by_name" value="{{ request()->filter_by_name }}">
                </div>
            @endif

            <!-- Additional search filters -->
            {{ $slot }}

            <div class="input-group col-md-2" style="flex-basis:content">
                <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
            @if (request()->route()->getName() != 'admin.user.list' &&
                    request()->route()->getName() != 'admin.creator.list' &&
                    request()->route()->getName() != 'admin.payments.listing')
                <div class="input-group col-md-2" style="flex-basis:content">
                    <div class="input-group-btn">
                        <button class="btn btn-primary clearFilter"> Clear Filter </button>
                    </div>
                </div>
            @endif
        </div>
    </form>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endpush

@push('scripts')
    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="dates"]').attr("placeholder",
                "{{ request()->dates != '' ? request()->dates : 'Select Dates' }}");
            jQuery('input[name="dates"]').daterangepicker({
                locale: {
                    format: "YYYY-MM-DD",
                    autoApply: false,
                    cancelLabel: 'Clear',
                }
            });
            jQuery('input[name="dates"]').val('');
            jQuery('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {});

            jQuery('.clearFilter').click(function(e) {
                e.preventDefault();
                jQuery('input[name="dates"]').attr("placeholder", "Select Dates");
                jQuery('form#searchForm :input').val('');
                var originURL = window.location.pathname;
                var relodeUrl = window.location.origin + originURL;
                jQuery(location).prop('href', relodeUrl)

            })
            jQuery('.daterange-appply-icon').click(function(e) {

                jQuery(document).find('input[name="dates"]').focus();
            });
        });
    </script>
@endpush
