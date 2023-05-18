<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <title>Ativo interno</title>
</head>

<body>
    <table style="width: 300px; border-width: 2px; border-style: solid; border-color: black;">
        <tr>
            <td style="padding: 5px;">

                <img src="data:image/png;base64, {!! base64_encode(
                    QrCode::format('svg')->size(100)->generate('http://sga-admin.test/consulta-ativo/' . $data->id),
                ) !!} ">

            </td>

            <td style="padding: 5px;">
                <span style="font-size: 24px; text-transform: uppercase;"><strong>{{ $data->patrimonio }}</strong></span><br>
                <span style="font-size: 24px;">{{ $data->titulo }} <span style="font-size: 18px;">{{ Tratamento::simpleDate($data->created_at) }}</span></span>

            </td>
        </tr>
    </table>

</body>

</html>
