@extends('layouts.primary')

@section('content')

    <div class="row">
        <div class="col">
            <h5 class="text-secondary">{{__('Tasks / kanban')}}</h5>
        </div>

        <div class="col text-end">

            <a href="/admin/tasks/list" type="button" class="btn btn-info text-white">

                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-table"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path></svg>
                {{__(' Task Table ')}}
            </a>
            <a href="/gantt" type="button" class="btn btn-secondary text-white">


                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                {{__(' Gantt Chart ')}}
            </a>

            <button type="button" class="btn bg-dark-alt text-white" id="btn_add_new_category">
                <i class="fa fa-plus"></i>{{__(' Add Task ')}}
            </button>
        </div>
    </div>

    <div class="">
        <div class="d-flex m-3">
            <div class="ms-auto d-flex">

                <div class="ps-4">

                </div>
            </div>
        </div>
        <div class="mt-3 kanban-container">
            <div class="py-2 min-vh-100 d-inline-flex" style="overflow-x: auto">
                <div id="myKanban"></div>
            </div>
        </div>
        <div class="modal fade" id="new-board-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="h5 modal-title">Choose your new Board Name</h5>
                        <button type="button" class="btn close pe-1" data-dismiss="modal" data-target="#new-board-modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="pt-4 modal-body">
                        <div class="mb-4 input-group">
<span class="input-group-text">
<i class="far fa-edit"></i>
</span>
                            <input class="form-control" placeholder="Board Name" type="text" id="jkanban-new-board-name" />
                        </div>
                        <div class="text-end">
                            <button class="m-1 btn btn-primary" id="jkanban-add-new-board" data-toggle="modal" data-target="#new-board-modal">
                                Save changes
                            </button>
                            <button class="m-1 btn btn-secondary" data-dismiss="modal" data-target="#new-board-modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden opacity-50 fixed inset-0 z-40 bg-black" id="new-board-modal-backdrop"></div>
        <div class="modal fade" id="jkanban-info-modal" style="display: none" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="h5 modal-title">Task details</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="pt-4 modal-body">
                        <input id="jkanban-task-id" class="d-none" />
                        <div class="mb-4 input-group">
<span class="input-group-text">
<i class="far fa-edit"></i>
</span>
                            <input class="form-control" placeholder="Task Title" type="text" id="jkanban-task-title" />
                        </div>
                        <div class="mb-4 input-group">
