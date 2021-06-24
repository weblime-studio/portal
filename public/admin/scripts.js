jQuery(document).ready(function() {
    $('.delete-btn').on('click', function() {
        var res = confirm('Ви дійсно бажаєте видалити запис?');
        if(!res) {
            return false;
        }
    })
})