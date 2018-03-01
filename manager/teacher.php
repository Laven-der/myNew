<meta charset="UTF-8" />
<?php
    session_start(); //开启session
    //判断登录时的session是否存在 如果存在则表示已经登录
    if(!$_SESSION['islogin']){
        // !$_SESSION['islogin']  表示不存在 回到登录页面
        
        echo "<script language=javascript>alert ('要访问的页面需要先登录。');

        window.location.href='index.html';</script>"; 
       exit;
    }
    //已经登录后的其他业务逻辑处理代码
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>小小老师管理系统</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <style type="text/css">
    body{  
      position: relative;
   
      background: url("../images/bg1.jpg") no-repeat; 
      background-size: 100% 700px ;
    }
        h2{
            text-align: center;
        }
        .hidden{
            display:none;
        }
    </style>
</head>

<body>
  <a href="http://127.0.0.1:3000/" style="position: absolute;
     right: 220px;
     top: 60px;font-size: 16px;">教学交流平台</a> 
     <a href="tui.php" style="position: absolute;
     right: 120px;
     top: 60px;font-size: 16px;">退出登录</a> 
    <div class="container">
        <div class="page-header">
        <h2 id="h2">教师管理系统</h2>
        
        </div>
        <p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="addBtn">增加教师</button> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="seahsBtn">查找教师</button>
            <button type="button" class="btn btn-primary hidden" id="indexBtn">返回首页</button>
        </p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>编号</th>
                  <th>姓名</th>
                  <th>年龄</th>
                  <th>性别</th>
                  <th>职位</th>
                  <th>地址</th>
                  <th>入职时间</th>
                  <th>更新</th>
                  <th>修改</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- 弹出层 -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document" style="width: 30%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body" id="submitData">
                <form>
                  <div class="form-group">
                    <label ><input type="number" class="form-control" name="bh" placeholder="请输入编号"></label>  <div class="form-group">
                    <label ><input type="text" class="form-control" name="xm" placeholder="请输入姓名"></label>
                  </div>
                    <div class="form-group">
                      <label ><input type="number" class="form-control" name="nl" placeholder="请输入年龄"></label>
                    </div>
                  <div class="checkbox">
                    <label><input type="radio" name="sex" value="男" class="sex" >男性</label>
                    <label><input type="radio" name="sex" value="女" class="sex">女性</label>
                  </div>
                    <div class="form-group">
                      <label ><input type="text" class="form-control"  name="zw" placeholder="请输入职位"></label>
                    </div>
                    <div class="form-group">
                      <label ><input type="text" class="form-control"  name="yx" placeholder="请输入地址"></label>
                    </div>
                    <div class="form-group">
                      <label ><input type="date" class="form-control"  name="sj" placeholder="请输入入职时间"></label>
                    </div>
                </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="button" name="ctrlBtn" class="btn btn-primary" id="submitBtn">添加</button>
            <button type="button" name="ctrlBtn" class="btn btn-primary hidden" id="editBtn">修改</button>
            <button type="button" name="ctrlBtn" class="btn btn-primary hidden" id="seahBtn">查找</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<script type="text/javascript" src="../js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
