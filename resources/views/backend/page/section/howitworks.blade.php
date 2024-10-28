@extends('backend.layouts.app')
@section('title')
    {{ __('How it works Section') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="title-content">
                            <h2 class="title">{{ __('How it works Section') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-tab-bars">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                @foreach($languages as $language)
                    <li class="nav-item" role="presentation">
                        <a
                            href=""
                            class="nav-link  {{ $loop->index == 0 ?'active' : '' }}"
                            id="pills-informations-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#{{$language->locale}}"
                            type="button"
                            role="tab"
                            aria-controls="pills-informations"
                            aria-selected="true"
                        ><i icon-name="languages"></i>{{$language->name}}</a
                        >
                    </li>
                @endforeach


            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">

            @foreach($groupData as $key => $value)

                @php
                    $data = new Illuminate\Support\Fluent($value);
                @endphp

                <div
                    class="tab-pane fade {{ $loop->index == 0 ?'show active' : '' }}"
                    id="{{$key}}"
                    role="tabpanel"
                    aria-labelledby="pills-informations-tab"
                >

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h3 class="title">{{ __('Titles and Activity') }}</h3>
                                </div>
                                <div class="site-card-body">
                                    <form action="{{ route('admin.page.section.section.update') }}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="section_code" value="howitworks">
                                        <input type="hidden" name="section_locale" value="{{$key}}">
                                        @if($key == 'en')
                                            <div class="site-input-groups row">
                                                <label for="" class="col-sm-3 col-label pt-0">{{ __('Section Activity') }}<i
                                                        icon-name="info" data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Manage Section Visibility"></i></label>
                                                <div class="col-sm-3">
                                                    <div class="site-input-groups">
                                                        <div class="switch-field">
                                                            <input type="radio" id="active" name="status" @if($status) checked
                                                                   @endif value="1"/>
                                                            <label for="active">{{ __('Show') }}</label>
                                                            <input type="radio" id="deactivate" name="status" @if(!$status) checked
                                                                   @endif value="0"/>
                                                            <label for="deactivate">{{ __('Hide') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="site-input-groups row">
                                            <label for=""
                                                   class="col-sm-3 col-label">{{ __('How It Works Title Small') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title_small" class="box-input"
                                                       value="{{ $data->title_small }}">
                                            </div>
                                        </div>
                                        <div class="site-input-groups row">
                                            <label for="" class="col-sm-3 col-label">{{ __('How It Works Title Big') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title_big" class="box-input"
                                                       value="{{ $data->title_big }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit"
                                                        class="site-btn-sm primary-btn w-100">{{ __('Save Changes') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

            <div class="site-card">
                    <div class="site-card-header">
                        <h3 class="title">{{ __('How It Works Contents') }}</h3>
                        <div class="card-header-links">
                            <a href="" class="card-header-link" type="button" data-bs-toggle="modal"
                               data-bs-target="#addNew">{{ __('Add New') }}</a>
                        </div>
                    </div>
                    <div class="site-card-body">
                        <div class="site-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Icon') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($landingContent as $content)
                                    <tr>
                                        <td>
                                            <img class="avatar" src="{{ asset($content->icon) }}" alt="">
                                        </td>
                                        <td>
                                            {{ $content->title }}
                                        </td>
                                        <td>{{ $content->description }}</td>
                                        <td>
                                            <button class="round-icon-btn primary-btn editContent" type="button"
                                                    data-id="{{ $content->id }}">
                                                <i icon-name="edit-3"></i>
                                            </button>
                                            <button class="round-icon-btn red-btn deleteContent" type="button"
                                                    data-id="{{ $content->id }}">
                                                <i icon-name="trash-2"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>



    <!-- Modal for Add New  -->
    @include('backend.page.section.include.__add_new_how_it_work')
    <!-- Modal for Add New How It Works End -->

    <!-- Modal for Edit -->
    @include('backend.page.section.include.__edit_how_it_work')
    <!-- Modal for Edit  End-->

    <!-- Modal for Delete  -->
    @include('backend.page.section.include.__delete_how_it_work')
    <!-- Modal for Delete  End-->
@endsection
@section('script')
    <script>
        $('.editContent').on('click',function (e) {
            "use strict";
            e.preventDefault();
            var id = $(this).data('id');

            var url = '{{ route("admin.page.content-edit", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Handle the response HTML
                    $('#target-element').html(response.html);
                    $('#editContent').modal('show');
                },
                error: function(xhr) {
                    // Handle any errors that occurred during the request
                    console.log(xhr.responseText);
                }
            });
        });

        $('.deleteContent').on('click',function (e) {
            "use strict";
            e.preventDefault();
            var id = $(this).data('id');
            $('#deleteId').val(id);
            $('#deleteContent').modal('show');
        });
    </script>
@endsection
