<?php
$nip                        = '';
if (!isset($_COOKIE["StrixscarII"])) {
       $account_name               = '';
       $display_account_no         = 'display:flex;';
} else {
       $account_name               = $_COOKIE["StrixscarII"];
       $display_account_no         = 'display:none;';
}
?>
<?php
//login.php
include('application/config_starter.php');

session_start();

date_default_timezone_set('Asia/Bangkok');

$message = '';

if (!empty($_POST)) {

       if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["account_name"])) {
              $message = "3";
              $account_name = $_POST["account_name"];
       } else {
              $query = "
  			SELECT  
			a.*
			FROM users a
                     INNER JOIN env b ON b.account_name ='$_POST[account_name]'
			WHERE a.username = :username";


              $statement = $pdo->prepare($query);
              $statement->execute(
                     array(
                            'username' => $_POST["username"]
                     )
              );
              $count = $statement->rowCount();
              if ($count > 0) {
                     $result = $statement->fetchAll();
                     foreach ($result as $row) {
                            if (password_verify($_POST["password"], $row["password"])) {
                                   $insert_query = "INSERT INTO login_details (
                                                        username, 
                                                               last_activity, 
                                                               ip_address,
                                                               browser,
                                                               devices,
                                                               nama) 
                                                               VALUES (
                                                                             :username, 
                                                                             :last_activity, 
                                                                             :ip_address,
                                                                             :browser,
                                                                             :devices,
                                                                             :nama
                                                                      )
                                                        ";
                                   $statement = $pdo->prepare($insert_query);
                                   $statement->execute(
                                          array(
                                                 'username'                => $row["username"],
                                                 'nama'                      => $row["nama"],
                                                 'ip_address'        => $ip_address,
                                                 'browser'               => $bname,
                                                 'devices'               => $platform . "/" . $bname . "/" . $version,
                                                 'last_activity'        => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))
                                          )
                                   );
                                   $login_id = $pdo->lastInsertId();
                                   if (!empty($login_id)) {
                                          # data nama disimpan di session browser
                                          $_SESSION['username']                         = $row['username'];
                                          $_SESSION['login']                                = $row['login'];

                                          $_SESSION['nama_user']                         = $row['nama'];
                                          $_SESSION['nama']                                = $row['nama'];
                                          $_SESSION['avatar']                                = $row['avatar'];
                                          $_SESSION['position']                         = $row['position'];
                                          $_SESSION['akses']                                  = $row['hak_akses'];
                                          $_SESSION['user_type']                           = $row['user_type'];
                                          $_SESSION['account_name']                           = $_POST["account_name"];


                                          $data                                        = $row['username'];
                                          $times                                       = date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));

                                          $_SESSION["login_id"] = $login_id;

                                          if ($row['login'] < 1) {
                                                 header('location: ../hrstudio.presfst/hrm/hrs{sys=reset-password}/');
                                          } else {

                                                 $cek_update_a = mysqli_fetch_array(mysqli_query($connect, "SELECT last_activity FROM login_details WHERE username = '$data' and last_activity <> '$times' ORDER BY last_activity DESC limit 1"));
                                                 $cek_update_ar = $cek_update_a['last_activity'];

                                                 $cek_update = mysqli_query($connect, "SELECT * FROM hrmupdate WHERE created_date > '$cek_update_ar'");
                                                 $cek_update_b = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmupdate WHERE created_date > '$cek_update_ar'"));

                                                 $cek_update_br = $cek_update_a['last_activity'];
                                                 $cek_update_created = $cek_update_b['created_date'];

                                                 $cek_update_remarks = $cek_update_b['messages'];

                                                 $cookie_name = "StrixscarII";
                                                 $cookie_value = strtolower($_POST["account_name"]);
                                                 setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

                                                 if (mysqli_num_rows($cek_update) > 0) {

                                                        echo "<script type='text/javascript'>
                                                                      window.location.replace('../hrstudio.presfst/hrm/hrm{sys=emp.update}/');             
                                                               </script>";
                                                 } else {

                                                        echo "<script type='text/javascript'>
                                                                      window.location.replace('../hrstudio.presfst/hrm/hrm{sys=dashboard}/');             
                                                               </script>";
                                                 }
                                          }

                                          # FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES 

                                          if ($_POST) {
                                                 $username = $_POST['username'];
                                                 $password = $_POST['password'];
                                          } else {
                                          }


                                          # FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES FOR COOKIES 
                                   }
                            } else {
                                   $message = "1";
                                   $nip                        = $_POST['username'];
                                   $account_name               = $_POST["account_name"];
                                   setcookie('username', '', 0, '/');
                                   setcookie('password', '', 0, '/');
                            }
                     }
              } else {
                     $message = "2";
                     $nip                               =  $_POST['username'];
                     $account_name                      = $_POST["account_name"];
                     setcookie('username', '', 0, '/');
                     setcookie('password', '', 0, '/');

                     echo $query;
              }
       }
}
?>


<?php
if (!empty($_COOKIE['username'])) {
       $usernameCookies = $_COOKIE['username'];
} else {
       $usernameCookies = '';
}


if (!empty($_SESSION['nama_user'])) {
       echo "<script type='text/javascript'>
                     window.location.replace('../hrstudio.presfst/hrm/hrm{sys=dashboard}/');             
              </script>";
}

if (!empty($_COOKIE['password'])) {
       $passwordCookies = $_COOKIE['password'];
} else {
       $passwordCookies = '';
}
?>

































<!DOCTYPE html>
<html class="plt-desktop md hydrated" mode="md" lang="en">