$("#indexBtn").click(function(){
     $("tbody").empty();
        getAll();
        $("#indexBtn").addClass("hidden");
        $("#addBtn").removeClass("hidden");
        $("#seahsBtn").removeClass("hidden");
})
    function getAll(){
         $('#h2').html("教师管理系统");
        $.get("getAllData.php",function(data){

            var dataObj = eval("("+data+")");
            console.log(dataObj)

            $.each(dataObj.result,function(i,item){

                $("<tr><td>"+item["id"]+"</td><td>"+item["num"]+"</td><td>"+item["name"]+"</td><td>"+item["age"]+"</td><td>"+item["sex"]+"</td><td>"+item["work"]+"</td><td>"+item["email"]+"</td><td>"+item["year"]+"</td><td><a href='javascript:void(0);' class='delbtn'>删除</a></td><td><a href='javascript:void(0);' class='editBtn'>修改</a></td></tr>").appendTo("tbody");
            })

        })
    } 
    getAll();
    // 添加教师
    $("#addBtn").click(function(){
         $('#myModal').find("input:not(.sex)").val("");
         $("[name=ctrlBtn]").eq(0).removeClass("hidden");
         $("[name=ctrlBtn]").eq(1).addClass("hidden");
         $("[name=ctrlBtn]").eq(2).addClass("hidden");
          $('#myModal').find("#myModalLabel").html("添加教师信息");
          $('#myModal').find("input[name=sex]").attr("checked",false);
    }) 
     $("#submitBtn").on("click",submitHandler);
    function submitHandler(){ 
      // if($("#submitData").find("input[name=sex]:checked").val()==null){
      //       alert("请输入性别");
      //       return false;
      //   }
        $(this).click(null);
          if($("#submitData").find("input[name=sex]:checked").val()==null){
           x="";
        }else{
          var x=$("#submitData").find("input[name=sex]:checked").val();
          console.log(x);
        }
        var JSON = {
            num:$("#submitData").find("input[name=bh]").val(),
            name:$("#submitData").find("input[name=xm]").val(),
            age:$("#submitData").find("input[name=nl]").val(),
            sex:x,
            work:$("#submitData").find("input[name=zw]").val(),
            email:$("#submitData").find("input[name=yx]").val(),
            year:$("#submitData").find("input[name=sj]").val(),
        }
        $.post("doadd.php",JSON,function(data){

            if( data == "success"){
                // 关闭模态框
                $('#myModal').modal('hide');
                $("tbody").empty();
                // 重新拉取数据
                getAll();
                alert("提交成功！")
            }else{
                alert("提交失败！")
            }
        })
    } 
    // 删除功能
    $(document).on("click",".delbtn",function(){

        var idnum = $(this).parent().siblings('td:nth-child(1)').text();

        var temp = confirm("您确定要删除我吗?");
        if( !temp) return;
        $.get("del.php",{id:idnum},function(data){

            if( data == "success"){
                $("tbody").empty();
                // 重新拉取数据
                getAll();
                alert("删除成功！")
            }else{
                alert("删除失败！")
            }
        });
    });
