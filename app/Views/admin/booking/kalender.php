<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-dark fw-semibold">Calendar Management</h5>
                </div>
                <div class="card-body p-4">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/admin/api/bookings',
            editable: false,
            selectable: true,
            height: 'auto',

            // Clean styling
            themeSystem: 'standard',

            // Button styling
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day'
            },

            // Event styling
            eventDisplay: 'block',
            eventBackgroundColor: '#6c757d',
            eventBorderColor: '#495057',
            eventTextColor: '#ffffff',

            // Day styling
            dayHeaderFormat: {
                weekday: 'short'
            },

            // Weekend styling
            weekends: true,

            // Click handlers
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.location.href = info.event.url;
                }
            },

            // Hover effects
            eventMouseEnter: function(info) {
                info.el.style.opacity = '0.8';
                info.el.style.cursor = 'pointer';
            },

            eventMouseLeave: function(info) {
                info.el.style.opacity = '1';
            }
        });

        calendar.render();

        // Responsive handling
        window.addEventListener('resize', function() {
            calendar.updateSize();
        });
    });
</script>

<style>
    /* Custom calendar styling */
    .fc {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .fc-toolbar {
        margin-bottom: 1.5rem;
    }

    .fc-toolbar-chunk {
        display: flex;
        align-items: center;
    }

    .fc-button {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #495057;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: all 0.15s ease-in-out;
    }

    .fc-button:hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
        color: #212529;
    }

    .fc-button-active {
        background-color: #495057;
        border-color: #495057;
        color: #ffffff;
    }

    .fc-button:focus {
        box-shadow: 0 0 0 0.2rem rgba(73, 80, 87, 0.25);
    }

    .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #212529;
        margin: 0;
    }

    .fc-daygrid-day-number {
        color: #495057;
        font-weight: 500;
    }

    .fc-col-header-cell {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .fc-col-header-cell-cushion {
        color: #6c757d;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .fc-daygrid-day {
        background-color: #ffffff;
    }

    .fc-daygrid-day:hover {
        background-color: #f8f9fa;
    }

    .fc-day-today {
        background-color: #fff3cd !important;
    }

    .fc-event {
        border-radius: 0.25rem;
        border: none;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .fc-daygrid-event-harness {
        margin: 2px;
    }

    .fc-daygrid-block-event .fc-event-title {
        padding: 0.25rem 0.5rem;
    }

    /* Grid lines */
    .fc-scrollgrid {
        border-color: #dee2e6;
    }

    .fc-scrollgrid td,
    .fc-scrollgrid th {
        border-color: #dee2e6;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .fc-toolbar {
            flex-direction: column;
            gap: 1rem;
        }

        .fc-toolbar-chunk {
            justify-content: center;
        }

        .fc-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }

        .fc-toolbar-title {
            font-size: 1.25rem;
        }
    }
</style>
<?= $this->endSection() ?>