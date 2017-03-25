@extends("template")

@section('content')
  <h1 class="page-title">
    Dashboard
  </h1>

  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
        <div class="visual">
          <i class="fa fa-comments"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="1349">1349</span>
          </div>
          <div class="desc"> Open Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 red" href="#">
        <div class="visual">
          <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="12,5">12,5</span>M$ </div>
          <div class="desc"> Completed Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 green" href="#">
        <div class="visual">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="549">549</span>
          </div>
          <div class="desc"> Invoiced Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
        <div class="visual">
          <i class="fa fa-globe"></i>
        </div>
        <div class="details">
          <div class="number"> +
            <span data-counter="counterup" data-value="89">89</span>% </div>
          <div class="desc"> Paid Tickets </div>
        </div>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light ">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-share font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Recent Activities</span>
          </div>
          <div class="actions">
            <div class="btn-group">
              <a class="btn btn-sm blue btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter By
                <i class="fa fa-angle-down"></i>
              </a>
              <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                <label class="mt-checkbox mt-checkbox-outline">
                  <input type="checkbox"> Finance
                  <span></span>
                </label>
                <label class="mt-checkbox mt-checkbox-outline">
                  <input type="checkbox" checked=""> Membership
                  <span></span>
                </label>
                <label class="mt-checkbox mt-checkbox-outline">
                  <input type="checkbox"> Customer Support
                  <span></span>
                </label>
                <label class="mt-checkbox mt-checkbox-outline">
                  <input type="checkbox" checked=""> HR
                  <span></span>
                </label>
                <label class="mt-checkbox mt-checkbox-outline">
                  <input type="checkbox"> System
                  <span></span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="portlet-body">
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;"><div class="scroller" style="height: 300px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
              <ul class="feeds">
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-info">
                          <i class="fa fa-check"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> You have 4 pending tasks.
                                                                <span class="label label-sm label-warning "> Take action
                                                                    <i class="fa fa-share"></i>
                                                                </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> Just now </div>
                  </div>
                </li>
                <li>
                  <a href="javascript:;">
                    <div class="col1">
                      <div class="cont">
                        <div class="cont-col1">
                          <div class="label label-sm label-success">
                            <i class="fa fa-bar-chart-o"></i>
                          </div>
                        </div>
                        <div class="cont-col2">
                          <div class="desc"> Finance Report for year 2013 has been released. </div>
                        </div>
                      </div>
                    </div>
                    <div class="col2">
                      <div class="date"> 20 mins </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-danger">
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 24 mins </div>
                  </div>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-info">
                          <i class="fa fa-shopping-cart"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> New order received with
                          <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 30 mins </div>
                  </div>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-success">
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 24 mins </div>
                  </div>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-default">
                          <i class="fa fa-bell-o"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> Web server hardware needs to be upgraded.
                          <span class="label label-sm label-default "> Overdue </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 2 hours </div>
                  </div>
                </li>
                <li>
                  <a href="javascript:;">
                    <div class="col1">
                      <div class="cont">
                        <div class="cont-col1">
                          <div class="label label-sm label-default">
                            <i class="fa fa-briefcase"></i>
                          </div>
                        </div>
                        <div class="cont-col2">
                          <div class="desc"> IPO Report for year 2013 has been released. </div>
                        </div>
                      </div>
                    </div>
                    <div class="col2">
                      <div class="date"> 20 mins </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-info">
                          <i class="fa fa-check"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> You have 4 pending tasks.
                                                                <span class="label label-sm label-warning "> Take action
                                                                    <i class="fa fa-share"></i>
                                                                </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> Just now </div>
                  </div>
                </li>
                <li>
                  <a href="javascript:;">
                    <div class="col1">
                      <div class="cont">
                        <div class="cont-col1">
                          <div class="label label-sm label-danger">
                            <i class="fa fa-bar-chart-o"></i>
                          </div>
                        </div>
                        <div class="cont-col2">
                          <div class="desc"> Finance Report for year 2013 has been released. </div>
                        </div>
                      </div>
                    </div>
                    <div class="col2">
                      <div class="date"> 20 mins </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-default">
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 24 mins </div>
                  </div>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-info">
                          <i class="fa fa-shopping-cart"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> New order received with
                          <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 30 mins </div>
                  </div>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-success">
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 24 mins </div>
                  </div>
                </li>
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-warning">
                          <i class="fa fa-bell-o"></i>
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> Web server hardware needs to be upgraded.
                          <span class="label label-sm label-default "> Overdue </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> 2 hours </div>
                  </div>
                </li>
                <li>
                  <a href="javascript:;">
                    <div class="col1">
                      <div class="cont">
                        <div class="cont-col1">
                          <div class="label label-sm label-info">
                            <i class="fa fa-briefcase"></i>
                          </div>
                        </div>
                        <div class="cont-col2">
                          <div class="desc"> IPO Report for year 2013 has been released. </div>
                        </div>
                      </div>
                    </div>
                    <div class="col2">
                      <div class="date"> 20 mins </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 186.335px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
          <div class="scroller-footer">
            <div class="btn-arrow-link pull-right">
              <a href="javascript:;">See All Records</a>
              <i class="icon-arrow-right"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light tasks-widget ">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-share font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Tasks</span>
            <span class="caption-helper">tasks summary...</span>
          </div>
          <div class="actions">
            <div class="btn-group">
              <a class="btn blue-oleo btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu pull-right">
                <li>
                  <a href="javascript:;"> All Project </a>
                </li>
                <li class="divider"> </li>
                <li>
                  <a href="javascript:;"> AirAsia </a>
                </li>
                <li>
                  <a href="javascript:;"> Cruise </a>
                </li>
                <li>
                  <a href="javascript:;"> HSBC </a>
                </li>
                <li class="divider"> </li>
                <li>
                  <a href="javascript:;"> Pending
                    <span class="badge badge-danger"> 4 </span>
                  </a>
                </li>
                <li>
                  <a href="javascript:;"> Completed
                    <span class="badge badge-success"> 12 </span>
                  </a>
                </li>
                <li>
                  <a href="javascript:;"> Overdue
                    <span class="badge badge-warning"> 9 </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="portlet-body">
          <div class="task-content">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 312px;"><div class="scroller" style="height: 312px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                <!-- START TASK LIST -->
                <ul class="task-list">
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Present 2013 Year IPO Statistics at Board Meeting </span>
                      <span class="label label-sm label-success">Company</span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Hold An Interview for Marketing Manager Position </span>
                      <span class="label label-sm label-danger">Marketing</span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> AirAsia Intranet System Project Internal Meeting </span>
                      <span class="label label-sm label-success">AirAsia</span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Technical Management Meeting </span>
                      <span class="label label-sm label-warning">Company</span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Kick-off Company CRM Mobile App Development </span>
                      <span class="label label-sm label-info">Internal Products</span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Prepare Commercial Offer For SmartVision Website Rewamp </span>
                      <span class="label label-sm label-danger">SmartVision</span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Sign-Off The Comercial Agreement With AutoSmart </span>
                      <span class="label label-sm label-default">AutoSmart</span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group dropup">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> Company Staff Meeting </span>
                      <span class="label label-sm label-success">Cruise</span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group dropup">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li class="last-line">
                    <div class="task-checkbox">
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                      </label>
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"> KeenThemes Investment Discussion </span>
                      <span class="label label-sm label-warning">KeenThemes </span>
                    </div>
                    <div class="task-config">
                      <div class="task-config-btn btn-group dropup">
                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                          <i class="fa fa-cog"></i>
                          <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-check"></i> Complete </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-pencil"></i> Edit </a>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="fa fa-trash-o"></i> Cancel </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
                <!-- END START TASK LIST -->
              </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 41px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 271.153px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
          </div>
          <div class="task-footer">
            <div class="btn-arrow-link pull-right">
              <a href="javascript:;">See All Records</a>
              <i class="icon-arrow-right"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection