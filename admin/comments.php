<?php

require_once '../functions.php';

xiu_get_current_user();

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php'; ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>Abouts</h1>
      </div>

      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
<!-- 使用jQuery的分页插件 -->
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="150">操作</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

  <?php $current_page = 'comments'; ?>
  <?php include 'inc/sidebar.php'; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/static/assets/vendors/jsrender/jsrender.js"></script>
  <script src="/static/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>


  <script id ="comments_tmpl" type="text/x-jsrender">
  //使用模板引擎jsrender
    {{for comments}}
    {{!--<tr><td>{{:#index}}</td><td>{{:content}}</td></tr> --}}
    <tr{{if status == 'held'}} class="warning"{{else status == 'rejected'}} class="danger" {{/if}}>
        <td class="text-center"><input type="checkbox"></td>
        <td>{{:author}}</td>
        <td>{{:content}}</td>
        <td>《{{:post_title}}》</td>
        <td>{{:created}}</td>
        <td>{{:status}}</td>
        <td class="text-center">
          {{if status == 'held'}}

          <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
          <a href="javascript:;" class="btn btn-warning btn-xs">删除</a>
          {{/if}}
          <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
        </td>
    </tr>
    {{/for}}


  </script>
  <script>
  // //发送ajax请求获取列表所需数据
  //   $.getJSON('/admin/api/comments.php',{ page:2 },function (res) {
  //     //请求得到响应过后自动执行
  //     //将数据渲染到页面上
  //     var html = $('#comments_tmpl').render({ comments:res})
  //     $('tbody').html(html)
  //     //准备一个给模板使用的数据
  //     //var data = {}
  //     //data.comments = res
  //     //var html = $('#comments_tmpl').render(data)
  //     // console.log(html)
  //   })
//对上面进行封装
    function loadPageData (page){
       $('tbody').fadeOut() 
       $.getJSON('/admin/api/comments.php',{ page:page },function (data) {
        $('.pagination').twbsPagination({
          totalPages:data.total_pages,
          visiblePages:5,
          initiateStartPageClick:false,//让第一次初始化时不会触发
          onPageClick:function (e, page){
            //第一次初始化时就会触发一次
            loadPageData(page)
          }
        })
    
        console.log(data)
        var html = $('#comments_tmpl').render({ comments:data.comments})          
            $('tbody').html(html).fadeIn()
          })
       }   
    

    loadPageData(1)

    
  </script>

  <script>NProgress.done()</script>
</body>
</html>
