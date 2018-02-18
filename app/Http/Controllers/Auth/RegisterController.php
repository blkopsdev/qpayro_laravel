<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\role_user;
use App\PaymentGateway;
use App\business;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'country' => 'required',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'status' => 'Active',
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'role' => 'User',
        ]);
        $id = $user->id;

        role_user::create([
          'user_id' => $id,
          'role_id' => '2',
        ]);

        session()->put('business_actual', '');
        session()->put('business_details', '');

        $url = 'https://api.sendgrid.com/';
        $user_sendgrid = 'qpaypro';
        $pass = 'H3jK8K-O9';

        $json_string = array(

          'to' => array(
            $data['email'], 'info@qpaypro.com'
          )
        );

        $params = array(
            'api_user'  => $user_sendgrid,
            'api_key'   => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to'        => $data['email'],
            'subject'   => 'Bienvenido a QPayPro',
            'html'      => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" data-dnd="true">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <!--<![endif]-->

  <!--[if (gte mso 9)|(IE)]><style type="text/css">
  table {border-collapse: collapse;}
  table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
  img {-ms-interpolation-mode: bicubic;}
  </style>
  <![endif]-->
  <style type="text/css">
  body {
    color: #626262;
  }
  body a {
    color: #0088cd;
    text-decoration: none;
  }
  p { margin: 0; padding: 0; }
  table[class="wrapper"] {
    width:100% !important;
    table-layout: fixed;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
    -moz-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
  }
  img[class="max-width"] {
    max-width: 100% !important;
  }
  @media screen and (max-width:480px) {
    .preheader .rightColumnContent,
    .footer .rightColumnContent {
        text-align: left !important;
    }
    .preheader .rightColumnContent div,
    .preheader .rightColumnContent span,
    .footer .rightColumnContent div,
    .footer .rightColumnContent span {
      text-align: left !important;
    }
    .preheader .rightColumnContent,
    .preheader .leftColumnContent {
      font-size: 80% !important;
      padding: 5px 0;
    }
    table[class="wrapper-mobile"] {
      width: 100% !important;
      table-layout: fixed;
    }
    img[class="max-width"] {
      height: auto !important;
    }
    a[class="bulletproof-button"] {
      display: block !important;
      width: auto !important;
      font-size: 80%;
      padding-left: 0 !important;
      padding-right: 0 !important;
    }
    // 2 columns
    #templateColumns{
        width:100% !important;
    }

    .templateColumnContainer{
        display:block !important;
        width:100% !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
  }
  </style>
  <style>
  body, p, div { font-family: helvetica,arial,sans-serif; }
</style>
  <style>
  body, p, div { font-size: 15px; }
</style>
</head>
<body yahoofix="true" style="min-width: 100%; margin: 0; padding: 0; font-size: 15px; font-family: helvetica,arial,sans-serif; color: #626262; background-color: #F4F4F4; color: #626262;" data-attributes="%7B%22dropped%22%3Atrue%2C%22bodybackground%22%3A%22%23F4F4F4%22%2C%22bodyfontname%22%3A%22helvetica%2Carial%2Csans-serif%22%2C%22bodytextcolor%22%3A%22%23626262%22%2C%22bodylinkcolor%22%3A%22%230088cd%22%2C%22bodyfontsize%22%3A15%7D>
  <center class="wrapper">
    <div class="webkit">
      <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#F4F4F4">
      <tr><td valign="top" bgcolor="#F4F4F4" width="100%">
      <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
          <![endif]-->
            <table width="100%" role="content-container" class="outer" data-attributes="%7B%22dropped%22%3Atrue%2C%22containerpadding%22%3A%220%2C0%2C0%2C0%22%2C%22containerwidth%22%3A600%2C%22containerbackground%22%3A%22%23F4F4F4%22%7D" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                    <!--[if (gte mso 9)|(IE)]>
                      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td>
                            <![endif]-->
                              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
                                <tr><td role="modules-container" style="padding: 0px 0px 0px 0px; color: #626262; text-align: left;" bgcolor="#F4F4F4" width="100%" align="left">
                                  <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="display:none !important; visibility:hidden; opacity:0; color:transparent; height:0; width:0;" class="module preheader preheader-hide" role="module" data-type="preheader">
  <tr><td role="module-content"><p>Tu cuenta ha sido creada exitosamente.</p></td></tr>
</table>
<table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22http%3A//app.qpaypro.com/app/public/login%22%2C%22width%22%3A%22200%22%2C%22height%22%3A%2256%22%2C%22imagebackground%22%3A%22%23f4f4f4%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png%22%2C%22alt_text%22%3A%22QPayPro%20-%20Negocios%20Electr%F3nicos%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%2220%2C0%2C20%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
<tr>
  <td style="font-size:6px;line-height:10px;background-color:#f4f4f4;padding: 20px 0px 20px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
<center>
<table width="200" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
  <tr>
    <td width="200" valign="top">
<![endif]-->
<a href="https://app.qpaypro.com" target="_blank">
  <img class="max-width"  width="200"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png" alt="QPayPro - Negocios Electrónicos" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 200px !important; width: 100% !important; height: auto !important; " />
</a>
<!--[if mso]>
</td></tr></table>
</center>
<![endif]--></td>
</tr>
</table><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C10%2C23%22%2C%22containerbackground%22%3A%22%23222121%22%7D">
<tr>
  <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 10px 23px;" bgcolor="#222121"><h1 style="text-align: center;"><span style="color:#FFFFFF;">Bienvenido a QPayPro</span></h1> </td>
</tr>
</table>
<table class="module" role="module" data-type="button" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22borderradius%22%3A6%2C%22buttonpadding%22%3A%2212%2C18%2C12%2C18%22%2C%22text%22%3A%22Empecemos%2520a%2520configurar%2520tu%2520cuenta%22%2C%22alignment%22%3A%22center%22%2C%22fontsize%22%3A16%2C%22url%22%3A%22https%253A//app.qpaypro.com/app/public/%22%2C%22height%22%3A%22%22%2C%22width%22%3A%22%22%2C%22containerbackground%22%3A%22%23222121%22%2C%22padding%22%3A%220%2C0%2C30%2C0%22%2C%22buttoncolor%22%3A%22%231188e6%22%2C%22textcolor%22%3A%22%23ffffff%22%2C%22bordercolor%22%3A%22%231288e5%22%7D">
<tr>
  <td style="padding: 0px 0px 30px 0px;" align="center" bgcolor="#222121">
    <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile">
      <tr>
        <td align="center" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; font-size: 16px;" bgcolor="#1188e6">
          <a href="https://app.qpaypro.com" class="bulletproof-button" target="_blank" style="height: px; width: px; font-size: 16px; line-height: px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 12px 18px 12px 18px; text-decoration: none; color: #ffffff; text-decoration: none; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border: 1px solid #1288e5; display: inline-block;">Empecemos a configurar tu cuenta</a>
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
<table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C34%2C23%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
<tr>
  <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 34px 23px;" bgcolor="#ffffff"><h1 style="text-align: center;"><span style="color:#2D2D2D;">Tu cuenta ha sido creada exitosamente</span></h1>  <div style="text-align: center;">Ahora completa tu aplicaci&oacute;n y empieza a recibir pagos en l&iacute;nea</div> </td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" role="module" data-type="columns" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A4%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22cellpadding%22%3A0%2C%22containerbackground%22%3A%22%22%7D">
  <tr><td style="padding: 0px 0px 0px 0px;" bgcolor="">
    <table class="columns--container-table" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
      <tr role="module-content">
        <td style="padding: 0px 0px 0px 0px" role="column-0" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
  <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/34970b0cf62ff01021c56a91bc7bdd22f5df1cfaf6b615b5fad9039e7d581d35f32d11c58737c73024bf42655596a2da4c3d0ec1017803c37b07a1b6582d6768.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
<tr>
  <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
<center>
<table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
  <tr>
    <td width="50" valign="top">
<![endif]-->

  <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/34970b0cf62ff01021c56a91bc7bdd22f5df1cfaf6b615b5fad9039e7d581d35f32d11c58737c73024bf42655596a2da4c3d0ec1017803c37b07a1b6582d6768.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

<!--[if mso]>
</td></tr></table>
</center>
<![endif]--></td>
</tr>
</table>
</td><td style="padding: 0px 0px 0px 0px" role="column-1" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
  <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/42b695da6fe99ce857721f0209e1adf4190f51a834cb45af5b1fc7422293c9c629b7ea6a2230d368503999dd5e5acda2aeb0a1e09265dca564317d259203a2e1.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
<tr>
  <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
<center>
<table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
  <tr>
    <td width="50" valign="top">
<![endif]-->

  <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/42b695da6fe99ce857721f0209e1adf4190f51a834cb45af5b1fc7422293c9c629b7ea6a2230d368503999dd5e5acda2aeb0a1e09265dca564317d259203a2e1.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

<!--[if mso]>
</td></tr></table>
</center>
<![endif]--></td>
</tr>
</table>
</td><td style="padding: 0px 0px 0px 0px" role="column-2" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
  <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/66f0a7ea03f8989f596eefde9f3a179973f2bb08526aba84eea98db89968264eccf90c2ca05c6b738baf6500e54bccd078a0fbe18fd7cf8598ea84c028fa7b1f.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
<tr>
  <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
<center>
<table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
  <tr>
    <td width="50" valign="top">
<![endif]-->

  <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/66f0a7ea03f8989f596eefde9f3a179973f2bb08526aba84eea98db89968264eccf90c2ca05c6b738baf6500e54bccd078a0fbe18fd7cf8598ea84c028fa7b1f.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

<!--[if mso]>
</td></tr></table>
</center>
<![endif]--></td>
</tr>
</table>
</td><td style="padding: 0px 0px 0px 0px" role="column-3" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
  <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/338f67587a9518856eca1dbf3d3ac25d092ebc90edef8a49923c169a50de399b7ed2985488b5e80e3cffbf75224bc2280d777f3d7d2641ceeb637ed8ebf909a7.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
<tr>
  <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
<center>
<table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
  <tr>
    <td width="50" valign="top">
<![endif]-->

  <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/338f67587a9518856eca1dbf3d3ac25d092ebc90edef8a49923c169a50de399b7ed2985488b5e80e3cffbf75224bc2280d777f3d7d2641ceeb637ed8ebf909a7.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

<!--[if mso]>
</td></tr></table>
</center>
<![endif]--></td>
</tr>
</table>
</td>
      </tr>
    </table>
  </td></tr>
</table><table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22spacing%22%3A30%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
<tr><td role="module-content" style="padding: 0px 0px 30px 0px;" bgcolor="#ffffff"></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="module footer" role="module" data-type="footer" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A%222%22%2C%22padding%22%3A%2248%2C34%2C17%2C34%22%2C%22containerbackground%22%3A%22%2332a9d6%22%7D">
  <tr><td style="padding: 48px 34px 17px 34px;" bgcolor="#32a9d6">
    <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
      <tr role="module-content">

        <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr>
              <td class="leftColumnContent" role="column-one" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
<tr>
  <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor="">  <div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;"><a href="[unsubscribe]"><span style="color:#FFFFFF;">Unsubscribe</span></a><span style="color:#FFFFFF;"> | </span><a href="[Unsubscribe_Preferences]"><span style="color:#FFFFFF;">Update Preferences</span></a></div>  </td>
</tr>
</table>
</td>
            </tr>
          </table>
        </td>
        <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr>
              <td class="rightColumnContent" role="column-two" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
<tr>
  <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor=""><div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">QPay, S.A.</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">Km. 22.5 Carretera a El Salvador, Edif. Plaza Portal del Bosque, Nivel 4, Of. 4A, Guatemala, Centro Am&eacute;rica</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">soporte@qpaypro.com</font></div> </td>
</tr>
</table>
</td>
            </tr>
          </table>
        </td>

      </tr>
    </table>
  </td></tr>
</table>

                                </tr></td>
                              </table>
                            <!--[if (gte mso 9)|(IE)]>
                          </td>
                        </td>
                      </table>
                    <![endif]-->
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
      </table>
      <![endif]-->
      </tr></td>
      </table>
    </div>
  </center>
</body>
</html>
',
            'text'      => '',
            'from'      => 'info@qpaypro.com',
          );
        $request =  $url.'api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt ($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);

        $json_string = array(

          'to' => array(
            'afiliaciones@qpaypro.com'
          )
        );

        $params = array(
            'api_user'  => $user_sendgrid,
            'api_key'   => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to'        => 'afiliaciones@qpaypro.com',
            'subject'   => 'Bienvenido a QPayPro',
            'html'      => '
              <p>Nuevo usuario registrado, la información del usuario es: </p><br>
              <ul>
                <li>Usuario: '.$data["username"].'</li>
                <li>Email: '. $data["email"] .'</li>
              </ul>
            ',
            'text'      => '',
            'from'      => 'info@qpaypro.com',
          );
        $request =  $url.'api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt ($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);

        curl_close($session);

        return $user;
        //Mail::to($user->email)->send(new Welcome($user));
        //return $user;
    }

}
