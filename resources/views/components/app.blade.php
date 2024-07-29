<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIJAGA - {{ $title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/template') }}/assets/images/logo/baru.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <!-- page css -->
    <link href="{{ url('public/template') }}/assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="{{ url('public/template') }}/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('public/template') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css"
        rel="stylesheet">

    <!-- Core css -->
    <link href="{{ url('public/template') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="{{ url('public/template') }}/assets/css/simadu.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ url('public/template') }}/plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="{{ url('public/template') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ url('public/template') }}/plugins/fullcalendar/main.css">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ url('public/template') }}/dist/css/adminlte.min.css"> --}}


</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <x-template.header />
            <!-- Header END -->

            <!-- Side Nav START -->
            <x-template.sidebar />
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <!-- Content Wrapper START -->
                <div class="main-content"
                    style="background-image: url('{{ url('public/template') }}/assets/images/others/bg.jpg')">
                    <div class="container-fluid pt-12">
                        <div class="row">
                            <div class="col-md-12">
                                <x-template.utils.notif />
                            </div>
                        </div>
                        <div class="table-responsive"> <!-- Tambahkan class table-responsive di sini -->
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                <x-template.footer />


            </div>


        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ url('public/template') }}/assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="{{ url('public/template') }}/assets/vendors/select2/select2.min.js"></script>
    <script src="{{ url('public/template') }}/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="{{ url('public/template') }}/assets/js/pages/dashboard-default.js"></script>
    <script src="{{ url('public/template') }}/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('public/template') }}/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('public/template') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>



    <!-- Script untuk inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>


    <!-- Core JS -->
    <script src="{{ url('public/template') }}/assets/js/app.min.js"></script>
    <script>
        $('#data-table').DataTable();
    </script>
    <script>
        $('#data-table1').DataTable();
    </script>
    <script>
        $('.select2').select2();
    </script>
    <script>
        $('#trigger-loading-1').on('click', function(e) {
            $(this).addClass("is-loading");
            setTimeout(function() {
                $("#trigger-loading-1").removeClass("is-loading");
            }, 4000);
            e.preventDefault();
        });
    </script>
    <script>
        $(function() {
            $(document).ready(function() {
                $('.datepicker-input').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                    language: 'id',
                    locale: 'id',
                });
            });
        })
    </script>
    <script src="{{ url('public/template') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ url('public/template') }}/plugins/fullcalendar/main.js"></script>

    <script>
        $(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: '#f56954', //red
                        borderColor: '#f56954', //red
                        allDay: true
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: '#f39c12', //yellow
                        borderColor: '#f39c12' //yellow
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        backgroundColor: '#0073b7', //Blue
                        borderColor: '#0073b7' //Blue
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        backgroundColor: '#00c0ef', //Info (aqua)
                        borderColor: '#00c0ef' //Info (aqua)
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        backgroundColor: '#00a65a', //Success (green)
                        borderColor: '#00a65a' //Success (green)
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'https://www.google.com/',
                        backgroundColor: '#3c8dbc', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    }
                ],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>

    <script src="{{ url('public/template') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ url('public/template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <script src="{{ url('public/template') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
</body>

</html>
