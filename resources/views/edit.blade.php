@extends('layouts.default')

@section('container-style', 'container-fluid')
@section('content')
    @include('layouts.navbar')

    <div class="row marketing">
        @include('components.error', ['error' => $errors ?? null])
        <form class="form-inline" method="POST"
              action="{{ $newPage ? wzRoute('project:page:new:show', ['id' => $project->id]) : wzRoute('project:page:edit:show', ['id' => $project->id, 'page_id' => $pageItem->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="project_id" id="editor-project_id" value="{{ $project->id or '' }}"/>
            <input type="hidden" name="page_id" id="editor-page_id" value="{{ $pageItem->id or '' }}">
            <input type="hidden" name="pid" id="editor-pid" value="{{ $pageItem->pid or '' }}">
            <div class="col-lg-12 wz-edit-control">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="editor-title"
                           value="{{ $pageItem->title or '' }}" placeholder="标题">
                </div>

                <div class="form-group pull-right">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">保存</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">另存为模板</a></li>
                            <li><a href="#">加入草稿箱</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div id="editormd">
                    <textarea style="display:none;" name="content">{{ $pageItem->content or '' }}</textarea>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('stylesheet')
<link href="/assets/vendor/editor-md/css/editormd.min.css" rel="stylesheet"/>
@endpush

@push('script')
<script src="/assets/vendor/editor-md/editormd.min.js"></script>
<script type="text/javascript">
    $(function () {
        var editor = editormd("editormd", {
            path: "/assets/vendor/editor-md/lib/",
            height: 640
        });
    });
</script>
@endpush