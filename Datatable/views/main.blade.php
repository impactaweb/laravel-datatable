<div data-container="loading"></div>
<div class="corpo-listing" data-query-separator="{{ $data['query_separator'] }}" id="psListing">
    <div class="header row" id="datatable-actions">
        @include('datatable::actions', ['data' => $data])
        <div class="col">
            @include('datatable::basic-search', ['data' => $data])
            @include('datatable::search.modal', ['data' => $data])
        </div>
    </div>
    <form id="listingForm" action="" method="POST" style="display:none">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="">
        <button type="submit"></button>
    </form>
    @include('datatable::table', ['data' => $data])
    @include('datatable::pagination', ['data' => $data])
</div>


<script>
    function search() {
        event.preventDefault();
        let q = document.getElementById('listing_search').value;
        setQs('q', q)
    }

    function setQs(key, value) {
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.set(key, value);
        window.location.search = searchParams.toString();
    }

    function previousPage(page) {
        let previous = (parseInt(page) - 1).toString()
        setQs('page', previous)
    }

    function nextPage(page) {
        let next = (parseInt(page) + 1).toString()
        setQs('page', next)
    }

    function setFilter(value, field) {
        let separator = $('#psListing').data('query-separator') || '__'
        let column = $(field).data('column')
        let newName = column + separator + value
        $(field).attr('name', newName)
    }

    function setOrder(column) {
        let searchParams = new URLSearchParams(window.location.search);
        let currentOrder = searchParams.get('ord') || '';
        let orderDir = currentOrder === column && searchParams.get('dir') !== 'DESC' ? 'DESC' : "ASC"
        searchParams.set('ord', column);
        searchParams.set('dir', orderDir);
        window.location.search = searchParams.toString();
    }
</script>
