<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">YÊU CẦU KẾT BẠN FACEBOOK</h1>
                <h1 class="page-subhead-line">Sử dụng toàn bộ token hiện có để thực hiện kết bạn</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Thông Tin UID
                    </div>
                    <div class="panel-body">
                        <form id="frm_importuid">
                            <div class="form-group">
                                <label>Danh sách UID cần kết bạn:</label>
                                <textarea id="result_token" name="import_uid"  class="form-control" rows="5"></textarea>
                            </div>
                            <button id="exec_import" type="button" class="btn btn-info">Nhập Dữ Liệu</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Danh Sách UID Đã Nạp
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <?php if ($batch_status == 'locked') { ?>
                            <button id="exec_run" type="button" class="btn btn-danger">Dừng Tiến Trình</button>
                            <?php } else { ?>
                            <button id="exec_run" type="button" class="btn btn-success">Chạy Tiến Trình</button>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>Thời gian chờ:</label>
                            <select class="form-control" name="time_delay">
                                <option>One Vale</option>
                                <option>Two Vale</option>
                                <option>Three Vale</option>
                                <option>Four Vale</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>UID</th>
                                    <th>Trạng Thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($list != null) { ?>
                                    <?php foreach ($list as $index => $item) { ?>
                                    <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a target="_blank" href="https://www.facebook.com/<?= $item['uid'] ?>"><?= $item['uid'] ?></a></td>

                                        <?php if ($item['status'] == 1) { ?>
                                            <td><div style="color: red;"><?= $item['status_text'] ?></div></td>
                                        <?php } else { ?>
                                            <td><?= $item['status_text'] ?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
</div>
<script>
    $(function() {
        $('#exec_import').click(function(){
            Base_ajax.ok_cancel_box('Thực hiện xử lý này ?',function(){
                    var html_ajax = new Base_ajax("json");
                    html_ajax.done_func = function(data) {
                        if(data.error_msg != ''){
                            Base_ajax.message_box_error(data.error_msg);
                        }
                        else{
                            $("#result_token").val('');
                            Base_ajax.message_box('Xong!');
                        }
                    };
                    var data = $("form#frm_importuid").serializeArray();
                    html_ajax.connect("POST", "friends/importUid", data);
                }
            );
        });

        $('#exec_run').click(function(){
            Base_ajax.ok_cancel_box('Thực hiện xử lý này ?',function(){
                    var html_ajax = new Base_ajax("json");
                    html_ajax.done_func = function(data) {
                        if(data.status == 'OK'){
                            if(data.batch_status == 'locked'){
                                $('#exec_run').html('Dừng Tiến Trình');
                                $('#exec_run').removeClass('btn-success');
                                $('#exec_run').addClass('btn-danger');
                            }
                            else{
                                $('#exec_run').html('Chạy Tiến Trình');
                                $('#exec_run').removeClass('btn-danger');
                                $('#exec_run').addClass('btn-success');
                            }
                        }
                    };
                    var data = $("form#frm_token_multi").serializeArray();
                    html_ajax.connect("POST", "friends/execFriendsRequest", data);
                }
            );
        });
    });
</script>