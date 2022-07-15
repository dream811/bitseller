@extends('user.layouts.window')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">쪽지</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline">
                <form id="frm" method="post">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">제목:</label>
                            <div class="col-sm-9 col-md-9 mt-1">
                                <h5>{{ $msgInfo->subject }}<h5>
                            </div>
                        </div>                        
                        <hr>
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">내용:</label>
                            <div class="col-sm-9 col-md-9 mt-2" style="font-size:12px;">
                                {!! $msgInfo->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-bottom-0 text-center px-5">                        
                        <a href="javascript:void(0)" onclick="window.opener=null; window.close(); return false;" class="btn btn-warning btn-xs" style="font-size:12px !important;">닫기</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>
@endsection