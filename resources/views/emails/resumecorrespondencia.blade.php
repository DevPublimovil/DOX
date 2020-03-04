<!-- MENU -->
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" bgcolor="#ffffff">
        <table class="table600" width="600" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="20" style="font-size: 1px; line-height: 20px;">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
              <img src="http://publimovil.iw.sv/images/publimovil-logo-dark.png" alt="logo" width="165" height="55" style="max-width: 220px; display: inline-block;">
            </td>
          </tr>
          <tr>
            <td height="20" style="font-size: 1px; line-height: 20px;">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!-- END MENU -->
  
  <!-- MAIN A -->
  <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <!-- Background -->
      <td align="center" bgcolor="#f5f5f5">
        <table class="table600" width="600" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="40" style="font-size: 1px; line-height: 40px;">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" style="font-family: 'Montserrat', sans-serif; font-size: 32px; font-weight: 400; color: #EB5B29; line-height: 42px; letter-spacing: 4px;">
             Informe DOX
            </td>
          </tr>
  
          <!-- Underline -->
          <tr>
            <td align="center">
              <table width="75" border="0" cellpadding="0" cellspacing="0">
              <!-- Edit Underline -->
                <tr>
                  <td height="20" style="border-bottom: 2px solid #EB5B29;"></td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- End Underline -->
  
          <tr>
            <td height="30" style="font-size: 1px; line-height: 30px;">&nbsp;</td>
          </tr>
  
          <tr>
            <td align="left" style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #22292f">
              <p style="text-align:center">¡Buen día!<br><span style="color:red;font-weight:400">DOX</span> @if(isset($motivo)) Te informa que han rechazado la siguiente correspondencia: @else te muestra el resumen de la correspondencia recibida @endif</p>
              @if(isset($correspondencias))
                @foreach ($correspondencias as $key=>$item)
                    <p style="margin:0%;padding:0%"><strong># </strong>{{$key+1}}</p>
                    <p style="margin:0%;padding:0%"><strong>Tipo: </strong>{{$item->tipo->nombre}}</p>
                    <p style="margin:0%;padding:0%"><strong>Detalles: </strong>{{$item->descripcion}}</p>
                    <hr>
                @endforeach
              @else
                @if(isset($motivo)) <p>Motivo: {{$motivo}}</p>@endif
                <p style="margin:0%;padding:0%"><strong>Tipo: </strong>{{$documento->tipo->nombre}}</p>
                <p style="margin:0%;padding:0%"><strong>Detalles: </strong>{{$documento->descripcion}}</p>
                <hr>
              @endif
          </tr>
  
          <tr>
            <td height="30" style="font-size: 1px; line-height: 30px;">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!-- END MAIN A -->
  
  <!-- FOOTER A -->
  <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" bgcolor="#EB5B29">
        <table class="table600" width="600" border="0" cellpadding="0" cellspacing="0">
  
          <tr>
            <td height="10" style="font-size: 1px; line-height: 10px;">&nbsp;</td>
          </tr>
  
          <tr>
            <td>
  
              <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
  
                <tr>
                  <td style="font-family: 'Open Sans', sans-serif; font-size: 9px; color: #ffffff; line-height: 12px;">
                    Este es mensaje auto-generado desde el sitio web de DOX. Por favor, no respondas a este correo.
                  </td>
                </tr>
  
              </table>
  
              <!-- SPACE -->
                <table class="full-width" width="1" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" >
                  <tr>
                    <td width="1" height="15" style="font-size: 1px; line-height: 15px;"></td>
                  </tr>
                </table>
              <!-- END SPACE -->
  
            </td>
          </tr>
  
          <tr>
            <td height="10" style="font-size: 1px; line-height: 10px;">&nbsp;</td>
          </tr>
  
        </table>
      </td>
    </tr>
  </table>
  <!-- END FOOTER A -->
  