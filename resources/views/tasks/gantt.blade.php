@extends('layouts.primary')



@section('content')

    <div class="row">
        <div class="col">
            <h5 class="text-secondary">{{__('Tasks /Gantt Chart')}}</h5>
        </div>
        <div class="col text-end">
            <a href="/kanban" type="button" class="btn btn-info">

                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg>
                {{__(' Kanban')}}
            </a>

            <a href="/admin/tasks/list" type="button" class="btn btn-secondary text-white">

                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-table"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path></svg>
                {{__(' Task Table ')}}
            </a>


        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-body">
                <svg id="gantt">

                </svg>
            </div>

        </div>
    </div>

@endsection

@section('script')


    <script>
        // jkanban init

        (function() {
            "use strict";
            var tasks = [
                    @foreach($tasks as $task)
                {
                    id: "{{$task->id}}",
                    name: '{{$task->subject}}',
                    start: '{{$task->start_date}}',
                    end: '{{$task->due_date}}',


                    @if($task->status === 'done')
                    progress: 100,

                    @elseif($task->status === 'in_review')
                    progress: 60,
                    @elseif($task->status === 'in_progress')
                    progress: 40,
                    @elseif($task->status === 'todo')
                    progress: 0,
                    @endif


                    // dependencies: 'Task 2, Task 3'
                },

                     @endforeach
            ]

            var gantt = new Gantt('#gantt', tasks, {
                // on_click: function (task) {
                //     console.log(task);
                // },
                // on_date_change: function(task, start, end) {
                //     console.log(task, start, end);
                // },
                // on_progress_change: function(task, progress) {
                //     console.log(task, progress);
                // },
                // on_view_change: function(mode) {
                //     console.log(mode);
                // }
            });
            // gantt.change_view_mode('Week');

        })();
    </script>
        @endsection
