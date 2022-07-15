@extends('user.layouts.window')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">공지사항</h1>
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
                                <h5>{{ $noticeInfo->subject }}<h5>
                            </div>
                        </div>                        
                        <hr>
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">공지내용:</label>
                            <div class="col-sm-9 col-md-9 mt-2" style="font-size:12px;">
                                {!! $noticeInfo->content !!}
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

        $('#txtSalesPeriodStartDateTime').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            },
            minYear: parseInt(moment().format('YYYY'), 10) - 1
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');

        });
        $('#summernote').summernote({
            height: '500px',
            
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
        $('#summernote').summernote('code', {!! json_encode($noticeInfo->strContent) !!});
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
                    $('#summernote').summernote("insertNode", image[0]);
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
@endsection