<span class="input-group-text">
<i class="fas fa-user"></i>
</span>
                            <input class="form-control" placeholder="Task Assignee" type="text" id="jkanban-task-assignee" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Task Description" id="jkanban-task-description" rows="4"></textarea>
                        </div>
                        <div class="alert alert-success d-none">Changes saved!</div>
                        <div class="text-end">
                            <button class="m-1 btn btn-primary" id="jkanban-update-task" data-toggle="modal" data-target="#jkanban-info-modal">
                                Save changes
                            </button>
                            <button class="m-1 btn btn-secondary" data-dismiss="modal" data-target="#jkanban-info-modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden opacity-50 fixed inset-0 z-40 bg-black" id="jkanban-info-modal-backdrop"></div>

    </div>


    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add Task')}}</h5>

                </div>

                <form method="post" id="form_main">

                    <div class="modal-body">
                        <div id="sp_result_div"></div>
                        <div class="">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{__('Subject/Task')}}</label>
                            <input type="text" id="input_name" name="subject" class="form-control form-control-solid"
                                   placeholder=""/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <label for="exampleFormControlInput1"
                                           class="required form-label">{{__('Start Date')}}</label>
                                    <input type="text" placeholder="Pick Date" id="start_date" name="start_date"
                                           @if (!empty($task)) value="{{$task->start_date}}"
                                           @endif class="form-control form-control-solid flatpickr-input"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="exampleFormControlInput1" class="form-label">{{__('End Date')}}</label>
                                    <input type="text" id="due_date" name="due_date"
                                           class="form-control form-control-solid"
                                           @if (!empty($task))
                                           value="{{$task->due_date}}"
                                           @endif placeholder="Pick Date"/>
                                </div>
                            </div>

                        </div>
                        <div class="mb-1 mt-2">

                            <label for="exampleFormControlInput1" class="form-label">{{__('Assign To')}}</label>
                            <select class="form-select form-select-solid fw-bolder" id="contact"
                                    aria-label="Floating label select example" name="contact_id">
                                <option value="0">{{__('None')}}</option>
                                @foreach ($users as $usertask)
                                    <option value="{{$usertask->id}}"
                                            @if (!empty($task))
                                            @if ($task->contact_id === $usertask->id)
                                            selected
                                            @endif
                                            @endif
                                    >{{$usertask->first_name}} {{$usertask->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">

                                    <label for="exampleFormControlInput1"
                                           class="form-label">{{__('Description')}}</label>
                                    <textarea type="text" name="description" id="description"
                                              class="form-control form-control-solid"
                                              rows="7">@if (!empty($task)){{$task->description}}@endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ms-3">
                        @csrf
                        <button type="submit" id="btn_submit" class="btn btn-info">{{__('Save')}} </button>
                        <button type="button" class="btn bg-pink-light text-danger"
                                data-bs-dismiss="modal">{{__('Close')}}</button>
                    </div>
                    <input type="hidden" name="task_id" id="task_id" value="">
                </form>
            </div>
        </div>
    </div>


 @endsection



@section('script')


    <script>
        // jkanban init

        (function() {
            if (document.getElementById("myKanban")) {
                var KanbanTest = new jKanban({
                    element: "#myKanban",
                    gutter: "1px",
                    widthBoard: "350px",

                    click: el => {


                        let myModal = new bootstrap.Modal(document.getElementById('kt_modal_1'), {
                            keyboard: false
                        });

                        let task_id = el.getAttribute("data-eid");

                        $.getJSON('{{route('admin.tasks',['action' => 'task.json'])}}?id=' + task_id, function (data) {
                            $('#input_name').val(data.subject);

                            $('#start_date').val(data.start_date);

                            flatpickr("#start_date", {

                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                            });

                            $('#due_date').val(data.due_date);

                            flatpickr("#due_date", {

                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                            });

                            $('#contact_id').val(data.contact_id);
                            $('#description').val(data.description);
                            $('#task_id').val(data.id);
                        });

                        myModal.show();

                    },
                    buttonClick: function(el, boardId) {
                        if (
                            document.querySelector("[data-id='" + boardId + "'] .itemform") ===
                            null
                        ) {
                            // create a form to enter element
                            var formItem = document.createElement("form");
                            formItem.setAttribute("class", "itemform");
                            formItem.innerHTML = `<div class="form-group">
          <textarea class="form-control" rows="2" autofocus></textarea>
          </div>
          <div class="form-group">
              <button type="submit" class="btn bg-gradient-success btn-sm pull-end">Add</button>
              <button type="button" id="kanban-cancel-item" class="btn bg-gradient-light btn-sm pull-end me-2">Cancel</button>
          </div>`;

                            KanbanTest.addForm(boardId, formItem);
                            formItem.addEventListener("submit", function(e) {
                                e.preventDefault();
                                var text = e.target[0].value;
                                let newTaskId =
                                    "_" + text.toLowerCase().replace(/ /g, "_") + boardId;
                                KanbanTest.addElement(boardId, {
                                    id: newTaskId,
                                    title: text,
                                    class: ["border-radius-md"]
                                });
                                formItem.parentNode.removeChild(formItem);
                            });
                            document.getElementById("kanban-cancel-item").onclick = function() {
                                formItem.parentNode.removeChild(formItem);
                            };
                        }
                    },
                    addItemButton: true,
                    boards: [{
                        id: "todo",
                        title: '<span class="text-dark">{{__('Todo')}}</span>',
                        item: [
                                @if(!empty($tasks['todo']))
                                @foreach($tasks['todo'] as $task)

                                {
                                    id: "{{$task->id}}",
                                    title: '<small>Due Date: </small><span class="badge badge-sm bg-pink-light text-danger fw-bolder mb-1">@if(!empty($task->due_date)){{(\App\Supports\DateSupport::parse($task->due_date))->format(config('app.date_format'))}}@endif</span><h6 class="text fw-bolder mt-2">{{$task->subject}}</h6><p class="text mt-2">{{$task->description}}</p><div class="d-flex"><div class="avatar avatart-sm rounded-circle">@if(isset($users[$task->contact_id]))@if(!empty($users[$task->contact_id]->photo))<a href="javascript:" class="avatar avatar-sm rounded-circle"><img src="{{PUBLIC_DIR}}/uploads/{{$users[$task->contact_id]->photo}}"></a>@else<div class="avatar  avatar-sm rounded-circle bg-indigo"><p class=" mt-3 text-white text-uppercase">{{$users[$task->contact_id]->first_name[0]}}{{$users[$task->contact_id]->last_name[0]}}</p> </div> @endif</div><div class="text-sm fw-bold mt-2 ms-2">{{$users[$task->contact_id]->first_name}} {{$users[$task->contact_id]->last_name}} </div>@endif</div></div>',
                                    class: ["border-radius-md"]
                                },

                        @endforeach
                                @endif


                        ]
                    },
                        {
                            id: "in_progress",
                            title:'<span class="text-dark">{{__('In progress')}}</span>' ,
                            item: [
                                    @if(!empty($tasks['in_progress']))
                                    @foreach($tasks['in_progress'] as $task)
                                {
                                    id: "{{$task->id}}",
                                        title: '<small>Due Date: </small><span class="badge badge-sm bg-pink-light text-danger fw-bolder mb-1">@if(!empty($task->due_date)){{(\App\Supports\DateSupport::parse($task->due_date))->format(config('app.date_format'))}}@endif</span><h6 class="text fw-bolder mt-2">{{$task->subject}}</h6><p class="text mt-2">{{$task->description}}</p><div class="d-flex"><div class="avatar avatart-sm rounded-circle">@if(isset($users[$task->contact_id]))@if(!empty($users[$task->contact_id]->photo))<a href="javascript:" class="avatar avatar-sm rounded-circle"><img src="{{PUBLIC_DIR}}/uploads/{{$users[$task->contact_id]->photo}}"></a>@else<div class="avatar  avatar-sm rounded-circle bg-indigo"><p class=" mt-3 text-white text-uppercase">{{$users[$task->contact_id]->first_name[0]}}{{$users[$task->contact_id]->last_name[0]}}</p> </div> @endif</div><div class="text-sm fw-bold mt-2 ms-2">{{$users[$task->contact_id]->first_name}} {{$users[$task->contact_id]->last_name}} </div>@endif</div></div>',
                                    class: ["border-radius-md"]
                                },
                                @endforeach
                                @endif

                            ]
                        },
                        {
                            id: "in_review",
                            title:'<span class="text-dark">{{__('In review')}}</span>',
                            item: [
                                    @if(!empty($tasks['in_review']))
                                    @foreach($tasks['in_review'] as $task)
                                {
                                        id: "{{$task->id}}",
                                        title: '<small>Due Date: </small><span class="badge badge-sm bg-pink-light text-danger fw-bolder mb-1">@if(!empty($task->due_date)){{(\App\Supports\DateSupport::parse($task->due_date))->format(config('app.date_format'))}}@endif</span><h6 class="text fw-bolder mt-2">{{$task->subject}}</h6><p class="text mt-2">{{$task->description}}</p><div class="d-flex"><div class="avatar avatart-sm rounded-circle">@if(isset($users[$task->contact_id]))@if(!empty($users[$task->contact_id]->photo))<a href="javascript:" class="avatar avatar-sm rounded-circle"><img src="{{PUBLIC_DIR}}/uploads/{{$users[$task->contact_id]->photo}}"></a>@else<div class="avatar  avatar-sm rounded-circle bg-indigo"><p class=" mt-3 text-white text-uppercase">{{$users[$task->contact_id]->first_name[0]}}{{$users[$task->contact_id]->last_name[0]}}</p> </div> @endif</div><div class="text-sm fw-bold mt-2 ms-2">{{$users[$task->contact_id]->first_name}} {{$users[$task->contact_id]->last_name}} </div>@endif</div></div>',
                                        class: ["border-radius-md"]
                                    },
                                @endforeach
                                    @endif

                            ]
                        },
                        {
                            id: "done",
                            title: '<span class="text-dark">{{__('Done')}}</span>',
                            item: [
                                    @if(!empty($tasks['done']))
                                    @foreach($tasks['done'] as $task)
                                {
                                        id: "{{$task->id}}",
                                        title: '<small>Due Date: </small><span class="badge badge-sm bg-pink-light text-danger fw-bolder mb-1">@if(!empty($task->due_date)){{(\App\Supports\DateSupport::parse($task->due_date))->format(config('app.date_format'))}}@endif</span><h6 class="text fw-bolder mt-2">{{$task->subject}}</h6><p class="text mt-2">{{$task->description}}</p><div class="d-flex"><div class="avatar avatart-sm rounded-circle">@if(isset($users[$task->contact_id]))@if(!empty($users[$task->contact_id]->photo))<a href="javascript:" class="avatar avatar-sm rounded-circle"><img src="{{PUBLIC_DIR}}/uploads/{{$users[$task->contact_id]->photo}}"></a>@else<div class="avatar  avatar-sm rounded-circle bg-indigo"><p class=" mt-3 text-white text-uppercase">{{$users[$task->contact_id]->first_name[0]}}{{$users[$task->contact_id]->last_name[0]}}</p> </div> @endif</div><div class="text-sm fw-bold mt-2 ms-2">{{$users[$task->contact_id]->first_name}} {{$users[$task->contact_id]->last_name}} </div>@endif</div></div>',
                                        class: ["border-radius-md"]
                                    },
                                @endforeach
                                    @endif

                            ]
                        }
                    ],

                    dropEl: function (el, target, source, sibling) {
                        let id = el.getAttribute("data-eid");

                        let $target = $(target);
                        let closest_board_id = $target.closest(".kanban-board").attr("data-id");

                        $.post("/todo/set-status", {
                            _token: "{{csrf_token()}}",
                            id: id,
                            status: closest_board_id
                        }, function (data) {
                            console.log(data);
                        });


                    }
                });

                var addBoardDefault = document.getElementById("jkanban-add-new-board");
                addBoardDefault.addEventListener("click", function() {

                    let newBoardName = document.getElementById("jkanban-new-board-name")
                        .value;
                    let newBoardId = "_" + newBoardName.toLowerCase().replace(/ /g, "_");
                    KanbanTest.addBoards([{
                        id: newBoardId,
                        title: newBoardName,
                        item: []
                    }]);
                    document.querySelector('#new-board-modal').classList.remove('show');
                    document.querySelector('body').classList.remove('modal-open');

                    document.querySelector('.modal-backdrop').remove();
                });

                var updateTask = document.getElementById("jkanban-update-task");
                updateTask.addEventListener("click", function() {
                    let jkanbanInfoModalTaskId = document.querySelector(
                        "#jkanban-info-modal #jkanban-task-id"
                    );
                    let jkanbanInfoModalTaskTitle = document.querySelector(
                        "#jkanban-info-modal #jkanban-task-title"
                    );
                    let jkanbanInfoModalTaskAssignee = document.querySelector(
                        "#jkanban-info-modal #jkanban-task-assignee"
                    );
                    let jkanbanInfoModalTaskDescription = document.querySelector(
                        "#jkanban-info-modal #jkanban-task-description"
                    );
                    KanbanTest.replaceElement(jkanbanInfoModalTaskId.value, {
                        title: jkanbanInfoModalTaskTitle.value,
                        assignee: jkanbanInfoModalTaskAssignee.value,
                        description: jkanbanInfoModalTaskDescription.value
                    });
                    jkanbanInfoModalTaskId.value = jkanbanInfoModalTaskId.value;
                    jkanbanInfoModalTaskTitle.value = jkanbanInfoModalTaskTitle.value;
                    jkanbanInfoModalTaskAssignee.value = jkanbanInfoModalTaskAssignee.value;
                    jkanbanInfoModalTaskDescription.value = jkanbanInfoModalTaskDescription.value;
                    document.querySelector('#jkanban-info-modal').classList.remove('show');
                    document.querySelector('body').classList.remove('modal-open');
                    document.querySelector('.modal-backdrop').remove();


                });
            }
        })();
    </script>

    <script>
        $(function () {
            "use strict";


            flatpickr("#start_date", {

                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            flatpickr("#due_date", {

                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
            $(document).ready(function () {
                $('#cloudonex_table').DataTable(
                );

            });


            let $btn_submit = $('#btn_submit');
            let $form_main = $('#form_main');
            let $sp_result_div = $('#sp_result_div');

            $form_main.on('submit', function (event) {
                event.preventDefault();
                $btn_submit.prop('disabled', true);
                $.post('{{route('admin.tasks.save',['action' => 'task'])}}', $form_main.serialize()).done(function () {
                    location.reload();
                }).fail(function (data) {
                    let obj = $.parseJSON(data.responseText);
                    $btn_submit.prop('disabled', false);
                    let html = '';
                    $.each(obj.errors, function (key, value) {
                        html += '<div class="alert bg-pink-light text-danger">' + value + '</div>'
                    });

                    $sp_result_div.html(html);

                });

            });

            let myModal = new bootstrap.Modal(document.getElementById('kt_modal_1'), {
                keyboard: false
            });


            $('.category_edit').on('click', function (event) {
                event.preventDefault();
                $.getJSON('{{route('admin.tasks',['action' => 'task.json'])}}?id=' + $(this).data('id'), function (data) {
                    $('#input_name').val(data.subject);

                    $('#start_date').val(data.start_date);

                    flatpickr("#start_date", {

                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                    });

                    $('#due_date').val(data.due_date);

                    flatpickr("#due_date", {

                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                    });

                    $('#contact_id').val(data.contact_id);
                    $('#description').val(data.description);
                    $('#task_id').val(data.id);
                });

                myModal.show();

            });

            $('#btn_add_new_category').on('click', function () {
                $('#input_name').val('');
                $('#task_id').val('');
                $('#start_date').val('');
                $('#due_date').val('');
                $('#contact_id').val('');
                $('#description').val('');

                myModal.show();
            });


            $('.change_task_status').on('click', function () {
                $.post('{{route('admin.tasks.save', ['action' => 'change-status'])}}', {
                    id: $(this).data('id'),
                    status: $(this).data('status'),
                    _token: '{{csrf_token()}}',
                }).done(function () {
                    location.reload();
                });
            });



        });
    </script>
@endsection


