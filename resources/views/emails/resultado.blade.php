<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CS1</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            min-width: 100% !important;
        }

        .content {
            width: 100%;
            max-width: 600px;
        }

        img {
            display: block
        }

    </style>
</head>

<body yahoo bgcolor="#fff">
    <table width="750" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="vertical-align: top;">
                <img src="https://qacci.dinersclubperu.pe/mail/header.jpg" alt="" width="750">
            </td>
        </tr>
        <tr style="background-color:#0079c2">
            <td>
                <table width="750" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="30"></td>
                        <td width="420">
                            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="100%" height="0"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:42px; color: #ffffff; margin: 0px 0 10px 8px ; padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">
                                            {{ $data['nombre'] }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:38px; color: #ffffff; margin: 0px 0 6px 8px ; padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">
                                            aqu&iacute; el resumen</p>
                                        <p
                                            style="font-size:38px; color: #ffffff; margin: 0px 0 6px 8px ; padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">
                                            de su transacci&oacute;n</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="420">
                            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="100%" height="50"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:20px; color: #ffffff; margin: 10px 0 0px 8px ; padding: 20px 0; font-family: Arial, Helvetica, sans-serif;text-align: left; border-top: 1px solid white;">
                                            {{ $data['refinanciacion']->nro_compras }} compras en soles: <span
                                                style="font-weight: bold;">{{ $data['refinanciacion']->tipo_compra == 'dolares' ? '$ ' : 'S/ ' }}
                                                {{ number_format($data['refinanciacion']->total_refinanciar, 2) }}</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:20px; color: #ffffff; margin: 4px 0 0px 8px ; padding: 20px 0; font-family: Arial, Helvetica, sans-serif;text-align: left; border-top: 1px solid white;">
                                            Tasa preferencial: 12%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:20px; color: #ffffff; margin: 4px 0 0px 8px ; padding: 20px 0; font-family: Arial, Helvetica, sans-serif;text-align: left; border-top: 1px solid white;">
                                            N&uacute;mero de cuotas:
                                            {{ $data['refinanciacion']->nro_cuotas < 10 ? '0' : '' }}{{ $data['refinanciacion']->nro_cuotas }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:20px; color: #ffffff; margin: 4px 0 0px 8px ; padding: 20px 0; font-family: Arial, Helvetica, sans-serif;text-align: left; border-top: 1px solid white;">
                                            Nueva cuota mensual:
                                            {{ $data['refinanciacion']->tipo_compra == 'dolares' ? '$ ' : 'S/ ' }}{{ number_format($data['refinanciacion']->cuota_mensual, 2) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style="width: 100%; height:1px; border-top: 1px solid white;margin: 4px 0 0px 8px">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%" height="60"> </td>
                                </tr>
                            </table>
                        </td>
                        <td width="30"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="750" valign="top" height="41"></td>
        </tr>
        <tr>
            <td>
                <table width="750" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66" valign="top"></td>
                        <td width="762" valign="top">
                            <p
                                style="font-size:16px; color: #878787; margin: 0px 0 12px 0px ; line-height: 36px;padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">
                                T&eacute;rminos y Condiciones: </p>
                            <p
                                style="font-size:16px; color: #878787; margin: 0px 0 12px 0px ; line-height: 36px;padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">
                                Campa&ntilde;a vigente del {{ $data['dia_inicio'] }} al {{ $data['dia_fin'] }} de {{ $data['mes_actual'] }} de {{ $data['anio'] }}. La tasa vigente exclusiva para
                                esta campa&ntilde;a es TEA 12%, y se aplicar&aacute; &uacute;nicamente para el
                                financiamiento de consumos en cuotas sin intereses, para los dem&aacute;s consumos
                                aplicar&aacute; la tasa vigente para el titular seg&uacute;n el tarifario. Diners Club
                                tendr&aacute; como m&aacute;ximo cuarenta y ocho (48) horas h&aacute;biles para ejecutar
                                en los sistemas la solicitud ingresada. La aprobaci&oacute;n de la solicitud la
                                ver&aacute; reflejada a trav&eacute;s de una constancia enviada al correo
                                electr&oacute;nico del Socio registrado en nuestra base de datos, as&iacute; como en su
                                pr&oacute;ximo Estado de Cuenta, en donde se reflejar&aacute; el financiamiento en
                                cuotas en la secci&oacute;n de “Detalle de movimientos” con la glosa "Refinanciamiento
                                en cuotas"</p>
                            <p
                                style="font-size:16px; color: #878787; margin: 0px 0 12px 0px ; line-height: 36px;padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">
                                Para mayor informaci&oacute;n sobre condiciones, tasas, comisiones y gastos consulte
                                nuestro Tarifario ubicado en la Red de Oficinas, ingrese a <a
                                    href="https://www.dinersclub.pe" target="_blank"
                                    style="font-size:16px; color: #878787;  padding: 0; font-family: Arial, Helvetica, sans-serif;text-align: left;">www.dinersclub.pe</a>
                                o comun&iacute;quese al &aacute;rea de Atenci&oacute;n al Socio llamando al (01)
                                615.1111, opci&oacute;n 2. Esta informaci&oacute;n se proporciona de acuerdo con el
                                Reglamento de Gesti&oacute;n de Conducta de Mercado del Sistema Financiero.</p>
                        </td>
                        <td width="72" valign="top"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="750" valign="top" height="80"></td>
        </tr>
        <tr>
            <td width="750" valign="top" height="177">
                <img src="https://qacci.dinersclubperu.pe/mail/footer.jpg" width="750" style="display:block;width:750px;border:0">
            </td>
        </tr>
    </table>
</body>

</html>
