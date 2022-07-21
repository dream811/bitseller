@extends('user.layouts.window')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">1대1문의</h1>
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
                        @if ($qnaInfo->is_answer == 0)
                            <input type="hidden" name="type" value="0">
                            <div class="form-group row mb-0">
                                <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">제목<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-9">
                                    <input type="text" class="form-control form-control-sm" id="subject" name="subject" value="{{ $qnaInfo->subject }}" placeholder="제목을 입력하세요.">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">내용<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-9">
                                    <textarea name="content" id="content">
                                    </textarea>
                                </div>
                            </div>
                        @else
                            <div class="form-group row mb-0">
                                <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">제목:</label>
                                <div class="col-sm-9 col-md-9 mt-1">
                                    <h5>{{ $qnaInfo->subject }}<h5>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-0">
                                <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">내용:</label>
                                <div class="col-sm-9 col-md-9 mt-2" style="font-size:12px;">
                                    {!! $qnaInfo->content !!}
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-0">
                                <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">답변:</label>
                                
                                <div class="col-sm-9 col-md-9 mt-2" style="font-size:12px;">
                                    {!! $qnaInfo->answer !!}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer border-bottom-0 text-center px-5">
                        @if ($qnaInfo->is_answer == 0)
                            <a href="javascript:void(0)" id="btnSave" class="btn btn-primary btn-xs" style="font-size:12px !important;">확인</a>
                        @endif
                        <a href="javascript:void(0)" onclick="window.opener=null; window.close(); return false;" class="btn btn-warning btn-xs" style="font-size:12px !important;">취소</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('#txtSalesPeriodStartDateTime').daterangepicker({
        //     singleDatePicker: true,
        //     showDropdowns: true,
        //     timePicker: true,
        //     timePicker24Hour: true,
        //     timePickerSeconds: true,
        //     locale: {
        //         format: 'YYYY-MM-DD HH:mm:ss'
        //     },
        //     minYear: parseInt(moment().format('YYYY'), 10) - 1
        // }, function(start, end, label) {
        //     var years = moment().diff(start, 'years');

        // });
        $('#content').summernote({
            height: '300px',
            toolbar: [
            
            ],
            disableResizeEditor: true,
            callbacks:{
                onImageUpload: function(files, editor, welEditable) {
                    var url= sendFile(files, editor, welEditable);
                },
                onMediaDelete : function(target) {
                    //deleteSNImage(target[0].src);
                }
            }
        });
        $('#content').summernote('code', {!! json_encode($qnaInfo->content) !!});
        function sendFile(files, editor, welEditable) {
            data = new FormData();
            //data.append("file", file);
            var i = 0, len = files.length, img, reader, file;
            for (var i = 0; i < len; i++) {
                file = files[i];
                data.append("file[]", file);
                
            }

            $.ajax({
                data: data,
                type: "POST",
                url: "/uploadImages",
                cache: false,
                contentType: false,
                processData: false,
                success: function({success, data}) {
                    data.forEach((element)=>{
                        var image = $('<img>').attr('src', element ).addClass("img-fluid");
                        $('#content').summernote("insertNode", image[0]);
                    });
                }
            });
        }
        
        $('#btnSave').on('click', function() {
            if(confirm("문의내용을 전송하시겠습니까")){
                $('#frm').submit();
            }
        });
    });
</script>
@endpush