<head>
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <meta charset="utf-8">
       <style data-styles="">
              ion-menu-button,
              ion-menu,
              ion-menu-toggle,
              ion-action-sheet,
              ion-fab-button,
              ion-fab,
              ion-fab-list,
              ion-refresher-content,
              ion-refresher,
              ion-alert,
              ion-back-button,
              ion-loading,
              ion-toast,
              ion-card,
              ion-card-content,
              ion-card-header,
              ion-card-subtitle,
              ion-card-title,
              ion-item-option,
              ion-item-options,
              ion-item-sliding,
              ion-accordion,
              ion-accordion-group,
              ion-breadcrumb,
              ion-breadcrumbs,
              ion-infinite-scroll-content,
              ion-infinite-scroll,
              ion-reorder,
              ion-reorder-group,
              ion-segment-button,
              ion-segment,
              ion-tab-button,
              ion-tab-bar,
              ion-chip,
              ion-modal,
              ion-searchbar,
              ion-route,
              ion-route-redirect,
              ion-router,
              ion-router-link,
              ion-avatar,
              ion-badge,
              ion-thumbnail,
              ion-col,
              ion-grid,
              ion-row,
              ion-nav,
              ion-nav-link,
              ion-slide,
              ion-slides,
              ion-img,
              ion-input,
              ion-progress-bar,
              ion-range,
              ion-split-pane,
              ion-text,
              ion-textarea,
              ion-toggle,
              ion-virtual-scroll,
              ion-picker-column-internal,
              ion-picker-internal,
              ion-checkbox,
              ion-select,
              ion-select-option,
              ion-select-popover,
              ion-backdrop,
              ion-popover,
              ion-app,
              ion-content,
              ion-footer,
              ion-header,
              ion-router-outlet,
              ion-title,
              ion-toolbar,
              ion-buttons,
              ion-item-divider,
              ion-item-group,
              ion-skeleton-text,
              ion-list,
              ion-list-header,
              ion-item,
              ion-label,
              ion-note,
              ion-datetime,
              ion-picker,
              ion-picker-column,
              ion-spinner,
              ion-radio,
              ion-radio-group,
              ion-ripple-effect,
              ion-button,
              ion-icon {
                     visibility: hidden
              }

              .hydrated {
                     visibility: inherit
              }
       </style>
       <style data-styles="">
              pwa-camera-modal,
              pwa-action-sheet,
              pwa-toast,
              pwa-camera,
              pwa-camera-modal-instance {
                     visibility: hidden
              }

              .hydrated {
                     visibility: inherit
              }
       </style>
       <!-- HTML Meta Tags -->
       <style>
              html.plt-mobile ion-app {
                     -webkit-user-select: none;
                     -moz-user-select: none;
                     -ms-user-select: none;
                     user-select: none
              }

              html.plt-mobile ion-app [contenteditable] {
                     -webkit-user-select: text;
                     -moz-user-select: text;
                     -ms-user-select: text;
                     user-select: text
              }

              ion-app.force-statusbar-padding {
                     --ion-safe-area-top: 20px
              }
       </style>
       <style>
              .item.sc-ion-label-md-h,
              .item .sc-ion-label-md-h {
                     --color: initial;
                     display: block;
                     color: var(--color);
                     font-family: var(--ion-font-family, inherit);
                     font-size: inherit;
                     text-overflow: ellipsis;
                     white-space: nowrap;
                     overflow: hidden;
                     -webkit-box-sizing: border-box;
                     box-sizing: border-box
              }

              .ion-color.sc-ion-label-md-h {
                     color: var(--ion-color-base)
              }

              .ion-text-wrap.sc-ion-label-md-h,
              [text-wrap].sc-ion-label-md-h {
                     white-space: normal
              }

              .item-interactive-disabled.sc-ion-label-md-h:not(.item-multiple-inputs),
              .item-interactive-disabled:not(.item-multiple-inputs) .sc-ion-label-md-h {
                     cursor: default;
                     opacity: 0.3;
                     pointer-events: none
              }

              .item-input.sc-ion-label-md-h,
              .item-input .sc-ion-label-md-h {
                     -ms-flex: initial;
                     flex: initial;
                     max-width: 200px;
                     pointer-events: none
              }

              .item-textarea.sc-ion-label-md-h,
              .item-textarea .sc-ion-label-md-h {
                     -ms-flex-item-align: baseline;
                     align-self: baseline
              }

              .label-fixed.sc-ion-label-md-h {
                     -ms-flex: 0 0 100px;
                     flex: 0 0 100px;
                     width: 100px;
                     min-width: 100px;
                     max-width: 200px
              }

              .label-stacked.sc-ion-label-md-h,
              .label-floating.sc-ion-label-md-h {
                     margin-bottom: 0;
                     -ms-flex-item-align: stretch;
                     align-self: stretch;
                     width: auto;
                     max-width: 100%
              }

              .label-no-animate.label-floating.sc-ion-label-md-h {
                     -webkit-transition: none;
                     transition: none
              }

              .sc-ion-label-md-s h1,
              .sc-ion-label-md-s h2,
              .sc-ion-label-md-s h3,
              .sc-ion-label-md-s h4,
              .sc-ion-label-md-s h5,
              .sc-ion-label-md-s h6 {
                     text-overflow: inherit;
                     overflow: inherit
              }

              .ion-text-wrap.sc-ion-label-md-h,
              [text-wrap].sc-ion-label-md-h {
                     line-height: 1.5
              }

              .label-stacked.sc-ion-label-md-h,
              .label-floating.sc-ion-label-md-h {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 0;
                     margin-bottom: 0;
                     -webkit-transform-origin: top left;
                     transform-origin: top left
              }

              .label-stacked.label-rtl.sc-ion-label-md-h,
              .label-floating.label-rtl.sc-ion-label-md-h {
                     -webkit-transform-origin: top right;
                     transform-origin: top right
              }

              .label-stacked.sc-ion-label-md-h {
                     -webkit-transform: translateY(50%) scale(0.75);
                     transform: translateY(50%) scale(0.75);
                     -webkit-transition: color 150ms cubic-bezier(0.4, 0, 0.2, 1);
                     transition: color 150ms cubic-bezier(0.4, 0, 0.2, 1)
              }

              .label-floating.sc-ion-label-md-h {
                     -webkit-transform: translateY(96%);
                     transform: translateY(96%);
                     -webkit-transition: color 150ms cubic-bezier(0.4, 0, 0.2, 1), -webkit-transform 150ms cubic-bezier(0.4, 0, 0.2, 1);
                     transition: color 150ms cubic-bezier(0.4, 0, 0.2, 1), -webkit-transform 150ms cubic-bezier(0.4, 0, 0.2, 1);
                     transition: color 150ms cubic-bezier(0.4, 0, 0.2, 1), transform 150ms cubic-bezier(0.4, 0, 0.2, 1);
                     transition: color 150ms cubic-bezier(0.4, 0, 0.2, 1), transform 150ms cubic-bezier(0.4, 0, 0.2, 1), -webkit-transform 150ms cubic-bezier(0.4, 0, 0.2, 1)
              }

              .ion-focused.label-floating.sc-ion-label-md-h,
              .ion-focused .label-floating.sc-ion-label-md-h,
              .item-has-focus.label-floating.sc-ion-label-md-h,
              .item-has-focus .label-floating.sc-ion-label-md-h,
              .item-has-placeholder.sc-ion-label-md-h:not(.item-input).label-floating,
              .item-has-placeholder:not(.item-input) .label-floating.sc-ion-label-md-h,
              .item-has-value.label-floating.sc-ion-label-md-h,
              .item-has-value .label-floating.sc-ion-label-md-h {
                     -webkit-transform: translateY(50%) scale(0.75);
                     transform: translateY(50%) scale(0.75)
              }

              .item-fill-outline.ion-focused.label-floating.sc-ion-label-md-h,
              .item-fill-outline.ion-focused .label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-focus.label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-focus .label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).label-floating,
              .item-fill-outline.item-has-placeholder:not(.item-input) .label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-value.label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-value .label-floating.sc-ion-label-md-h {
                     -webkit-transform: translateY(-6px) scale(0.75);
                     transform: translateY(-6px) scale(0.75);
                     position: relative;
                     max-width: -webkit-min-content;
                     max-width: -moz-min-content;
                     max-width: min-content;
                     background-color: var(--ion-item-background, var(--ion-background-color, #fff));
                     overflow: visible;
                     z-index: 3
              }

              .item-fill-outline.ion-focused.label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.ion-focused .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.ion-focused.label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.ion-focused .label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-focus.label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-focus .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-focus.label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-focus .label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).label-floating::before,
              .item-fill-outline.item-has-placeholder:not(.item-input) .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).label-floating::after,
              .item-fill-outline.item-has-placeholder:not(.item-input) .label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-value.label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-value .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-value.label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-value .label-floating.sc-ion-label-md-h::after {
                     position: absolute;
                     width: 4px;
                     height: 100%;
                     background-color: var(--ion-item-background, var(--ion-background-color, #fff));
                     content: ""
              }

              .item-fill-outline.ion-focused.label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.ion-focused .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-focus.label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-focus .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).label-floating::before,
              .item-fill-outline.item-has-placeholder:not(.item-input) .label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-value.label-floating.sc-ion-label-md-h::before,
              .item-fill-outline.item-has-value .label-floating.sc-ion-label-md-h::before {
                     left: calc(-1 * 4px)
              }

              .item-fill-outline.ion-focused.label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.ion-focused .label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-focus.label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-focus .label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).label-floating::after,
              .item-fill-outline.item-has-placeholder:not(.item-input) .label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-value.label-floating.sc-ion-label-md-h::after,
              .item-fill-outline.item-has-value .label-floating.sc-ion-label-md-h::after {
                     right: calc(-1 * 4px)
              }

              .item-fill-outline.ion-focused.item-has-start-slot.label-floating.sc-ion-label-md-h,
              .item-fill-outline.ion-focused.item-has-start-slot .label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-focus.item-has-start-slot.label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-focus.item-has-start-slot .label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).item-has-start-slot.label-floating,
              .item-fill-outline.item-has-placeholder:not(.item-input).item-has-start-slot .label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-value.item-has-start-slot.label-floating.sc-ion-label-md-h,
              .item-fill-outline.item-has-value.item-has-start-slot .label-floating.sc-ion-label-md-h {
                     -webkit-transform: translateX(-32px) translateY(-6px) scale(0.75);
                     transform: translateX(-32px) translateY(-6px) scale(0.75)
              }

              .item-fill-outline.ion-focused.item-has-start-slot.label-floating.label-rtl.sc-ion-label-md-h,
              .item-fill-outline.ion-focused.item-has-start-slot .label-floating.label-rtl.sc-ion-label-md-h,
              .item-fill-outline.item-has-focus.item-has-start-slot.label-floating.label-rtl.sc-ion-label-md-h,
              .item-fill-outline.item-has-focus.item-has-start-slot .label-floating.label-rtl.sc-ion-label-md-h,
              .item-fill-outline.item-has-placeholder.sc-ion-label-md-h:not(.item-input).item-has-start-slot.label-floating.label-rtl,
              .item-fill-outline.item-has-placeholder:not(.item-input).item-has-start-slot .label-floating.label-rtl.sc-ion-label-md-h,
              .item-fill-outline.item-has-value.item-has-start-slot.label-floating.label-rtl.sc-ion-label-md-h,
              .item-fill-outline.item-has-value.item-has-start-slot .label-floating.label-rtl.sc-ion-label-md-h {
                     -webkit-transform: translateX(calc(-1 * -32px)) translateY(-6px) scale(0.75);
                     transform: translateX(calc(-1 * -32px)) translateY(-6px) scale(0.75)
              }

              .ion-focused.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .ion-focused .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .ion-focused.label-floating.sc-ion-label-md-h:not(.ion-color),
              .ion-focused .label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus.label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus .label-floating.sc-ion-label-md-h:not(.ion-color) {
                     color: var(--ion-color-primary, #3880ff)
              }

              .ion-focused.ion-color.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .ion-focused.ion-color .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .ion-focused.ion-color.label-floating.sc-ion-label-md-h:not(.ion-color),
              .ion-focused.ion-color .label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus.ion-color.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus.ion-color .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus.ion-color.label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-has-focus.ion-color .label-floating.sc-ion-label-md-h:not(.ion-color) {
                     color: var(--ion-color-contrast)
              }

              .item-fill-solid.ion-focused.ion-color.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.ion-focused.ion-color .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.ion-focused.ion-color.label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.ion-focused.ion-color .label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.ion-focused.ion-color.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.ion-focused.ion-color .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.ion-focused.ion-color.label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.ion-focused.ion-color .label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.item-has-focus.ion-color.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.item-has-focus.ion-color .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.item-has-focus.ion-color.label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-solid.item-has-focus.ion-color .label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.item-has-focus.ion-color.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.item-has-focus.ion-color .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.item-has-focus.ion-color.label-floating.sc-ion-label-md-h:not(.ion-color),
              .item-fill-outline.item-has-focus.ion-color .label-floating.sc-ion-label-md-h:not(.ion-color) {
                     color: var(--ion-color-base)
              }

              .ion-invalid.ion-touched.label-stacked.sc-ion-label-md-h:not(.ion-color),
              .ion-invalid.ion-touched .label-stacked.sc-ion-label-md-h:not(.ion-color),
              .ion-invalid.ion-touched.label-floating.sc-ion-label-md-h:not(.ion-color),
              .ion-invalid.ion-touched .label-floating.sc-ion-label-md-h:not(.ion-color) {
                     color: var(--highlight-color-invalid)
              }

              .sc-ion-label-md-s h1 {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 0;
                     margin-bottom: 2px;
                     font-size: 24px;
                     font-weight: normal
              }

              .sc-ion-label-md-s h2 {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 2px;
                     margin-bottom: 2px;
                     font-size: 16px;
                     font-weight: normal
              }

              .sc-ion-label-md-s h3,
              .sc-ion-label-md-s h4,
              .sc-ion-label-md-s h5,
              .sc-ion-label-md-s h6 {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 2px;
                     margin-bottom: 2px;
                     font-size: 14px;
                     font-weight: normal;
                     line-height: normal
              }

              .sc-ion-label-md-s p {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 0;
                     margin-bottom: 2px;
                     font-size: 14px;
                     line-height: 20px;
                     text-overflow: inherit;
                     overflow: inherit
              }

              .sc-ion-label-md-s>p {
                     color: var(--ion-color-step-600, #666666)
              }

              .sc-ion-label-md-h.in-item-color.sc-ion-label-md-s>p {
                     color: inherit
              }
       </style>
       <style>
              ion-header {
                     display: block;
                     position: relative;
                     -ms-flex-order: -1;
                     order: -1;
                     width: 100%;
                     z-index: 10
              }

              ion-header ion-toolbar:first-of-type {
                     padding-top: var(--ion-safe-area-top, 0)
              }

              .header-md::after {
                     left: 0;
                     bottom: -5px;
                     background-position: left 0 top -2px;
                     position: absolute;
                     width: 100%;
                     height: 5px;
                     background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAHBAMAAADzDtBxAAAAD1BMVEUAAAAAAAAAAAAAAAAAAABPDueNAAAABXRSTlMUCS0gBIh/TXEAAAAaSURBVAjXYxCEAgY4UIICBmMogMsgFLtAAQCNSwXZKOdPxgAAAABJRU5ErkJggg==);
                     background-repeat: repeat-x;
                     content: ""
              }

              [dir=rtl] .header-md::after,
              :host-context([dir=rtl]) .header-md::after {
                     left: unset;
                     right: unset;
                     right: 0
              }

              [dir=rtl] .header-md::after,
              :host-context([dir=rtl]) .header-md::after {
                     background-position: right 0 top -2px
              }

              .header-collapse-condense {
                     display: none
              }

              .header-md.ion-no-border::after {
                     display: none
              }
       </style>
       <style>
              .sc-ion-searchbar-md-h {
                     --placeholder-color: initial;
                     --placeholder-font-style: initial;
                     --placeholder-font-weight: initial;
                     --placeholder-opacity: .5;
                     -moz-osx-font-smoothing: grayscale;
                     -webkit-font-smoothing: antialiased;
                     display: -ms-flexbox;
                     display: flex;
                     position: relative;
                     -ms-flex-align: center;
                     align-items: center;
                     width: 100%;
                     color: var(--color);
                     font-family: var(--ion-font-family, inherit);
                     -webkit-box-sizing: border-box;
                     box-sizing: border-box
              }

              .ion-color.sc-ion-searchbar-md-h {
                     color: var(--ion-color-contrast)
              }

              .ion-color.sc-ion-searchbar-md-h .searchbar-input.sc-ion-searchbar-md {
                     background: var(--ion-color-base)
              }

              .ion-color.sc-ion-searchbar-md-h .searchbar-clear-button.sc-ion-searchbar-md,
              .ion-color.sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md,
              .ion-color.sc-ion-searchbar-md-h .searchbar-search-icon.sc-ion-searchbar-md {
                     color: inherit
              }

              .searchbar-search-icon.sc-ion-searchbar-md {
                     color: var(--icon-color);
                     pointer-events: none
              }

              .searchbar-input-container.sc-ion-searchbar-md {
                     display: block;
                     position: relative;
                     -ms-flex-negative: 1;
                     flex-shrink: 1;
                     width: 100%
              }

              .searchbar-input.sc-ion-searchbar-md {
                     font-family: inherit;
                     font-size: inherit;
                     font-style: inherit;
                     font-weight: inherit;
                     letter-spacing: inherit;
                     text-decoration: inherit;
                     text-indent: inherit;
                     text-overflow: inherit;
                     text-transform: inherit;
                     text-align: inherit;
                     white-space: inherit;
                     color: inherit;
                     border-radius: var(--border-radius);
                     display: block;
                     width: 100%;
                     border: 0;
                     outline: none;
                     background: var(--background);
                     font-family: inherit;
                     -webkit-box-shadow: var(--box-shadow);
                     box-shadow: var(--box-shadow);
                     -webkit-box-sizing: border-box;
                     box-sizing: border-box;
                     -webkit-appearance: none;
                     -moz-appearance: none;
                     appearance: none
              }

              .searchbar-input.sc-ion-searchbar-md::-webkit-input-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .searchbar-input.sc-ion-searchbar-md::-moz-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .searchbar-input.sc-ion-searchbar-md:-ms-input-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .searchbar-input.sc-ion-searchbar-md::-ms-input-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .searchbar-input.sc-ion-searchbar-md::placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .searchbar-input.sc-ion-searchbar-md::-webkit-search-cancel-button,
              .searchbar-input.sc-ion-searchbar-md::-ms-clear {
                     display: none
              }

              .searchbar-cancel-button.sc-ion-searchbar-md {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 0;
                     margin-bottom: 0;
                     display: none;
                     height: 100%;
                     border: 0;
                     outline: none;
                     color: var(--cancel-button-color);
                     cursor: pointer;
                     -webkit-appearance: none;
                     -moz-appearance: none;
                     appearance: none
              }

              .searchbar-cancel-button.sc-ion-searchbar-md>div.sc-ion-searchbar-md {
                     display: -ms-flexbox;
                     display: flex;
                     -ms-flex-align: center;
                     align-items: center;
                     -ms-flex-pack: center;
                     justify-content: center;
                     width: 100%;
                     height: 100%
              }

              .searchbar-clear-button.sc-ion-searchbar-md {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 0;
                     margin-bottom: 0;
                     padding-left: 0;
                     padding-right: 0;
                     padding-top: 0;
                     padding-bottom: 0;
                     display: none;
                     min-height: 0;
                     outline: none;
                     color: var(--clear-button-color);
                     -webkit-appearance: none;
                     -moz-appearance: none;
                     appearance: none
              }

              .searchbar-has-value.searchbar-should-show-clear.sc-ion-searchbar-md-h .searchbar-clear-button.sc-ion-searchbar-md {
                     display: block
              }

              .searchbar-disabled.sc-ion-searchbar-md-h {
                     cursor: default;
                     opacity: 0.4;
                     pointer-events: none
              }

              .sc-ion-searchbar-md-h {
                     --background: var(--ion-background-color, #fff);
                     --border-radius: 2px;
                     --box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
                     --cancel-button-color: var(--ion-color-step-900, #1a1a1a);
                     --clear-button-color: initial;
                     --color: var(--ion-color-step-850, #262626);
                     --icon-color: var(--ion-color-step-600, #666666);
                     padding-left: 8px;
                     padding-right: 8px;
                     padding-top: 8px;
                     padding-bottom: 8px;
                     background: inherit
              }

              @supports ((-webkit-margin-start: 0) or (margin-inline-start: 0)) or (-webkit-margin-start: 0) {
                     .sc-ion-searchbar-md-h {
                            padding-left: unset;
                            padding-right: unset;
                            -webkit-padding-start: 8px;
                            padding-inline-start: 8px;
                            -webkit-padding-end: 8px;
                            padding-inline-end: 8px
                     }
              }

              .searchbar-search-icon.sc-ion-searchbar-md {
                     left: 16px;
                     top: 11px;
                     width: 21px;
                     height: 21px
              }

              [dir=rtl].sc-ion-searchbar-md .searchbar-search-icon.sc-ion-searchbar-md,
              [dir=rtl].sc-ion-searchbar-md-h .searchbar-search-icon.sc-ion-searchbar-md,
              [dir=rtl] .sc-ion-searchbar-md-h .searchbar-search-icon.sc-ion-searchbar-md {
                     left: unset;
                     right: unset;
                     right: 16px
              }

              .searchbar-cancel-button.sc-ion-searchbar-md {
                     left: 5px;
                     top: 0;
                     background-color: transparent;
                     font-size: 1.6em
              }

              [dir=rtl].sc-ion-searchbar-md .searchbar-cancel-button.sc-ion-searchbar-md,
              [dir=rtl].sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md,
              [dir=rtl] .sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md {
                     left: unset;
                     right: unset;
                     right: 5px
              }

              .searchbar-search-icon.sc-ion-searchbar-md,
              .searchbar-cancel-button.sc-ion-searchbar-md {
                     position: absolute
              }

              .searchbar-search-icon.ion-activated.sc-ion-searchbar-md,
              .searchbar-cancel-button.ion-activated.sc-ion-searchbar-md {
                     background-color: transparent
              }

              .searchbar-input.sc-ion-searchbar-md {
                     padding-left: 55px;
                     padding-right: 55px;
                     padding-top: 6px;
                     padding-bottom: 6px;
                     background-position: left 8px center;
                     height: auto;
                     font-size: 16px;
                     font-weight: 400;
                     line-height: 30px
              }

              @supports ((-webkit-margin-start: 0) or (margin-inline-start: 0)) or (-webkit-margin-start: 0) {
                     .searchbar-input.sc-ion-searchbar-md {
                            padding-left: unset;
                            padding-right: unset;
                            -webkit-padding-start: 55px;
                            padding-inline-start: 55px;
                            -webkit-padding-end: 55px;
                            padding-inline-end: 55px
                     }
              }

              [dir=rtl].sc-ion-searchbar-md .searchbar-input.sc-ion-searchbar-md,
              [dir=rtl].sc-ion-searchbar-md-h .searchbar-input.sc-ion-searchbar-md,
              [dir=rtl] .sc-ion-searchbar-md-h .searchbar-input.sc-ion-searchbar-md {
                     background-position: right 8px center
              }

              .searchbar-clear-button.sc-ion-searchbar-md {
                     right: 13px;
                     top: 0;
                     padding-left: 0;
                     padding-right: 0;
                     padding-top: 0;
                     padding-bottom: 0;
                     position: absolute;
                     height: 100%;
                     border: 0;
                     background-color: transparent
              }

              [dir=rtl].sc-ion-searchbar-md .searchbar-clear-button.sc-ion-searchbar-md,
              [dir=rtl].sc-ion-searchbar-md-h .searchbar-clear-button.sc-ion-searchbar-md,
              [dir=rtl] .sc-ion-searchbar-md-h .searchbar-clear-button.sc-ion-searchbar-md {
                     left: unset;
                     right: unset;
                     left: 13px
              }

              .searchbar-clear-button.ion-activated.sc-ion-searchbar-md {
                     background-color: transparent
              }

              .searchbar-clear-icon.sc-ion-searchbar-md {
                     width: 22px;
                     height: 100%
              }

              .searchbar-has-focus.sc-ion-searchbar-md-h .searchbar-search-icon.sc-ion-searchbar-md {
                     display: block
              }

              .searchbar-has-focus.sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md,
              .searchbar-should-show-cancel.sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md {
                     display: block
              }

              .searchbar-has-focus.sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md+.searchbar-search-icon.sc-ion-searchbar-md,
              .searchbar-should-show-cancel.sc-ion-searchbar-md-h .searchbar-cancel-button.sc-ion-searchbar-md+.searchbar-search-icon.sc-ion-searchbar-md {
                     display: none
              }

              ion-toolbar.sc-ion-searchbar-md-h,
              ion-toolbar .sc-ion-searchbar-md-h {
                     padding-left: 7px;
                     padding-right: 7px;
                     padding-top: 3px;
                     padding-bottom: 3px
              }

              @supports ((-webkit-margin-start: 0) or (margin-inline-start: 0)) or (-webkit-margin-start: 0) {

                     ion-toolbar.sc-ion-searchbar-md-h,
                     ion-toolbar .sc-ion-searchbar-md-h {
                            padding-left: unset;
                            padding-right: unset;
                            -webkit-padding-start: 7px;
                            padding-inline-start: 7px;
                            -webkit-padding-end: 7px;
                            padding-inline-end: 7px
                     }
              }
       </style>
       <style>
              .sc-ion-loading-md-h {
                     --min-width: auto;
                     --width: auto;
                     --min-height: auto;
                     --height: auto;
                     -moz-osx-font-smoothing: grayscale;
                     -webkit-font-smoothing: antialiased;
                     left: 0;
                     right: 0;
                     top: 0;
                     bottom: 0;
                     display: -ms-flexbox;
                     display: flex;
                     position: fixed;
                     -ms-flex-align: center;
                     align-items: center;
                     -ms-flex-pack: center;
                     justify-content: center;
                     outline: none;
                     font-family: var(--ion-font-family, inherit);
                     contain: strict;
                     -ms-touch-action: none;
                     touch-action: none;
                     -webkit-user-select: none;
                     -moz-user-select: none;
                     -ms-user-select: none;
                     user-select: none;
                     z-index: 1001
              }

              .overlay-hidden.sc-ion-loading-md-h {
                     display: none
              }

              .loading-wrapper.sc-ion-loading-md {
                     display: -ms-flexbox;
                     display: flex;
                     -ms-flex-align: inherit;
                     align-items: inherit;
                     -ms-flex-pack: inherit;
                     justify-content: inherit;
                     width: var(--width);
                     min-width: var(--min-width);
                     max-width: var(--max-width);
                     height: var(--height);
                     min-height: var(--min-height);
                     max-height: var(--max-height);
                     background: var(--background);
                     opacity: 0;
                     z-index: 10
              }

              .spinner-lines.sc-ion-loading-md,
              .spinner-lines-small.sc-ion-loading-md,
              .spinner-bubbles.sc-ion-loading-md,
              .spinner-circles.sc-ion-loading-md,
              .spinner-crescent.sc-ion-loading-md,
              .spinner-dots.sc-ion-loading-md {
                     color: var(--spinner-color)
              }

              .sc-ion-loading-md-h {
                     --background: var(--ion-color-step-50, #f2f2f2);
                     --max-width: 280px;
                     --max-height: 90%;
                     --spinner-color: var(--ion-color-primary, #3880ff);
                     --backdrop-opacity: var(--ion-backdrop-opacity, 0.32);
                     color: var(--ion-color-step-850, #262626);
                     font-size: 14px
              }

              .loading-wrapper.sc-ion-loading-md {
                     border-radius: 2px;
                     padding-left: 24px;
                     padding-right: 24px;
                     padding-top: 24px;
                     padding-bottom: 24px;
                     -webkit-box-shadow: 0 16px 20px rgba(0, 0, 0, 0.4);
                     box-shadow: 0 16px 20px rgba(0, 0, 0, 0.4)
              }

              @supports ((-webkit-margin-start: 0) or (margin-inline-start: 0)) or (-webkit-margin-start: 0) {
                     .loading-wrapper.sc-ion-loading-md {
                            padding-left: unset;
                            padding-right: unset;
                            -webkit-padding-start: 24px;
                            padding-inline-start: 24px;
                            -webkit-padding-end: 24px;
                            padding-inline-end: 24px
                     }
              }

              .loading-spinner.sc-ion-loading-md+.loading-content.sc-ion-loading-md {
                     margin-left: 16px
              }

              @supports ((-webkit-margin-start: 0) or (margin-inline-start: 0)) or (-webkit-margin-start: 0) {
                     .loading-spinner.sc-ion-loading-md+.loading-content.sc-ion-loading-md {
                            margin-left: unset;
                            -webkit-margin-start: 16px;
                            margin-inline-start: 16px
                     }
              }
       </style>
       <style>
              .sc-ion-input-md-h {
                     --placeholder-color: initial;
                     --placeholder-font-style: initial;
                     --placeholder-font-weight: initial;
                     --placeholder-opacity: .5;
                     --padding-top: 0;
                     --padding-end: 0;
                     --padding-bottom: 0;
                     --padding-start: 0;
                     --background: transparent;
                     --color: initial;
                     display: -ms-flexbox;
                     display: flex;
                     position: relative;
                     -ms-flex: 1;
                     flex: 1;
                     -ms-flex-align: center;
                     align-items: center;
                     width: 100%;
                     padding: 0 !important;
                     background: var(--background);
                     color: var(--color);
                     font-family: var(--ion-font-family, inherit);
                     z-index: 2
              }

              ion-item.sc-ion-input-md-h:not(.item-label),
              ion-item:not(.item-label) .sc-ion-input-md-h {
                     --padding-start: 0
              }

              .ion-color.sc-ion-input-md-h {
                     color: var(--ion-color-base)
              }

              .native-input.sc-ion-input-md {
                     border-radius: var(--border-radius);
                     padding-left: var(--padding-start);
                     padding-right: var(--padding-end);
                     padding-top: var(--padding-top);
                     padding-bottom: var(--padding-bottom);
                     font-family: inherit;
                     font-size: inherit;
                     font-style: inherit;
                     font-weight: inherit;
                     letter-spacing: inherit;
                     text-decoration: inherit;
                     text-indent: inherit;
                     text-overflow: inherit;
                     text-transform: inherit;
                     text-align: inherit;
                     white-space: inherit;
                     color: inherit;
                     display: inline-block;
                     -ms-flex: 1;
                     flex: 1;
                     width: 100%;
                     max-width: 100%;
                     max-height: 100%;
                     border: 0;
                     outline: none;
                     background: transparent;
                     -webkit-box-sizing: border-box;
                     box-sizing: border-box;
                     -webkit-appearance: none;
                     -moz-appearance: none;
                     appearance: none
              }

              @supports ((-webkit-margin-start: 0) or (margin-inline-start: 0)) or (-webkit-margin-start: 0) {
                     .native-input.sc-ion-input-md {
                            padding-left: unset;
                            padding-right: unset;
                            -webkit-padding-start: var(--padding-start);
                            padding-inline-start: var(--padding-start);
                            -webkit-padding-end: var(--padding-end);
                            padding-inline-end: var(--padding-end)
                     }
              }

              .native-input.sc-ion-input-md::-webkit-input-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .native-input.sc-ion-input-md::-moz-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .native-input.sc-ion-input-md:-ms-input-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .native-input.sc-ion-input-md::-ms-input-placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .native-input.sc-ion-input-md::placeholder {
                     color: var(--placeholder-color);
                     font-family: inherit;
                     font-style: var(--placeholder-font-style);
                     font-weight: var(--placeholder-font-weight);
                     opacity: var(--placeholder-opacity)
              }

              .native-input.sc-ion-input-md:-webkit-autofill {
                     background-color: transparent
              }

              .native-input.sc-ion-input-md:invalid {
                     -webkit-box-shadow: none;
                     box-shadow: none
              }

              .native-input.sc-ion-input-md::-ms-clear {
                     display: none
              }

              .native-input[disabled].sc-ion-input-md {
                     opacity: 0.4
              }

              .cloned-input.sc-ion-input-md {
                     left: 0;
                     top: 0;
                     position: absolute;
                     pointer-events: none
              }

              [dir=rtl].sc-ion-input-md .cloned-input.sc-ion-input-md,
              [dir=rtl].sc-ion-input-md-h .cloned-input.sc-ion-input-md,
              [dir=rtl] .sc-ion-input-md-h .cloned-input.sc-ion-input-md {
                     left: unset;
                     right: unset;
                     right: 0
              }

              .input-clear-icon.sc-ion-input-md {
                     margin-left: 0;
                     margin-right: 0;
                     margin-top: 0;
                     margin-bottom: 0;
                     padding-left: 0;
                     padding-right: 0;
                     padding-top: 0;
                     padding-bottom: 0;
                     background-position: center;
                     border: 0;
                     outline: none;
                     background-color: transparent;
                     background-repeat: no-repeat;
                     visibility: hidden;
                     -webkit-appearance: none;
                     -moz-appearance: none;
                     appearance: none
              }

              .input-clear-icon.sc-ion-input-md:focus {
                     opacity: 0.5
              }

              .has-value.sc-ion-input-md-h .input-clear-icon.sc-ion-input-md {
                     visibility: visible
              }

              .has-focus.sc-ion-input-md-h {
                     pointer-events: none
              }

              .has-focus.sc-ion-input-md-h input.sc-ion-input-md,
              .has-focus.sc-ion-input-md-h a.sc-ion-input-md,
              .has-focus.sc-ion-input-md-h button.sc-ion-input-md {
                     pointer-events: auto
              }

              .item-label-floating.item-has-placeholder.sc-ion-input-md-h:not(.item-has-value),
              .item-label-floating.item-has-placeholder:not(.item-has-value) .sc-ion-input-md-h {
                     opacity: 0
              }

              .item-label-floating.item-has-placeholder.sc-ion-input-md-h:not(.item-has-value).item-has-focus,
              .item-label-floating.item-has-placeholder:not(.item-has-value).item-has-focus .sc-ion-input-md-h {
                     -webkit-transition: opacity 0.15s cubic-bezier(0.4, 0, 0.2, 1);
                     transition: opacity 0.15s cubic-bezier(0.4, 0, 0.2, 1);
                     opacity: 1
              }

              .sc-ion-input-md-h {
                     --padding-top: 10px;
                     --padding-end: 0;
                     --padding-bottom: 10px;
                     --padding-start: 8px;
                     font-size: inherit
              }

              .item-label-stacked.sc-ion-input-md-h,
              .item-label-stacked .sc-ion-input-md-h,
              .item-label-floating.sc-ion-input-md-h,
              .item-label-floating .sc-ion-input-md-h {
                     --padding-top: 8px;
                     --padding-bottom: 8px;
                     --padding-start: 0
              }

              .input-clear-icon.sc-ion-input-md {
                     background-image: url("data:image/svg+xml;charset=utf-8,<svg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20512%20512'><polygon%20fill='var(--ion-color-step-600,%20%23666666)'%20points='405,136.798%20375.202,107%20256,226.202%20136.798,107%20107,136.798%20226.202,256%20107,375.202%20136.798,405%20256,285.798%20375.202,405%20405,375.202%20285.798,256'/></svg>");
                     width: 30px;
                     height: 30px;
                     background-size: 22px
              }
       </style>
      

       <!-- add to homescreen for ios -->
       <meta name="apple-mobile-web-app-capable" content="yes">
       <meta name="apple-mobile-web-app-status-bar-style" content="black">

       <script type="text/javascript" async="" src="asset/gdp/destination"></script>
       <script type="text/javascript" async="" src="asset/gdp/js"></script>
       <script src="asset/gdp/js_003"></script>

       <style>
              .app-loading {
                     position: absolute;
                     top: 50%;
                     left: 50%;
                     transform: translate(-50%, -50%);
              }

              body {
                     /* font-family: "Roboto", "Helvetica Neue", sans-serif; */
                     font-size: 14px;
                     background: white !important;
              }
       </style>

       <meta name="theme-color" content="#1976d2">
       <style>
 

              html {
                     --ion-font-family: var(--ion-default-font)
              }

              body {
                     background: var(--ion-background-color)
              }

              @supports (padding-top: 20px) {
                     html {
                            --ion-safe-area-top: var(--ion-statusbar-padding)
                     }
              }

              @supports (padding-top: constant(safe-area-inset-top)) {
                     html {
                            --ion-safe-area-top: constant(safe-area-inset-top);
                            --ion-safe-area-bottom: constant(safe-area-inset-bottom);
                            --ion-safe-area-left: constant(safe-area-inset-left);
                            --ion-safe-area-right: constant(safe-area-inset-right)
                     }
              }

              @supports (padding-top: env(safe-area-inset-top)) {
                     html {
                            --ion-safe-area-top: env(safe-area-inset-top);
                            --ion-safe-area-bottom: env(safe-area-inset-bottom);
                            --ion-safe-area-left: env(safe-area-inset-left);
                            --ion-safe-area-right: env(safe-area-inset-right)
                     }
              }

              * {
                     box-sizing: border-box;
                     -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                     -webkit-tap-highlight-color: transparent;
                     -webkit-touch-callout: none
              }

              html {
                     width: 100%;
                     height: 100%;
                     text-size-adjust: 100%
              }

              html:not(.hydrated) body {
                     display: none
              }

              body {
                     -moz-osx-font-smoothing: grayscale;
                     -webkit-font-smoothing: antialiased;
                     margin: 0;
                     padding: 0;
                     position: fixed;
                     width: 100%;
                     max-width: 100%;
                     height: 100%;
                     max-height: 100%;
                     text-rendering: optimizeLegibility;
                     overflow: hidden;
                     touch-action: manipulation;
                     -webkit-user-drag: none;
                     -ms-content-zooming: none;
                     word-wrap: break-word;
                     overscroll-behavior-y: none;
                     text-size-adjust: none
              }

              html {
                     font-family: var(--ion-font-family)
              }

              * {
                     transition: background-color .4s, background .4s, box-shadow .4s, color .4s, border-top .4s, border-bottom .4s, border-right .4s, border-left .4s, --background .4s
              }

              html:not(.hydrated) body {
                     display: block !important
              }

              /* * {
                     font-family: Nunito-Regular
              } */

              :root {
                     --ion-color-primary: #f68a22;
                     --ion-color-primary-secondary: #f9af58;
                     --ion-color-primary-tertiary: #ffe6c1;
                     --ion-color-primary-rgb: 246, 138, 34;
                     --ion-color-primary-hsl: 32deg 93% 66%;
                     --ion-color-primary-hs: 32deg 93%;
                     --ion-color-primary-contrast: var(--ion-color-light);
                     --ion-color-primary-contrast-rgb: 255, 255, 255;
                     --ion-color-primary-shade: #db9a4d;
                     --ion-color-primary-tint: #fab769;
                     --ion-color-secondary: #3dc2ff;
                     --ion-color-secondary-rgb: 61, 194, 255;
                     --ion-color-secondary-contrast: var(--ion-color-light);
                     --ion-color-secondary-contrast-rgb: 255, 255, 255;
                     --ion-color-secondary-shade: #36abe0;
                     --ion-color-secondary-tint: #50c8ff;
                     --ion-color-tertiary: #1a73e8;
                     --ion-color-tertiary-rgb: 26, 115, 232;
                     --ion-color-tertiary-contrast: var(--ion-color-light);
                     --ion-color-tertiary-contrast-rgb: 255, 255, 255;
                     --ion-color-tertiary-shade: #4854e0;
                     --ion-color-tertiary-tint: #6370ff;
                     --ion-color-success: #2bb34d;
                     --ion-color-success-secondary: #5ad16c;
                     --ion-color-success-tertiary: #7ee884;
                     --ion-color-success-rgb: 43, 179, 77;
                     --ion-color-success-contrast: var(--ion-color-light);
                     --ion-color-success-contrast-rgb: 255, 255, 255;
                     --ion-color-success-shade: #4fb85f;
                     --ion-color-success-tint: #6bd67b;
                     --ion-color-warning: #ffab00;
                     --ion-color-warning-secondary: #ffc63f;
                     --ion-color-warning-tertiary: #fff0c8;
                     --ion-color-warning-rgb: 255, 171, 0;
                     --ion-color-warning-contrast: var(--ion-color-light);
                     --ion-color-warning-contrast-rgb: 255, 255, 255;
                     --ion-color-warning-shade: #e0ae37;
                     --ion-color-warning-tint: #ffcc52;
                     --ion-color-danger: #f0624d;
                     --ion-color-danger-secondary: #f69278;
                     --ion-color-danger-tertiary: #ffded0;
                     --ion-color-danger-rgb: 240, 98, 77;
                     --ion-color-danger-contrast: var(--ion-color-light);
                     --ion-color-danger-contrast-rgb: 255, 255, 255;
                     --ion-color-danger-shade: #d8806a;
                     --ion-color-danger-tint: #f79d86;
                     --ion-color-dark: #363636;
                     --ion-color-dark-rgb: 54, 54, 54;
                     --ion-color-dark-contrast: #ffffff;
                     --ion-color-dark-contrast-rgb: 255, 255, 255;
                     --ion-color-dark-shade: #1e2023;
                     --ion-color-dark-tint: #383a3e;
                     --ion-color-medium: #898989;
                     --ion-color-medium-rgb: 137, 137, 137;
                     --ion-color-medium-contrast: #ffffff;
                     --ion-color-medium-contrast-rgb: 255, 255, 255;
                     --ion-color-medium-shade: #808289;
                     --ion-color-medium-tint: #9d9fa6;
                     --ion-color-light: #f8f8f8;
                     --ion-color-light-rgb: 248, 248, 248;
                     --ion-color-light-secondary: #e9ebee;
                     --ion-color-light-tertiary: #f0f2f4;
                     --ion-color-light-contrast: #000000;
                     --ion-color-light-contrast-rgb: 0, 0, 0;
                     --ion-color-light-shade: #d7d8da;
                     --ion-color-light-tint: #f5f6f9;
                     --ion-color-light-mode: #d7dae0;
                     --gdx-color-skeleton: #dddddd;
                     --gdx-color-skeleton-glow: #e5e9eb;
                     --gdx-color-outline: #dbdbe1;
                     --gdx-color-bginput: #f6f8f9;
                     --gdx-color-bgaccent: #192528;
                     --gdx-color-bgcard: #ffffff;
                     --gdx-color-bgcard2: #f0f2f4;
                     --gdx-color-bgfloor: #f6f8f9;
                     --gdx-color-bgfloor-rgb: 246, 248, 249;
                     --gdx-color-bghover: #efefef;
                     --gdx-color-bghover-rgb: 239, 239, 239;
                     --gdx-color-bgdot: #d7dae0;
                     --ion-text-color: #121212;
                     --ion-color-text-header: #363636;
                     --ion-color-text-subheader: #808080;
                     --ion-color-text-placeholder: #dbdbdb;
                     --ion-color-text-disable: #f0f2f4;
                     --ion-color-text-notes: #a5b0b7;
                     --gdx-border-radius: 8px;
                     --gdx-border-radius-card: 16px;
                     --gdx-content-padding-top: 90px;
                     --gdx-box-shadow: rgb(0 0 0 / 12%) 0px 4px 16px;
                     --gdx-box-shadow-2: 0px 1px 3px rgba(0, 0, 0, .12);
                     --gdx-color-row-change: #ffe6c1;
                     --gdx-color-white: #fff;
                     --gdx-color-bgfloor2-rgb: 240, 242, 244
              }

              @media only screen and (min-width: 1280px) {
                     :root {
                            --gdx-border-radius-card: 16px !important
                     }
              }

              @font-face {
                     font-family: Nunito-Regular;
                     src: url(Nunito-Regular.356cf14003d102b3.ttf)
              }
       </style>
       <link rel="stylesheet" href="asset/gdp/styles.5ae9f16b2a304583.css" media="all" onload="this.media='all'">
       <noscript>
              <link rel="stylesheet" href="styles.5ae9f16b2a304583.css">
       </noscript>
       <style>
              ion-app[_ngcontent-aax-c248] {
                     background: var(--gdx-color-bgfloor)
              }

              .app-page[_ngcontent-aax-c248] {
                     position: relative
              }

              @media only screen and (min-width: 360px) and (max-width: 768px) {
                     .wrapper[_ngcontent-aax-c248] {
                            min-height: 100vh
                     }
              }

              .toast-frame[_ngcontent-aax-c248] {
                     position: fixed;
                     bottom: 24px;
                     left: 16px;
                     width: calc(100% - 32px);
                     z-index: 999
              }

              @media only screen and (min-width: 768px) {
                     .toast-frame[_ngcontent-aax-c248] {
                            bottom: 24px;
                            left: 30px;
                            width: calc(100% - 32px);
                            max-width: 337px;
                            z-index: 999
                     }
              }

              .toast-attendance[_ngcontent-aax-c248] {
                     height: 50px;
                     z-index: 999999;
                     background: black;
                     width: 95%;
                     max-width: 500px;
                     position: absolute;
                     bottom: 20px;
                     left: 10px;
                     right: 10px;
                     padding: 16px;
                     border-radius: 10px;
                     box-shadow: 0 5px 5px #5c5b5b;
                     color: #fff !important;
                     margin: 0 auto
              }

              app-menu-header[_ngcontent-aax-c248],
              app-menu-side[_ngcontent-aax-c248]+ion-router-outlet[_ngcontent-aax-c248] {
                     top: 80px
              }

              .active-sidebar[_ngcontent-aax-c248]+ion-router-outlet[_ngcontent-aax-c248] {
                     width: calc(100vw - 210px);
                     height: calc(100vh - 80px);
                     left: 210px
              }

              .minimize-sidebar[_ngcontent-aax-c248] {
                     width: 50px
              }

              .minimize-sidebar[_ngcontent-aax-c248]+ion-router-outlet[_ngcontent-aax-c248] {
                     width: calc(100vw - 50px);
                     height: calc(100vh - 80px);
                     left: 50px
              }

              app-menu-side[_ngcontent-aax-c248] {
                     margin-top: 80px
              }

              @media screen and (max-width: 768px) {
                     ion-router-outlet[_ngcontent-aax-c248] {
                            width: 100% !important;
                            left: 0 !important;
                            top: 0 !important;
                            height: 100% !important
                     }

                     app-menu-side[_ngcontent-aax-c248] {
                            margin-top: 0 !important;
                            width: 100% !important
                     }
              }

              @media screen and (min-width: 768px) {
                     app-menu-header.show-breadcrumb[_ngcontent-aax-c248]+app-menu-side[_ngcontent-aax-c248]+ion-router-outlet[_ngcontent-aax-c248] {
                            top: 130px;
                            height: calc(100vh - 130px)
                     }
              }

              app-menu-header[_ngcontent-aax-c248] {
                     z-index: 3
              }

              app-menu-side[_ngcontent-aax-c248] {
                     z-index: -1;
                     width: 210px
              }

              app-menu-side.active-sidebar[_ngcontent-aax-c248] {
                     z-index: 2
              }

              ion-router-outlet[_ngcontent-aax-c248] {
                     z-index: 1
              }

              .hideElement[_ngcontent-aax-c248] {
                     display: none
              }

              .intercom-button-launcher[_ngcontent-aax-c248] {
                     font-size: 25px;
                     width: 60px;
                     height: 60px;
                     background: red;
                     border-radius: 50%;
                     text-align: center;
                     line-height: 65px;
                     position: absolute;
                     bottom: 20px;
                     right: 60px;
                     color: #fff;
                     box-shadow: 0 5px 5px gray;
                     z-index: 999999999
              }

              .intercom-button-launcher[_ngcontent-aax-c248]:hover {
                     cursor: pointer;
                     opacity: .75
              }
       </style>
       <style type="text/css">
              /*
  @angular/flex-layout - workaround for possible browser quirk with mediaQuery listeners
  see http://bit.ly/2sd4HMP
*/
              @media screen and (min-width: 600px),
              screen and (min-width: 960px),
              screen and (min-width: 1280px),
              screen and (min-width: 1920px),
              screen and (min-width: 1920px) and (max-width: 4999.98px),
              screen and (max-width: 1919.98px),
              screen and (min-width: 1280px) and (max-width: 1919.98px),
              screen and (max-width: 1279.98px),
              screen and (min-width: 960px) and (max-width: 1279.98px),
              screen and (max-width: 959.98px),
              screen and (min-width: 600px) and (max-width: 959.98px),
              screen and (max-width: 599.98px),
              screen and (min-width: 0px) and (max-width: 599.98px),
              print {}
       </style>
       <script type="text/javascript" src="asset/gdp/firebase-app.js" id="firebase-app"></script>
       <script type="text/javascript" src="asset/gdp/firebase-analytics.js" id="firebase-ac"></script>
       <style>
              app-home-web[_ngcontent-aax-c361] {
                     height: 100%
              }

              app-home-mobile[_ngcontent-aax-c361] {
                     height: 100%
              }

              ion-content[_ngcontent-aax-c361]::part(scroll) {
                     overflow: hidden
              }

              .tab-box[_ngcontent-aax-c361] .tab-section[_ngcontent-aax-c361] {
                     padding: 12px 0
              }
       </style>
       <style>
              .home-new {
                     height: 100%
              }

              .home-new ion-content.home-section {
                     background: var(--gdx-color-bgfloor);
                     transition: background-color .4s
              }

              .home-new ion-content.home-section .my-onboarding-wrapper {
                     background-color: var(--gdx-color-bgcard2);
                     pointer-events: auto
              }

              .home-new ion-content.home-section .my-onboarding-wrapper h2 {
                     font-size: 16px
              }

              .home-new ion-content.home-section .my-onboarding-wrapper .my-onboarding-box {
                     box-shadow: 0 1px 5px #dbdbdb;
                     padding: 10px 15px;
                     background: white;
                     border-radius: 10px
              }

              .home-new ion-content.home-section .my-onboarding-wrapper .my-onboarding-head {
                     padding-top: 20px
              }

              .home-new ion-content.home-section .my-onboarding-wrapper .my-onboarding-head h2 {
                     margin-bottom: 15px
              }

              .home-new ion-content.home-section .my-onboarding-wrapper .my-onboarding-body .bar-progress {
                     padding: 15px 0 8px
              }

              .home-new ion-content.home-section .my-onboarding-wrapper .my-onboarding-body .box-percent {
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section app-dash-frame {
                     height: 100%
              }

              .home-new ion-content.home-section app-home-feed {
                     grid-area: post
              }

              .home-new ion-content.home-section .home-body {
                     height: 100%;
                     background: none
              }

              .home-new ion-content.home-section .toggle-box {
                     margin: 0 0 16px 16px
              }

              .home-new ion-content.home-section .spinner {
                     width: 100% !important;
                     text-align: center !important;
                     z-index: 9999999999
              }

              .home-new ion-content.home-section .home-content.toggle-dashboard {
                     grid-template-areas: "attendance post toggle-box""attendance post task""attendance post task""attendance post ."
              }

              .home-new ion-content.home-section .home-content {
                     min-height: 100%;
                     max-width: 1420px;
                     display: grid;
                     grid-template-columns: 375px minmax(0, 1fr) 375px;
                     grid-template-rows: auto auto 1fr;
                     grid-template-areas: "attendance post task""attendance post task""attendance post task""attendance post .";
                     position: relative;
                     pointer-events: none
              }

              @media screen and (min-width: 1024px) {
                     .home-new ion-content.home-section .home-content .add-post-wrapper {
                            margin-top: unset !important;
                            max-height: unset !important
                     }
              }

              .home-new ion-content.home-section .home-content .toggle-box {
                     background-color: var(--gdx-color-bgcard2);
                     border-right: 1px solid var(--gdx-color-bgcard2)
              }

              .home-new ion-content.home-section .home-content .toggle-banner {
                     grid-area: toggle-box;
                     padding: 0 16px
              }

              .home-new ion-content.home-section .home-content .toggle-banner .wrapper-icon {
                     width: 24px;
                     height: 24px;
                     border-radius: 200px;
                     background-color: rgba(var(--ion-color-medium-rgb), .1)
              }

              .home-new ion-content.home-section .home-content .toggle-banner .bg {
                     border: 1px solid var(--gdx-color-outline);
                     padding: 12px;
                     border-radius: var(--gdx-border-radius);
                     width: 100%;
                     min-height: 85px;
                     background: var(--gdx-color-floor)
              }

              .home-new ion-content.home-section .home-content .toggle-banner .bg .badge-new {
                     background: rgba(var(--ion-color-primary-rgb), .2);
                     border: 1px solid var(--ion-color-primary);
                     border-radius: 100px;
                     padding: 4px 10px;
                     font-size: 10px;
                     color: var(--ion-color-primary);
                     font-weight: 700
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper {
                     width: unset;
                     height: unset;
                     border-radius: 0 0 20px 20px;
                     grid-area: add-post;
                     background: transparent;
                     min-height: auto;
                     padding: 18px;
                     pointer-events: auto;
                     transition: height .25s;
                     overflow: hidden;
                     z-index: 2
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper .add-post-box {
                     background: var(--ion-color-light);
                     border-radius: 16px;
                     padding: 5px 10px;
                     will-change: transform;
                     position: relative;
                     z-index: 1
              }

              .home-new ion-content.home-section .home-content .add-post-md {
                     box-shadow: none;
                     border-left: 1px solid var(--ion-color-light-shade);
                     border-right: 1px solid var(--ion-color-light-shade);
                     border-radius: 0;
                     background: grey;
                     height: auto !important;
                     min-height: 98px
              }

              .home-new ion-content.home-section .home-content .add-post-md .add-post-box {
                     border: 1px solid var(--gdx-color-outline);
                     box-shadow: 0 0 23px -12px #0003;
                     margin-top: 23px
              }

              .home-new ion-content.home-section .home-content .col-head {
                     margin-bottom: 17px
              }

              .home-new ion-content.home-section .home-content .col-head h5 {
                     font-weight: 600;
                     color: var(--ion-color-dark)
              }

              .home-new ion-content.home-section .home-content .col-head .viewmore {
                     color: var(--ion-color-medium)
              }

              .home-new ion-content.home-section .home-content .card-info-wrapper {
                     padding: 8px 18px;
                     background-color: var(--gdx-color-bgcard2)
              }

              .home-new ion-content.home-section .home-content .card-info-wrapper .card-info {
                     grid-area: card-info;
                     background-color: rgba(var(--ion-color-tertiary-rgb), .2);
                     border-radius: var(--gdx-border-radius)
              }

              .home-new ion-content.home-section .home-content .card-info-wrapper .card-info ion-label,
              .home-new ion-content.home-section .home-content .card-info-wrapper .card-info p {
                     color: var(--ion-color-tertiary) !important
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper {
                     grid-area: attendance;
                     padding: 20px 18px 20px 20px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body {
                     border-bottom: 1px solid var(--ion-color-light-shade);
                     margin-bottom: 30px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user {
                     padding: 15px 0
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .col-body-user-photo {
                     margin-right: 10px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .col-body-user-info {
                     width: 100%;
                     overflow: hidden
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .col-body-user-info [name] {
                     margin-bottom: 5px;
                     color: var(--ion-color-dark)
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo {
                     width: 100%
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo .skeleton-box {
                     width: 100%;
                     margin-bottom: 12px;
                     justify-content: center;
                     align-items: center
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo .skeleton-box app-avatar {
                     margin-right: 12px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo .skeleton-box .info-box {
                     margin-right: 16px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo .skeleton-box .info-box .skeleton-line1 {
                     width: 100%;
                     height: 10px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo .skeleton-box .info-box .skeleton-line2 {
                     width: 50%;
                     height: 10px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-user .skeleton-userinfo .skeleton-box .button .skeleton-button {
                     width: 110px;
                     height: 40px;
                     border-radius: 10px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance {
                     border-radius: var(--gdx-border-radius);
                     border: 1px solid var(--ion-color-light-shade);
                     margin: 30px 0;
                     padding: 15px
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .start-time {
                     text-align: center
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .start-time h4 {
                     color: var(--ion-color-success);
                     font-weight: 700
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .devider {
                     border-right: 1px solid var(--ion-color-light-shade);
                     height: 50px;
                     align-self: center
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .end-time {
                     text-align: center
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .end-time h4 {
                     color: var(--ion-color-danger);
                     font-weight: 700
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .skeleton-userinfo {
                     width: 100%
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .skeleton-userinfo .skeleton-box {
                     width: 100%;
                     margin-top: 10px;
                     margin-bottom: 12px;
                     justify-content: center;
                     align-items: center
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .skeleton-userinfo .skeleton-box .info-box {
                     margin: 0 auto !important
              }

              .home-new ion-content.home-section .home-content .left-sidebar-wrapper .left-sidebar .attendance-wrapper .col-body .col-body-atendance .skeleton-userinfo .skeleton-box .info-box .skeleton-line1 {
                     height: 10px;
                     width: 100%;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .right-sidebar {
                     grid-area: task;
                     padding: 20px 0
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item {
                     position: relative;
                     z-index: 1
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .toggle-area {
                     border-radius: 200px;
                     width: 36px;
                     height: 36px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     transition: all .2s;
                     position: relative;
                     cursor: pointer
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .toggle-area .checkmark-box {
                     width: 16px;
                     height: 16px;
                     border-radius: 4px;
                     font-size: 15px;
                     display: flex;
                     border: 1.5px solid rgba(var(--ion-color-medium-rgb), .7);
                     color: var(--ion-color-medium-contrast)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .toggle-area .checkmark-box ion-icon {
                     position: relative;
                     top: -1px;
                     opacity: 0
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .toggle-area .checkmark-box.complete {
                     background: var(--ion-color-success);
                     border-color: var(--ion-color-success)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .toggle-area .checkmark-box.complete ion-icon {
                     opacity: 1
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .toggle-area:hover {
                     background: var(--ion-color-light-shade)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box {
                     position: absolute;
                     top: -45px;
                     right: unset;
                     bottom: unset;
                     left: -7px;
                     background-color: transparent;
                     cursor: auto
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .kuncup {
                     position: absolute;
                     top: unset;
                     right: unset;
                     bottom: -4px;
                     left: 21px;
                     width: 8px;
                     height: 8px;
                     border-radius: 0;
                     border: 1px solid var(--gdx-color-outline);
                     transform: rotate(45deg);
                     border-top: none;
                     border-left: none;
                     background-color: var(--gdx-color-bgcard)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section {
                     width: unset;
                     height: 34px;
                     border-radius: var(--gdx-border-radius);
                     border: 1px solid var(--gdx-color-outline);
                     padding: 0 11px;
                     background-color: var(--gdx-color-bgcard);
                     margin-right: 3px;
                     align-items: center
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section ion-label:after {
                     content: "|";
                     color: #222 !important;
                     margin: 0 5px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section ion-label:last-child:after {
                     content: "";
                     margin: 0
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section .respond {
                     color: var(--ion-color-dark) !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section .complete {
                     color: #8cc63f !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section .closed {
                     color: #63befb !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .option-section .canceled {
                     color: #fbac5e !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .close-box {
                     background-color: rgba(var(--ion-color-dark-rgb), .42);
                     width: 34px;
                     height: 34px;
                     border-radius: 7px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .option-box .close-box ion-icon {
                     font-size: 24px;
                     color: var(--ion-color-light)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .gd-avatar {
                     display: flex
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .captions {
                     flex: 1 1 auto;
                     width: 100px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .captions p:first-child,
              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .captions p:last-child {
                     color: var(--ion-color-medium)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .captions p {
                     margin: 1px 0;
                     color: var(--ion-color-dark)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .captions span {
                     color: var(--ion-color-medium)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time span {
                     color: var(--ion-color-medium)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time>p {
                     color: var(--ion-color-dark)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time .badge {
                     border-radius: 12px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time .badge p {
                     text-transform: capitalize;
                     padding: 0 7px;
                     font-weight: unset;
                     width: unset;
                     height: 20px;
                     display: flex;
                     justify-content: flex-start;
                     align-items: center
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time .new-badge {
                     background-color: #63befb4d;
                     border: 1px solid #63befb;
                     color: #63befb
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time .reopen-badge {
                     background-color: #fbac5e4d;
                     border: 1px solid #fbac5e;
                     color: #fbac5e
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .time .fixed-badge {
                     background-color: #8cc63f4d;
                     border: 1px solid #8cc63f;
                     color: #8cc63f
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item .task-hover {
                     width: calc(100% + 38px);
                     height: calc(100% + 15px);
                     position: absolute;
                     left: -18px;
                     top: -8px;
                     z-index: -2;
                     transition: all .2s
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-body .task-item:hover>.task-hover {
                     background: var(--ion-color-light-tint)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .empty-state {
                     margin-top: 10px;
                     text-align: center
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .empty-state img {
                     opacity: .75
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .empty-state .heading ion-label {
                     font-weight: 700;
                     color: var(--ion-color-dark)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .empty-state .sub-heading {
                     color: var(--ion-color-dark)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .empty-state .sub-heading .label-link {
                     color: #63befb;
                     cursor: pointer;
                     margin-right: 2px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .empty-state .sub-heading ion-label {
                     white-space: initial
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box {
                     width: 100%;
                     margin-bottom: 12px;
                     justify-content: center;
                     align-items: center
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box app-avatar {
                     margin-right: 12px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .skeleton-radio {
                     width: 16px;
                     height: 16px;
                     margin: 10px;
                     border-radius: 4px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .detail-box {
                     margin-right: 16px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .detail-box .skeleton-line1 {
                     height: 11px;
                     width: 50px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .detail-box .skeleton-line2 {
                     height: 13px;
                     width: 120px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .detail-box .skeleton-line3 {
                     width: 80px;
                     height: 9px;
                     border-radius: 4px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .badge-box .skeleton-time {
                     width: 32px;
                     height: 12px;
                     border-radius: 4px;
                     margin-bottom: 7px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .skeleton-task .skeleton-box .badge-box .skeleton-badge {
                     width: 36px;
                     height: 14px;
                     border-radius: 12px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body {
                     margin-top: 25px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .info {
                     position: relative;
                     z-index: 1
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .info .picture img {
                     width: 55px;
                     height: 55px;
                     border-radius: 5px;
                     object-fit: cover
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .info .new {
                     margin-right: 0 !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .info .info-hover {
                     width: calc(100% + 38px);
                     height: 100%;
                     border-radius: 0;
                     position: absolute;
                     left: -18px;
                     top: 0;
                     z-index: -2;
                     transition: all .2s
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .caption-company {
                     margin-top: -2px;
                     overflow: hidden
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .caption-company .title {
                     color: var(--ion-color-dark) !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .caption-company .desc {
                     color: var(--ion-color-medium) !important;
                     margin-top: 2px;
                     margin-bottom: 2px;
                     display: -webkit-box;
                     -webkit-line-clamp: 2;
                     -webkit-box-orient: vertical;
                     overflow: hidden;
                     text-overflow: ellipsis;
                     white-space: initial
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .caption-company .desc * {
                     margin: 0
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .caption-company .date {
                     color: var(--ion-color-medium) !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .company-body .new .my-icon {
                     border-radius: 12px;
                     border: 1px solid #fb745e;
                     background: rgba(251, 116, 94, .3);
                     color: #fb745e;
                     font-size: 10px;
                     text-align: center;
                     text-transform: uppercase;
                     padding: 3px 10px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .skeleton-company .skeleton-box {
                     margin-bottom: 24px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .skeleton-company .skeleton-box .detail-box .skeleton-line1 {
                     width: 100px;
                     height: 11px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .skeleton-company .skeleton-box .detail-box .skeleton-line2 {
                     width: 150px;
                     height: 13px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .skeleton-company .skeleton-box .detail-box .skeleton-line3 {
                     width: 70px;
                     height: 9px;
                     border-radius: 4px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .company-wrapper .skeleton-company .skeleton-box .badge-box .skeleton-badge {
                     width: 36px;
                     height: 14px;
                     border-radius: 12px
              }

              .home-new ion-content.home-section .home-content .feed-wrapper {
                     grid-area: post
              }

              .home-new ion-content.home-section .home-content .content-section {
                     background: var(--gdx-color-bgcard);
                     border-radius: 20px 20px 0 0;
                     padding: 10px 15px;
                     box-shadow: 0 -8px 10px -7px #0000001a;
                     transition: all .25s;
                     transform: translateY(220px);
                     pointer-events: auto;
                     z-index: 9999999;
                     overflow: hidden
              }

              .home-new ion-content.home-section .home-content .content-section .holder-box {
                     justify-content: center;
                     padding-bottom: 20px
              }

              .home-new ion-content.home-section .home-content .content-section .holder-box .holder-area {
                     width: 100%;
                     height: 33px;
                     border-radius: 0;
                     position: absolute;
                     top: 0
              }

              .home-new ion-content.home-section .home-content .content-section .holder-box .block-handler {
                     width: 100px;
                     height: 8px;
                     border-radius: 200px;
                     background: #eaecee;
                     margin: 4px 0
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body {
                     margin-top: 15px
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user {
                     width: 75px
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user .avatar app-avatar {
                     padding: 3px;
                     border-radius: 200%
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user .attendance {
                     margin-top: 10px
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user .attendance ion-icon {
                     margin-right: 5px
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user .attendance .in {
                     margin: 5px 0
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user .attendance .leave {
                     text-align: center;
                     margin: 15px 0
              }

              .home-new ion-content.home-section .home-content .content-section .today-teammates-wrapper .today-teammates-body .today-teammates-user .attendance .leave ion-label {
                     border: 1px solid var(--ion-color-danger);
                     border-radius: 50px;
                     padding: 2px 5px
              }

              .home-new ion-content.home-section .home-content .progress-card {
                     background: white;
                     margin: 15px 0;
                     box-shadow: 0 1px 5px #e6e6e6;
                     border-radius: var(--gdx-border-radius);
                     justify-content: center;
                     padding: 25px 15px
              }

              .home-new ion-content.home-section .home-content .progress-card h3 {
                     margin-top: 0;
                     font-size: 14px;
                     font-weight: 700
              }

              .home-new ion-content.home-section .content-webmode {
                     background: var(--gdx-color-bgcard);
                     margin: 0 auto;
                     border-radius: 20px 20px 0 0;
                     box-shadow: 0 8px 12px -7px #0003
              }

              .home-new ion-content.home-section .my-bg {
                     overflow: hidden;
                     position: absolute;
                     top: 0;
                     width: 100%;
                     height: 171px;
                     border-radius: 0 0 20px 20px;
                     background-image: radial-gradient(#ffc330, #fbac5e);
                     box-shadow: 0 8px 12px -7px #0003
              }

              .home-new ion-content.home-section .my-bg .kiri {
                     position: absolute;
                     bottom: -4px;
                     left: 0
              }

              .home-new ion-content.home-section .my-bg .kanan {
                     position: absolute;
                     right: 0;
                     top: 0
              }

              @media screen and (min-width: 680px) and (max-width: 1280px) {
                     .home-new ion-content.home-section .home-content.toggle-dashboard {
                            grid-template-areas: "attendance post""toggle-box post""task post" !important
                     }

                     .home-new ion-content.home-section .home-content.toggle-dashboard .teammates-content {
                            min-height: unset !important
                     }

                     .home-new ion-content.home-section .home-content {
                            display: grid;
                            grid-template-columns: 350px minmax(0, 1fr);
                            grid-template-areas: "attendance post""task post""task post""task post""task post"
                     }

                     .home-new ion-content.home-section .home-content .feed-wrapper {
                            padding: 0 0 0 16px !important
                     }

                     .home-new ion-content.home-section .home-content .add-post-wrapper {
                            padding: 18px 0 18px 18px !important
                     }
              }

              @media screen and (max-width: 768px) {
                     .home-new ion-content.home-section .add-post-wrapper {
                            margin-top: 45px !important
                     }
              }

              @media screen and (max-width: 679px) {
                     .home-new ion-content.home-section .home-content.toggle-dashboard {
                            grid-template-rows: unset !important;
                            grid-template-areas: "attendance""attendance""toggle-box""task""post" !important
                     }

                     .home-new ion-content.home-section .home-content.toggle-dashboard .teammates-content {
                            min-height: unset !important
                     }

                     .home-new ion-content.home-section .home-content {
                            grid-template-columns: unset !important;
                            grid-template-rows: unset !important;
                            grid-template-areas: "attendance""task""post" !important
                     }
              }

              .home-new ion-content.home-section .home-body {
                     margin: 36px 16px 0
              }

              .home-new ion-content.home-section .home-content {
                     pointer-events: auto
              }

              .home-new ion-content.home-section .home-content .content-section {
                     transform: translateY(0) !important;
                     background: 0 0 !important;
                     border: none !important;
                     box-shadow: none !important
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper {
                     width: unset;
                     height: unset;
                     border-radius: 0 0 20px 20px;
                     grid-area: add-post;
                     min-height: auto;
                     padding: 18px;
                     pointer-events: auto;
                     transition: height .25s;
                     overflow: hidden;
                     z-index: 2;
                     background-color: var(--gdx-color-bgcard2);
                     border-radius: 0 !important;
                     box-shadow: none !important;
                     margin-top: unset
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper .add-post-box {
                     border: 1px solid var(--gdx-color-outline);
                     box-shadow: 0 0 23px -12px #0003;
                     margin-top: 23px;
                     background: var(--ion-color-light);
                     border-radius: 16px;
                     padding: 5px 10px;
                     will-change: transform;
                     position: relative;
                     z-index: 1
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper .add-post-box .gd-avatar {
                     display: flex
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper .add-post-box input {
                     border: none;
                     color: var(--ion-color-medium);
                     text-overflow: ellipsis;
                     background: transparent;
                     outline: none
              }

              .home-new ion-content.home-section .home-content .add-post-wrapper .fixed-add-post {
                     position: fixed;
                     top: 20px;
                     z-index: 5;
                     box-shadow: 0 3px 15px #00000029
              }

              .home-new ion-content.home-section .home-content .feed-wrapper {
                     background-color: var(--gdx-color-bgcard2);
                     border-right: 1px solid var(--ion-color-light-shade);
                     padding: 18px
              }

              .home-new ion-content.home-section .home-content .feed-wrapper .feed-box {
                     margin-left: auto;
                     margin-right: auto
              }

              .home-new ion-content.home-section .home-content .right-sidebar {
                     padding: 0
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper {
                     margin-bottom: 15px
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs {
                     margin-bottom: 20px;
                     border-bottom: 1px solid var(--ion-color-light-shade)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area {
                     position: relative;
                     width: calc(100% - 60px)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .tab-box {
                     padding: 15px 0 25px;
                     color: var(--ion-color-medium);
                     text-align: center
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .tab-box b,
              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .tab-box strong {
                     pointer-events: none
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .tab-box:nth-last-of-type(1) {
                     margin-right: 0 !important
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .tab-box.active {
                     color: var(--ion-color-primary)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .tab-box.active b {
                     color: var(--ion-color-primary)
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .tab-area .active-tab-border {
                     background: var(--ion-color-primary);
                     width: 40%;
                     height: 4px;
                     border-radius: 0;
                     position: absolute;
                     bottom: -1px;
                     left: 0;
                     transition: all .2s
              }

              .home-new ion-content.home-section .home-content .right-sidebar .task-wrapper .task-tabs .add-task ion-button {
                     min-width: 45px;
                     --border-color: var(--ion-color-light-shade) !important;
                     --border-width: 1px;
                     --padding-start: 0px;
                     --padding-end: 0px;
                     --border-radius: var(--gdx-border-radius)
              }

              .home-new ion-content.home-section .menu-wrapper {
                     display: none !important
              }
       </style>
       <style>
              .teammates-content[_ngcontent-aax-c340] {
                     overflow: scroll
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-heading[_ngcontent-aax-c340] {
                     margin-bottom: 15px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-heading[_ngcontent-aax-c340] h5[_ngcontent-aax-c340] {
                     font-weight: 700;
                     color: var(--ion-color-dark)
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-heading[_ngcontent-aax-c340] .pagination[_ngcontent-aax-c340] {
                     display: flex;
                     width: 60px;
                     justify-content: space-between
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] {
                     position: relative;
                     display: grid !important;
                     grid-template-columns: repeat(4, minmax(70px, 1fr));
                     text-align: center
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user[_ngcontent-aax-c340] {
                     width: 65px;
                     margin: 15px 2px;
                     width: auto;
                     max-width: 70px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user[_ngcontent-aax-c340] .avatar[_ngcontent-aax-c340] app-avatar[_ngcontent-aax-c340] {
                     padding: 3px;
                     border-radius: 200%
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user[_ngcontent-aax-c340] .name[_ngcontent-aax-c340] {
                     margin-top: 4px;
                     text-align: center;
                     color: var(--ion-color-dark)
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user[_ngcontent-aax-c340] .attendance[_ngcontent-aax-c340] {
                     margin-top: 10px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user[_ngcontent-aax-c340] .attendance[_ngcontent-aax-c340] ion-icon[_ngcontent-aax-c340] {
                     margin-right: 5px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user-add[_ngcontent-aax-c340] {
                     width: 70px;
                     margin: 15px 3px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user-add[_ngcontent-aax-c340] .avatar[_ngcontent-aax-c340] {
                     width: 47px;
                     height: 47px;
                     border-radius: 200px;
                     background-color: var(--ion-color-primary)
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user-add[_ngcontent-aax-c340] .name[_ngcontent-aax-c340] {
                     margin-top: 4px;
                     text-align: center
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .myteam-body-user-add[_ngcontent-aax-c340] ion-label[_ngcontent-aax-c340] {
                     color: var(--ion-color-dark)
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .click-action[_ngcontent-aax-c340] {
                     width: 100%;
                     height: 100%;
                     position: absolute;
                     z-index: 88
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] {
                     opacity: 0;
                     transition: all .2s;
                     width: 100%;
                     display: flex;
                     justify-content: space-between;
                     padding: 0 8px;
                     position: absolute;
                     top: 50%;
                     left: 50%;
                     z-index: 99;
                     transform: translate(-50%, -50%)
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] .nav-left[_ngcontent-aax-c340],
              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] .nav-right[_ngcontent-aax-c340] {
                     background: var(--gdx-color-bgcard);
                     width: 40px;
                     height: 30px;
                     border-radius: 8px;
                     box-shadow: #0000001f 0 4px 16px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     color: var(--ion-color-dark);
                     transition: all .2s
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] .nav-left.invis[_ngcontent-aax-c340],
              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] .nav-right.invis[_ngcontent-aax-c340] {
                     opacity: 0;
                     pointer-events: none
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] .nav-left[_ngcontent-aax-c340]:hover ion-icon[_ngcontent-aax-c340],
              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340] .team-nav[_ngcontent-aax-c340] .nav-right[_ngcontent-aax-c340]:hover ion-icon[_ngcontent-aax-c340] {
                     color: var(--ion-color-primary)
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .myteam-body[_ngcontent-aax-c340]:hover .team-nav[_ngcontent-aax-c340] {
                     opacity: 1
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] {
                     width: 65px;
                     margin: 15px 2px;
                     padding: 12px 0
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .name-box[_ngcontent-aax-c340] {
                     height: 35px;
                     margin-top: 4px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .name-box[_ngcontent-aax-c340] .skeleton-name-1[_ngcontent-aax-c340],
              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .name-box[_ngcontent-aax-c340] .skeleton-name-2[_ngcontent-aax-c340] {
                     width: 60px;
                     height: 10px;
                     border-radius: 4px;
                     margin-bottom: 7px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .attendance-box[_ngcontent-aax-c340] {
                     height: 35px;
                     margin-top: 10px
              }

              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .attendance-box[_ngcontent-aax-c340] .skeleton-attendance-1[_ngcontent-aax-c340],
              .teammates-content[_ngcontent-aax-c340] .myteam[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .attendance-box[_ngcontent-aax-c340] .skeleton-attendance-2[_ngcontent-aax-c340] {
                     width: 45px;
                     height: 10px;
                     border-radius: 4px;
                     margin-bottom: 7px
              }

              @media screen and (min-width: 768px) {
                     .teammates-content[_ngcontent-aax-c340] {
                            padding: unset !important;
                            height: unset !important;
                            overflow: unset !important
                     }

                     .teammates-content[_ngcontent-aax-c340] .myteam-body-user[_ngcontent-aax-c340],
                     .teammates-content[_ngcontent-aax-c340] .myteam-body-user-add[_ngcontent-aax-c340],
                     .teammates-content[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] {
                            width: 70px !important
                     }
              }

              .section-header[_ngcontent-aax-c340] {
                     margin-bottom: 15px
              }

              .section-header[_ngcontent-aax-c340] div[_ngcontent-aax-c340] h5[_ngcontent-aax-c340] {
                     font-weight: 600
              }

              .section-header[_ngcontent-aax-c340] div[_ngcontent-aax-c340] p[_ngcontent-aax-c340] {
                     color: var(--ion-color-medium) !important
              }

              .section-header[_ngcontent-aax-c340] p.viewmore[_ngcontent-aax-c340] {
                     color: var(--ion-color-primary) !important
              }

              .section-body[_ngcontent-aax-c340] .load-section[_ngcontent-aax-c340] gd-comp-loading[_ngcontent-aax-c340] {
                     margin: 10px auto 15px
              }

              .section-body[_ngcontent-aax-c340] .load-section[_ngcontent-aax-c340] ion-label[_ngcontent-aax-c340] {
                     text-align: center;
                     color: var(--ion-color-primary) !important;
                     font-weight: 700
              }

              .section-body[_ngcontent-aax-c340] .empty-state-section[_ngcontent-aax-c340] {
                     margin-top: 10px;
                     width: 100%;
                     text-align: center
              }

              .section-body[_ngcontent-aax-c340] .empty-state-section[_ngcontent-aax-c340] img[_ngcontent-aax-c340] {
                     max-width: 200px
              }

              .section-body[_ngcontent-aax-c340] .empty-state-section[_ngcontent-aax-c340] .heading[_ngcontent-aax-c340] ion-label[_ngcontent-aax-c340] {
                     font-weight: 700;
                     font-size: 18px !important;
                     margin-bottom: -10px
              }

              .section-body[_ngcontent-aax-c340] .empty-state-section[_ngcontent-aax-c340] .sub-heading[_ngcontent-aax-c340] .label-link[_ngcontent-aax-c340] {
                     color: var(--ion-color-tertiary) !important;
                     cursor: pointer;
                     margin-right: 2px
              }

              .section-body[_ngcontent-aax-c340] .empty-state-section[_ngcontent-aax-c340] .sub-heading[_ngcontent-aax-c340] ion-label[_ngcontent-aax-c340] {
                     white-space: initial
              }

              .section-body[_ngcontent-aax-c340] .empty-state-section[_ngcontent-aax-c340] .sub-heading[_ngcontent-aax-c340] .secondary[_ngcontent-aax-c340] {
                     color: var(--ion-color-medium) !important
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] h2[_ngcontent-aax-c340] {
                     font-size: 24px
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] p[_ngcontent-aax-c340] {
                     margin: 5px 0 15px;
                     color: var(--ion-color-medium) !important
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] p.good[_ngcontent-aax-c340] {
                     color: var(--ion-color-success) !important
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] p.bad[_ngcontent-aax-c340] {
                     color: var(--ion-color-danger) !important
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] ion-icon[_ngcontent-aax-c340] {
                     font-size: 26px
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] canvas#barActivity[_ngcontent-aax-c340] {
                     background: var(--ion-color-dark) !important;
                     height: 400px
              }

              .section-body[_ngcontent-aax-c340] .box-chart[_ngcontent-aax-c340] canvas#pieRatio[_ngcontent-aax-c340] {
                     background: var(--ion-color-dark) !important;
                     height: 300px
              }

              .all-teammates-body[_ngcontent-aax-c340] {
                     display: flex;
                     flex-wrap: wrap
              }

              .all-teammates-body[_ngcontent-aax-c340] .my-all-teammates[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .locked-box[_ngcontent-aax-c340] {
                     flex: 0 0 calc((100% + -0px)/5);
                     margin-bottom: 20px
              }

              .all-teammates-body[_ngcontent-aax-c340] .my-all-teammates[_ngcontent-aax-c340]:last-child,
              .all-teammates-body[_ngcontent-aax-c340] .my-all-teammates[_ngcontent-aax-c340]:nth-child(5),
              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340]:last-child,
              .all-teammates-body[_ngcontent-aax-c340] .locked-box[_ngcontent-aax-c340]:last-child {
                     margin-right: 0
              }

              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] gd-avatar[_ngcontent-aax-c340] .skeleton[_ngcontent-aax-c340] {
                     margin-bottom: 8px
              }

              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .skeleton-top[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .locked-top[_ngcontent-aax-c340] {
                     margin-bottom: 5px
              }

              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .skeleton-status[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .skeleton-top[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .locked-status[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .skeleton-box[_ngcontent-aax-c340] .locked-top[_ngcontent-aax-c340] {
                     width: 38px;
                     height: 10px;
                     border-radius: 4px
              }

              .all-teammates-body[_ngcontent-aax-c340] .locked-box[_ngcontent-aax-c340] .avatar[_ngcontent-aax-c340] {
                     margin-bottom: 8px
              }

              .all-teammates-body[_ngcontent-aax-c340] .locked-box[_ngcontent-aax-c340] .locked-status[_ngcontent-aax-c340],
              .all-teammates-body[_ngcontent-aax-c340] .locked-box[_ngcontent-aax-c340] .locked-top[_ngcontent-aax-c340] {
                     margin: 0 auto;
                     background: #e2e9ed
              }

              .all-teammates-body[_ngcontent-aax-c340] .name[_ngcontent-aax-c340] {
                     text-align: center;
                     margin: 5px 0 10px
              }

              .all-teammates-body[_ngcontent-aax-c340] .attendance[_ngcontent-aax-c340] .start-in[_ngcontent-aax-c340] .data-in[_ngcontent-aax-c340] {
                     margin-left: 5px;
                     text-align: center;
                     width: 100%;
                     margin-bottom: 5px
              }

              .all-teammates-body[_ngcontent-aax-c340] .attendance[_ngcontent-aax-c340] .start-in[_ngcontent-aax-c340] .data-in[_ngcontent-aax-c340] ion-label[_ngcontent-aax-c340] {
                     color: var(--ion-color-success) !important
              }

              .all-teammates-body[_ngcontent-aax-c340] .attendance[_ngcontent-aax-c340] .start-out[_ngcontent-aax-c340] .data-out[_ngcontent-aax-c340] {
                     margin-left: 5px;
                     text-align: center;
                     width: 100%
              }

              .all-teammates-body[_ngcontent-aax-c340] .attendance[_ngcontent-aax-c340] .start-out[_ngcontent-aax-c340] .data-out[_ngcontent-aax-c340] ion-label[_ngcontent-aax-c340] {
                     color: var(--ion-color-danger) !important
              }

              .all-teammates-body[_ngcontent-aax-c340] .add[_ngcontent-aax-c340] {
                     align-self: flex-start;
                     text-align: center;
                     flex: 0 0 calc((100% + -0px)/4);
                     cursor: pointer
              }

              .all-teammates-body[_ngcontent-aax-c340] .add[_ngcontent-aax-c340] img[_ngcontent-aax-c340] {
                     margin-top: 8px;
                     margin-bottom: 12px;
                     width: 42px;
                     align-self: center
              }

              .all-teammates-body[_ngcontent-aax-c340] .text-wrap[_ngcontent-aax-c340] {
                     white-space: normal;
                     width: 60px;
                     line-height: 18px;
                     display: -webkit-box;
                     -webkit-line-clamp: 2;
                     -webkit-box-orient: vertical;
                     overflow: hidden;
                     margin: -3px auto 0;
                     text-transform: capitalize
              }

              .all-teammates-body[_ngcontent-aax-c340] .text-wrap[_ngcontent-aax-c340]:first-letter {
                     text-transform: uppercase
              }

              .skeleton-team-box[_ngcontent-aax-c340] {
                     padding: 8px
              }

              .skeleton-team-box[_ngcontent-aax-c340] .circle-box[_ngcontent-aax-c340] {
                     width: 38px;
                     height: 38px;
                     border-radius: 100px;
                     margin-bottom: 12px
              }

              .skeleton-team-box[_ngcontent-aax-c340] .circle-box[_ngcontent-aax-c340]+div[_ngcontent-aax-c340] {
                     width: 100%
              }

              .skeleton-team-box[_ngcontent-aax-c340] .line-box[_ngcontent-aax-c340] {
                     width: 100%;
                     height: 16px;
                     border-radius: 4px;
                     margin-bottom: 8px
              }

              .round-avatar[_ngcontent-aax-c340] {
                     border-radius: 50% !important
              }
       </style>
       <style>
              .task-wrapper[_ngcontent-aax-c341] {
                     margin-bottom: 15px
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] {
                     position: relative;
                     z-index: 1
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .toggle-area[_ngcontent-aax-c341] {
                     border-radius: 200px;
                     width: 36px;
                     height: 36px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     transition: all .2s;
                     position: relative;
                     cursor: pointer
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .toggle-area[_ngcontent-aax-c341] .checkmark-box[_ngcontent-aax-c341] {
                     width: 16px;
                     height: 16px;
                     border-radius: 4px;
                     font-size: 15px;
                     display: flex;
                     border: 1.5px solid rgba(var(--ion-color-medium-rgb), .7);
                     color: var(--ion-color-medium-contrast)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .toggle-area[_ngcontent-aax-c341] .checkmark-box[_ngcontent-aax-c341] ion-icon[_ngcontent-aax-c341] {
                     position: relative;
                     top: -1px;
                     opacity: 0
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .toggle-area[_ngcontent-aax-c341] .checkmark-box.complete[_ngcontent-aax-c341] {
                     background: var(--ion-color-success);
                     border-color: var(--ion-color-success)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .toggle-area[_ngcontent-aax-c341] .checkmark-box.complete[_ngcontent-aax-c341] ion-icon[_ngcontent-aax-c341] {
                     opacity: 1
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .toggle-area[_ngcontent-aax-c341]:hover {
                     background: var(--ion-color-light-shade)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] {
                     position: absolute;
                     top: -45px;
                     right: unset;
                     bottom: unset;
                     left: -7px;
                     background-color: transparent;
                     cursor: auto
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .kuncup[_ngcontent-aax-c341] {
                     position: absolute;
                     top: unset;
                     right: unset;
                     bottom: -4px;
                     left: 21px;
                     width: 8px;
                     height: 8px;
                     border-radius: 0;
                     border: 1px solid var(--gdx-color-outline);
                     transform: rotate(45deg);
                     border-top: none;
                     border-left: none;
                     background-color: var(--gdx-color-bgcard)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] {
                     width: unset;
                     height: 34px;
                     border-radius: var(--gdx-border-radius);
                     border: 1px solid var(--gdx-color-outline);
                     padding: 0 11px;
                     background-color: var(--gdx-color-bgcard);
                     margin-right: 3px;
                     align-items: center
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] ion-label[_ngcontent-aax-c341]:after {
                     content: "|";
                     color: #222 !important;
                     margin: 0 5px
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] ion-label[_ngcontent-aax-c341]:last-child:after {
                     content: "";
                     margin: 0
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] .respond[_ngcontent-aax-c341] {
                     color: var(--ion-color-dark) !important
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] .complete[_ngcontent-aax-c341] {
                     color: #8cc63f !important
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] .closed[_ngcontent-aax-c341] {
                     color: #63befb !important
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .option-section[_ngcontent-aax-c341] .canceled[_ngcontent-aax-c341] {
                     color: #fbac5e !important
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .close-box[_ngcontent-aax-c341] {
                     background-color: rgba(var(--ion-color-dark-rgb), .42);
                     width: 34px;
                     height: 34px;
                     border-radius: 7px
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .option-box[_ngcontent-aax-c341] .close-box[_ngcontent-aax-c341] ion-icon[_ngcontent-aax-c341] {
                     font-size: 24px;
                     color: var(--ion-color-light)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .gd-avatar[_ngcontent-aax-c341] {
                     display: flex
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .captions[_ngcontent-aax-c341] {
                     flex: 1 1 auto;
                     width: 100px
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .captions[_ngcontent-aax-c341] p[_ngcontent-aax-c341]:first-child,
              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .captions[_ngcontent-aax-c341] p[_ngcontent-aax-c341]:last-child {
                     color: var(--ion-color-medium)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .captions[_ngcontent-aax-c341] p[_ngcontent-aax-c341] {
                     margin: 1px 0;
                     color: var(--ion-color-dark)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .captions[_ngcontent-aax-c341] span[_ngcontent-aax-c341],
              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] span[_ngcontent-aax-c341] {
                     color: var(--ion-color-medium)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341]>p[_ngcontent-aax-c341] {
                     color: var(--ion-color-dark)
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .badge[_ngcontent-aax-c341] {
                     border-radius: 12px
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .badge[_ngcontent-aax-c341] p[_ngcontent-aax-c341] {
                     text-transform: capitalize;
                     padding: 0 7px;
                     font-weight: unset;
                     width: unset;
                     height: 20px;
                     display: flex;
                     justify-content: flex-start;
                     align-items: center
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .new-badge[_ngcontent-aax-c341] {
                     background-color: #63befb33;
                     border: 1px solid #63befb;
                     color: #63befb
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .new-badge[_ngcontent-aax-c341] p[_ngcontent-aax-c341] {
                     color: #63befb
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .reopen-badge[_ngcontent-aax-c341] {
                     background-color: #fbac5e33;
                     border: 1px solid #fbac5e;
                     color: #fbac5e
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .reopen-badge[_ngcontent-aax-c341] p[_ngcontent-aax-c341] {
                     color: #fbac5e
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .fixed-badge[_ngcontent-aax-c341] {
                     background-color: #8cc63f33;
                     border: 1px solid #8cc63f;
                     color: #8cc63f
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .time[_ngcontent-aax-c341] .fixed-badge[_ngcontent-aax-c341] p[_ngcontent-aax-c341] {
                     color: #8cc63f
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341] .task-hover[_ngcontent-aax-c341] {
                     width: calc(100% + 38px);
                     height: calc(100% + 15px);
                     position: absolute;
                     left: -18px;
                     top: -8px;
                     z-index: -2;
                     transition: all .2s
              }

              .task-wrapper[_ngcontent-aax-c341] .task-body[_ngcontent-aax-c341] .task-item[_ngcontent-aax-c341]:hover>.task-hover[_ngcontent-aax-c341] {
                     background: var(--ion-color-light-tint)
              }

              .task-wrapper[_ngcontent-aax-c341] .empty-state[_ngcontent-aax-c341] {
                     margin-top: 10px;
                     text-align: center
              }

              .task-wrapper[_ngcontent-aax-c341] .empty-state[_ngcontent-aax-c341] img[_ngcontent-aax-c341] {
                     opacity: .75
              }

              .task-wrapper[_ngcontent-aax-c341] .empty-state[_ngcontent-aax-c341] .heading[_ngcontent-aax-c341] ion-label[_ngcontent-aax-c341] {
                     font-weight: 700;
                     color: var(--ion-color-dark)
              }

              .task-wrapper[_ngcontent-aax-c341] .empty-state[_ngcontent-aax-c341] .sub-heading[_ngcontent-aax-c341] {
                     color: var(--ion-color-dark)
              }

              .task-wrapper[_ngcontent-aax-c341] .empty-state[_ngcontent-aax-c341] .sub-heading[_ngcontent-aax-c341] .label-link[_ngcontent-aax-c341] {
                     color: #63befb;
                     cursor: pointer;
                     margin-right: 2px
              }

              .task-wrapper[_ngcontent-aax-c341] .empty-state[_ngcontent-aax-c341] .sub-heading[_ngcontent-aax-c341] ion-label[_ngcontent-aax-c341] {
                     white-space: initial
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] {
                     width: 100%;
                     margin-bottom: 12px;
                     justify-content: center;
                     align-items: center
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] app-avatar[_ngcontent-aax-c341] {
                     margin-right: 12px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .skeleton-radio[_ngcontent-aax-c341] {
                     width: 16px;
                     height: 16px;
                     margin: 10px;
                     border-radius: 4px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .detail-box[_ngcontent-aax-c341] {
                     margin-right: 16px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .detail-box[_ngcontent-aax-c341] .skeleton-line1[_ngcontent-aax-c341] {
                     height: 11px;
                     width: 50px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .detail-box[_ngcontent-aax-c341] .skeleton-line2[_ngcontent-aax-c341] {
                     height: 13px;
                     width: 120px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .detail-box[_ngcontent-aax-c341] .skeleton-line3[_ngcontent-aax-c341] {
                     width: 80px;
                     height: 9px;
                     border-radius: 4px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .badge-box[_ngcontent-aax-c341] .skeleton-time[_ngcontent-aax-c341] {
                     width: 32px;
                     height: 12px;
                     border-radius: 4px;
                     margin-bottom: 7px
              }

              .task-wrapper[_ngcontent-aax-c341] .skeleton-task[_ngcontent-aax-c341] .skeleton-box[_ngcontent-aax-c341] .badge-box[_ngcontent-aax-c341] .skeleton-badge[_ngcontent-aax-c341] {
                     width: 36px;
                     height: 14px;
                     border-radius: 12px
              }
       </style>
       <style>
              @media only screen and (min-width: 768px) {
                     .company-wrapper[_ngcontent-aax-c336] {
                            background: var(--gdx-color-bgcard);
                            padding: 0 !important
                     }
              }

              .company-wrapper[_ngcontent-aax-c336] {
                     background: var(--gdx-color-bgcard);
                     padding: 16px;
                     margin-bottom: 40px
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] {
                     margin-top: 25px
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .info[_ngcontent-aax-c336] {
                     position: relative;
                     z-index: 1;
                     border: 1px solid var(--ion-color-light-shade);
                     border-radius: 8px;
                     padding: 16px;
                     margin-bottom: 16px;
                     background: var(--gdx-color-bgcard);
                     transition: all .2s
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .info[_ngcontent-aax-c336] .picture[_ngcontent-aax-c336] img[_ngcontent-aax-c336] {
                     width: 55px;
                     height: 55px;
                     border-radius: 5px;
                     object-fit: cover
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .info[_ngcontent-aax-c336] .new[_ngcontent-aax-c336] {
                     margin-right: 0 !important
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .info[_ngcontent-aax-c336] .info-hover[_ngcontent-aax-c336] {
                     width: calc(100% + 38px);
                     height: 100%;
                     border-radius: 0;
                     position: absolute;
                     left: -18px;
                     top: 0;
                     z-index: -2;
                     transition: all .2s
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .info[_ngcontent-aax-c336]:hover {
                     background: var(--ion-color-light-tint)
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .caption-company[_ngcontent-aax-c336] {
                     margin-top: -2px;
                     overflow: hidden
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .caption-company[_ngcontent-aax-c336] .title[_ngcontent-aax-c336] {
                     color: var(--ion-color-dark) !important
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .caption-company[_ngcontent-aax-c336] .desc[_ngcontent-aax-c336] {
                     color: var(--ion-color-medium) !important;
                     margin-top: 2px;
                     margin-bottom: 2px;
                     display: -webkit-box;
                     -webkit-line-clamp: 4;
                     -webkit-box-orient: vertical;
                     overflow: hidden;
                     text-overflow: ellipsis;
                     white-space: initial
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .caption-company[_ngcontent-aax-c336] .desc[_ngcontent-aax-c336] *[_ngcontent-aax-c336] {
                     margin: 0
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .caption-company[_ngcontent-aax-c336] .date[_ngcontent-aax-c336] {
                     color: var(--ion-color-medium) !important
              }

              .company-wrapper[_ngcontent-aax-c336] .company-body[_ngcontent-aax-c336] .new[_ngcontent-aax-c336] .my-icon[_ngcontent-aax-c336] {
                     border-radius: 12px;
                     border: 1px solid #fb745e;
                     background: rgba(251, 116, 94, .3);
                     color: #fb745e;
                     font-size: 10px;
                     text-align: center;
                     text-transform: uppercase;
                     padding: 3px 10px
              }

              .company-wrapper[_ngcontent-aax-c336] .skeleton-company[_ngcontent-aax-c336] .skeleton-box[_ngcontent-aax-c336] {
                     margin-bottom: 24px
              }

              .company-wrapper[_ngcontent-aax-c336] .skeleton-company[_ngcontent-aax-c336] .skeleton-box[_ngcontent-aax-c336] .detail-box[_ngcontent-aax-c336] .skeleton-line1[_ngcontent-aax-c336] {
                     width: 100px;
                     height: 11px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .company-wrapper[_ngcontent-aax-c336] .skeleton-company[_ngcontent-aax-c336] .skeleton-box[_ngcontent-aax-c336] .detail-box[_ngcontent-aax-c336] .skeleton-line2[_ngcontent-aax-c336] {
                     width: 150px;
                     height: 13px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .company-wrapper[_ngcontent-aax-c336] .skeleton-company[_ngcontent-aax-c336] .skeleton-box[_ngcontent-aax-c336] .detail-box[_ngcontent-aax-c336] .skeleton-line3[_ngcontent-aax-c336] {
                     width: 70px;
                     height: 9px;
                     border-radius: 4px
              }

              .company-wrapper[_ngcontent-aax-c336] .skeleton-company[_ngcontent-aax-c336] .skeleton-box[_ngcontent-aax-c336] .badge-box[_ngcontent-aax-c336] .skeleton-badge[_ngcontent-aax-c336] {
                     width: 36px;
                     height: 14px;
                     border-radius: 12px
              }
       </style>
       <style>
              @media screen and (min-width: 1024px) {
                     .add-post-wrapper[_ngcontent-aax-c357] {
                            max-height: unset !important
                     }
              }

              @media screen and (min-width: 1024px) and (max-width: 1280px) {

                     .add-post-wrapper[_ngcontent-aax-c357],
                     .card-info-wrapper[_ngcontent-aax-c357],
                     .feed-wrapper[_ngcontent-aax-c357] {
                            border-right: none !important
                     }
              }

              @media screen and (max-width: 1023px) {

                     .add-post-wrapper[_ngcontent-aax-c357],
                     .card-info-wrapper[_ngcontent-aax-c357],
                     .feed-wrapper[_ngcontent-aax-c357] {
                            border-right: none !important
                     }
              }

              @media screen and (min-width: 768px) {

                     .add-post-wrapper[_ngcontent-aax-c357],
                     .card-info-wrapper[_ngcontent-aax-c357],
                     .feed-wrapper[_ngcontent-aax-c357] {
                            border-left: 1px solid var(--ion-color-light-shade);
                            border-right: 1px solid var(--ion-color-light-shade)
                     }
              }

              .section-post[_ngcontent-aax-c357] {
                     height: 100%
              }

              .add-post-wrapper[_ngcontent-aax-c357] {
                     width: unset;
                     height: unset;
                     border-radius: 0 0 20px 20px;
                     min-height: auto;
                     padding: 18px;
                     pointer-events: auto;
                     transition: height .25s;
                     overflow: hidden;
                     z-index: 2;
                     background-color: var(--gdx-color-bgcard2);
                     border-radius: 0 !important;
                     box-shadow: none !important
              }

              .add-post-wrapper[_ngcontent-aax-c357] .add-post-box[_ngcontent-aax-c357] {
                     border: 1px solid var(--gdx-color-outline);
                     box-shadow: 0 0 23px -12px #0003;
                     margin-top: 23px;
                     background: var(--ion-color-light);
                     border-radius: 16px;
                     padding: 5px 10px;
                     will-change: transform;
                     position: relative;
                     z-index: 1
              }

              .add-post-wrapper[_ngcontent-aax-c357] .add-post-box[_ngcontent-aax-c357] .gd-avatar[_ngcontent-aax-c357] {
                     display: flex
              }

              .add-post-wrapper[_ngcontent-aax-c357] .add-post-box[_ngcontent-aax-c357] input[_ngcontent-aax-c357] {
                     border: none;
                     color: var(--ion-color-medium);
                     text-overflow: ellipsis;
                     background: transparent;
                     outline: none
              }

              .add-post-wrapper[_ngcontent-aax-c357] .fixed-add-post[_ngcontent-aax-c357] {
                     position: fixed;
                     top: 20px;
                     z-index: 5;
                     box-shadow: 0 3px 15px #00000029
              }

              .feed-wrapper[_ngcontent-aax-c357] {
                     background-color: var(--gdx-color-bgcard2);
                     padding: 18px
              }

              .feed-wrapper[_ngcontent-aax-c357] .feed-box[_ngcontent-aax-c357] {
                     margin-left: auto;
                     margin-right: auto
              }

              .card-info-wrapper[_ngcontent-aax-c357] {
                     padding: 8px 18px;
                     background-color: var(--gdx-color-bgcard2)
              }

              .card-info-wrapper[_ngcontent-aax-c357] .card-info[_ngcontent-aax-c357] {
                     grid-area: card-info;
                     background-color: rgba(var(--ion-color-tertiary-rgb), .2);
                     border-radius: var(--gdx-border-radius)
              }

              .card-info-wrapper[_ngcontent-aax-c357] .card-info[_ngcontent-aax-c357] ion-label[_ngcontent-aax-c357],
              .card-info-wrapper[_ngcontent-aax-c357] .card-info[_ngcontent-aax-c357] p[_ngcontent-aax-c357] {
                     color: var(--ion-color-tertiary) !important
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] {
                     background-color: var(--gdx-color-bgcard2);
                     pointer-events: auto
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] h2[_ngcontent-aax-c357] {
                     font-size: 16px
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] .my-onboarding-box[_ngcontent-aax-c357] {
                     box-shadow: 0 1px 5px #dbdbdb;
                     padding: 10px 15px;
                     background: white;
                     border-radius: 10px
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] .my-onboarding-head[_ngcontent-aax-c357] {
                     padding-top: 20px
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] .my-onboarding-head[_ngcontent-aax-c357] h2[_ngcontent-aax-c357] {
                     margin-bottom: 15px
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] .my-onboarding-body[_ngcontent-aax-c357] .bar-progress[_ngcontent-aax-c357] {
                     padding: 15px 0 8px
              }

              .my-onboarding-wrapper[_ngcontent-aax-c357] .my-onboarding-body[_ngcontent-aax-c357] .box-percent[_ngcontent-aax-c357] {
                     margin-bottom: 5px
              }
       </style>
       <style>
              .empty-logo[_ngcontent-aax-c148],
              .null-logo[_ngcontent-aax-c148] {
                     max-width: 220px;
                     height: auto;
                     width: 100%
              }

              .empty-title[_ngcontent-aax-c148] {
                     color: var(--ion-color-dark);
                     font-weight: 700;
                     margin-bottom: 2px
              }

              .empty-subtitle[_ngcontent-aax-c148] {
                     color: var(--ion-color-medium);
                     font-size: 12px
              }

              .empty-subtitle[_ngcontent-aax-c148] a[_ngcontent-aax-c148] {
                     color: var(--ion-color-secondary);
                     cursor: pointer
              }

              .empty-subtitle[_ngcontent-aax-c148] a[_ngcontent-aax-c148]:hover {
                     text-decoration: underline
              }
       </style>
       <script type="text/javascript" async="" src="asset/gdp/shim.latest.js"></script>
       <style>
              gd-comp-icon[_ngcontent-aax-c247] {
                     margin-left: 4px;
                     position: relative;
                     top: 3px;
                     display: none !important
              }

              @media screen and (max-width: 768px) {
                     .wrapper[_ngcontent-aax-c247] .label-box[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                            opacity: .5
                     }

                     .wrapper[_ngcontent-aax-c247] .label-box[_ngcontent-aax-c247] ion-icon[_ngcontent-aax-c247] {
                            display: none
                     }

                     .wrapper[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box[_ngcontent-aax-c247] {
                            padding: 10px 16px !important
                     }

                     .wrapper[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                            font-size: 16px;
                            font-weight: 700
                     }

                     .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] {
                            transition: all .3s ease;
                            width: 210px !important;
                            background-color: var(--gdx-color-bgcard) !important;
                            overflow: auto !important
                     }

                     .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] {
                            padding: 10px 0 10px 16px !important
                     }

                     .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                            width: auto !important;
                            height: auto !important;
                            overflow: inherit !important
                     }

                     .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] ion-icon[_ngcontent-aax-c247] {
                            transform: rotate(0) !important
                     }

                     .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] {
                            opacity: 1 !important
                     }
              }

              .wrapper[_ngcontent-aax-c247] .back-arrow-box[_ngcontent-aax-c247] {
                     width: 30px;
                     height: 30px;
                     border: 2px solid var(--gdx-color-outline);
                     cursor: pointer;
                     border-right: 0px solid var(--gdx-color-outline);
                     margin-left: 10px
              }

              .wrapper[_ngcontent-aax-c247] .back-arrow-box[_ngcontent-aax-c247] ion-icon[_ngcontent-aax-c247] {
                     color: var(--ion-color-medium)
              }

              .wrapper[_ngcontent-aax-c247] .back-arrow-box[_ngcontent-aax-c247]:hover {
                     background-color: #0000000d
              }

              .wrapper[_ngcontent-aax-c247] .borderRight[_ngcontent-aax-c247] {
                     margin-left: 10px !important;
                     border-right: 2px solid var(--gdx-color-outline) !important;
                     transition: all ease .3s
              }

              .wrapper[_ngcontent-aax-c247] .collapsible[_ngcontent-aax-c247] {
                     transition: all .3s ease;
                     width: 210px !important;
                     background-color: var(--gdx-color-bgcard) !important;
                     overflow: auto !important;
                     padding-bottom: 16px
              }

              .wrapper[_ngcontent-aax-c247] .collapsible[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] {
                     padding: 10px 0 10px 16px !important
              }

              .wrapper[_ngcontent-aax-c247] .collapsible[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                     width: auto !important;
                     height: auto !important;
                     overflow: inherit !important
              }

              .wrapper[_ngcontent-aax-c247] .collapsible[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] ion-icon[_ngcontent-aax-c247] {
                     transform: rotate(0) !important
              }

              .wrapper[_ngcontent-aax-c247] .collapsible[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] {
                     opacity: 1 !important
              }

              .wrapper[_ngcontent-aax-c247] .hide-mobile[_ngcontent-aax-c247] {
                     width: 0px !important
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] {
                     height: calc(100vh - 75px);
                     transition: all .3s ease;
                     background-color: transparent;
                     overflow: hidden;
                     width: 50px;
                     z-index: 2
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] {
                     padding: 10px 16px 10px 0
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                     width: 0;
                     height: 0;
                     overflow: hidden;
                     margin-right: 0 !important
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .head-menu[_ngcontent-aax-c247] ion-icon[_ngcontent-aax-c247] {
                     transform: rotate(180deg)
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] {
                     opacity: 0
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .label-box[_ngcontent-aax-c247] {
                     padding: 10px 16px;
                     cursor: pointer
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .label-box[_ngcontent-aax-c247] ion-icon[_ngcontent-aax-c247] {
                     color: var(--ion-color-medium)
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .label-box[_ngcontent-aax-c247]:hover {
                     transition: all .2s ease;
                     background-color: #0000000d
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] {
                     transition: all cubic-bezier(1, -.11, .72, .89) .2s;
                     opacity: 1
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box[_ngcontent-aax-c247] {
                     padding: 10px 16px 10px 24px;
                     cursor: pointer
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box[_ngcontent-aax-c247]:hover {
                     transition: all .2s ease;
                     background-color: #0000000d
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box.active[_ngcontent-aax-c247] {
                     border-left: 5px solid var(--ion-color-primary);
                     background-color: #0000000d
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box.active[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                     color: var(--ion-color-primary) !important
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] .sub-box[_ngcontent-aax-c247] ion-label[_ngcontent-aax-c247] {
                     pointer-events: none
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-section[_ngcontent-aax-c247] .list-sub.hide[_ngcontent-aax-c247] {
                     max-height: 0px;
                     overflow: hidden;
                     transition: all cubic-bezier(.11, 1.08, .72, .89) .2s;
                     opacity: 0
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .list-menu[_ngcontent-aax-c247] .list-group[_ngcontent-aax-c247] .list-sub[_ngcontent-aax-c247] {
                     flex-direction: column
              }

              .wrapper[_ngcontent-aax-c247] .side-menu[_ngcontent-aax-c247] .more-icon[_ngcontent-aax-c247] {
                     display: none
              }

              .wrapper[_ngcontent-aax-c247] ion-router-outlet[_ngcontent-aax-c247] {
                     position: relative
              }

              .wrapper.desktop[_ngcontent-aax-c247] {
                     margin-top: 75px
              }

              @media screen and (max-width: 768px) {
                     .overlay-mobile[_ngcontent-aax-c247] {
                            background: rgba(37, 37, 37, .3);
                            height: 100vh;
                            width: 100%;
                            z-index: 1
                     }

                     .more-icon[_ngcontent-aax-c247] {
                            display: block !important;
                            font-size: 22px;
                            position: absolute;
                            right: 12px;
                            top: 16px
                     }

                     .hide-popover[_ngcontent-aax-c247] {
                            display: none
                     }

                     .list-sub.hide[_ngcontent-aax-c247] {
                            max-height: unset !important;
                            overflow: unset;
                            opacity: 1 !important
                     }
              }
       </style>
       <style>
              .app-header[_ngcontent-aax-c246] {
                     padding: 0 16px;
                     z-index: 2;
                     position: fixed;
                     background: #333333;
                     height: 80px;
                     justify-content: center
              }

              .app-header[_ngcontent-aax-c246] .logo[_ngcontent-aax-c246] {
                     object-fit: contain;
                     width: 110px;
                     min-width: 80px
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button[_ngcontent-aax-c246] {
                     padding: 14px 16px;
                     border-radius: 8px
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button[_ngcontent-aax-c246] ion-label[_ngcontent-aax-c246] {
                     color: #fff;
                     pointer-events: none
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button[_ngcontent-aax-c246] .loading[_ngcontent-aax-c246] {
                     width: 100px !important
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button[_ngcontent-aax-c246] .arrow-down[_ngcontent-aax-c246] {
                     width: 0;
                     height: 0;
                     border-left: 5px solid transparent;
                     border-right: 5px solid transparent;
                     border-top: 5px solid #fff;
                     pointer-events: none
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button[_ngcontent-aax-c246]:hover {
                     background-color: #ffffff4d
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button.active[_ngcontent-aax-c246] {
                     background-color: #fff !important
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button.active[_ngcontent-aax-c246] ion-label[_ngcontent-aax-c246] {
                     color: #333 !important
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button.active[_ngcontent-aax-c246] .arrow-down[_ngcontent-aax-c246] {
                     border-top: 5px solid #333333 !important
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button.loading[_ngcontent-aax-c246] {
                     background-color: transparent !important
              }

              .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button.loading[_ngcontent-aax-c246] .arrow-down[_ngcontent-aax-c246] {
                     border-top: 5px solid rgba(242, 244, 247, .22) !important
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] {
                     position: absolute;
                     top: 74px;
                     left: 134px;
                     width: calc(96% - 134px);
                     max-width: 1280px;
                     min-height: 200px;
                     background-color: var(--ion-color-light);
                     padding: 8px;
                     z-index: 2;
                     border-radius: 8px;
                     box-shadow: 0 3px 9px #00000026
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] {
                     max-width: 380px
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-title[_ngcontent-aax-c246] {
                     border-bottom: 1px solid var(--gdx-color-outline);
                     padding: 8px
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-title[_ngcontent-aax-c246] p[_ngcontent-aax-c246] {
                     color: var(--ion-color-dark)
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-title[_ngcontent-aax-c246] .arrow-up[_ngcontent-aax-c246] {
                     width: 0;
                     height: 0;
                     border-left: 5px solid transparent;
                     border-right: 5px solid transparent;
                     border-bottom: 5px solid var(--ion-color-dark)
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-sub[_ngcontent-aax-c246] p[_ngcontent-aax-c246] {
                     padding: 8px;
                     color: var(--ion-color-medium)
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-sub[_ngcontent-aax-c246] p.menu[_ngcontent-aax-c246]:hover {
                     opacity: .6
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-sub[_ngcontent-aax-c246] .view-all[_ngcontent-aax-c246] gd-comp-icon[_ngcontent-aax-c246] {
                     margin-left: 8px
              }

              .app-header[_ngcontent-aax-c246] .menu-popover[_ngcontent-aax-c246] .menu-block[_ngcontent-aax-c246] .menu-sub[_ngcontent-aax-c246] .view-all[_ngcontent-aax-c246]:hover {
                     opacity: .6
              }

              .app-header[_ngcontent-aax-c246] .input-box[_ngcontent-aax-c246] {
                     transition: all .2s;
                     border-radius: 8px;
                     max-width: 650px;
                     position: relative
              }

              .app-header[_ngcontent-aax-c246] .input-box[_ngcontent-aax-c246] ion-icon[_ngcontent-aax-c246] {
                     font-size: 22px;
                     color: var(--ion-color-medium);
                     z-index: 6;
                     position: absolute;
                     right: 10px
              }

              .app-header[_ngcontent-aax-c246] .input-box[_ngcontent-aax-c246] ion-input[_ngcontent-aax-c246] {
                     --placeholder-color: rgba(255, 255, 255, .5);
                     height: 43px;
                     width: 100%;
                     max-width: 650px;
                     border-radius: 8px;
                     font-size: 12px;
                     background-color: #333;
                     --color: #fff !important;
                     border: 1px solid rgba(255, 255, 255, .5);
                     --padding-start: 10px;
                     --padding-end: 40px
              }

              .app-header[_ngcontent-aax-c246] .input-box[_ngcontent-aax-c246] .notify[_ngcontent-aax-c246] {
                     position: absolute;
                     z-index: 2;
                     bottom: -55px;
                     background: rgba(255, 255, 255, .79);
                     padding: 6px;
                     border-radius: 8px;
                     display: none
              }

              .app-header[_ngcontent-aax-c246] .input-box[_ngcontent-aax-c246]:hover .notify[_ngcontent-aax-c246] {
                     display: block;
                     transition: display .2s
              }

              .app-header[_ngcontent-aax-c246] .input-box[_ngcontent-aax-c246]:hover {
                     box-shadow: 0 2px 16px -3px #0000001a
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] {
                     position: relative;
                     margin: 0 15px
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] {
                     padding: 6px 15px;
                     border-radius: 8px
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] .notif-section[_ngcontent-aax-c246] {
                     width: 46px;
                     height: 46px;
                     border-radius: 200px;
                     border: 1px solid var(--ion-color-light-shade);
                     background-color: var(--ion-color-light);
                     position: relative
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] .notif-section[_ngcontent-aax-c246] img[_ngcontent-aax-c246] {
                     width: 22px;
                     height: 22px;
                     border-radius: 0
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] .notif-section[_ngcontent-aax-c246] .badge-box[_ngcontent-aax-c246] {
                     position: absolute;
                     right: -10px;
                     width: 18px;
                     height: 18px;
                     border-radius: 200px
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] .notif-section[_ngcontent-aax-c246] .badge-box[_ngcontent-aax-c246] p[_ngcontent-aax-c246] {
                     color: #fff
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] .notif-section[_ngcontent-aax-c246] .badge-box.top[_ngcontent-aax-c246] {
                     top: -5px;
                     background-color: var(--ion-color-danger);
                     border: 1px solid var(--ion-color-danger-shade)
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] .notif-section[_ngcontent-aax-c246] .badge-box.bottom[_ngcontent-aax-c246] {
                     bottom: 5px;
                     background-color: var(--ion-color-warning);
                     border: 1px solid var(--ion-color-warning-shade)
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .notif-box[_ngcontent-aax-c246] p[_ngcontent-aax-c246] {
                     color: var(--ion-color-dark)
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .bell-icon[_ngcontent-aax-c246],
              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .news-icon[_ngcontent-aax-c246] {
                     position: relative
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .bell-icon[_ngcontent-aax-c246] [badge-dot][_ngcontent-aax-c246],
              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .news-icon[_ngcontent-aax-c246] [badge-dot][_ngcontent-aax-c246] {
                     position: absolute;
                     right: 0;
                     bottom: 18px
              }

              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .bell-icon[_ngcontent-aax-c246] .notif-block[_ngcontent-aax-c246],
              .app-header[_ngcontent-aax-c246] .right-feature[_ngcontent-aax-c246] .news-icon[_ngcontent-aax-c246] .notif-block[_ngcontent-aax-c246] {
                     width: 100%;
                     height: 100%;
                     position: absolute;
                     cursor: pointer;
                     z-index: 9
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] {
                     border-radius: 8px 8px 0 0;
                     position: relative;
                     max-width: 250px;
                     max-width: 145px;
                     min-width: 145px
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .profil-box[_ngcontent-aax-c246] {
                     border-radius: 8px 8px 0 0;
                     position: relative;
                     z-index: 3;
                     padding: 10px 0
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .profil-box[_ngcontent-aax-c246] .option-section[_ngcontent-aax-c246] {
                     overflow: hidden
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .profil-box[_ngcontent-aax-c246] .option-section[_ngcontent-aax-c246] .name[_ngcontent-aax-c246] {
                     color: var(--ion-color-dark);
                     margin-top: 3px;
                     white-space: nowrap
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .profil-box[_ngcontent-aax-c246] .option-section[_ngcontent-aax-c246] .job[_ngcontent-aax-c246] {
                     color: var(--ion-color-medium);
                     overflow: hidden;
                     display: inline-block;
                     text-overflow: ellipsis;
                     white-space: nowrap
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246]:not(.option-active) .name[_ngcontent-aax-c246] {
                     color: #fff !important
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] {
                     position: absolute;
                     top: 0;
                     left: -13px;
                     width: -webkit-fill-available;
                     background-color: var(--ion-color-light);
                     border-radius: 8px;
                     padding: 60px 0 12px;
                     z-index: 2;
                     transition: all .2s;
                     overflow: hidden;
                     min-width: 210px
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] {
                     max-height: 420px;
                     overflow-y: scroll;
                     padding: 0 8px 8px 16px;
                     background-color: var(--ion-color-light)
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section[_ngcontent-aax-c246] {
                     padding: 10px 0
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section[_ngcontent-aax-c246] img[_ngcontent-aax-c246] {
                     width: 24px;
                     object-fit: contain
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section[_ngcontent-aax-c246] p[_ngcontent-aax-c246] {
                     color: var(--ion-color-medium)
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section[_ngcontent-aax-c246] .remove-icon[_ngcontent-aax-c246] {
                     background: var(--gdx-color-light);
                     border-radius: 100px;
                     width: 30px;
                     min-width: 30px;
                     height: 30px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     opacity: 0;
                     transition: all .2s
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section[_ngcontent-aax-c246]:hover gd-comp-icon[_ngcontent-aax-c246] {
                     opacity: 1
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section[_ngcontent-aax-c246]:hover .remove-icon[_ngcontent-aax-c246] {
                     opacity: 1
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .remove-icon[_ngcontent-aax-c246]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .list-section.no-close[_ngcontent-aax-c246]>*[_ngcontent-aax-c246] {
                     pointer-events: none
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .border-vertikal[_ngcontent-aax-c246] {
                     border-top: 1px solid var(--gdx-color-outline);
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .border-top[_ngcontent-aax-c246] {
                     border-top: 1px solid var(--gdx-color-outline)
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .list-box[_ngcontent-aax-c246] .border-bottom[_ngcontent-aax-c246] {
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .company-label[_ngcontent-aax-c246] {
                     color: var(--ion-color-medium);
                     margin-bottom: 6px
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .company-wrap[_ngcontent-aax-c246] {
                     overflow: auto;
                     max-height: 180px;
                     margin-bottom: 16px
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .hide-content[_ngcontent-aax-c246] {
                     position: absolute;
                     top: 60px;
                     z-index: 0
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .show-content[_ngcontent-aax-c246] {
                     position: relative;
                     z-index: 9
              }

              .app-header[_ngcontent-aax-c246] .option-box[_ngcontent-aax-c246] .option-popover[_ngcontent-aax-c246] .fixed-content[_ngcontent-aax-c246] {
                     position: sticky;
                     top: 0;
                     background-color: var(--ion-color-light);
                     z-index: 9
              }

              .app-header[_ngcontent-aax-c246] .option-active[_ngcontent-aax-c246] {
                     box-shadow: 0 0 29px -8px #0000004d
              }

              .app-header[_ngcontent-aax-c246] .breadcrumb-header[_ngcontent-aax-c246] {
                     background: transparent;
                     height: 50px;
                     z-index: 1;
                     position: absolute;
                     top: 80px;
                     width: calc(100vw - 210px);
                     right: 0;
                     display: flex;
                     justify-content: flex-start;
                     align-items: center;
                     padding: 8px 16px
              }

              .app-header[_ngcontent-aax-c246] .beta[_ngcontent-aax-c246] {
                     position: relative
              }

              .app-header[_ngcontent-aax-c246] .beta[_ngcontent-aax-c246] app-news-popover[_ngcontent-aax-c246] {
                     position: absolute;
                     right: 0;
                     margin: 0 !important;
                     top: 50px;
                     z-index: 2;
                     background: var(--ion-color-light);
                     max-width: 523px;
                     width: 523px;
                     height: 391px;
                     border-radius: var(--gdx-border-radius) !important;
                     box-shadow: 0 0 29px -8px #0000004d;
                     overflow: hidden
              }

              @media screen and (max-width: 1280px) {
                     .app-header[_ngcontent-aax-c246] .menu-box[_ngcontent-aax-c246] .menu-button[_ngcontent-aax-c246] {
                            padding: 14px 6px
                     }

                     .beta[_ngcontent-aax-c246] span[_ngcontent-aax-c246] {
                            display: none
                     }

                     .beta[_ngcontent-aax-c246] gd-comp-icon[_ngcontent-aax-c246] {
                            margin-right: 8px !important
                     }
              }

              @media screen and (min-width: 768px) and (max-width: 920px) {
                     .menu-popover[_ngcontent-aax-c246] {
                            left: 130px !important
                     }

                     div#openNavBar[_ngcontent-aax-c246] {
                            margin-right: 0 !important
                     }
              }

              .no-close[_ngcontent-aax-c246]>*[_ngcontent-aax-c246] {
                     pointer-events: none
              }

              [_nghost-aax-c246] ion-searchbar.mobile-searchbar .searchbar-input-container {
                     height: 40px;
                     --color: var(--ion-color-ligth) !important;
                     color: var(--ion-color-ligth) !important
              }

              [_nghost-aax-c246] ion-searchbar.mobile-searchbar .searchbar-input-container input {
                     background: var(--gdx-color-bgfloor) !important;
                     border-radius: 100px !important;
                     font-size: 12px;
                     border: none !important;
                     padding: 5px 40px 5px 16px !important
              }

              .mobile-container[_ngcontent-aax-c246] ion-searchbar.mobile-searchbar[_ngcontent-aax-c246] {
                     padding: 0;
                     height: 40px;
                     color: var(--ion-color-dark) !important
              }

              .mobile-container[_ngcontent-aax-c246] .searchbar-container[_ngcontent-aax-c246] {
                     background: var(--gdx-color-bgcard) !important;
                     border-radius: 16px 16px 0 0;
                     position: fixed;
                     top: 0;
                     width: 100%;
                     z-index: 9
              }

              .mobile-container[_ngcontent-aax-c246] .title-container[_ngcontent-aax-c246] {
                     border-top: 1px solid var(--gdx-color-outline);
                     border-bottom: 1px solid var(--gdx-color-outline);
                     background: var(--gdx-color-bgcard) !important;
                     margin-top: 72px;
                     position: fixed;
                     z-index: 99;
                     width: 100%
              }

              .mobile-container[_ngcontent-aax-c246] .title-container[_ngcontent-aax-c246] h5[_ngcontent-aax-c246] {
                     margin: 0
              }

              .mobile-container[_ngcontent-aax-c246] .title-container[_ngcontent-aax-c246] .hr[_ngcontent-aax-c246] {
                     height: 16px;
                     width: 1px;
                     background: var(--gdx-color-outline)
              }

              .mobile-container[_ngcontent-aax-c246] .menu-container[_ngcontent-aax-c246] {
                     background-color: var(--gdx-color-bgfloor);
                     margin-top: 130px
              }

              .mobile-container[_ngcontent-aax-c246] .edit-fav[_ngcontent-aax-c246] {
                     margin-top: 335px !important
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu.favourite[_ngcontent-aax-c246] {
                     position: fixed;
                     z-index: 99;
                     width: 100%;
                     top: 130px
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] {
                     background: var(--gdx-color-bgcard);
                     margin-bottom: 16px
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] h5[_ngcontent-aax-c246] {
                     margin: 0
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .no-action[_ngcontent-aax-c246] {
                     pointer-events: none
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .hidden[_ngcontent-aax-c246] {
                     display: none
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] {
                     grid-template-columns: unset;
                     grid-gap: 0px;
                     max-height: 195px;
                     overflow: hidden;
                     transition: height .2s
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] {
                     align-items: flex-start;
                     border-bottom: 1px solid var(--gdx-color-outline);
                     padding: 14px 0
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] .menu-icon[_ngcontent-aax-c246] {
                     display: none !important
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] ion-label[_ngcontent-aax-c246] {
                     width: 100%;
                     display: flex;
                     justify-content: space-between
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] ion-label[_ngcontent-aax-c246] gd-comp-icon[_ngcontent-aax-c246] {
                     display: block !important
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246]:nth-child(1) {
                     border-bottom: 1px solid var(--gdx-color-outline) !important
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.view-list[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246]:last-child {
                     border-bottom: none
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.fav[_ngcontent-aax-c246] {
                     grid-template-columns: repeat(4, minmax(70px, 1fr));
                     display: flex !important;
                     overflow-x: auto
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.fav[_ngcontent-aax-c246] .empty-fav[_ngcontent-aax-c246] {
                     background: rgba(var(--ion-color-medium-rgb), .3);
                     width: 28px;
                     height: 28px;
                     border-radius: 100px;
                     outline: 7px solid rgba(var(--ion-color-medium-rgb), .1);
                     margin-top: 7px
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile.fav[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] {
                     width: 70px;
                     min-width: 70px;
                     min-height: 90px
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile[_ngcontent-aax-c246] {
                     margin-top: 16px;
                     display: grid !important;
                     grid-template-columns: repeat(4, minmax(70px, 1fr));
                     grid-gap: 16px
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] {
                     display: flex;
                     flex-direction: column;
                     justify-content: flex-start;
                     align-items: center;
                     text-align: center
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] ion-label[_ngcontent-aax-c246] {
                     word-break: break-word;
                     position: relative;
                     font-size: 12px !important
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] ion-label[_ngcontent-aax-c246] gd-comp-icon[_ngcontent-aax-c246] {
                     display: none !important
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] .add[_ngcontent-aax-c246] {
                     background: var(--ion-color-success);
                     border-radius: 100px;
                     width: 15px;
                     height: 15px;
                     display: flex;
                     align-items: center;
                     justify-content: center;
                     align-self: center
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-mobile[_ngcontent-aax-c246] .menu[_ngcontent-aax-c246] .add[_ngcontent-aax-c246] gd-comp-icon[_ngcontent-aax-c246] {
                     transform: translate(-1px, -1px)
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-icon[_ngcontent-aax-c246] {
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     position: relative;
                     width: 40px;
                     height: 40px
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-icon[_ngcontent-aax-c246] .menu-circle[_ngcontent-aax-c246] {
                     position: absolute;
                     top: 0;
                     left: 0;
                     width: 40px;
                     height: 40px;
                     border-radius: 100px;
                     opacity: .25
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-icon[_ngcontent-aax-c246] .add[_ngcontent-aax-c246] {
                     position: absolute;
                     top: 0;
                     left: 0;
                     z-index: 2
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-icon[_ngcontent-aax-c246] .minus[_ngcontent-aax-c246] {
                     background: var(--ion-color-danger);
                     border-radius: 100px;
                     width: 15px;
                     height: 15px;
                     position: absolute;
                     top: 0;
                     left: 0;
                     z-index: 9;
                     display: flex;
                     align-items: center;
                     justify-content: center
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .menu-icon[_ngcontent-aax-c246] .minus[_ngcontent-aax-c246] gd-comp-icon[_ngcontent-aax-c246] {
                     transform: translate(-1px, -1px)
              }

              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .mini[_ngcontent-aax-c246],
              .mobile-container[_ngcontent-aax-c246] .section-menu[_ngcontent-aax-c246] .mini[_ngcontent-aax-c246] .menu-circle[_ngcontent-aax-c246] {
                     width: 24px;
                     height: 24px
              }
       </style>
       <style>
              svg-icon[_ngcontent-aax-c125] {
                     display: flex
              }

              .sficon-upload-machine[_ngcontent-aax-c125]:before {
                     content: "\e98a"
              }

              .sficon-announcesort[_ngcontent-aax-c125]:before {
                     content: "\e900"
              }

              .sficon-ask[_ngcontent-aax-c125]:before {
                     content: "\e901"
              }

              .sficon-backward[_ngcontent-aax-c125]:before {
                     content: "\e902"
              }

              .sficon-barcode[_ngcontent-aax-c125]:before {
                     content: "\e903"
              }

              .sficon-benefit[_ngcontent-aax-c125]:before {
                     content: "\e98b"
              }

              .sficon-briefcase[_ngcontent-aax-c125]:before {
                     content: "\e904"
              }

              .sficon-briefcasetime[_ngcontent-aax-c125]:before {
                     content: "\e905"
              }

              .sficon-businesstrip[_ngcontent-aax-c125]:before {
                     content: "\e906"
              }

              .sficon-businesstripdec[_ngcontent-aax-c125]:before {
                     content: "\e907"
              }

              .sficon-businesstype[_ngcontent-aax-c125]:before {
                     content: "\e908"
              }

              .sficon-calendar[_ngcontent-aax-c125]:before {
                     content: "\e909"
              }

              .sficon-calendar2[_ngcontent-aax-c125]:before {
                     content: "\e90a"
              }

              .sficon-calendar3[_ngcontent-aax-c125]:before {
                     content: "\e90b"
              }

              .sficon-calendarsingle[_ngcontent-aax-c125]:before {
                     content: "\e90c"
              }

              .sficon-call[_ngcontent-aax-c125]:before {
                     content: "\e90d"
              }

              .sficon-camera[_ngcontent-aax-c125]:before {
                     content: "\e90e"
              }

              .sficon-car[_ngcontent-aax-c125]:before {
                     content: "\e98c"
              }

              .sficon-carddetail[_ngcontent-aax-c125]:before {
                     content: "\e90f"
              }

              .sficon-carddetail2[_ngcontent-aax-c125]:before {
                     content: "\e910"
              }

              .sficon-cardemployee[_ngcontent-aax-c125]:before {
                     content: "\e911"
              }

              .sficon-chart[_ngcontent-aax-c125]:before {
                     content: "\e912"
              }

              .sficon-chat[_ngcontent-aax-c125]:before {
                     content: "\e913"
              }

              .sficon-chatsort[_ngcontent-aax-c125]:before {
                     content: "\e914"
              }

              .sficon-checkdouble[_ngcontent-aax-c125]:before {
                     content: "\e915"
              }

              .sficon-checksingle[_ngcontent-aax-c125]:before {
                     content: "\e916"
              }

              .sficon-clip[_ngcontent-aax-c125]:before {
                     content: "\e917"
              }

              .sficon-clock[_ngcontent-aax-c125]:before {
                     content: "\e918"
              }

              .sficon-clock2[_ngcontent-aax-c125]:before {
                     content: "\e919"
              }

              .sficon-clockbackground[_ngcontent-aax-c125]:before {
                     content: "\e91a"
              }

              .sficon-clockdash[_ngcontent-aax-c125]:before {
                     content: "\e91b"
              }

              .sficon-close[_ngcontent-aax-c125]:before {
                     content: "\e91c"
              }

              .sficon-coin[_ngcontent-aax-c125]:before {
                     content: "\e91d"
              }

              .sficon-comment[_ngcontent-aax-c125]:before {
                     content: "\e91e"
              }

              .sficon-company[_ngcontent-aax-c125]:before {
                     content: "\e91f"
              }

              .sficon-email[_ngcontent-aax-c125]:before {
                     content: "\e920"
              }

              .sficon-email2[_ngcontent-aax-c125]:before {
                     content: "\e921"
              }

              .sficon-employeperson[_ngcontent-aax-c125]:before {
                     content: "\e922"
              }

              .sficon-exit[_ngcontent-aax-c125]:before {
                     content: "\e923"
              }

              .sficon-fillask[_ngcontent-aax-c125]:before {
                     content: "\e924"
              }

              .sficon-fillasksort[_ngcontent-aax-c125]:before {
                     content: "\e925"
              }

              .sficon-fingerprint[_ngcontent-aax-c125]:before {
                     content: "\e926"
              }

              .sficon-flag[_ngcontent-aax-c125]:before {
                     content: "\e927"
              }

              .sficon-flagfill[_ngcontent-aax-c125]:before {
                     content: "\e928"
              }

              .sficon-forward[_ngcontent-aax-c125]:before {
                     content: "\e929"
              }

              .sficon-home[_ngcontent-aax-c125]:before {
                     content: "\e92a"
              }

              .sficon-house[_ngcontent-aax-c125]:before {
                     content: "\e98d"
              }

              .sficon-idcard[_ngcontent-aax-c125]:before {
                     content: "\e92b"
              }

              .sficon-information[_ngcontent-aax-c125]:before {
                     content: "\e92c"
              }

              .sficon-key[_ngcontent-aax-c125]:before {
                     content: "\e92d"
              }

              .sficon-kpi[_ngcontent-aax-c125]:before {
                     content: "\e92e"
              }

              .sficon-leftfill[_ngcontent-aax-c125]:before {
                     content: "\e92f"
              }

              .sficon-love[_ngcontent-aax-c125]:before {
                     content: "\e930"
              }

              .sficon-lovefill[_ngcontent-aax-c125]:before {
                     content: "\e931"
              }

              .sficon-magnifier[_ngcontent-aax-c125]:before {
                     content: "\e932"
              }

              .sficon-menu[_ngcontent-aax-c125]:before {
                     content: "\e933"
              }

              .sficon-molamola[_ngcontent-aax-c125]:before {
                     content: "\e934"
              }

              .sficon-music[_ngcontent-aax-c125]:before {
                     content: "\e935"
              }

              .sficon-notificationsort[_ngcontent-aax-c125]:before {
                     content: "\e936"
              }

              .sficon-orgchart[_ngcontent-aax-c125]:before {
                     content: "\e937"
              }

              .sficon-peopleadd[_ngcontent-aax-c125]:before {
                     content: "\e938"
              }

              .sficon-person[_ngcontent-aax-c125]:before {
                     content: "\e939"
              }

              .sficon-persontime[_ngcontent-aax-c125]:before {
                     content: "\e93a"
              }

              .sficon-phone[_ngcontent-aax-c125]:before {
                     content: "\e93b"
              }

              .sficon-phone2[_ngcontent-aax-c125]:before {
                     content: "\e93c"
              }

              .sficon-pigmoney[_ngcontent-aax-c125]:before {
                     content: "\e93d"
              }

              .sficon-placeholder[_ngcontent-aax-c125]:before {
                     content: "\e93e"
              }

              .sficon-placeholder2[_ngcontent-aax-c125]:before {
                     content: "\e93f"
              }

              .sficon-playbutton[_ngcontent-aax-c125]:before {
                     content: "\e940"
              }

              .sficon-plusadd[_ngcontent-aax-c125]:before {
                     content: "\e941"
              }

              .sficon-rightfill[_ngcontent-aax-c125]:before {
                     content: "\e942"
              }

              .sficon-roundannounce[_ngcontent-aax-c125]:before {
                     content: "\e943"
              }

              .sficon-roundcamera[_ngcontent-aax-c125]:before {
                     content: "\e944"
              }

              .sficon-roundchat[_ngcontent-aax-c125]:before {
                     content: "\e945"
              }

              .sficon-rounddash[_ngcontent-aax-c125]:before {
                     content: "\e946"
              }

              .sficon-roundfillask[_ngcontent-aax-c125]:before {
                     content: "\e947"
              }

              .sficon-roundorg[_ngcontent-aax-c125]:before {
                     content: "\e948"
              }

              .sficon-search[_ngcontent-aax-c125]:before {
                     content: "\e949"
              }

              .sficon-search2[_ngcontent-aax-c125]:before {
                     content: "\e94a"
              }

              .sficon-sent[_ngcontent-aax-c125]:before {
                     content: "\e94b"
              }

              .sficon-setting[_ngcontent-aax-c125]:before {
                     content: "\e94c"
              }

              .sficon-shiftschedule[_ngcontent-aax-c125]:before {
                     content: "\e94d"
              }

              .sficon-star[_ngcontent-aax-c125]:before {
                     content: "\e94e"
              }

              .sficon-starfill[_ngcontent-aax-c125]:before {
                     content: "\e94f"
              }

              .sficon-target[_ngcontent-aax-c125]:before {
                     content: "\e950"
              }

              .sficon-taskcomplete[_ngcontent-aax-c125]:before {
                     content: "\e951"
              }

              .sficon-taskdone[_ngcontent-aax-c125]:before {
                     content: "\e952"
              }

              .sficon-tasktime[_ngcontent-aax-c125]:before {
                     content: "\e953"
              }

              .sficon-taskwrite[_ngcontent-aax-c125]:before {
                     content: "\e954"
              }

              .sficon-top[_ngcontent-aax-c125]:before {
                     content: "\e955"
              }

              .sficon-trash[_ngcontent-aax-c125]:before {
                     content: "\e956"
              }

              .sficon-travel[_ngcontent-aax-c125]:before {
                     content: "\e957"
              }

              .sficon-turning[_ngcontent-aax-c125]:before {
                     content: "\e958"
              }

              .sficon-turningfill[_ngcontent-aax-c125]:before {
                     content: "\e959"
              }

              .sficon-undo[_ngcontent-aax-c125]:before {
                     content: "\e95a"
              }

              .sficon-video[_ngcontent-aax-c125]:before {
                     content: "\e95b"
              }

              .sficon-wallet[_ngcontent-aax-c125]:before {
                     content: "\e95c"
              }

              .sficon-devicepin[_ngcontent-aax-c125]:before {
                     content: "\e95d"
              }

              .sficon-language[_ngcontent-aax-c125]:before {
                     content: "\e95e"
              }

              .sficon-notifsetting[_ngcontent-aax-c125]:before {
                     content: "\e95f"
              }

              .sficon-viewoffline[_ngcontent-aax-c125]:before {
                     content: "\e960"
              }

              .sficon-component[_ngcontent-aax-c125]:before {
                     content: "\e961"
              }

              .sficon-download[_ngcontent-aax-c125]:before {
                     content: "\e962"
              }

              .sficon-payprocess[_ngcontent-aax-c125]:before {
                     content: "\e963"
              }

              .sficon-payrolldata[_ngcontent-aax-c125]:before {
                     content: "\e964"
              }

              .sficon-payschedule[_ngcontent-aax-c125]:before {
                     content: "\e965"
              }

              .sficon-tappayslipin[_ngcontent-aax-c125]:before {
                     content: "\e966"
              }

              .sficon-tappayslipout[_ngcontent-aax-c125]:before {
                     content: "\e967"
              }

              .sficon-upload[_ngcontent-aax-c125]:before {
                     content: "\e968"
              }

              .sficon-wizard[_ngcontent-aax-c125]:before {
                     content: "\e969"
              }

              .sficon-write[_ngcontent-aax-c125]:before {
                     content: "\e96a"
              }

              .sficon-people[_ngcontent-aax-c125]:before {
                     content: "\e96b"
              }

              .sficon-placeholderwrong[_ngcontent-aax-c125]:before {
                     content: "\e96c"
              }

              .sficon-sort[_ngcontent-aax-c125]:before {
                     content: "\e96d"
              }

              .sficon-addminute[_ngcontent-aax-c125]:before {
                     content: "\e96e"
              }

              .sficon-changehr[_ngcontent-aax-c125]:before {
                     content: "\e96f"
              }

              .sficon-changeprivacy[_ngcontent-aax-c125]:before {
                     content: "\e970"
              }

              .sficon-configuredata[_ngcontent-aax-c125]:before {
                     content: "\e971"
              }

              .sficon-roundfull[_ngcontent-aax-c125]:before {
                     content: "\e972"
              }

              .sficon-roundhalfleft[_ngcontent-aax-c125]:before {
                     content: "\e973"
              }

              .sficon-roundhalfright[_ngcontent-aax-c125]:before {
                     content: "\e974"
              }

              .sficon-shiftpattern[_ngcontent-aax-c125]:before {
                     content: "\e975"
              }

              .sficon-sales[_ngcontent-aax-c125]:before {
                     content: "\e976"
              }

              .sficon-purchase[_ngcontent-aax-c125]:before {
                     content: "\e977"
              }

              .sficon-customer[_ngcontent-aax-c125]:before {
                     content: "\e978"
              }

              .sficon-marketplace[_ngcontent-aax-c125]:before {
                     content: "\e979"
              }

              .sficon-taskfeedback[_ngcontent-aax-c125]:before {
                     content: "\e97a"
              }

              .sficon-elearning[_ngcontent-aax-c125]:before {
                     content: "\e97b"
              }

              .sficon-eyeoff[_ngcontent-aax-c125]:before {
                     content: "\e97c"
              }

              .sficon-eyeon[_ngcontent-aax-c125]:before {
                     content: "\e97d"
              }

              .sficon-bookmark[_ngcontent-aax-c125]:before {
                     content: "\e97e"
              }

              .sficon-doc[_ngcontent-aax-c125]:before {
                     content: "\e97f"
              }

              .sficon-list[_ngcontent-aax-c125]:before {
                     content: "\e980"
              }

              .sficon-pdf[_ngcontent-aax-c125]:before {
                     content: "\e981"
              }

              .sficon-ppt[_ngcontent-aax-c125]:before {
                     content: "\e982"
              }

              .sficon-swf[_ngcontent-aax-c125]:before {
                     content: "\e983"
              }

              .sficon-zxvideo[_ngcontent-aax-c125]:before {
                     content: "\e984"
              }

              .sficon-xls[_ngcontent-aax-c125]:before {
                     content: "\e985"
              }

              .sficon-changeaccess[_ngcontent-aax-c125]:before {
                     content: "\e986"
              }

              .sficon-showmap[_ngcontent-aax-c125]:before {
                     content: "\e987"
              }

              .sficon-scales[_ngcontent-aax-c125]:before {
                     content: "\e988"
              }

              .sficon-survey[_ngcontent-aax-c125]:before {
                     content: "\e989"
              }
       </style>
       <style>
              image-component[_ngcontent-aax-c189] {
                     height: 100%;
                     width: 100%;
                     display: flex
              }

              [_nghost-aax-c189] image-component img {
                     border-radius: 200px;
                     width: 100%;
                     height: 100%;
                     object-fit: cover;
                     object-position: top
              }
       </style>
       <style>
              ion-button[_ngcontent-aax-c130] {
                     --box-shadow: none;
                     --border-radius: var(--gdx-border-radius);
                     min-width: 95px
              }

              .radius-progress[_ngcontent-aax-c130] {
                     --border-radius: 0 0 var(--gdx-border-radius) var(--gdx-border-radius);
                     margin-top: 0 !important
              }

              .progress-bar[_ngcontent-aax-c130] {
                     border-radius: var(--gdx-border-radius) var(--gdx-border-radius) 0 0;
                     margin: 0 auto;
                     width: calc(100% - 4px);
                     height: 7px;
                     background-color: #e5e9eb;
                     overflow: hidden
              }

              .progress-bar[_ngcontent-aax-c130] .progress-section[_ngcontent-aax-c130] {
                     height: 100%;
                     background-color: #a5b0b7;
                     transition: all .2s ease
              }

              ion-icon[_ngcontent-aax-c130] {
                     margin-left: 5px
              }

              svg-icon[_ngcontent-aax-c130] {
                     margin-left: 5px
              }

              .white[_ngcontent-aax-c130] {
                     color: #fff !important
              }

              .disabled-text[_ngcontent-aax-c130] {
                     color: #f0f2f4 !important
              }

              span.text[_ngcontent-aax-c130] {
                     display: flex;
                     align-items: center;
                     text-transform: none;
                     white-space: normal;
                     font-weight: 700;
                     font-family: Sans-Regular !important
              }

              [_nghost-aax-c130] ion-button.icon-only {
                     --padding-start: 0;
                     --padding-end: 0;
                     min-width: 36px !important
              }

              [_nghost-aax-c130] ion-button.icon-only svg-icon {
                     margin: 0 !important
              }

              [_nghost-aax-c130] ion-button.icon-only gdx-icon {
                     margin: 0 !important
              }

              ion-button[_ngcontent-aax-c130]::part(native) {
                     transition: all .2s;
                     overflow: visible !important
              }

              ion-button[fill=clear][_ngcontent-aax-c130]:hover::part(native) {
                     background: var(--gdx-color-bghover)
              }

              ion-button[fill=outline][_ngcontent-aax-c130]::part(native) {
                     border-color: var(--gdx-color-outline) !important
              }

              .progress-detail[_ngcontent-aax-c130] ion-label[_ngcontent-aax-c130] {
                     text-transform: lowercase !important
              }

              ion-button.button-disabled[_ngcontent-aax-c130] {
                     opacity: .8 !important
              }

              ion-button.disabled-btn[_ngcontent-aax-c130]::part(native) {
                     background-color: var(--ion-color-light-mode) !important;
                     color: var(--ion-color-medium) !important;
                     font-family: Sans-Regular !important
              }

              .list-box[_ngcontent-aax-c130] {
                     border-radius: 4px;
                     overflow: hidden
              }

              .list-box[_ngcontent-aax-c130] .list-section[_ngcontent-aax-c130] {
                     border-bottom: 1px solid var(--gdx-color-outline);
                     padding: 8px 16px
              }

              .list-box[_ngcontent-aax-c130] .list-section[_ngcontent-aax-c130]:hover {
                     cursor: pointer;
                     background-color: #0000000d
              }

              .list-box[_ngcontent-aax-c130] .list-section[_ngcontent-aax-c130]:last-child {
                     border-bottom: none !important
              }
       </style>
       <style>
              .app-breadcrumb[_ngcontent-aax-c245] {
                     display: none
              }

              .home-box[_ngcontent-aax-c245] {
                     margin-right: 5px
              }

              .home-box[_ngcontent-aax-c245] ion-label[_ngcontent-aax-c245] {
                     cursor: pointer;
                     border-bottom: 1px solid transparent
              }

              .home-box[_ngcontent-aax-c245] ion-label[_ngcontent-aax-c245]:hover {
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              @media only screen and (min-width: 768px) {
                     .app-breadcrumb[_ngcontent-aax-c245] {
                            display: flex !important
                     }
              }

              svg-icon[_ngcontent-aax-c245] {
                     width: 18px;
                     height: 18px
              }

              svg-icon[_ngcontent-aax-c245] path[_ngcontent-aax-c245] {
                     stroke: var(--ion-color-medium)
              }
       </style>
       <style>
              .avatar[_ngcontent-aax-c137] {
                     position: relative;
                     width: 40px;
                     height: 40px;
                     border-radius: 200px
              }

              .avatar[_ngcontent-aax-c137] .on-present[_ngcontent-aax-c137] {
                     border: 2px solid var(--ion-color-success) !important;
                     padding: 2px !important
              }

              .avatar[_ngcontent-aax-c137] .on-leave[_ngcontent-aax-c137] {
                     border: 2px solid var(--ion-color-danger) !important;
                     padding: 2px !important
              }

              .avatar[_ngcontent-aax-c137] ion-avatar[_ngcontent-aax-c137] {
                     margin-right: 0 !important;
                     border-radius: 200px;
                     width: 100%;
                     height: 100%;
                     padding: 0 !important;
                     border: 0px !important
              }

              .avatar[_ngcontent-aax-c137] ion-avatar[_ngcontent-aax-c137] img[_ngcontent-aax-c137],
              .avatar[_ngcontent-aax-c137] ion-avatar[_ngcontent-aax-c137] lazy-img[_ngcontent-aax-c137] {
                     width: 100% !important;
                     height: 100% !important;
                     object-fit: cover;
                     object-position: 50% 20%
              }

              .avatar[_ngcontent-aax-c137] ion-avatar[_ngcontent-aax-c137] .empty-state[_ngcontent-aax-c137] {
                     background-color: #e2e9ed;
                     border-radius: 200px;
                     width: 100%;
                     height: 100%
              }

              .avatar[_ngcontent-aax-c137] ion-avatar[_ngcontent-aax-c137] .empty-state[_ngcontent-aax-c137] p[_ngcontent-aax-c137] {
                     color: #a5b0b7;
                     font-size: 18px;
                     font-weight: 600;
                     text-transform: capitalize
              }

              .avatar[_ngcontent-aax-c137] .favourite[_ngcontent-aax-c137] {
                     position: absolute;
                     right: -4px;
                     top: -3px
              }

              .avatar[_ngcontent-aax-c137] .favourite[_ngcontent-aax-c137] ion-icon[_ngcontent-aax-c137] {
                     font-size: 17px
              }

              .avatar[_ngcontent-aax-c137] .favourite[_ngcontent-aax-c137] img[_ngcontent-aax-c137] {
                     width: 17px;
                     height: 17px
              }

              .avatar[_ngcontent-aax-c137] .favourite.large-fav[_ngcontent-aax-c137] {
                     right: -4px !important;
                     top: -2px !important
              }

              .avatar[_ngcontent-aax-c137] .favourite.large-fav[_ngcontent-aax-c137] svg[_ngcontent-aax-c137] {
                     width: 23px;
                     height: 23px
              }

              .avatar[_ngcontent-aax-c137] .favourite.mini-fav[_ngcontent-aax-c137] {
                     right: -4px !important;
                     top: -4px !important
              }

              .avatar[_ngcontent-aax-c137] .favourite.mini-fav[_ngcontent-aax-c137] svg[_ngcontent-aax-c137] {
                     width: 16px;
                     height: 16px
              }

              .avatar[_ngcontent-aax-c137] .achievement[_ngcontent-aax-c137] {
                     position: absolute;
                     bottom: -10px;
                     right: -10px
              }

              .avatar[_ngcontent-aax-c137] .achievement[_ngcontent-aax-c137] ion-icon[_ngcontent-aax-c137] {
                     font-size: 50px
              }

              .extra-large[_ngcontent-aax-c137] {
                     width: 80px !important;
                     height: 80px !important
              }

              .huge[_ngcontent-aax-c137] {
                     width: 100px !important;
                     height: 100px !important
              }

              .large[_ngcontent-aax-c137] {
                     width: 46px !important;
                     height: 46px !important
              }

              .medium[_ngcontent-aax-c137] {
                     width: 32px !important;
                     height: 32px !important
              }

              .medium[_ngcontent-aax-c137] .on-present[_ngcontent-aax-c137] {
                     padding: 1px !important
              }

              .mini[_ngcontent-aax-c137] {
                     width: 22px !important;
                     height: 22px !important
              }

              .mini[_ngcontent-aax-c137] .on-present[_ngcontent-aax-c137] {
                     padding: 1px !important
              }

              .skeleton[_ngcontent-aax-c137] .skeleton-avatar[_ngcontent-aax-c137] {
                     width: 40px;
                     height: 40px;
                     border-radius: 200px
              }
       </style>
       <style>
              .photo-profile[_ngcontent-aax-c188] {
                     width: 100%;
                     height: 100%;
                     object-fit: cover;
                     object-position: top
              }
       </style>
       <style>
              .xng-breadcrumb-root {
                     color: rgba(0, 0, 0, .6);
                     margin: 0
              }

              .xng-breadcrumb-list {
                     align-items: center;
                     display: flex;
                     flex-wrap: wrap;
                     margin: 0;
                     padding: 0
              }

              .xng-breadcrumb-item {
                     list-style: none
              }

              .xng-breadcrumb-trail {
                     align-items: center;
                     color: rgba(0, 0, 0, .9);
                     display: flex
              }

              .xng-breadcrumb-link {
                     align-items: center;
                     color: inherit;
                     cursor: pointer;
                     display: flex;
                     text-decoration: none;
                     transition: -webkit-text-decoration .3s;
                     transition: text-decoration .3s;
                     transition: text-decoration .3s, -webkit-text-decoration .3s;
                     white-space: nowrap
              }

              .xng-breadcrumb-link:hover {
                     text-decoration: underline
              }

              .xng-breadcrumb-link-disabled {
                     cursor: disabled;
                     pointer-events: none
              }

              .xng-breadcrumb-separator {
                     -moz-user-select: none;
                     -ms-user-select: none;
                     -webkit-user-select: none;
                     display: flex;
                     margin-left: 8px;
                     margin-right: 8px;
                     user-select: none
              }
       </style>
       <style>
              @media only screen and (min-width: 768px) {
                     .col-body[_ngcontent-aax-c250] {
                            border-bottom: 0px solid var(--ion-color-light-shade) !important;
                            padding: 0 !important
                     }

                     .col-body[_ngcontent-aax-c250] .col-body-user-notification[_ngcontent-aax-c250] {
                            display: none !important
                     }
              }

              .col-body[_ngcontent-aax-c250] {
                     border-bottom: 1px solid var(--ion-color-light-shade);
                     background: var(--gdx-color-bgcard);
                     padding: 16px;
                     margin-bottom: 8px;
                     border-bottom: 0px solid var(--ion-color-light-shade)
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] {
                     padding: 15px 0
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .col-body-user-photo[_ngcontent-aax-c250] {
                     margin-right: 10px
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .col-body-user-info[_ngcontent-aax-c250] {
                     width: 100%;
                     overflow: hidden
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .col-body-user-notification[_ngcontent-aax-c250] {
                     position: relative;
                     display: block
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .col-body-user-notification[_ngcontent-aax-c250] .dot-notif[_ngcontent-aax-c250] {
                     width: 8px;
                     height: 8px;
                     border-radius: 100px;
                     background-color: var(--ion-color-danger);
                     position: absolute;
                     right: 3px;
                     top: 3px
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] {
                     width: 100%
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] {
                     width: 100%;
                     margin-bottom: 12px;
                     justify-content: center;
                     align-items: center
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] app-avatar[_ngcontent-aax-c250] {
                     margin-right: 12px
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] .info-box[_ngcontent-aax-c250] {
                     margin-right: 16px
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] .info-box[_ngcontent-aax-c250] .skeleton-line1[_ngcontent-aax-c250] {
                     width: 100%;
                     height: 10px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] .info-box[_ngcontent-aax-c250] .skeleton-line2[_ngcontent-aax-c250] {
                     width: 50%;
                     height: 10px;
                     border-radius: 4px;
                     margin-bottom: 5px
              }

              .col-body[_ngcontent-aax-c250] .col-body-user[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] .button[_ngcontent-aax-c250] .skeleton-button[_ngcontent-aax-c250] {
                     width: 30px;
                     height: 30px;
                     border-radius: 10px
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] {
                     border-radius: var(--gdx-border-radius);
                     border: 1px solid var(--ion-color-light-shade);
                     margin: 30px 0;
                     padding: 15px
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .start-time[_ngcontent-aax-c250] {
                     text-align: center
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .start-time[_ngcontent-aax-c250] h4[_ngcontent-aax-c250] {
                     color: var(--ion-color-success);
                     font-weight: 700
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .devider[_ngcontent-aax-c250] {
                     border-right: 1px solid var(--ion-color-light-shade);
                     height: 50px;
                     align-self: center
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .end-time[_ngcontent-aax-c250] {
                     text-align: center
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .end-time[_ngcontent-aax-c250] h4[_ngcontent-aax-c250] {
                     color: var(--ion-color-danger);
                     font-weight: 700
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] {
                     width: 100%
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] {
                     width: 100%;
                     margin-top: 10px;
                     margin-bottom: 12px;
                     justify-content: center;
                     align-items: center
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] .info-box[_ngcontent-aax-c250] {
                     margin: 0 auto !important
              }

              .col-body[_ngcontent-aax-c250] .col-body-atendance[_ngcontent-aax-c250] .skeleton-userinfo[_ngcontent-aax-c250] .skeleton-box[_ngcontent-aax-c250] .info-box[_ngcontent-aax-c250] .skeleton-line1[_ngcontent-aax-c250] {
                     height: 10px;
                     width: 100%;
                     border-radius: 4px;
                     margin-bottom: 5px
              }
       </style>
       <style>
              @keyframes hilightAnimate {
                     0% {
                            background: rgba(255, 171, 0, .3)
                     }

                     30% {
                            background: rgba(255, 171, 0, .1)
                     }

                     60% {
                            background: rgba(255, 171, 0, .1)
                     }

                     to {
                            background: rgba(255, 171, 0, 0)
                     }
              }

              .warning-card[_ngcontent-aax-c230] {
                     background-color: rgba(var(--ion-color-warning-rgb), .2);
                     padding: 15px 20px;
                     margin: 18px 10px;
                     border-radius: 8px
              }

              .warning-card[_ngcontent-aax-c230] .button[_ngcontent-aax-c230] {
                     width: 100%
              }

              .warning-card[_ngcontent-aax-c230] .button[_ngcontent-aax-c230] gd-comp-button[_ngcontent-aax-c230] {
                     width: 100%
              }

              ion-label[_ngcontent-aax-c230] {
                     display: block
              }

              .padding-all[_ngcontent-aax-c230] {
                     padding: 16px
              }

              .no-padding[_ngcontent-aax-c230] {
                     padding: 0 !important
              }

              .view-more-label[_ngcontent-aax-c230] {
                     text-align: center;
                     padding: 16px
              }

              .view-more-label[_ngcontent-aax-c230]:hover {
                     background-color: var(--gdx-color-bghover)
              }

              .transitions[_ngcontent-aax-c230] {
                     transition: transform .4s
              }

              .rotation[_ngcontent-aax-c230] {
                     transform: rotate(180deg)
              }

              .rotate60[_ngcontent-aax-c230] {
                     transform: rotate(90deg)
              }

              .time-slider[_ngcontent-aax-c230] {
                     background-color: var(--gdx-color-bgcard);
                     border-radius: 8px;
                     border: 1px solid var(--ion-color-light-shade);
                     overflow: hidden
              }

              .no-border-top[_ngcontent-aax-c230] {
                     border-top: unset !important
              }

              .time-slider-row[_ngcontent-aax-c230] {
                     display: flex;
                     flex-direction: row;
                     align-items: center
              }

              .time-slider-row[_ngcontent-aax-c230] .time-box[_ngcontent-aax-c230] {
                     margin-right: 16px;
                     flex: 1 1 auto
              }

              .option-box[_ngcontent-aax-c230] {
                     cursor: pointer;
                     border-radius: 2px
              }

              .option-box[_ngcontent-aax-c230]:hover {
                     background-color: rgba(var(--ion-color-medium-rgb), .1)
              }

              .time-item[_ngcontent-aax-c230],
              .time-element[_ngcontent-aax-c230] {
                     flex-wrap: wrap
              }

              .devider[_ngcontent-aax-c230] {
                     width: 1px;
                     background-color: var(--ion-color-light-shade);
                     height: 40px;
                     margin-left: 16px !important;
                     margin-right: 16px !important
              }

              .avatar-box[_ngcontent-aax-c230] {
                     position: relative
              }

              .avatar-box[_ngcontent-aax-c230] .coffee-box[_ngcontent-aax-c230] {
                     width: 14px;
                     height: 14px;
                     border-radius: 200px;
                     position: absolute;
                     bottom: 7px;
                     right: -3px;
                     background-color: var(--gdx-color-bgcard)
              }

              .time-box[_ngcontent-aax-c230] .time-head-detail[_ngcontent-aax-c230] {
                     padding: 12px 16px;
                     text-align: left;
                     cursor: pointer
              }

              .time-box[_ngcontent-aax-c230] .time-head-detail[_ngcontent-aax-c230]:hover {
                     background-color: rgba(var(--ion-color-medium-rgb), .1)
              }

              .time-box[_ngcontent-aax-c230] .icon-box[_ngcontent-aax-c230] {
                     position: relative
              }

              .time-box[_ngcontent-aax-c230] .icon-box[_ngcontent-aax-c230] .hover-box[_ngcontent-aax-c230] {
                     visibility: hidden;
                     opacity: 0;
                     position: absolute;
                     top: 100%;
                     left: 0;
                     z-index: 22;
                     width: 230px;
                     border-radius: 4px;
                     background-color: var(--gdx-color-bgcard);
                     box-shadow: 0 2px 8px #00000026
              }

              .time-box[_ngcontent-aax-c230] .icon-box[_ngcontent-aax-c230]:hover .hover-box[_ngcontent-aax-c230] {
                     visibility: visible;
                     opacity: 1;
                     z-index: 2
              }

              .time-box[_ngcontent-aax-c230] .icon-box.endtime[_ngcontent-aax-c230]:hover .hover-box[_ngcontent-aax-c230] {
                     visibility: visible;
                     opacity: 1;
                     z-index: 2;
                     right: 0;
                     left: unset
              }

              .time-box[_ngcontent-aax-c230] .devider2[_ngcontent-aax-c230] {
                     width: 1px;
                     background-color: var(--ion-color-light-shade);
                     height: 14px;
                     margin-left: 8px !important;
                     margin-right: 8px !important
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] ion-label.padding[_ngcontent-aax-c230] {
                     padding: 8px 16px
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-bottom-detail[_ngcontent-aax-c230] {
                     border-top: 1px solid var(--gdx-color-outline);
                     border-bottom: 0px solid var(--gdx-color-outline);
                     padding: 12px 16px;
                     background-color: var(--gdx-color-bgfloor);
                     position: relative;
                     z-index: 9
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] {
                     padding: 8px 0 0
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .log-title[_ngcontent-aax-c230] {
                     padding: 0 16px
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .line[_ngcontent-aax-c230] {
                     height: 1px;
                     background-color: var(--gdx-color-outline)
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .hilight[_ngcontent-aax-c230] {
                     background: var(--gdx-color-bgcard);
                     animation: hilightAnimate 2s ease
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .log-list[_ngcontent-aax-c230] {
                     padding: 10px 16px;
                     cursor: pointer
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .log-list[_ngcontent-aax-c230] .border-wrapper[_ngcontent-aax-c230] {
                     padding-bottom: 10px;
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .log-list[_ngcontent-aax-c230] .border-wrapper[_ngcontent-aax-c230] ion-chip[_ngcontent-aax-c230] {
                     padding: 4px 8px
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .log-list[_ngcontent-aax-c230]:hover {
                     background-color: var(--gdx-color-bghover)
              }

              .time-box[_ngcontent-aax-c230] .log-head[_ngcontent-aax-c230] .log-body[_ngcontent-aax-c230] .icon[_ngcontent-aax-c230] {
                     padding-left: 10px;
                     border-left: 1px solid var(--gdx-color-outline)
              }

              .time-box[_ngcontent-aax-c230] .time-head[_ngcontent-aax-c230] {
                     background-color: var(--gdx-color-bgfloor);
                     border-radius: 4px 4px 0 0
              }

              .time-box[_ngcontent-aax-c230] .time-head[_ngcontent-aax-c230] ion-label[_ngcontent-aax-c230] {
                     text-align: left !important
              }

              .time-box[_ngcontent-aax-c230] .time-head[_ngcontent-aax-c230] .time-complete[_ngcontent-aax-c230] {
                     color: #1a73e8 !important
              }

              .time-box[_ngcontent-aax-c230] .time-head[_ngcontent-aax-c230] ion-icon[_ngcontent-aax-c230] {
                     font-size: 16px !important
              }

              .time-box[_ngcontent-aax-c230] .attendance[_ngcontent-aax-c230] .img-box[_ngcontent-aax-c230] {
                     margin-right: 8px;
                     width: 32px;
                     height: 32px;
                     border-radius: 200px;
                     overflow: hidden
              }

              .time-box[_ngcontent-aax-c230] .attendance[_ngcontent-aax-c230] .img-box[_ngcontent-aax-c230] gd-comp-avatar .avatar {
                     width: 32px !important;
                     height: 32px !important
              }

              .time-box[_ngcontent-aax-c230] .attendance[_ngcontent-aax-c230] .img-box[_ngcontent-aax-c230] img[_ngcontent-aax-c230] {
                     width: 100%;
                     height: 100%;
                     object-fit: cover;
                     object-position: top
              }

              .time-box[_ngcontent-aax-c230] .attendance[_ngcontent-aax-c230] .fingerprint[_ngcontent-aax-c230] {
                     transform: scale(.6)
              }

              .time-box[_ngcontent-aax-c230] .record-area[_ngcontent-aax-c230] {
                     margin-top: 16px
              }

              .time-box[_ngcontent-aax-c230] .record-area[_ngcontent-aax-c230] .note[_ngcontent-aax-c230] {
                     margin-top: 0
              }

              .time-box[_ngcontent-aax-c230] .record-area[_ngcontent-aax-c230] gd-comp-button[_ngcontent-aax-c230] {
                     width: 100%;
                     align-self: center
              }

              .time-box[_ngcontent-aax-c230] .record-area[_ngcontent-aax-c230] gd-comp-button[_ngcontent-aax-c230] button[_ngcontent-aax-c230] {
                     width: 100%
              }

              .time-box[_ngcontent-aax-c230] .time-wrapper-small[_ngcontent-aax-c230] {
                     padding: 16px !important
              }

              .time-box[_ngcontent-aax-c230] .time-wrapper[_ngcontent-aax-c230] {
                     border-radius: 0 0 4px 4px;
                     overflow: visible;
                     transition: all .2s ease
              }

              .time-box[_ngcontent-aax-c230] .card-warning[_ngcontent-aax-c230] {
                     background-color: rgba(var(--ion-color-warning-rgb), .2);
                     border-radius: 4px
              }

              .time-box[_ngcontent-aax-c230] .break-box[_ngcontent-aax-c230] {
                     padding: 8px 16px
              }

              .time-box[_ngcontent-aax-c230] .break-box[_ngcontent-aax-c230] .chevron-break[_ngcontent-aax-c230] {
                     width: 24px;
                     height: 24px;
                     border-radius: 4px;
                     border: 1px solid var(--gdx-color-outline);
                     cursor: pointer
              }

              .time-box[_ngcontent-aax-c230] .break-box[_ngcontent-aax-c230] .chevron-break[_ngcontent-aax-c230]:hover {
                     background-color: var(--gdx-color-bghover)
              }

              .time-box[_ngcontent-aax-c230] .break-box.breaktime-only[_ngcontent-aax-c230] {
                     width: 100%
              }

              .time-box[_ngcontent-aax-c230] .break-box.breaktime-only[_ngcontent-aax-c230] .devider[_ngcontent-aax-c230] {
                     margin-right: 12px !important;
                     margin-left: 12px !important
              }

              .time-box[_ngcontent-aax-c230] .break-box.breaktime-only[_ngcontent-aax-c230] .break-subsection[_ngcontent-aax-c230] {
                     width: 100%
              }

              .time-box[_ngcontent-aax-c230] .skeleton[_ngcontent-aax-c230] .skeleton-box[_ngcontent-aax-c230] {
                     width: 85px
              }

              .time-box[_ngcontent-aax-c230] .skeleton[_ngcontent-aax-c230] .skeleton-box[_ngcontent-aax-c230] app-avatar[_ngcontent-aax-c230] {
                     margin-right: 10px
              }

              .time-box[_ngcontent-aax-c230] .skeleton[_ngcontent-aax-c230] .skeleton-box[_ngcontent-aax-c230] .name-box[_ngcontent-aax-c230] {
                     height: 35px;
                     margin-top: 10px
              }

              .time-box[_ngcontent-aax-c230] .skeleton[_ngcontent-aax-c230] .skeleton-box[_ngcontent-aax-c230] .name-box[_ngcontent-aax-c230] .skeleton-name-1[_ngcontent-aax-c230],
              .time-box[_ngcontent-aax-c230] .skeleton[_ngcontent-aax-c230] .skeleton-box[_ngcontent-aax-c230] .name-box[_ngcontent-aax-c230] .skeleton-name-2[_ngcontent-aax-c230] {
                     height: 10px;
                     width: 60px;
                     border-radius: 4px;
                     margin-bottom: 7px
              }

              .break-head[_ngcontent-aax-c230] {
                     border-top: 1px solid var(--gdx-color-outline);
                     padding: 12px 16px;
                     background-color: var(--gdx-color-bgfloor);
                     position: relative;
                     z-index: 1
              }

              [full][_ngcontent-aax-c230] {
                     width: 100%
              }

              .view-btn[_ngcontent-aax-c230] {
                     border-top: 1px solid var(--ion-color-light-shade);
                     background-color: var(--gdx-color-bgfloor);
                     cursor: pointer
              }

              .view-btn[_ngcontent-aax-c230]:hover {
                     background-color: rgba(var(--ion-color-medium-rgb), .1)
              }

              .greyScale[_ngcontent-aax-c230] {
                     filter: grayscale(100%)
              }
       </style>
       <style>
              ion-segment[_ngcontent-aax-c168] {
                     --background: transparent;
                     scroll-behavior: smooth;
                     margin-block: 4px;
                     scrollbar-width: none !important
              }

              ion-segment[_ngcontent-aax-c168]::-webkit-scrollbar {
                     height: 0px !important
              }

              ion-segment-button[_ngcontent-aax-c168] {
                     --color-checked: var(--ion-color-primary)
              }

              ion-segment-button[_ngcontent-aax-c168] .inside[_ngcontent-aax-c168] {
                     border-bottom: 2px solid transparent
              }

              ion-segment-button[_ngcontent-aax-c168]>*[_ngcontent-aax-c168] {
                     pointer-events: none
              }

              ion-segment-button[_ngcontent-aax-c168] ion-label[_ngcontent-aax-c168] {
                     color: var(--ion-color-text-header) !important;
                     text-transform: capitalize;
                     transition: color .2s;
                     font-weight: 700
              }

              ion-segment-button[_ngcontent-aax-c168] .dot[_ngcontent-aax-c168] {
                     width: 8px;
                     height: 8px;
                     border-radius: 200px;
                     background-color: var(--ion-color-danger);
                     transform: translate3d(2px, 0, 10px)
              }

              ion-segment-button[_ngcontent-aax-c168] .dot.value[_ngcontent-aax-c168] {
                     min-width: 19px;
                     min-height: 19px;
                     color: #fff;
                     font-size: 10px;
                     display: flex;
                     align-items: center;
                     justify-content: center;
                     padding: 2px;
                     width: unset
              }

              ion-segment-button[_ngcontent-aax-c168]:hover ion-label[_ngcontent-aax-c168] {
                     color: var(--ion-color-medium)
              }

              ion-segment-button[_ngcontent-aax-c168]:before {
                     display: none
              }

              .tab-box[_ngcontent-aax-c168] {
                     position: relative
              }

              .left-arrow[_ngcontent-aax-c168] {
                     position: relative;
                     align-self: stretch;
                     left: 0;
                     align-items: center;
                     z-index: 99
              }

              .left-arrow[_ngcontent-aax-c168]:after {
                     content: "";
                     width: 40px;
                     height: 100%;
                     position: absolute;
                     left: 22px;
                     pointer-events: none
              }

              .right-arrow[_ngcontent-aax-c168] {
                     position: relative;
                     align-self: stretch;
                     right: 0;
                     align-items: center;
                     z-index: 99
              }

              .right-arrow[_ngcontent-aax-c168]:before {
                     content: "";
                     width: 40px;
                     height: 100%;
                     position: absolute;
                     right: 22px;
                     pointer-events: none
              }

              .right-arrow.no-shades[_ngcontent-aax-c168]:before {
                     background: transparent !important
              }

              .left-arrow.no-shades[_ngcontent-aax-c168]:after {
                     background: transparent !important
              }

              .active-line[_ngcontent-aax-c168] {
                     border-bottom: 2px solid var(--ion-color-primary) !important;
                     position: absolute;
                     bottom: 8px
              }

              .activeBox[_ngcontent-aax-c168] {
                     border-bottom: 2px solid var(--ion-color-primary) !important;
                     padding-bottom: 4px
              }

              .activeBox[_ngcontent-aax-c168] ion-label[_ngcontent-aax-c168] {
                     color: var(--ion-color-primary) !important
              }

              ion-segment-button[_ngcontent-aax-c168]::part(indicator-background) {
                     background: transparent !important;
                     box-shadow: none
              }

              .activeArrow[_ngcontent-aax-c168] {
                     color: var(--ion-color-dark)
              }

              .inactiveArrow[_ngcontent-aax-c168] {
                     color: var(--ion-color-light-shade)
              }

              ion-icon[_ngcontent-aax-c168] {
                     font-size: 22px !important
              }

              ion-segment-button.segment-chip[_ngcontent-aax-c168] {
                     --padding-end: 0px;
                     --padding-start: 0px;
                     margin-inline: 6px;
                     min-height: 30px
              }

              ion-segment-button.segment-chip[_ngcontent-aax-c168] .inside[_ngcontent-aax-c168] {
                     border-radius: 100px;
                     padding: 5px 12px;
                     text-transform: capitalize;
                     color: var(--ion-color-medium) !important;
                     background: rgba(var(--ion-color-medium-rgb), .1) !important;
                     border: 1px solid rgba(var(--ion-color-medium-rgb), .2) !important
              }

              ion-segment-button.segment-chip[_ngcontent-aax-c168]::part(native) {
                     border-radius: 100px
              }

              ion-segment-button.segment-chip.segment-button-checked[_ngcontent-aax-c168] {
                     --padding-end: 0px;
                     --padding-start: 0px
              }

              ion-segment-button.segment-chip.segment-button-checked[_ngcontent-aax-c168] .inside[_ngcontent-aax-c168] {
                     color: var(--ion-color-primary) !important;
                     background: rgba(var(--ion-color-primary-rgb), .3) !important;
                     border: 1px solid rgba(var(--ion-color-primary-rgb), .7) !important
              }
       </style>
       <script src="asset/gdp/js_002" async=""></script>
       <style>
              ion-header[_ngcontent-aax-c241] ion-toolbar[_ngcontent-aax-c241] {
                     border-radius: 16px 16px 0 0;
                     --background: var(--gdx-color-bgcard) !important
              }

              @media only screen and (min-width: 768px) {
                     ion-header[_ngcontent-aax-c241] ion-toolbar.toolbar-title-default[_ngcontent-aax-c241] {
                            --background: var(--gdx-color-bgfloor) !important;
                            border-radius: 0 !important
                     }
              }

              .list-box[_ngcontent-aax-c241] {
                     max-height: 420px;
                     overflow-y: scroll;
                     background-color: var(--ion-color-light)
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] {
                     padding: 12px 16px
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] img[_ngcontent-aax-c241] {
                     width: 24px;
                     object-fit: contain
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] p[_ngcontent-aax-c241] {
                     color: var(--ion-color-medium);
                     font-size: 12px !important
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] .remove-icon[_ngcontent-aax-c241] {
                     background: var(--gdx-color-light);
                     border-radius: 100px;
                     width: 30px;
                     min-width: 30px;
                     height: 30px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     opacity: 0
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] .overhidden[_ngcontent-aax-c241] {
                     overflow: hidden
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] .overhidden[_ngcontent-aax-c241]>div[_ngcontent-aax-c241] {
                     overflow: hidden
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] .overhidden[_ngcontent-aax-c241]>div[_ngcontent-aax-c241] ion-label[_ngcontent-aax-c241] {
                     text-overflow: ellipsis;
                     white-space: nowrap;
                     overflow: hidden
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241]:hover gd-comp-icon[_ngcontent-aax-c241] {
                     opacity: 1
              }

              .list-box[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241]:hover .remove-icon[_ngcontent-aax-c241] {
                     opacity: 1
              }

              .list-box[_ngcontent-aax-c241] .remove-icon[_ngcontent-aax-c241]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .list-box[_ngcontent-aax-c241] .list-section.no-close[_ngcontent-aax-c241]>*[_ngcontent-aax-c241] {
                     pointer-events: none
              }

              .list-box[_ngcontent-aax-c241] .border-vertikal[_ngcontent-aax-c241] {
                     border-top: 1px solid var(--gdx-color-outline);
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .list-box[_ngcontent-aax-c241] .border-top[_ngcontent-aax-c241] {
                     border-top: 1px solid var(--gdx-color-outline)
              }

              .list-box[_ngcontent-aax-c241] .border-bottom[_ngcontent-aax-c241] {
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .list-box-mobile[_ngcontent-aax-c241] {
                     background-color: transparent !important;
                     max-height: unset !important;
                     padding: 16px
              }

              .list-box-mobile[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] {
                     margin-bottom: 10px;
                     padding: 14px 0 !important
              }

              .list-box-mobile[_ngcontent-aax-c241] .list-section[_ngcontent-aax-c241] p[_ngcontent-aax-c241] {
                     font-size: 14px !important
              }
       </style>
       <style>
              .list-box[_ngcontent-aax-c242] {
                     max-height: 310px;
                     overflow-y: scroll;
                     background-color: var(--ion-color-light)
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242] {
                     padding: 12px 16px
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242] img[_ngcontent-aax-c242] {
                     width: 24px;
                     object-fit: contain
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242] p[_ngcontent-aax-c242] {
                     color: var(--ion-color-medium)
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242] .remove-icon[_ngcontent-aax-c242] {
                     background: var(--gdx-color-light);
                     border-radius: 100px;
                     width: 30px;
                     min-width: 30px;
                     height: 30px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     opacity: 0
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242]:hover gd-comp-icon[_ngcontent-aax-c242] {
                     opacity: 1
              }

              .list-box[_ngcontent-aax-c242] .list-section[_ngcontent-aax-c242]:hover .remove-icon[_ngcontent-aax-c242] {
                     opacity: 1
              }

              .list-box[_ngcontent-aax-c242] .remove-icon[_ngcontent-aax-c242]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .list-box[_ngcontent-aax-c242] .list-section.no-close[_ngcontent-aax-c242]>*[_ngcontent-aax-c242] {
                     pointer-events: none
              }

              .list-box[_ngcontent-aax-c242] .border-vertikal[_ngcontent-aax-c242] {
                     border-top: 1px solid var(--gdx-color-outline);
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .list-box[_ngcontent-aax-c242] .border-top[_ngcontent-aax-c242] {
                     border-top: 1px solid var(--gdx-color-outline)
              }

              .list-box[_ngcontent-aax-c242] .border-bottom[_ngcontent-aax-c242] {
                     border-bottom: 1px solid var(--gdx-color-outline)
              }
       </style>
       <style>
              .list-box[_ngcontent-aax-c243] {
                     background-color: var(--ion-color-light)
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243] {
                     padding: 12px 16px
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243] img[_ngcontent-aax-c243] {
                     width: 24px;
                     object-fit: contain
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243] p[_ngcontent-aax-c243] {
                     color: var(--ion-color-medium)
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243] .remove-icon[_ngcontent-aax-c243] {
                     background: var(--gdx-color-light);
                     border-radius: 100px;
                     width: 30px;
                     min-width: 30px;
                     height: 30px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     opacity: 0;
                     transition: all .2s
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243]:hover gd-comp-icon[_ngcontent-aax-c243] {
                     opacity: 1
              }

              .list-box[_ngcontent-aax-c243] .list-section[_ngcontent-aax-c243]:hover .remove-icon[_ngcontent-aax-c243] {
                     opacity: 1
              }

              .list-box[_ngcontent-aax-c243] .remove-icon[_ngcontent-aax-c243]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              .list-box[_ngcontent-aax-c243] .list-section.no-close[_ngcontent-aax-c243]>*[_ngcontent-aax-c243] {
                     pointer-events: none
              }

              .list-box[_ngcontent-aax-c243] .border-vertikal[_ngcontent-aax-c243] {
                     border-top: 1px solid var(--gdx-color-outline);
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              .list-box[_ngcontent-aax-c243] .border-top[_ngcontent-aax-c243] {
                     border-top: 1px solid var(--gdx-color-outline)
              }

              .list-box[_ngcontent-aax-c243] .border-bottom[_ngcontent-aax-c243] {
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              @media only screen and (min-width: 768px) {
                     .list-box[_ngcontent-aax-c243] {
                            max-height: 310px;
                            overflow-y: scroll
                     }
              }

              .username-box[_ngcontent-aax-c243] {
                     word-break: break-all;
                     font-size: 10px;
                     color: var(--ion-color-medium)
              }
       </style>
       <script type="text/javascript" charset="UTF-8" src="asset/gdp/common.js"></script>
       <script type="text/javascript" charset="UTF-8" src="asset/gdp/util.js"></script>
       <style>
              @media only screen and (min-width: 768px) {
                     app-title[_ngcontent-aax-c373] {
                            display: block !important
                     }

                     ion-searchbar[_ngcontent-aax-c373] {
                            display: block !important
                     }

                     .search[_ngcontent-aax-c373],
                     .close[_ngcontent-aax-c373] {
                            display: none !important
                     }
              }

              ion-searchbar[_ngcontent-aax-c373] {
                     display: none;
                     text-align: left;
                     --background: var(--gdx-color-bgcard) !important;
                     --clear-button-color: var(--gdx-color-bgcard) !important
              }

              .self-center[_ngcontent-aax-c373] {
                     align-self: center
              }

              .new-container[_ngcontent-aax-c373] ion-label[_ngcontent-aax-c373] {
                     display: block
              }

              .new-container[_ngcontent-aax-c373] .banner-box[_ngcontent-aax-c373] {
                     position: relative;
                     overflow: hidden;
                     border-radius: 4px;
                     padding-top: 18px;
                     padding-right: 36px
              }

              .new-container[_ngcontent-aax-c373] .banner-box[_ngcontent-aax-c373] .bg-img[_ngcontent-aax-c373] {
                     position: absolute;
                     top: 0;
                     left: 0;
                     width: 100%;
                     height: 100%;
                     z-index: 1;
                     object-fit: cover
              }

              .new-container[_ngcontent-aax-c373] .banner-box[_ngcontent-aax-c373] .desc-box[_ngcontent-aax-c373],
              .new-container[_ngcontent-aax-c373] .banner-box[_ngcontent-aax-c373] .img-box[_ngcontent-aax-c373] {
                     z-index: 2
              }

              .new-container[_ngcontent-aax-c373] .banner-box[_ngcontent-aax-c373] .img-box[_ngcontent-aax-c373] {
                     width: 275px;
                     position: relative;
                     height: 110px
              }

              .new-container[_ngcontent-aax-c373] .banner-box[_ngcontent-aax-c373] .img-box[_ngcontent-aax-c373] img[_ngcontent-aax-c373] {
                     position: absolute;
                     left: 0;
                     bottom: -16px;
                     width: 100%;
                     object-fit: contain
              }

              .new-container[_ngcontent-aax-c373] .menu-box[_ngcontent-aax-c373] .menu-group[_ngcontent-aax-c373] {
                     border-bottom: 1px solid var(--gdx-color-outline);
                     padding-bottom: 20px
              }

              .new-container[_ngcontent-aax-c373] .menu-box[_ngcontent-aax-c373] .menu-group[_ngcontent-aax-c373] .menu-group-title[_ngcontent-aax-c373] {
                     text-transform: uppercase;
                     letter-spacing: .16em;
                     color: #d7dae0 !important;
                     margin-bottom: 20px
              }

              .new-container[_ngcontent-aax-c373] .menu-box[_ngcontent-aax-c373] .menu-group[_ngcontent-aax-c373] .menu-section[_ngcontent-aax-c373] .menu-item[_ngcontent-aax-c373] {
                     width: 90px
              }

              .new-container[_ngcontent-aax-c373] .menu-box[_ngcontent-aax-c373] .menu-group[_ngcontent-aax-c373] .menu-section[_ngcontent-aax-c373] .menu-item[_ngcontent-aax-c373] ion-label[_ngcontent-aax-c373] {
                     text-align: center
              }

              .new-container[_ngcontent-aax-c373] .menu-box[_ngcontent-aax-c373] .menu-group[_ngcontent-aax-c373] .menu-section[_ngcontent-aax-c373] .menu-item[_ngcontent-aax-c373] img[_ngcontent-aax-c373] {
                     width: 40px;
                     height: 40px;
                     object-fit: contain
              }
       </style>
       <style>
              gd-comp-icon[_ngcontent-aax-c254] {
                     margin-left: 4px;
                     position: relative;
                     top: 3px;
                     display: none !important
              }

              ion-title[_ngcontent-aax-c254] {
                     color: var(--ion-color-dark)
              }

              @media screen and (max-width: 768px) {
                     gd-comp-icon[_ngcontent-aax-c254] {
                            display: inline-flex !important
                     }

                     ion-title[_ngcontent-aax-c254] {
                            cursor: pointer
                     }
              }
       </style>
       <style>
              ion-content[_ngcontent-aax-c237] .ripple-parent[_ngcontent-aax-c237] {
                     position: relative;
                     overflow: hidden
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] {
                     display: flex;
                     height: 100%
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] img.left[_ngcontent-aax-c237] {
                     position: absolute;
                     z-index: 0;
                     opacity: .1;
                     left: 0
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] img.right[_ngcontent-aax-c237] {
                     opacity: .1;
                     z-index: 0;
                     position: absolute;
                     right: 0;
                     bottom: 0
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .closed[_ngcontent-aax-c237] {
                     position: absolute;
                     z-index: 0;
                     width: 100%;
                     height: 100%
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] {
                     width: -moz-fit-content;
                     width: fit-content;
                     margin: 0 auto
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] {
                     position: relative;
                     width: 100%;
                     max-width: 1156px;
                     border-radius: 24px;
                     background: var(--gdx-color-bgcard);
                     overflow: hidden
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-left[_ngcontent-aax-c237] {
                     width: 100%;
                     overflow: hidden;
                     display: flex
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-left[_ngcontent-aax-c237] img[_ngcontent-aax-c237] {
                     height: -webkit-fill-available
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] {
                     width: 578px;
                     height: -webkit-fill-available;
                     padding: 30px;
                     display: flex;
                     flex-direction: column;
                     align-self: center
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-brand[_ngcontent-aax-c237] {
                     border-radius: 8px;
                     background-color: rgba(var(--ion-color-success-rgb), .25);
                     margin-bottom: 30px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-brand[_ngcontent-aax-c237] img[_ngcontent-aax-c237] {
                     width: 110px;
                     height: 94px;
                     margin-right: 24px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-brand[_ngcontent-aax-c237] .alert-text[_ngcontent-aax-c237] {
                     cursor: pointer;
                     padding: 2px;
                     border-radius: 8px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-brand[_ngcontent-aax-c237] .alert-text[_ngcontent-aax-c237]:hover {
                     background-color: rgba(var(--ion-color-dark-rgb), .05)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-brand[_ngcontent-aax-c237] .box-brand-caption[_ngcontent-aax-c237] ion-label[_ngcontent-aax-c237] {
                     display: block
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-img[_ngcontent-aax-c237] {
                     margin-bottom: 30px;
                     text-align: center
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-img[_ngcontent-aax-c237] img[_ngcontent-aax-c237] {
                     width: 190px;
                     height: 53px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] {
                     position: relative;
                     z-index: 4;
                     border: 2px solid #efefef;
                     box-sizing: border-box;
                     border-radius: 8px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] ion-input[_ngcontent-aax-c237] {
                     --padding-end: 16px;
                     --padding-start: 16px;
                     --padding-bottom: 12px;
                     --padding-top: 12px;
                     font-size: 14px !important;
                     --placeholder-color: #808080 !important;
                     --color: #808080 !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] input[type=search][_ngcontent-aax-c237] {
                     width: 100%;
                     border: none;
                     border-radius: 5px 0 0 5px;
                     padding: 12px 16px;
                     outline: none !important;
                     font-size: 14px;
                     color: gray
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] ion-icon[_ngcontent-aax-c237] {
                     padding: 0 10px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] {
                     position: absolute;
                     top: -5px;
                     z-index: -1;
                     width: 380px;
                     margin: -10px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] .header[_ngcontent-aax-c237] {
                     padding-top: 70px;
                     width: 100%;
                     background: var(--ion-item-background, var(--ion-background-color, #fff));
                     box-shadow: 0 2px 8px #00000026
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] .header[_ngcontent-aax-c237] .box[_ngcontent-aax-c237] {
                     width: 94%;
                     height: 45px;
                     position: absolute;
                     top: 13px;
                     left: 13px;
                     border-radius: 8px;
                     border: 2px solid #efefef
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] ion-list.md.list-md.hydrated[_ngcontent-aax-c237],
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] ion-list.ios.list-ios.hydrated[_ngcontent-aax-c237] {
                     height: 300px;
                     overflow: overlay;
                     box-shadow: 0 2px 8px #00000026
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] ion-list.md.list-md.hydrated[_ngcontent-aax-c237] ion-item.item.md.in-list.ion-focusable.hydrated[_ngcontent-aax-c237],
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] ion-list.ios.list-ios.hydrated[_ngcontent-aax-c237] ion-item.item.md.in-list.ion-focusable.hydrated[_ngcontent-aax-c237] {
                     color: var(--ion-color-dark)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] {
                     background: white;
                     position: relative;
                     border: 2px solid #efefef;
                     border-radius: 8px;
                     box-sizing: border-box
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] ion-input[_ngcontent-aax-c237] {
                     --padding-end: 16px;
                     --padding-start: 16px;
                     --padding-bottom: 12px;
                     --padding-top: 12px;
                     font-size: 14px !important;
                     --placeholder-color: #808080 !important;
                     --color: #808080 !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] ion-icon[_ngcontent-aax-c237] {
                     padding: 0 10px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] input#password-field[_ngcontent-aax-c237] {
                     width: 100%;
                     padding: 12px 16px;
                     border: none;
                     color: #000
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] input[_ngcontent-aax-c237]:focus,
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] select[_ngcontent-aax-c237]:focus,
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] textarea[_ngcontent-aax-c237]:focus,
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] button[_ngcontent-aax-c237]:focus {
                     outline: none
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box[_ngcontent-aax-c237] .disabled-input[_ngcontent-aax-c237] {
                     pointer-events: none
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-cridential[_ngcontent-aax-c237] .box[_ngcontent-aax-c237] {
                     border-radius: 200px;
                     border: 2px solid var(--gdx-color-bghover);
                     width: -moz-fit-content;
                     width: fit-content
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-cridential[_ngcontent-aax-c237] .box[_ngcontent-aax-c237] ion-label[_ngcontent-aax-c237] {
                     font-weight: 700 !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-check[_ngcontent-aax-c237] .box-login-right-box-check-left[_ngcontent-aax-c237] ion-item[_ngcontent-aax-c237] {
                     --ripple-color: transparent;
                     --background: rgba(0, 0, 0, 0);
                     --border-color: rgba(0, 0, 0, 0)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-check[_ngcontent-aax-c237] .box-login-right-box-check-left[_ngcontent-aax-c237] ion-item[_ngcontent-aax-c237] ion-checkbox.ion-color.ion-color-primary.md.interactive.hydrated[_ngcontent-aax-c237],
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-check[_ngcontent-aax-c237] .box-login-right-box-check-left[_ngcontent-aax-c237] ion-item[_ngcontent-aax-c237] ion-checkbox.ion-color.ion-color-primary.ios.interactive.hydrated[_ngcontent-aax-c237] {
                     --size: 19px;
                     --checkmark-width: 5px;
                     --border-width: 2px;
                     margin-right: 8px;
                     border: 1px solid #80808080;
                     border-radius: 4px !important;
                     --background: var(--ion-background-color)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-check[_ngcontent-aax-c237] .box-login-right-box-check-left[_ngcontent-aax-c237] ion-item[_ngcontent-aax-c237] ion-checkbox.ion-color.ion-color-primary.md.in-item.interactive.hydrated.checkbox-checked[_ngcontent-aax-c237] {
                     border: 0px solid #80808080 !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-check[_ngcontent-aax-c237] ion-label[_ngcontent-aax-c237] {
                     font-size: 12px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-bottom[_ngcontent-aax-c237] {
                     margin-bottom: 16px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-bottom[_ngcontent-aax-c237] ion-button[_ngcontent-aax-c237] {
                     --color: white !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] h6[_ngcontent-aax-c237] {
                     margin-top: 30px;
                     text-align: center;
                     text-transform: capitalize;
                     color: var(--ion-color-medium) !important;
                     margin-bottom: 19px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] h6.or[_ngcontent-aax-c237] {
                     position: relative;
                     z-index: 1
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] h6.or[_ngcontent-aax-c237]:before {
                     border-top: 1px solid var(--gdx-color-bghover);
                     content: "";
                     margin: 0 auto;
                     position: absolute;
                     inset: 50% 0 0;
                     width: 95%;
                     z-index: -1
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] h6.or[_ngcontent-aax-c237] span[_ngcontent-aax-c237] {
                     background: #fff;
                     padding: 0 15px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .google[_ngcontent-aax-c237] {
                     border-radius: 8px;
                     border: 2px solid var(--gdx-color-bghover);
                     padding: 14px;
                     margin-top: 8px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .google[_ngcontent-aax-c237] img[_ngcontent-aax-c237] {
                     width: 18px;
                     height: 18px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] {
                     margin-top: 24px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] ion-label[_ngcontent-aax-c237] {
                     font-size: 12px !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] .box-login-right-footer-language[_ngcontent-aax-c237] {
                     --ion-background-color: #ffffff !important;
                     padding: 0
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] .box-login-right-footer-language[_ngcontent-aax-c237] ion-select.md.in-item.hydrated[_ngcontent-aax-c237],
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] .box-login-right-footer-language[_ngcontent-aax-c237] ion-select.ios.in-item.hydrated[_ngcontent-aax-c237] {
                     max-width: 100% !important;
                     margin: 0;
                     padding: 0;
                     color: var(--ion-color-dark)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] .box-login-right-footer-language[_ngcontent-aax-c237] ion-item.item.md.ion-activatable.ion-focusable.hydrated.item-interactive.item-select.item-has-value[_ngcontent-aax-c237],
              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-footer[_ngcontent-aax-c237] .box-login-right-footer-language[_ngcontent-aax-c237] ion-item.item.ios.ion-activatable.ion-focusable.hydrated.item-interactive.item-select.item-has-value[_ngcontent-aax-c237] {
                     --ion-background-color: #ffffff !important;
                     border-radius: 8px;
                     border: 2px solid #808080
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .account-section[_ngcontent-aax-c237] {
                     overflow-y: auto;
                     max-height: 300px
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section[_ngcontent-aax-c237] {
                     padding: 12px 0
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section[_ngcontent-aax-c237] img[_ngcontent-aax-c237] {
                     width: 24px;
                     object-fit: contain
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section[_ngcontent-aax-c237] p[_ngcontent-aax-c237] {
                     color: var(--ion-color-medium)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section[_ngcontent-aax-c237] .remove-icon[_ngcontent-aax-c237] {
                     background: var(--gdx-color-light);
                     border-radius: 100px;
                     width: 30px;
                     min-width: 30px;
                     height: 30px;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     opacity: 0;
                     transition: all .2s
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section[_ngcontent-aax-c237]:hover gd-comp-icon[_ngcontent-aax-c237] {
                     opacity: 1
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section[_ngcontent-aax-c237]:hover .remove-icon[_ngcontent-aax-c237] {
                     opacity: 1
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .remove-icon[_ngcontent-aax-c237]:hover {
                     background: rgba(var(--ion-color-medium-rgb), .2) !important
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-section.no-close[_ngcontent-aax-c237]>*[_ngcontent-aax-c237] {
                     pointer-events: none
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .switch-btn[_ngcontent-aax-c237] {
                     padding: 12px 0
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .border-top[_ngcontent-aax-c237] {
                     border-top: 1px solid var(--gdx-color-outline)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .border-bottom[_ngcontent-aax-c237] {
                     border-bottom: 1px solid var(--gdx-color-outline)
              }

              ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .company[_ngcontent-aax-c237] {
                     position: relative;
                     z-index: 99
              }

              @media (max-width: 768px) {
                     ion-content[_ngcontent-aax-c237] {
                            --padding-top: 0px !important
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] {
                            background: var(--gdx-color-bgcard)
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] {
                            width: 100% !important;
                            height: unset !important
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] {
                            width: 100% !important;
                            border-radius: unset !important
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-left[_ngcontent-aax-c237] {
                            display: none
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] {
                            width: 100%;
                            max-width: unset !important;
                            padding: 18px !important
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237] {
                            display: none
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-language[_ngcontent-aax-c237] {
                            display: none
                     }

                     ion-content[_ngcontent-aax-c237] .content[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right-bottom[_ngcontent-aax-c237] {
                            margin-bottom: 32px !important
                     }
              }

              .mobile_ui[_ngcontent-aax-c237] {
                     --padding-top: 0px !important
              }

              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] {
                     width: 100% !important
              }

              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] {
                     width: 100% !important;
                     min-height: 100vh !important;
                     height: auto !important;
                     border-radius: unset !important;
                     overflow: hidden
              }

              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-left[_ngcontent-aax-c237] {
                     display: none
              }

              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] {
                     width: 100%;
                     max-width: unset !important;
                     height: auto !important;
                     padding: 18px !important
              }

              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .box-login-right-box-search-hasil[_ngcontent-aax-c237],
              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right[_ngcontent-aax-c237] .list-language[_ngcontent-aax-c237] {
                     display: none
              }

              .mobile_ui[_ngcontent-aax-c237] .content-box[_ngcontent-aax-c237] .box-login[_ngcontent-aax-c237] .box-login-right-bottom[_ngcontent-aax-c237] {
                     margin-bottom: 32px !important
              }

              [margin-temporary][_ngcontent-aax-c237] {
                     margin-top: -8px !important
              }
       </style>
</head>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="asset/gt_developer/jquery.min.js"></script>


<body class="">
       <!-- Custom SplashScreen -->
       <!-- <div class="splash-first" id="splash-screen">
	</div>
	<div class="footer-splash" id="footer-splash">
		<img class="cloud-section" src="assets/images/splashscreen/cloud-splash.svg">
		<div class="powered-splash">
			<div class="text-section">Custom by</div>
			<div class="logo-section"><img src="assets/images/splashscreen/greatdaylogo-footer-splash.svg"> </img></div>
		</div>
	</div>

	<script>
		function getOS() {
			let userAgent = navigator.userAgent || navigator.vendor || window.opera;

			if (/windows phone/i.test(userAgent)) {
				return "windows";
			}

			if (/android/i.test(userAgent)) {
				return "android";
			}

			if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
				return "ios";
			}
			return "browser";
		}

		let platform = this.getOS();

		if (platform == "browser") {
			document.getElementById("footer-splash").remove();
		}
		else {
			const splashscreen = localStorage.getItem('splashscreen');
			console.log('get splashscreen', splashscreen);
			try {
				document.getElementById('splash-screen').innerHTML = `<img src='${splashscreen}' onError="this.src ='assets/images/splashscreen/gd-icon.svg'">`;
			}
			catch (err) {
				console.log('error get splashscreen', err);
				document.getElementById('splash-screen').innerHTML = `<img src='assets/images/splashscreen/gd-icon.svg'>`;
			}
		}
	</script> -->

       <app-root _nghost-aax-c248="" ng-version="13.3.11">
              <ion-app _ngcontent-aax-c248="" fxlayout="row" style="flex-direction: row; box-sizing: border-box; display: flex;" class="md ion-page hydrated">
                     <div _ngcontent-aax-c248="" fxflex="" fxlayout="column" class="app-page" style="flex-direction: column; box-sizing: border-box; display: flex; flex: 1 1 0%;">
                            <!---->
                            <!---->
                            <ion-router-outlet _ngcontent-aax-c248="" class="hydrated">
                                   <app-login-standard _nghost-aax-c237="" class="ng-tns-c237-4 ng-star-inserted ion-page" style="z-index: 101;">
                                          <ion-content _ngcontent-aax-c237="" class="ng-tns-c237-4 ion-color md hydrated ion-color-primary" style="--offset-top: 0px; --offset-bottom: 0px;" color="primary">
                                                 <div _ngcontent-aax-c237="" class="content">
                                                        <!----><img _ngcontent-aax-c237="" src="asset/gdp/vector-left.png" alt="" disable-drag="" class="left ng-tns-c237-4 ng-star-inserted">
                                                        <!----><img _ngcontent-aax-c237="" src="asset/gdp/vector-right.png" alt="" disable-drag="" class="right ng-tns-c237-4 ng-star-inserted">
                                                        <!---->
                                                        <div _ngcontent-aax-c237="" fxlayoutalign="center center" class="content-box ng-tns-c237-4" style="place-content: center; align-items: center; flex-direction: row; box-sizing: border-box; display: flex;">
                                                               <div _ngcontent-aax-c237="" fxlayout="row" fxlayoutalign="space-between " class="box-login ng-tns-c237-4" style="place-content: stretch space-between; align-items: stretch; flex-direction: row; box-sizing: border-box; display: flex;">
                                                                      <div _ngcontent-aax-c237="" fxflex="50" class="box-login-left ng-tns-c237-4 ng-star-inserted" style="flex: 1 1 100%; box-sizing: border-box; max-width: 50%;"><img _ngcontent-aax-c237="" src="asset/gdp/login-illustration.png" disable-drag="" alt="" class="ng-tns-c237-4">
                                                                      </div>
                                                                      <!---->
                                                                      <!---->
                                                                      <!---->
                                                                      <div _ngcontent-aax-c237="" fxflex="50" class="box-login-right ng-tns-c237-4" style="flex: 1 1 100%; box-sizing: border-box; max-width: 50%;top: 100px;">
                                                                             <div _ngcontent-aax-c237="" tappable="" class="box-login-right-img ng-tns-c237-4"><img style="width: 147px;" _ngcontent-aax-c237="" src="asset/admus/logo-pralon_white-1024x422.png" alt="" disable-drag="" class="ng-tns-c237-4 ng-star-inserted">
                                                                                    <!---->
                                                                                    <!---->
                                                                             </div>
                                                                             <div _ngcontent-aax-c237="" class="ng-tns-c237-4 ng-trigger ng-trigger-animateArc" style="opacity: 1; transform: translateX(0%); position: relative; z-index: 99;">
                                                                                    <!---->
                                                                             </div>
                                                                             <form method="post" id="myform" class="login__form" novalidate="">
                                                                                    <!---->
                                                                                    <!---->
                                                                                    <div id="frm_account" _ngcontent-aax-c237="" fxlayout="row" fxlayoutalign="space-around center" mb-8="" class="box-login-right-box ng-tns-c237-4 ng-star-inserted" style="place-content: center space-around; align-items: center; flex-direction: row; box-sizing: border-box; display: flex; <?php echo $display_account_no; ?>">
                                                                                           <ion-input _ngcontent-aax-c237="" formcontrolname="userName" class="ng-tns-c237-4 ng-untouched ng-pristine ng-invalid ion-tns-c237-4 ion-untouched ion-pristine ion-invalid sc-ion-input-md-h sc-ion-input-md-s md hydrated">
                                                                                                  <input class="native-input sc-ion-input-md" oninput="getcube()" autocapitalize="none" autocomplete="off" autocorrect="off" id="account_name" name="account_name" placeholder="Account Name" spellcheck="false" type="text" value="<?php echo $account_name; ?>">
                                                                                           </ion-input>
                                                                                           <ion-icon _ngcontent-aax-c237="" name="icon-users" icon-large="" class="ng-tns-c237-4 md hydrated" aria-label="icon users" role="img"></ion-icon>
                                                                                    </div>



                                                                                    <div id="frm_username" _ngcontent-aax-c237="" fxlayout="row" fxlayoutalign="space-around center" mb-8="" class="box-login-right-box ng-tns-c237-4 ng-star-inserted" style="place-content: center space-around; align-items: center; flex-direction: row; box-sizing: border-box; display: none;">
                                                                                           <ion-input _ngcontent-aax-c237="" formcontrolname="userName" class="ng-tns-c237-4 ng-untouched ng-pristine ng-invalid ion-tns-c237-4 ion-untouched ion-pristine ion-invalid sc-ion-input-md-h sc-ion-input-md-s md hydrated">
                                                                                                  <input class="native-input sc-ion-input-md" oninput="getcube()" autocapitalize="none" autocomplete="off" autocorrect="off" id="username" name="username" placeholder="Username" spellcheck="false" type="text" value="<?php echo $nip; ?>">
                                                                                           </ion-input>
                                                                                           <ion-icon _ngcontent-aax-c237="" name="icon-users" icon-large="" class="ng-tns-c237-4 md hydrated" aria-label="icon users" role="img"></ion-icon>
                                                                                    </div>



                                                                                    <div id="frm_password" _ngcontent-aax-c237="" fxlayout="row" fxlayoutalign="space-around center" mb-8="" class="box-login-right-box ng-tns-c237-4 ng-star-inserted" style="place-content: center space-around; align-items: center; flex-direction: row; box-sizing: border-box; display: none;">
                                                                                           <ion-input _ngcontent-aax-c237="" formcontrolname="userName" class="ng-tns-c237-4 ng-untouched ng-pristine ng-invalid ion-tns-c237-4 ion-untouched ion-pristine ion-invalid sc-ion-input-md-h sc-ion-input-md-s md hydrated">
                                                                                                  <input type="password" class="native-input sc-ion-input-md" oninput="getcube()" autocapitalize="none" autocomplete="off" autocorrect="off" id="password" name="password" placeholder="Password" spellcheck="false" type="text">
                                                                                           </ion-input>
                                                                                           <ion-icon _ngcontent-aax-c237="" name="icon-users" icon-large="" class="ng-tns-c237-4 md hydrated" aria-label="icon users" role="img"></ion-icon>
                                                                                           <label for="password" class="form__label--floating" aria-hidden="true"></label>
                                                                                           <span style="z-index: 99;font-family: verdana;font-size: 8pt;top: 10px;" id="password-visibility-toggle" class="button__password-visibility mercado-button--tertiary" role="button" tabindex="0" onclick="myFunction()">Show Password</span>
                                                                                    </div>

                                                                                    <script>
                                                                                           $(document).ready(function() {
                                                                                   
                                                                                                  var x = document.getElementById("frm_username");
                                                                                                  var y = document.getElementById("frm_password");

                                                                                               
                                                                                                  $('#frm_username').fadeIn('slow');
                                                                                                  $('#frm_password').fadeIn('slow');
                                                                                                  
                                                                                                  x.style.display = "flex";
                                                                                                  y.style.display = "flex";
                                                                                           });
                                                                                    </script>



                                                                                    <div _ngcontent-aax-c237="" fxlayout="row" fxlayoutalign="space-around center" mb-8="" class="box-login-right-box ng-tns-c237-4 ng-star-inserted" style="place-content: center space-around; align-items: center; flex-direction: row; box-sizing: border-box;border: 1px solid white;">
                                                                                           <span style="z-index: 99;font-family: verdana;font-size: 8pt;top: auto;" id="myHref" class="button__password-visibility mercado-button--tertiary" role="button" tabindex="0">Sign in with different account</span>

                                                                                           <ion-icon _ngcontent-aax-c237="" name="icon-users" icon-large="" class="ng-tns-c237-4 md hydrated" aria-label="icon users" role="img"></ion-icon>
                                                                                           <label for="password" class="form__label--floating" aria-hidden="true"></label>

                                                                                    </div>

                                                                                    <script>
                                                                                           $("#myHref").on('click', function() {
                                                                                                  window.location = "application/logout_clear_cookies.php";
                                                                                           });
                                                                                    </script>







                                                                                    <div _ngcontent-aax-c237="" mt-12="" class="box-login-right-bottom ng-tns-c237-4">
                                                                                           <div id="accesstrue" style="place-content: center; align-items: center; flex-direction: row; box-sizing: border-box; position: relative; cursor: pointer; display: none;top: -29px;">
                                                                                                  <button type="submit" class="btn__primary--large from__button--floating mercado-button--primary ladda-button" data-style="slide-up" style="font-family: verdana;font-size: 10pt;"><span class="ladda-label"> Sign in </span></button>
                                                                                           </div>
                                                                                    </div>




                                                                                   






                                                                                    <script type="text/javascript">
                                                                                           function getcube() {
                                                                                                  var x = document.getElementById("accesstrue");
                                                                                                  var account_name = document.getElementById("account_name").value;
                                                                                                  var username = document.getElementById("username").value;
                                                                                                  var password = document.getElementById("password").value;

                                                                                                  if (account_name == '' || username == '' || password == '') {
                                                                                                         x.style.display = "none";
                                                                                                  } else {

                                                                                                         $("#accesstrue").fadeIn('slow');
                                                                                                         x.style.display = "flex";
                                                                                                  }
                                                                                           }
                                                                                    </script>






                                                                             </form>
                                                                             <!---->

                                                                      </div>
                                                               </div>
                                                        </div>
                                                 </div>
                                          </ion-content>
                                   </app-login-standard>
                            </ion-router-outlet>
                            <!---->
                            <div _ngcontent-aax-c248="" class="toast-frame">
                                   <!---->
                            </div>
                     </div>
              </ion-app>
       </app-root>
       <noscript>Please enable JavaScript to continue using this application.</noscript>
       <script src="asset/gdp/polyfills.c6fb0bd46777781e.js" type="module"></script>
       <script src="asset/gdp/scripts.25b13c98e6142d5c.js" defer="defer"></script>
       <script src="asset/gdp/main.04dec145184cd1c3.js" type="module"></script>

       <iframe id="intercom-frame" style="position: absolute !important; opacity: 0 !important; width: 1px !important; height: 1px !important; top: 0 !important; left: 0 !important; border: none !important; display: block !important; z-index: -1 !important; pointer-events: none;" aria-hidden="true" tabindex="-1" title="Intercom"></iframe>
       <div class="intercom-lightweight-app">
              <style id="intercom-lightweight-app-style" type="text/css">
                     @keyframes intercom-lightweight-app-launcher {
                            from {
                                   opacity: 0;
                                   transform: scale(0.5);
                            }

                            to {
                                   opacity: 1;
                                   transform: scale(1);
                            }
                     }

                     @keyframes intercom-lightweight-app-gradient {
                            from {
                                   opacity: 0;
                            }

                            to {
                                   opacity: 1;
                            }
                     }

                     @keyframes intercom-lightweight-app-messenger {
                            from {
                                   opacity: 0;
                                   transform: translateY(20px);
                            }

                            to {
                                   opacity: 1;
                                   transform: translateY(0);
                            }
                     }

                     .intercom-lightweight-app {
                            position: fixed;
                            z-index: 2147483001;
                            width: 0;
                            height: 0;
                            font-family: intercom-font, "Helvetica Neue", "Apple Color Emoji", Helvetica, Arial, sans-serif;
                     }

                     .intercom-lightweight-app-gradient {
                            position: fixed;
                            z-index: 2147483002;
                            width: 500px;
                            height: 500px;
                            bottom: 0;
                            right: 0;
                            pointer-events: none;
                            background: radial-gradient(ellipse at bottom right,
                                          rgba(29, 39, 54, 0.16) 0%,
                                          rgba(29, 39, 54, 0) 72%);
                            animation: intercom-lightweight-app-gradient 200ms ease-out;
                     }

                     .intercom-lightweight-app-launcher {
                            position: fixed;
                            z-index: 2147483003;
                            bottom: 25px;
                            right: 100px;
                            width: 60px;
                            height: 60px;
                            border-radius: 50%;
                            background: #ff7300;
                            cursor: pointer;
                            box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.06), 0 2px 32px 0 rgba(0, 0, 0, 0.16);
                            animation: intercom-lightweight-app-launcher 250ms ease;
                     }

                     .intercom-lightweight-app-launcher:focus {
                            outline: none;

                     }

                     .intercom-lightweight-app-launcher-icon {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 60px;
                            height: 60px;
                            transition: transform 100ms linear, opacity 80ms linear;
                     }

                     .intercom-lightweight-app-launcher-icon-open {

                            opacity: 1;
                            transform: rotate(0deg) scale(1);

                     }

                     .intercom-lightweight-app-launcher-icon-open svg {
                            width: 28px;
                            height: 32px;
                     }

                     .intercom-lightweight-app-launcher-icon-open svg path {
                            fill: rgb(255, 255, 255);
                     }

                     .intercom-lightweight-app-launcher-icon-self-serve {

                            opacity: 1;
                            transform: rotate(0deg) scale(1);

                     }

                     .intercom-lightweight-app-launcher-icon-self-serve svg {
                            height: 56px;
                     }

                     .intercom-lightweight-app-launcher-icon-self-serve svg path {
                            fill: rgb(255, 255, 255);
                     }

                     .intercom-lightweight-app-launcher-custom-icon-open {
                            max-height: 36px;
                            max-width: 36px;

                            opacity: 1;
                            transform: rotate(0deg) scale(1);

                     }

                     .intercom-lightweight-app-launcher-icon-minimize {

                            opacity: 0;
                            transform: rotate(-60deg) scale(0);

                     }

                     .intercom-lightweight-app-launcher-icon-minimize svg {
                            width: 16px;
                     }

                     .intercom-lightweight-app-launcher-icon-minimize svg path {
                            fill: rgb(255, 255, 255);
                     }

                     .intercom-lightweight-app-messenger {
                            position: fixed;
                            z-index: 2147483003;
                            overflow: hidden;
                            background-color: white;
                            animation: intercom-lightweight-app-messenger 250ms ease-out;

                            width: 376px;
                            height: calc(100% - 125px);
                            max-height: 704px;
                            min-height: 250px;
                            right: 100px;
                            bottom: 105px;
                            box-shadow: 0 5px 40px rgba(0, 0, 0, 0.16);
                            border-radius: 8px;

                     }

                     .intercom-lightweight-app-messenger-header {
                            height: 75px;
                            background: linear-gradient(135deg,
                                          rgb(84, 98, 112) 0%,
                                          rgb(40, 47, 54) 100%);
                     }

                     @media print {
                            .intercom-lightweight-app {
                                   display: none;
                            }
                     }
              </style>
             
       </div>
</body>

</html>



















<script type="text/javascript">
       function onReady(callback) {
              var intervalID = window.setInterval(checkReady, 4000);

              function checkReady() {
                     if (document.getElementsByTagName('body')[0] !== undefined) {
                            window.clearInterval(intervalID);
                            callback.call(this);
                     }
              }
       }

       function show(id, value) {
              document.getElementById(id).style.display = value ? 'block' : 'none';
       }
       onReady(function() {
              show('page', true);
              show('loading', false);
              show('loadings', false);

       });
</script>


<link href="asset/admus/style.css" rel="stylesheet">


<script src="asset/gt_developer/jquery-1.11.3.min.js"></script>
<style>
       .ladda-button {
              position: relative
       }

       .ladda-button .ladda-spinner {
              position: absolute;
              z-index: 2;
              display: inline-block;
              width: 32px;
              height: 32px;
              top: 50%;
              margin-top: -16px;
              opacity: 0;
              pointer-events: none
       }

       .ladda-button .ladda-label {
              position: relative;
              z-index: 3
       }

       .ladda-button .ladda-progress {
              position: absolute;
              width: 0;
              height: 100%;
              left: 0;
              top: 0;
              background: rgba(0, 0, 0, 0.2);
              visibility: hidden;
              opacity: 0;
              -webkit-transition: 0.1s linear all !important;
              -moz-transition: 0.1s linear all !important;
              -ms-transition: 0.1s linear all !important;
              -o-transition: 0.1s linear all !important;
              transition: 0.1s linear all !important
       }

       .ladda-button[data-loading] .ladda-progress {
              opacity: 1;
              visibility: visible
       }

       .ladda-button,
       .ladda-button .ladda-spinner,
       .ladda-button .ladda-label {
              -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) all !important;
              -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) all !important;
              -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) all !important;
              -o-transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) all !important;
              transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) all !important
       }

       .ladda-button[data-style=zoom-in],
       .ladda-button[data-style=zoom-in] .ladda-spinner,
       .ladda-button[data-style=zoom-in] .ladda-label,
       .ladda-button[data-style=zoom-out],
       .ladda-button[data-style=zoom-out] .ladda-spinner,
       .ladda-button[data-style=zoom-out] .ladda-label {
              -webkit-transition: 0.3s ease all !important;
              -moz-transition: 0.3s ease all !important;
              -ms-transition: 0.3s ease all !important;
              -o-transition: 0.3s ease all !important;
              transition: 0.3s ease all !important
       }

       .ladda-button[data-style=expand-right] .ladda-spinner {
              right: 14px
       }

       .ladda-button[data-style=expand-right][data-size="s"] .ladda-spinner,
       .ladda-button[data-style=expand-right][data-size="xs"] .ladda-spinner {
              right: 4px
       }

       .ladda-button[data-style=expand-right][data-loading] {
              padding-right: 56px
       }

       .ladda-button[data-style=expand-right][data-loading] .ladda-spinner {
              opacity: 1
       }

       .ladda-button[data-style=expand-right][data-loading][data-size="s"],
       .ladda-button[data-style=expand-right][data-loading][data-size="xs"] {
              padding-right: 40px
       }

       .ladda-button[data-style=expand-left] .ladda-spinner {
              left: 14px
       }

       .ladda-button[data-style=expand-left][data-size="s"] .ladda-spinner,
       .ladda-button[data-style=expand-left][data-size="xs"] .ladda-spinner {
              left: 4px
       }

       .ladda-button[data-style=expand-left][data-loading] {
              padding-left: 56px
       }

       .ladda-button[data-style=expand-left][data-loading] .ladda-spinner {
              opacity: 1
       }

       .ladda-button[data-style=expand-left][data-loading][data-size="s"],
       .ladda-button[data-style=expand-left][data-loading][data-size="xs"] {
              padding-left: 40px
       }

       .ladda-button[data-style=expand-up] {
              overflow: hidden
       }

       .ladda-button[data-style=expand-up] .ladda-spinner {
              top: -32px;
              left: 50%;
              margin-left: -16px
       }

       .ladda-button[data-style=expand-up][data-loading] {
              padding-top: 54px
       }

       .ladda-button[data-style=expand-up][data-loading] .ladda-spinner {
              opacity: 1;
              top: 14px;
              margin-top: 0
       }

       .ladda-button[data-style=expand-up][data-loading][data-size="s"],
       .ladda-button[data-style=expand-up][data-loading][data-size="xs"] {
              padding-top: 32px
       }

       .ladda-button[data-style=expand-up][data-loading][data-size="s"] .ladda-spinner,
       .ladda-button[data-style=expand-up][data-loading][data-size="xs"] .ladda-spinner {
              top: 4px
       }

       .ladda-button[data-style=expand-down] {
              overflow: hidden
       }

       .ladda-button[data-style=expand-down] .ladda-spinner {
              top: 62px;
              left: 50%;
              margin-left: -16px
       }

       .ladda-button[data-style=expand-down][data-size="s"] .ladda-spinner,
       .ladda-button[data-style=expand-down][data-size="xs"] .ladda-spinner {
              top: 40px
       }

       .ladda-button[data-style=expand-down][data-loading] {
              padding-bottom: 54px
       }

       .ladda-button[data-style=expand-down][data-loading] .ladda-spinner {
              opacity: 1
       }

       .ladda-button[data-style=expand-down][data-loading][data-size="s"],
       .ladda-button[data-style=expand-down][data-loading][data-size="xs"] {
              padding-bottom: 32px
       }

       .ladda-button[data-style=slide-left] {
              overflow: hidden
       }

       .ladda-button[data-style=slide-left] .ladda-label {
              position: relative
       }

       .ladda-button[data-style=slide-left] .ladda-spinner {
              left: 100%;
              margin-left: -16px
       }

       .ladda-button[data-style=slide-left][data-loading] .ladda-label {
              opacity: 0;
              left: -100%
       }

       .ladda-button[data-style=slide-left][data-loading] .ladda-spinner {
              opacity: 1;
              left: 50%
       }

       .ladda-button[data-style=slide-right] {
              overflow: hidden
       }

       .ladda-button[data-style=slide-right] .ladda-label {
              position: relative
       }

       .ladda-button[data-style=slide-right] .ladda-spinner {
              right: 100%;
              margin-left: -16px
       }

       .ladda-button[data-style=slide-right][data-loading] .ladda-label {
              opacity: 0;
              left: 100%
       }

       .ladda-button[data-style=slide-right][data-loading] .ladda-spinner {
              opacity: 1;
              left: 50%
       }

       .ladda-button[data-style=slide-up] {
              overflow: hidden
       }

       .ladda-button[data-style=slide-up] .ladda-label {
              position: relative
       }

       .ladda-button[data-style=slide-up] .ladda-spinner {
              left: 50%;
              margin-left: -16px;
              margin-top: 1em
       }

       .ladda-button[data-style=slide-up][data-loading] .ladda-label {
              opacity: 0;
              top: -1em
       }

       .ladda-button[data-style=slide-up][data-loading] .ladda-spinner {
              opacity: 1;
              margin-top: -16px
       }

       .ladda-button[data-style=slide-down] {
              overflow: hidden
       }

       .ladda-button[data-style=slide-down] .ladda-label {
              position: relative
       }

       .ladda-button[data-style=slide-down] .ladda-spinner {
              left: 50%;
              margin-left: -16px;
              margin-top: -2em
       }

       .ladda-button[data-style=slide-down][data-loading] .ladda-label {
              opacity: 0;
              top: 1em
       }

       .ladda-button[data-style=slide-down][data-loading] .ladda-spinner {
              opacity: 1;
              margin-top: -16px
       }

       .ladda-button[data-style=zoom-out] {
              overflow: hidden
       }

       .ladda-button[data-style=zoom-out] .ladda-spinner {
              left: 50%;
              margin-left: -16px;
              -webkit-transform: scale(2.5);
              -moz-transform: scale(2.5);
              -ms-transform: scale(2.5);
              -o-transform: scale(2.5);
              transform: scale(2.5)
       }

       .ladda-button[data-style=zoom-out] .ladda-label {
              position: relative;
              display: inline-block
       }

       .ladda-button[data-style=zoom-out][data-loading] .ladda-label {
              opacity: 0;
              -webkit-transform: scale(0.5);
              -moz-transform: scale(0.5);
              -ms-transform: scale(0.5);
              -o-transform: scale(0.5);
              transform: scale(0.5)
       }

       .ladda-button[data-style=zoom-out][data-loading] .ladda-spinner {
              opacity: 1;
              -webkit-transform: none;
              -moz-transform: none;
              -ms-transform: none;
              -o-transform: none;
              transform: none
       }

       .ladda-button[data-style=zoom-in] {
              overflow: hidden
       }

       .ladda-button[data-style=zoom-in] .ladda-spinner {
              left: 50%;
              margin-left: -16px;
              -webkit-transform: scale(0.2);
              -moz-transform: scale(0.2);
              -ms-transform: scale(0.2);
              -o-transform: scale(0.2);
              transform: scale(0.2)
       }

       .ladda-button[data-style=zoom-in] .ladda-label {
              position: relative;
              display: inline-block
       }

       .ladda-button[data-style=zoom-in][data-loading] .ladda-label {
              opacity: 0;
              -webkit-transform: scale(2.2);
              -moz-transform: scale(2.2);
              -ms-transform: scale(2.2);
              -o-transform: scale(2.2);
              transform: scale(2.2)
       }

       .ladda-button[data-style=zoom-in][data-loading] .ladda-spinner {
              opacity: 1;
              -webkit-transform: none;
              -moz-transform: none;
              -ms-transform: none;
              -o-transform: none;
              transform: none
       }

       .ladda-button[data-style=contract] {
              overflow: hidden;
              width: 100px
       }

       .ladda-button[data-style=contract] .ladda-spinner {
              left: 50%;
              margin-left: -16px
       }

       .ladda-button[data-style=contract][data-loading] {
              border-radius: 50%;
              width: 52px
       }

       .ladda-button[data-style=contract][data-loading] .ladda-label {
              opacity: 0
       }

       .ladda-button[data-style=contract][data-loading] .ladda-spinner {
              opacity: 1
       }

       .ladda-button[data-style=contract-overlay] {
              overflow: hidden;
              width: 100px;
              box-shadow: 0px 0px 0px 3000px rgba(0, 0, 0, 0)
       }

       .ladda-button[data-style=contract-overlay] .ladda-spinner {
              left: 50%;
              margin-left: -16px
       }

       .ladda-button[data-style=contract-overlay][data-loading] {
              border-radius: 50%;
              width: 52px;
              box-shadow: 0px 0px 0px 3000px rgba(0, 0, 0, 0.8)
       }

       .ladda-button[data-style=contract-overlay][data-loading] .ladda-label {
              opacity: 0
       }

       .ladda-button[data-style=contract-overlay][data-loading] .ladda-spinner {
              opacity: 1
       }
</style>

<script>
       $(window).load(function() {
              // Bind normal buttons
              Ladda.bind('div:not(.progress-demo) button', {
                     timeout: 7500
              });

              // Bind progress buttons and simulate loading progress
              Ladda.bind('.progress-demo button', {
                     callback: function(instance) {
                            var progress = 0;
                            var interval = setInterval(function() {
                                   progress = Math.min(progress + Math.random() * 0.1, 1);
                                   instance.setProgress(progress);

                                   if (progress === 1) {
                                          instance.stop();
                                          clearInterval(interval);
                                   }
                            }, 2);
                     }
              });
       });
       (function(t, e) {
              "object" == typeof exports ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.Spinner = e()
       })(this, function() {
              "use strict";

              function t(t, e) {
                     var i, n = document.createElement(t || "div");
                     for (i in e) n[i] = e[i];
                     return n
              }

              function e(t) {
                     for (var e = 1, i = arguments.length; i > e; e++) t.appendChild(arguments[e]);
                     return t
              }

              function i(t, e, i, n) {
                     var o = ["opacity", e, ~~(100 * t), i, n].join("-"),
                            r = .01 + 100 * (i / n),
                            a = Math.max(1 - (1 - t) / e * (100 - r), t),
                            s = u.substring(0, u.indexOf("Animation")).toLowerCase(),
                            l = s && "-" + s + "-" || "";
                     return f[o] || (c.insertRule("@" + l + "keyframes " + o + "{" + "0%{opacity:" + a + "}" + r + "%{opacity:" + t + "}" + (r + .01) + "%{opacity:1}" + (r + e) % 100 + "%{opacity:" + t + "}" + "100%{opacity:" + a + "}" + "}", c.cssRules.length), f[o] = 1), o
              }

              function n(t, e) {
                     var i, n, o = t.style;
                     if (void 0 !== o[e]) return e;
                     for (e = e.charAt(0).toUpperCase() + e.slice(1), n = 0; d.length > n; n++)
                            if (i = d[n] + e, void 0 !== o[i]) return i
              }

              function o(t, e) {
                     for (var i in e) t.style[n(t, i) || i] = e[i];
                     return t
              }

              function r(t) {
                     for (var e = 1; arguments.length > e; e++) {
                            var i = arguments[e];
                            for (var n in i) void 0 === t[n] && (t[n] = i[n])
                     }
                     return t
              }

              function a(t) {
                     for (var e = {
                                   x: t.offsetLeft,
                                   y: t.offsetTop
                            }; t = t.offsetParent;) e.x += t.offsetLeft, e.y += t.offsetTop;
                     return e
              }

              function s(t) {
                     return this === void 0 ? new s(t) : (this.opts = r(t || {}, s.defaults, p), void 0)
              }

              function l() {
                     function i(e, i) {
                            return t("<" + e + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', i)
                     }
                     c.addRule(".spin-vml", "behavior:url(#default#VML)"), s.prototype.lines = function(t, n) {
                            function r() {
                                   return o(i("group", {
                                          coordsize: u + " " + u,
                                          coordorigin: -l + " " + -l
                                   }), {
                                          width: u,
                                          height: u
                                   })
                            }

                            function a(t, a, s) {
                                   e(f, e(o(r(), {
                                          rotation: 360 / n.lines * t + "deg",
                                          left: ~~a
                                   }), e(o(i("roundrect", {
                                          arcsize: n.corners
                                   }), {
                                          width: l,
                                          height: n.width,
                                          left: n.radius,
                                          top: -n.width >> 1,
                                          filter: s
                                   }), i("fill", {
                                          color: n.color,
                                          opacity: n.opacity
                                   }), i("stroke", {
                                          opacity: 0
                                   }))))
                            }
                            var s, l = n.length + n.width,
                                   u = 2 * l,
                                   d = 2 * -(n.width + n.length) + "px",
                                   f = o(r(), {
                                          position: "absolute",
                                          top: d,
                                          left: d
                                   });
                            if (n.shadow)
                                   for (s = 1; n.lines >= s; s++) a(s, -2, "progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");
                            for (s = 1; n.lines >= s; s++) a(s);
                            return e(t, f)
                     }, s.prototype.opacity = function(t, e, i, n) {
                            var o = t.firstChild;
                            n = n.shadow && n.lines || 0, o && o.childNodes.length > e + n && (o = o.childNodes[e + n], o = o && o.firstChild, o = o && o.firstChild, o && (o.opacity = i))
                     }
              }
              var u, d = ["webkit", "Moz", "ms", "O"],
                     f = {},
                     c = function() {
                            var i = t("style", {
                                   type: "text/css"
                            });
                            return e(document.getElementsByTagName("head")[0], i), i.sheet || i.styleSheet
                     }(),
                     p = {
                            lines: 12,
                            length: 7,
                            width: 5,
                            radius: 10,
                            rotate: 0,
                            corners: 1,
                            color: "#000",
                            direction: 1,
                            speed: 1,
                            trail: 100,
                            opacity: .25,
                            fps: 20,
                            zIndex: 2e9,
                            className: "spinner",
                            top: "auto",
                            left: "auto",
                            position: "relative"
                     };
              s.defaults = {}, r(s.prototype, {
                     spin: function(e) {
                            this.stop();
                            var i, n, r = this,
                                   s = r.opts,
                                   l = r.el = o(t(0, {
                                          className: s.className
                                   }), {
                                          position: s.position,
                                          width: 0,
                                          zIndex: s.zIndex
                                   }),
                                   d = s.radius + s.length + s.width;
                            if (e && (e.insertBefore(l, e.firstChild || null), n = a(e), i = a(l), o(l, {
                                          left: ("auto" == s.left ? n.x - i.x + (e.offsetWidth >> 1) : parseInt(s.left, 10) + d) + "px",
                                          top: ("auto" == s.top ? n.y - i.y + (e.offsetHeight >> 1) : parseInt(s.top, 10) + d) + "px"
                                   })), l.setAttribute("role", "progressbar"), r.lines(l, r.opts), !u) {
                                   var f, c = 0,
                                          p = (s.lines - 1) * (1 - s.direction) / 2,
                                          h = s.fps,
                                          m = h / s.speed,
                                          g = (1 - s.opacity) / (m * s.trail / 100),
                                          v = m / s.lines;
                                   (function y() {
                                          c++;
                                          for (var t = 0; s.lines > t; t++) f = Math.max(1 - (c + (s.lines - t) * v) % m * g, s.opacity), r.opacity(l, t * s.direction + p, f, s);
                                          r.timeout = r.el && setTimeout(y, ~~(1e3 / h))
                                   })()
                            }
                            return r
                     },
                     stop: function() {
                            var t = this.el;
                            return t && (clearTimeout(this.timeout), t.parentNode && t.parentNode.removeChild(t), this.el = void 0), this
                     },
                     lines: function(n, r) {
                            function a(e, i) {
                                   return o(t(), {
                                          position: "absolute",
                                          width: r.length + r.width + "px",
                                          height: r.width + "px",
                                          background: e,
                                          boxShadow: i,
                                          transformOrigin: "left",
                                          transform: "rotate(" + ~~(360 / r.lines * l + r.rotate) + "deg) translate(" + r.radius + "px" + ",0)",
                                          borderRadius: (r.corners * r.width >> 1) + "px"
                                   })
                            }
                            for (var s, l = 0, d = (r.lines - 1) * (1 - r.direction) / 2; r.lines > l; l++) s = o(t(), {
                                   position: "absolute",
                                   top: 1 + ~(r.width / 2) + "px",
                                   transform: r.hwaccel ? "translate3d(0,0,0)" : "",
                                   opacity: r.opacity,
                                   animation: u && i(r.opacity, r.trail, d + l * r.direction, r.lines) + " " + 1 / r.speed + "s linear infinite"
                            }), r.shadow && e(s, o(a("#000", "0 0 4px #000"), {
                                   top: "2px"
                            })), e(n, e(s, a(r.color, "0 0 1px rgba(0,0,0,.1)")));
                            return n
                     },
                     opacity: function(t, e, i) {
                            t.childNodes.length > e && (t.childNodes[e].style.opacity = i)
                     }
              });
              var h = o(t("group"), {
                     behavior: "url(#default#VML)"
              });
              return !n(h, "transform") && h.adj ? l() : u = n(h, "animation"), s
       });
       (function(t, e) {
              "object" == typeof exports ? module.exports = e() : "function" == typeof define && define.amd ? define(["spin"], e) : t.Ladda = e(t.Spinner)
       })(this, function(t) {
              "use strict";

              function e(t) {
                     if (t === void 0) return console.warn("Ladda button target must be defined."), void 0;
                     t.querySelector(".ladda-label") || (t.innerHTML = '<span class="ladda-label">' + t.innerHTML + "</span>");
                     var e = i(t),
                            n = document.createElement("span");
                     n.className = "ladda-spinner", t.appendChild(n);
                     var r, a = {
                            start: function() {
                                   return t.setAttribute("disabled", ""), t.setAttribute("data-loading", ""), clearTimeout(r), e.spin(n), this.setProgress(0), this
                            },
                            startAfter: function(t) {
                                   return clearTimeout(r), r = setTimeout(function() {
                                          a.start()
                                   }, t), this
                            },
                            stop: function() {
                                   return t.removeAttribute("disabled"), t.removeAttribute("data-loading"), clearTimeout(r), r = setTimeout(function() {
                                          e.stop()
                                   }, 1e3), this
                            },
                            toggle: function() {
                                   return this.isLoading() ? this.stop() : this.start(), this
                            },
                            setProgress: function(e) {
                                   e = Math.max(Math.min(e, 1), 0);
                                   var n = t.querySelector(".ladda-progress");
                                   0 === e && n && n.parentNode ? n.parentNode.removeChild(n) : (n || (n = document.createElement("div"), n.className = "ladda-progress", t.appendChild(n)), n.style.width = (e || 0) * t.offsetWidth + "px")
                            },
                            enable: function() {
                                   return this.stop(), this
                            },
                            disable: function() {
                                   return this.stop(), t.setAttribute("disabled", ""), this
                            },
                            isLoading: function() {
                                   return t.hasAttribute("data-loading")
                            }
                     };
                     return o.push(a), a
              }

              function n(t, n) {
                     n = n || {};
                     var r = [];
                     "string" == typeof t ? r = a(document.querySelectorAll(t)) : "object" == typeof t && "string" == typeof t.nodeName && (r = [t]);
                     for (var i = 0, o = r.length; o > i; i++)(function() {
                            var t = r[i];
                            if ("function" == typeof t.addEventListener) {
                                   var a = e(t),
                                          o = -1;
                                   t.addEventListener("click", function() {
                                          a.startAfter(1), "number" == typeof n.timeout && (clearTimeout(o), o = setTimeout(a.stop, n.timeout)), "function" == typeof n.callback && n.callback.apply(null, [a])
                                   }, !1)
                            }
                     })()
              }

              function r() {
                     for (var t = 0, e = o.length; e > t; t++) o[t].stop()
              }

              function i(e) {
                     var n, r = e.offsetHeight;
                     r > 32 && (r *= .8), e.hasAttribute("data-spinner-size") && (r = parseInt(e.getAttribute("data-spinner-size"), 10)), e.hasAttribute("data-spinner-color") && (n = e.getAttribute("data-spinner-color"));
                     var i = 12,
                            a = .2 * r,
                            o = .6 * a,
                            s = 7 > a ? 2 : 3;
                     return new t({
                            color: n || "#fff",
                            lines: i,
                            radius: a,
                            length: o,
                            width: s,
                            zIndex: "auto",
                            top: "auto",
                            left: "auto",
                            className: ""
                     })
              }

              function a(t) {
                     for (var e = [], n = 0; t.length > n; n++) e.push(t[n]);
                     return e
              }
              var o = [];
              return {
                     bind: n,
                     create: e,
                     stopAll: r
              }
       });
</script>










<!DOCTYPE html>
<html class="artdeco " lang="id-ID">

<head>
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">

       <title>Login hrs, Masuk | hrs</title>

       <link rel="stylesheet" href="asset/vendor/front.css">



</head>

<body class="system-fonts ">
       <div id="app__container" class="">
              <header>
                     <div class="nav__base mercado-nav__base--none"></div>
              </header>
              <main class="app__content " role="main">
                     <div data-litms-pageview="true"></div>
                     <div class="header__logo" aria-hidden="true">
                            <h2 class="in__logo">hrs</h2>


                            <style>
                                   body,
                                   p {
                                          font-size: 1.6rem;
                                          line-height: 1.5;
                                          font-weight: 400;
                                          color: rgba(0, 0, 0, 0.9);
                                          overflow: hidden;
                                   }
                            </style>

                            </li-icon>
                     </div>
                     <div class="header__content ">
                            <img src="asset/img/corporate.png" width="300">
                            <h1 class="header__content__heading "></h1>
                            <p class="header__content__subheading ">Silahkan masuk untuk melakukan pengajuan administrasi kehadiran anda seperti Cuti, Ijin, Sakit dll. </p>
                     </div>







                     <!DOCTYPE html>
                     <html>
                     <style>
                            /* The container */
                            .container {
                                   display: block;
                                   position: relative;
                                   margin-bottom: 12px;
                                   cursor: pointer;
                                   font-size: 14px;
                                   -webkit-user-select: none;
                                   -moz-user-select: none;
                                   -ms-user-select: none;
                                   user-select: none;
                            }

                            /* Hide the browser's default checkbox */
                            .container input {
                                   position: absolute;
                                   opacity: 0;
                                   cursor: pointer;
                                   height: 0;
                                   width: 0;
                            }

                            /* Create a custom checkbox */
                            .checkmark {
                                   position: absolute;
                                   top: 0;
                                   left: 0;
                                   height: 25px;
                                   width: 25px;
                                   background-color: #eee;
                            }

                            /* On mouse-over, add a grey background color */
                            .container:hover input~.checkmark {
                                   background-color: #ccc;
                            }

                            /* When the checkbox is checked, add a blue background */
                            .container input:checked~.checkmark {
                                   background-color: #2196F3;
                            }

                            /* Create the checkmark/indicator (hidden when not checked) */
                            .checkmark:after {
                                   content: "";
                                   position: absolute;
                                   display: none;
                            }

                            /* Show the checkmark when checked */
                            .container input:checked~.checkmark:after {
                                   display: block;
                            }

                            /* Style the checkmark/indicator */
                            .container .checkmark:after {
                                   left: 9px;
                                   top: 5px;
                                   width: 5px;
                                   height: 10px;
                                   border: solid white;
                                   border-width: 0 3px 3px 0;
                                   -webkit-transform: rotate(45deg);
                                   -ms-transform: rotate(45deg);
                                   transform: rotate(45deg);
                            }
                     </style>

                     <body>



                            <script>
                                   function myFunction() {
                                          var x = document.getElementById("password");
                                          if (x.type === "password") {
                                                 x.type = "text";
                                          } else {
                                                 x.type = "password";
                                          }
                                   }
                            </script>



                            <?php
                            $value = $message;
                            if ($value == 1) {
                                   echo "<script type='text/javascript'>
              window.alert('Wrong Password'); 
       </script>";
                            } elseif ($value == 2) {
                                   echo "<script type='text/javascript'>
              window.alert('Wrong Credential Data or Invalid Session'); 
       </script>";
                            }
                            if ($value == 3) {
                                   echo "<script type='text/javascript'>
              window.alert('Something wrong!'); 
       </script>";
                            }
                            ?>




