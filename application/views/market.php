<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/img/basic/favicon.ico'); ?>" type="image/x-icon">
    <title>Hi Wajo</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>
        (function(w, d, u) {
            w.readyQ = [];
            w.bindReadyQ = [];

            function p(x, y) {
                if (x == "ready") {
                    w.bindReadyQ.push(y);
                } else {
                    w.readyQ.push(x);
                }
            };
            var a = {
                ready: p,
                bind: p
            };
            w.$ = w.jQuery = function(f) {
                if (f === d || f === u) {
                    return a
                } else {
                    p(f)
                }
            }
        })(window, document)
    </script>
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
            <section class="sidebar">
                <div class="w-80px mt-3 mb-3 ml-3">
                    <img src="<?php echo base_url('assets/img/basic/logo.png'); ?>" alt="">
                </div>
                <div class="relative">
                    <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false" aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                        <i class="icon icon-cogs"></i>
                    </a>
                    <div class="user-panel p-3 light mb-2">
                        <div>
                            <div class="float-left image">
                                <img class="user_avatar" src="<?php echo base_url($this->session->userdata('foto')); ?>" alt="User Image">
                            </div>
                            <div class="float-left info">
                                <h6 class="font-weight-light mt-2 mb-1"><?php echo $this->session->userdata('name'); ?></h6>
                                <a href="#"><i class="icon-circle text-primary blink"></i> <?php echo $this->session->userdata('status'); ?></a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="collapse multi-collapse" id="userSettingsCollapse">
                            <div class="list-group mt-3 shadow">
                                <a href="index.html" class="list-group-item list-group-item-action ">
                                    <i class="mr-2 icon-umbrella text-blue"></i>Profile
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"><i class="mr-2 icon-cogs text-yellow"></i>Settings</a>
                                <a href="#" class="list-group-item list-group-item-action"><i class="mr-2 icon-security text-purple"></i>Change Password</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"><strong>MAIN NAVIGATION</strong></li>
                    <li class="treeview"><a href="<?php echo base_url(); ?>">
                        <i class="icon icon-sailing-boat-water purple-text s-18"></i><span>Dashboard</span></a>
                    </li>
                    <li class="treeview"><a href="#">
                            <i class="icon icon icon-package blue-text s-18"></i>
                            <span>Main Features</span>
                            <span class="badge r-3 badge-primary pull-right">3</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="complaint"><i class="icon icon-circle-o"></i>Complaint</a></li>
                            <li><a href="event"><i class="icon icon-circle-o"></i>Event</a></li>
                            <li><a href="news"><i class="icon icon-circle-o"></i>News</a></li>
                        </ul>
                    </li>
                    <li class="treeview"><a href="#">
                            <i class="icon icon icon-package blue-text s-18"></i>
                            <span>Products</span>
                            <span class="badge r-3 badge-primary pull-right">12</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="bank_finance"><i class="icon icon-circle-o"></i>Bank and Finance</a></li>
                            <li><a href="cafe"><i class="icon icon-circle-o"></i>Cafe</a></li>
                            <li><a href="culinary"><i class="icon icon-circle-o"></i>Culinary</a></li>
                            <li><a href="education"><i class="icon icon-circle-o"></i>Education</a></li>
                            <li><a href="entertainment"><i class="icon icon-circle-o"></i>Entertainment</a></li>
                            <li><a href="government"><i class="icon icon-circle-o"></i>Government</a></li>
                            <li><a href="health"><i class="icon icon-circle-o"></i>Health</a></li>
                            <li><a href="housing"><i class="icon icon-circle-o"></i>Housing</a></li>
                            <li><a href="market"><i class="icon icon-circle-o"></i>Market</a></li>
                            <li><a href="restaurant"><i class="icon icon-circle-o"></i>Restaurant</a></li>
                            <li><a href="sports"><i class="icon icon-circle-o"></i>Sports</a></li>
                            <li><a href="travel_transportation"><i class="icon icon-circle-o"></i>Travel and Transportation</a></li>
                            <li><a href="tourism"><i class="icon icon-circle-o"></i>Tourism</a></li>
                        </ul>
                    </li>
                    <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Users<i class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="panel-page-users.html"><i class="icon icon-circle-o"></i>All Users</a>
                            </li>
                            <li><a href="panel-page-users-create.html"><i class="icon icon-add"></i>Add User</a>
                            </li>
                            <li><a href="panel-page-profile.html"><i class="icon icon-user"></i>User Profile </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview no-b"><a href="#">
                            <i class="icon icon-package light-green-text s-18"></i>
                            <span>Inbox</span>
                            <span class="badge r-3 badge-success pull-right">20</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="panel-page-inbox.html"><i class="icon icon-circle-o"></i>All Messages</a>
                            </li>
                            <li><a href="panel7-inbox.html"><i class="icon icon-circle-o"></i>Panel7 - Inbox</a>
                            </li>
                            <li><a href="panel8-inbox.html"><i class="icon icon-circle-o"></i>Panel8 - Inbox</a>
                            </li>
                            <li><a href="panel-page-inbox-create.html"><i class="icon icon-add"></i>Compose</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header light mt-3"><strong>UI COMPONENTS</strong></li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="icon icon-package text-lime s-18"></i> <span>Apps</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="panel-page-chat.html"><i class="icon icon-circle-o"></i>Chat</a>
                            </li>
                            <li><a href="panel7-tasks.html"><i class="icon icon-circle-o"></i>Tasks / Todo</a>
                            </li>
                            <li><a href="panel-page-calendar.html"><i class="icon icon-date_range"></i>Calender</a>
                            </li>
                            <li><a href="panel-page-calendar2.html"><i class="icon icon-date_range"></i>Calender 2</a>
                            </li>
                            <li><a href="panel-page-contacts.html"><i class="icon icon-circle-o"></i>Contacts</a>
                            </li>
                            <li><a href="panel1-projects.html"><i class="icon icon-circle-o"></i>Panel1 - Projects</a>
                            </li>
                            <li><a href="panel7-projects-list.html"><i class="icon icon-circle-o"></i>Panel7 - Projects List</a>
                            </li>
                            <li><a href="panel7-invoices.html"><i class="icon icon-circle-o"></i>Invoices</a>
                            <li><a href="panel7-meetings.html"><i class="icon icon-circle-o"></i>Meetings</a>
                            <li><a href="panel7-payments.html"><i class="icon icon-circle-o"></i>Payments</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon icon-documents3 text-blue s-18"></i> <span>Pages</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="icon icon-documents3"></i>Blank Pages<i class="icon icon-angle-left s-18 pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="panel-page-blank.html"><i class="icon icon-document"></i>Simple Blank</a>
                                    </li>
                                    <li><a href="panel-page-blank-tabs.html"><i class="icon icon-document"></i>Tabs Blank <i class="icon icon-angle-left s-18 pull-right"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon icon-fingerprint text-green"></i>Auth Pages<i class="icon icon-angle-left s-18 pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="login.html"><i class="icon icon-document"></i>Login Page 1</a>
                                    </li>
                                    <li><a href="login-2.html"><i class="icon icon-document"></i>Login Page 2</a>
                                    </li>
                                    <li><a href="login-3.html"><i class="icon icon-document"></i>Login Page 3</a>
                                    </li>
                                    <li><a href="login-4.html"><i class="icon icon-document"></i>Login Page 4</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon icon-bug text-red"></i>Error Pages<i class="icon icon-angle-left s-18 pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="panel-page-404.html"><i class="icon icon-document"></i>404 Page</a>
                                    </li>
                                    <li><a href="panel-page-500.html"><i class="icon icon-document"></i>500 Page<i class="icon icon-angle-left s-18 pull-right"></i></a>
                                    </li>
                                    <li><a href="panel-page-error.html"><i class="icon icon-document"></i>420 Page<i class="icon icon-angle-left s-18 pull-right"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon icon-documents3"></i>Other Pages<i class="icon icon-angle-left s-18 pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="panel-page-invoice.html"><i class="icon icon-document"></i>Invoice Page</a>
                                    </li>
                                    <li><a href="panel-page-no-posts.html"><i class="icon icon-document"></i>No Post Page</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon icon-goals-1 amber-text s-18"></i> <span>Elements</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="panel-element-widgets.html">
                                    <i class="icon icon-widgets amber-text s-14"></i> <span>Widgets</span>
                                </a>
                            </li>
                            <li><a href="panel-element-counters.html">
                                    <i class="icon icon-filter_9_plus amber-text s-14"></i> <span>Counters</span>
                                </a>
                            <li><a href="panel-element-buttons.html">
                                    <i class="icon icon-touch_app amber-text s-14"></i> <span>Buttons</span>
                                </a>
                            </li>
                            <li>
                                <a href="panel-element-typography.html">
                                    <i class="icon icon-text-width amber-text s-14"></i> <span>Typography</span>
                                </a>
                            </li>
                            <li><a href="panel-element-tabels.html">
                                    <i class="icon icon-table amber-text s-14"></i> <span>Tables</span>
                                </a>
                            </li>
                            <li><a href="panel-element-alerts.html">
                                    <i class="icon icon-exclamation-circle amber-text s-14"></i> <span>Alerts</span>
                                </a>
                            </li>
                            <li><a href="panel-element-slider.html"><i class="icon icon-view_carousel amber-text s-14"></i>
                                    <span>Slider</span></a></li>
                            <li><a href="panel-element-tabs.html"><i class="icon icon-folders2 amber-text s-14"></i>
                                    <span>Tabs</span></a></li>
                            <li><a href="panel-element-progress-bars.html"><i class="icon icon-folders2 amber-text s-14"></i>
                                    <span>Progress Bars</span></a></li>
                            <li><a href="panel-element-badges.html"><i class="icon icon-flag7 amber-text s-14"></i>
                                    <span>Badges</span></a></li>
                            <li><a href="panel-element-preloaders.html"><i class="icon icon-data_usage amber-text s-14"></i>
                                    <span>Preloaders</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="icon icon-wpforms light-green-text s-18 "></i> <span>Main Features</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="panel-element-forms.html"><i class="icon icon-wpforms light-green-text"></i>Bootstrap
                                    Inputs</a>
                            </li>
                            <li><a href="form-bootstrap-validations.html"><i class="icon icon-note-important light-green-text"></i>
                                    Form Validation (Bootstrap)</a>
                            </li>
                            <li><a href="panel-element-editor.html"><i class="icon icon-pen2 light-green-text"></i>Editor</a>
                            </li>
                            <li><a href="panel-element-toast.html"><i class="icon icon-notifications_active light-green-text"></i>Toasts</a>
                            </li>
                            <li><a href="panel-element-stepper.html"><i class="icon icon-burst_mode light-green-text"></i>Stepper</a>
                            </li>
                            <li><a href="panel-element-date-time-picker.html"><i class="icon icon-date_range light-green-text"></i>Date Time Picker</a>
                            </li>
                            <li><a href="panel-element-color-picker.html"><i class="icon icon-adjust light-green-text"></i>Color
                                    Picker</a>
                            </li>
                            <li><a href="panel-element-range-slider.html"><i class="icon icon-space_bar light-green-text"></i>Range
                                    Slider</a>
                            </li>
                            <li><a href="panel-element-select2.html"><i class="icon  icon-one-finger-click light-green-text"></i>Select 2</a>
                            </li>
                            <li><a href="panel-element-tags.html"><i class="icon  icon-tags3 light-green-text"></i>Tags</a>
                            </li>
                            <li><a href="restaurant_list"><i class="icon icon-table light-green-text"></i>Restaurant List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview"><a href="#">
                            <i class="icon icon-bar-chart2 pink-text s-18"></i>
                            <span>Charts</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="panel-element-charts-js.html"><i class="icon icon-area-chart pink-text s-14"></i><span>Charts.Js</span></a>
                            </li>
                            <li>
                                <a href="panel-element-morris.html"><i class="icon icon-bubble_chart pink-text s-14"></i>Morris
                                    Charts</a>
                            </li>
                            <li>
                                <a href="panel-element-echarts.html">
                                    <i class="icon icon-bar-chart-o pink-text s-14"></i>Echarts</a>
                            </li>
                            <li>
                                <a href="panel-element-easy-pie-charts.html">
                                    <i class="icon icon-area-chart pink-text s-14"></i>Easy Pie Charts</a>
                            </li>
                            <li>
                                <a href="panel-element-jqvmap.html">
                                    <i class="icon icon-map pink-text s-14"></i>Jqvmap</a>
                            </li>
                            <li>
                                <a href="panel-element-sparklines.html">
                                    <i class="icon icon-line-chart2 pink-text s-14"></i>Sparklines</a>
                            </li>
                            <li>
                                <a href="panel-element-float.html">
                                    <i class="icon icon-pie-chart pink-text s-14"></i>Float Charts</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview"><a href="#">
                            <i class="icon icon-dialpad blue-text  s-18"></i>
                            <span>Extra</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="panel-element-letters.html">
                                    <i class="icon icon-brightness_auto light-blue-text s-14"></i>
                                    <span>Avatar Placeholders</span>
                                </a>
                            </li>
                            <li>
                                <a href="panel-element-icons.html">
                                    <i class="icon icon-camera2 light-blue-text s-14"></i> <span>Icons</span>
                                </a>
                            </li>
                            <li><a href="panel-element-colors.html">
                                    <i class="icon icon-palette light-blue-text s-14"></i> <span>Colors</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
        </aside>
        <!--Sidebar End-->
        <div class="has-sidebar-left">
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                        <div class="search-bar">
                            <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text" placeholder="start typing...">
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
                    </div>
                </div>
            </div>
            <div class="sticky">
                <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
                    <div class="relative">
                        <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                            <i></i>
                        </a>
                    </div>
                    <!--Top Menu Start -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages-->
                            <li class="dropdown custom-dropdown messages-menu">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="icon-message "></i>
                                    <span class="badge badge-success badge-mini rounded-circle">4</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu pl-2 pr-2">
                                            <!-- start message -->
                                            <li>
                                                <a href="#">
                                                    <div class="avatar float-left">
                                                        <img src="<?php echo base_url('assets/img/dummy/u4.png'); ?>" alt="">
                                                        <span class="avatar-badge busy"></span>
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                            <!-- start message -->
                                            <li>
                                                <a href="#">
                                                    <div class="avatar float-left">
                                                        <img src="<?php echo base_url('assets/img/dummy/u1.png'); ?>" alt="">
                                                        <span class="avatar-badge online"></span>
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                            <!-- start message -->
                                            <li>
                                                <a href="#">
                                                    <div class="avatar float-left">
                                                        <img src="<?php echo base_url('assets/img/dummy/u2.png'); ?>" alt="">
                                                        <span class="avatar-badge idle"></span>
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                            <!-- start message -->
                                            <li>
                                                <a href="#">
                                                    <div class="avatar float-left">
                                                        <img src="<?php echo base_url('assets/img/dummy/u3.png'); ?>" alt="">
                                                        <span class="avatar-badge busy"></span>
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        </ul>
                                    </li>
                                    <li class="footer s-12 p-2 text-center"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- Notifications -->
                            <li class="dropdown custom-dropdown notifications-menu">
                                <a href="#" class=" nav-link" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-notifications "></i>
                                    <span class="badge badge-danger badge-mini rounded-circle">4</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="icon icon-data_usage text-success"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon icon-data_usage text-danger"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon icon-data_usage text-yellow"></i> 5 new members joined today
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer p-2 text-center"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="nav-link " data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class=" icon-search3 "></i>
                                </a>
                            </li>
                            <!-- Right Sidebar Toggle Button -->
                            <li>
                                <a class="nav-link ml-2" data-toggle="control-sidebar">
                                    <i class="icon-tasks "></i>
                                </a>
                            </li>
                            <!-- User Account-->
                            <li class="dropdown custom-dropdown user user-menu ">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <img src="<?php echo base_url($this->session->userdata('foto')); ?>" class="user-image" alt="User Image">
                                    <i class="icon-more_vert "></i>
                                </a>
                                <div class="dropdown-menu p-4 dropdown-menu-right">
                                    <div class="row box justify-content-between my-4">
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                                                <div class="pt-1">Apps</div>
                                            </a>
                                        </div>
                                        <div class="col"><a href="#">
                                                <i class="icon-beach_access pink lighten-1 avatar  r-5"></i>
                                                <div class="pt-1">Profile</div>
                                            </a></div>
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-perm_data_setting indigo lighten-2 avatar  r-5"></i>
                                                <div class="pt-1">Settings</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row box justify-content-between my-4">
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-star light-green lighten-1 avatar  r-5"></i>
                                                <div class="pt-1">Favourites</div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-save2 orange accent-1 avatar  r-5"></i>
                                                <div class="pt-1">Saved</div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-perm_data_setting grey darken-3 avatar  r-5"></i>
                                                <div class="pt-1">Settings</div>
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row box justify-content-between my-4">
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                                                <div class="pt-1">Apps</div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="#">
                                                <i class="icon-beach_access pink lighten-1 avatar  r-5"></i>
                                                <div class="pt-1">Profile</div>
                                            </a></div>
                                        <div class="col">
                                            <a href="<?php echo site_url('main/logout'); ?>">
                                                <i class="icon-perm_data_setting indigo lighten-2 avatar  r-5"></i>
                                                <div class="pt-1">Logout</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page has-sidebar-left bg-light height-full">
            <header class="blue accent-3 relative nav-sticky">
                <div class="container-fluid text-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="my-3">
                                <i class="icon icon-notifications_active"></i>
                                Market<span class="s-14"></span>
                            </h3>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card no-b">
                            <div class="card-body">
                                <?php echo $this->session->flashdata('msg'); ?>
                                <div class="card-title">
                                    <button type="button" class="btn btn-outline-danger" onclick="create_market();">Add Market</button>
                                </div>
                                <table class="table table-bordered table-hover" id="table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th style="width:20%;">Code</th>
                                            <th style="width:20%;">Name</th>
                                            <th style="width:20%;">Address</th>
                                            <th>Phone Number</th>
                                            <th style="width:20%;">Description</th>
                                            <th style="width:20%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="newsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" id="add_news">
                            <input type="hidden" name="id" />
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" required>
                                    <label class="form-label">Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="address" required>
                                    <label class="form-label">Address</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="phone_number" required>
                                    <label class="form-label">Phone Number</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                    <label class="form-label">Description</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" aria-describedby="inputGroupFileAddon01" required>
                                    <label class="custom-file-label" for="inputGroupFile01">Select Image</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSave" onclick="save();">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Are you sure ?
                </div>
                <div class="modal-body">
                    <p>Delete <span style="font-weight:bold;" name="delete_body"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok" name="delete" onclick="delete_market(this.value)">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script>
        (function($, d) {
            $.each(readyQ, function(i, f) {
                $(f)
            });
            $.each(bindReadyQ, function(i, f) {
                $(d).bind("ready", f)
            })
        })(jQuery, document)
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
        var table;
        var save_method;
        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({ 
 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('main/read_market')?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    { 
                        "targets": [ -1 ], //last column
                        "orderable": false, //set not orderable
                    },
                ],
            });
        });
        function create_market()
        {
            save_method = 'add';
            $('#add_news')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            // $('.help-block').empty(); // clear error string
            $('#newsModal').modal('show'); // show bootstrap modal
            // $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
        }
        function edit_market(id)
        {
            save_method = 'update';
            $('#add_news')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            // $('.help-block').empty(); // clear error string
        
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('main/edit_market')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
        
                    $('[name="id"]').val(data.id);
                    $('[name="name"]').val(data.name);
                    $('[name="address"]').val(data.address);
                    $('[name="phone_number"]').val(data.phone_number);
                    $('[name="description"]').val(data.description);
                    // $('[name="image"]').val(data.image);
                    // $('[name="dob"]').datepicker('update',data.dob);
                    $('#newsModal').modal('show'); // show bootstrap modal when complete loaded
                    // $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
        
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function get_data_delete_market(id)
        {
        
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('main/edit_market')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
        
                    $('[name="delete"]').val(data.id);
                    $('[name="delete_body"]').html(data.name);
                    $('#confirm-delete').modal('show');
        
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function save()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;
        
            if(save_method == 'add') {
                url = "<?php echo site_url('main/create_market')?>";
            } else {
                url = "<?php echo site_url('main/update_market')?>";
            }

            var form = $('#add_news')[0];
            var formData = new FormData(form);
        
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType:false,
                processData:false,
                success: function(data)
                {
                    console.log(data);
        
                    if(data.status == "success") //if success close modal and reload ajax table
                    {
                        $('#newsModal').modal('hide');
                        table.ajax.reload();
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
        
        
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
        
                }
            });
        }

        function delete_market(id)
        {
            var table = $('#table').DataTable();
                    // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('main/delete_market')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    $('#confirm-delete').modal('hide');
                    table.ajax.reload();

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
        }
    </script>
</body>

</html>