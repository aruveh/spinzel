(function(){
    const form = document.getElementById('blogSearchForm');
    const input = document.getElementById('blogSearchInput');
    if(!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const search = input.value.trim();
        const url = new URL(window.location.href);
        if (search !== '') {
            url.searchParams.set('search', search);
        } else {
            url.searchParams.delete('search');
        }

        // Reset pagination when performing a new search
        url.searchParams.delete('page');
        window.location.href = url.toString();
    });
})()