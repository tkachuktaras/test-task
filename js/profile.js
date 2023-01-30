$(document).ready( function () {
    $('#selectedColumn').DataTable({
        columnDefs: [
            { orderable: false, targets: 4 }
        ],
        order: [ 3, 'desc' ]
    });
});

function delete_survey(url){
    if(confirm('Do you want to delete?')){
        window.location.href = url;
    }
}