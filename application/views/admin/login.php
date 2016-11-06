<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>后台登录中心</title>
        <script src="<?php echo base_url(); ?>public/js/jquery-2.2.2.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                $('#cap').bind('click', function() {
                    $.get("<?php echo site_url('admin/login/change_code?'); ?>"+Math.random(), function(data){
                        $('#cap').attr("src","<?php echo base_url() ?>public/captcha/"+data+".jpg");
                    });
                });

            });

        </script>
        <style  type="text/css">
            li{margin:0; padding:0; list-sytle:none}
        </style>
    </head>
    <body>
        <?php echo form_open('admin/login/dologin'); ?>
        <div class="Main">
            <ul>
                <li class="topD">
                    <ul class="login">
                        <li>
                            <span class="left">用户名：</span>
                            <span style="left">
                                <input id="Text1" type="text" name ="name" class="txt" />
                            </span>
                        </li>
                        <li><span class="left">密 码：</span> <span style="left">
                                <input id="Text2" type="password" name="password" class="txt" />
                            </span>
                        </li>
                        <li>
                            <span class="left">验证码：</span> <span style="left" >
                                <input id="Text3" type="text" name="code" class="txtCode" />
                                <img width="110" id="cap" height="30"  style="border:0;" src="<?php echo base_url() ?>public/captcha/<?php echo isset($captcha) ? $captcha['time'] : '' ?>.jpg" title="看不清？点此更换">
                            </span>
                        </li>
                        <li style="padding-left: 50px;line-height:15px;">
                            <span  style="color:red;" >
                                <?php
                                if (!empty($login_error)) {
                                    echo $login_error;
                                } elseif (validation_errors()) {
                                    echo validation_errors();
                                } else {
                                    echo '';
                                }
                                ?>
                            </span>
                        </li>
                    </ul>
                </li>
                <li class="topE"></li>
                <li class="middle_A"></li>
                <li class="middle_B">
                </li>
                <li class="middle_C">
                    <span class="btn">
                        <input type="image" alt="" src="<?php echo base_url() ?>public/images/login.jpg" />
                    </span>
                </li>
                <li class="middle_D"></li>
                <li class="bottom_A"></li>
                <li class="bottom_B">
                    后台管理
                </li>
            </ul>
        </div>
        </form>
    </body>
</html>

