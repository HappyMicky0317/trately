@extends('layouts.primary')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder"> {{__(' McKinsey\'s 7-S Model')}}</h4>
                    <p>{{__('The McKinsey 7-S Model is a change framework based on a company’s organizational design. It aims to depict how change leaders can effectively manage organizational change by strategizing around the interactions of seven key elements: structure, strategy, system, shared values, skill, style, and staff.
')}}</p>
                    <hr>
                    <form method="post" action="/save-mckinsey-model">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('Business/Company Name')}}
                            </label><label class="text-danger">*</label>
                            <input class="form-control" name="company_name" id="company_name"

                                   @if (!empty($model))
                                   value="{{$model->company_name}}"
                                @endif
                            >

                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Structure')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Structure is the way in which a company is organized – chain of command and accountability relationships that form its organizational chart.')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="structure"
                                                  name="structure">@if (!empty($model)){{$model->structure}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Strategy')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Strategy refers to a well-curated business plan that allows the company to formulate a plan of action to achieve a sustainable competitive advantage, reinforced by the company’s mission and values.')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="strategy"
                                              name="strategy">@if (!empty($model)){{$model->strategy}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('System')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Systems entail the business and technical infrastructure of the company that establishes workflows and the chain of decision-making.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="system"
                                                  name="system">@if(!empty($model)){{$model->system}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Style')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('The attitude of senior employees in a company establishes a code of conduct through their ways of interactions and symbolic decision-making, which forms the management style of its leaders.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="style"
                                              name="style">@if(!empty($model)){{$model->style}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Staff')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Staff involves talent management and all human resources related to company decisions, such as training, recruiting, and rewards systems')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="staff"
                                              name="staff">@if(!empty($model)){{$model->staff}}@endif</textarea>
                                </div>
                            </div>
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Skill')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Skills form the capabilities and competencies of a company that enables its employees to achieve its objectives.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="skill"
                                                  name="skill">@if(!empty($model)){{$model->skill}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row mt-4">

                                <div class="col-md-12 align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Shared Values')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('The mission, objectives, and values form the foundation of every organization and play an important role in aligning all key elements to maintain an effective organizational design.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="shared"
                                                  name="shared_values">@if(!empty($model)){{$model->shared_values}}@endif</textarea>
                                    </div>
                                </div>

                            </div>

                        @if($model)
                            <input type="hidden" name="id" value="{{$model->id}}">
                        @endif
                        @csrf
                        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        (function(){
            "use strict";
            tinymce.init({
                selector: '#structure',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#strategy',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#system',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#skill',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#staff',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#style',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#shared',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
        })();
    </script>
@endsection

