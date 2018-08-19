$(function() {
    $('#data_table').dynatable({
        features: {
            paginate: true,
            search: false,
            recordCount: true,
            perPageSelect: false
        },
    });
});