<div data-container="loading"></div>
<div class="corpo-listing" data-query-separator="{{ $data['query_separator'] }}" id="psListing">
    <div class="header row">
        @include('listing.actions', ['data' => $data])
        <div class="col">
            @include('listing.basic-search', ['data' => $data])
            @include('listing.search.modal', ['data' => $data])
        </div>
    </div>

    @include('listing.table', ['data' => $data])
    @include('listing.pagination', ['data' => $data])
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
