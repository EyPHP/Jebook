<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jebook 后台管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/h-admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('/h-admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{ URL::asset('/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('/h-admin/js/xadmin.js')}}"></script>

</head>