//十五分钟之后，登录失效，跳回登录界面
setTimeout(function(){
  alert("登录失效，请重新登录")
  window.location.href="tui.php";},900000);
    // 修改功能
    var idnum,xingming,nianling,xingbie,qqhao;
    $(document).on("click",".editBtn",function(){
        $("[name=ctrlBtn]").eq(0).addClass("hidden");
        $("[name=ctrlBtn]").eq(1).removeClass("hidden");
        $("[name=ctrlBtn]").eq(2).addClass("hidden");
        idnum = $(this).parent().siblings('td:nth-child(1)').text();
        var temp = confirm("您确定要修改我吗?");
        if( !temp) {


        return;}
        // 获取信息
        num = $(this).parent().siblings('td:nth-child(2)').text();
        name = $(this).parent().siblings('td:nth-child(3)').text();
        age = $(this).parent().siblings('td:nth-child(4)').text();
        sex = $(this).parent().siblings('td:nth-child(5)').text();
        work = $(this).parent().siblings('td:nth-child(6)').text();
        email = $(this).parent().siblings('td:nth-child(7)').text();
        year = $(this).parent().siblings('td:nth-child(8)').text();

        // 显示模态框
        $('#myModal').modal('show');

        $('#myModal').find("input[name=bh]").val(num);
        $('#myModal').find("input[name=xm]").val(name);
        $('#myModal').find("input[name=nl]").val(age);
        if( sex == "男"){

            $('#myModal').find("input[name=sex]").eq(0).attr("checked",true);

        }else if( sex == "女"){

            $('#myModal').find("input[name=sex]").eq(1).attr("checked",true);

        }
       $('#myModal').find("input[name=zw]").val(work);
       $('#myModal').find("input[name=yx]").val(email);
       $('#myModal').find("input[name=sj]").val(year);

        $('#myModal').find("#myModalLabel").html("修改教师信息");

        $("#editBtn").on("click",submitUpdataHandler);

    });
    function submitUpdataHandler(){
            var JSON = {
                 id: idnum,
                 num:$("#submitData").find("input[name=bh]").val(),
                 name:$("#submitData").find("input[name=xm]").val(),
                 age:$("#submitData").find("input[name=nl]").val(),
                 sex:$("#submitData").find("input[name=sex]:checked").val(),
                 work:$("#submitData").find("input[name=zw]").val(),
                 email:$("#submitData").find("input[name=yx]").val(),
                 year:$("#submitData").find("input[name=sj]").val(),
            }
            $.post("doupdata.php",JSON,function(data){

                if( data == "success"){
                    // 关闭模态框
                    $('#myModal').modal('hide');
                    // 清空莫泰框的数据
                    $('#myModal').find("input:not(.sex)").val("");
                    $("tbody").empty();
                    // 重新拉取数据
                    $("tbody").empty();
                   window.location.href="teacher.php";
                    alert("修改成功！")
                }else{
                    alert("修改失败！")
                }
            })
        }
         $("#addBtn").click(function(){

         $("[name=ctrlBtn]").eq(0).removeClass("hidden");
         $("[name=ctrlBtn]").eq(1).addClass("hidden");
          $('#myModal').find("#myModalLabel").html("添加教师信息");
    })



         //查找功能实现
     $("#seahsBtn").click(function(){
        $('#myModal').find("input[name=sex]").attr("checked",false);
            $("[name =ctrlBtn]").eq(2).removeClass("hidden");
            $("[name =ctrlBtn]").eq(1).addClass("hidden");
            $("[name =ctrlBtn]").eq(0).addClass("hidden");
            $('#myModal').find("#myModalLabel").html("查找教师，");
    })
    $(document).on("click","#seahBtn",function(){
        if($("#submitData").find("input[name=sex]:checked").val()==null){
           x="";
        }else{
          var x=$("#submitData").find("input[name=sex]:checked").val();
          console.log(x);
        }
        var JSON = {
            num:$("#submitData").find("input[name=bh]").val(),
            name:$("#submitData").find("input[name=xm]").val(),
            age:$("#submitData").find("input[name=nl]").val(),
            sex:x,
            work:$("#submitData").find("input[name=zw]").val(),
            email:$("#submitData").find("input[name=yx]").val(),
            year:$("#submitData").find("input[name=sj]").val(),
        }
         $.post("seacher.php",JSON,function(data){
            var dataObj = eval("("+data+")");
            console.log(dataObj);
            
    if(dataObj=="1"){
         alert("没有找到教师！");
           $("tbody").empty();
         getAll();
         $("#indexBtn").addClass("hidden");
        $("#addBtn").removeClass("hidden");
        $("#seahsBtn").removeClass("hidden");
        
    }
    else{
          // 关闭模态框
         $('#h2').html("教师查询结果");
              // 清空莫泰框的数据
             $('#myModal').find("input:not(.sex)").val("");
          $("tbody").empty();
            $.each(dataObj.result,function(i,item){
               $("<tr><td>"+item["id"]+"</td><td>"+item["num"]+"</td><td>"+item["name"]+"</td><td>"+item["age"]+"</td><td>"+item["sex"]+"</td><td>"+item["work"]+"</td><td>"+item["email"]+"</td><td>"+item["year"]+"</td><td><a href='javascript:void(0);' class='delbtn'>删除</a></td><td><a href='javascript:void(0);' class='editBtn'>修改</a></td></tr>").appendTo("tbody");
                    })
             alert("查找成功！");  

                  $("#indexBtn").removeClass("hidden");
                  $("#addBtn").addClass("hidden");
                  $("#seahsBtn").addClass("hidden"); 
                }

              $('#myModal').modal('hide');
         })

    });

</script>
