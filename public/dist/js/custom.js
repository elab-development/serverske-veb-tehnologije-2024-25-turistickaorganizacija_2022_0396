(function($){
    "use strict";
    $(".inputtags").tagsinput('items');
    $(document).ready(function() {
        $('#example1').DataTable({
    language: {
        "sEmptyTable": "Nema podataka u tabeli",
        "sInfo": "Prikazano _START_ do _END_ od ukupno _TOTAL_ unosa",
        "sInfoEmpty": "Prikazano 0 do 0 od 0 unosa",
        "sInfoFiltered": "(filtrirano iz _MAX_ unosa)",
        "sLengthMenu": "Prikaži _MENU_ unosa",
        "sLoadingRecords": "Učitavanje...",
        "sProcessing": "Obrada...",
        "sSearch": "Pretraga:",
        "sZeroRecords": "Nije pronađen nijedan rezultat",
        "oPaginate": {
            "sFirst": "Prva",
            "sLast": "Poslednja",
            "sNext": "Sledeća",
            "sPrevious": "Prethodna"
        }
    }
});

    });
    $('.icp_demo').iconpicker();

    $('#datepicker1').datepicker({
        dateFormat: 'yyyy-mm-dd',
        language: {
            today: 'Today',
            days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    });
    $('#datepicker2').datepicker({
        dateFormat: 'yyyy-mm-dd',
        language: {
            today: 'Today',
            days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    });
    $('#datepicker3').datepicker({
        dateFormat: 'yyyy-mm-dd',
        language: {
            today: 'Today',
            days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    });
    $('#timepicker').datepicker({
        language: 'en',
        timepicker: true,
        onlyTimepicker: true,
        timeFormat: 'hh:ii',
        dateFormat: null
    });

    tinymce.init({
        selector: '.editor',
        height : '300'
    });

})(jQuery);