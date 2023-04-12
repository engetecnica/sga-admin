<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Termo de Retirada</title>
</head>

<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        border-collapse: collapse;
        text-align: justify;
    }

    @page {
        margin: 0 !important;
        padding: 0 !important;
    }

    body {
        background-image: url('assets/images/background-termo.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        z-index: -1000;
        margin: 0 !important;
        padding: 0;
    }

    table {
        width: 100% !important;
    }

    td,
    th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #C02028;
        color: white;
    }

    .container {
        margin-top: 150px !important;
        margin-left: 75px !important;
        margin-right: 75px !important;
    }

    .page-break { page-break-after: always; }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body text-justify">

                        <h4 class="card-title">DADOS DO FUNCIONÁRIO</h4>
                        <table class="table table-bordered table-striped table-houver">
                            <thead class="table-dark">
                                <tr>
                                    <th>Funcionário</th>
                                    <th>Matrícula</th>
                                    <th>Obra Atual</th>
                                    <th>Usuário Autorizado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $detalhes->funcionario }}</td>
                                    <td>{{ $detalhes->funcionario_matricula }}</td>
                                    <td>{{ $detalhes->codigo_obra }}</td>
                                    <td>{{ $detalhes->name }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>
                        <h4 class="card-title">TERMO DE RETIRADA</h4>
                        <p class="card-description">Identificação da Retirada #{{ $detalhes->id }}</p>
                        <p>
                            Pelo presente instrumento particular e na melhor forma de direito, de um lado, ENGETECNICA
                            ENGENHARIA E CONSTRUÇÃO LTDA, inscrita no CNPJ: 76.624.584/0001-38, Endereço Rua João
                            Bettega, 1160, CEP 81070-001, Município de Curitiba, Estado do Paraná, doravante denominada
                            COMODANTE.
                        </p>

                        <p>
                            E, de outro lado, <br>FUNCIONÁRIO, contratado pela Engetecnica Engenharia e Construção Ltda,
                            doravante denominada COMODATÁRIO.
                        </p>

                        <hr>
                        <h4 class="card-title">CLÁUSULA PRIMEIRA – DAS DECLARAÇÕES</h4>

                        <p>1.1 Declaro ter recebido da COMODANTE, à título de empréstimo, para uso em minhas funções
                            operacionais, conforme determinado em lei, as ferramentas e equipamentos especificados neste
                            termo de responsábilidade.</p>

                        <p>1.2 O COMODATÁRIO compromete-se a zelar, cuidar, manter em ordem e perfeito funcionamento,
                            todas as ferramentas e equipamentos disponibilizados para uso pela COMODANTE, durante todo
                            período da execução de suas atividades.</p>

                        <hr>
                        <h4 class="card-title">CLÁUSULA SEGUNDA – DAS OBRIGAÇÕES E RESPONSABILIDADES</h4>

                        <p>2.1 O COMODATÁRIO será responsabilizado em caso de danificar, extraviar, emprego inadequado,
                            e/ou mau uso. A COMODANTE fornecerá um novo equipamento ao COMODATÁRIO e cobrará o valor de
                            acordo com o custo do equipamento da mesma marca e modelo ou equivalente, disponível no
                            mercado.</p>


                        <p>2.2 Em caso de dano e inutilização do equipamento por parte do COMODATÁRIO o mesmo, deverá
                            comunicar por escrito a COMODANTE apresentando o equipamento danificado no prazo máximo de
                            24 horas. </p>                        

                        <p>2.3 Em caso de furto ou roubo, o COMODATÁRIO deverá apresentar o boletim de ocorrência, no
                            qual informe detalhadamente os fatos e as circunstâncias do ocorrido. </p>

                        <p>2.4 Uma vez em posse do COMODATÁRIO ferramentas e equipamentos, a COMODANTE poderá a qualquer
                            momento e sem prévio aviso, realizar as inspeções e conferencias de todos os itens
                            disponibilizados ao COMODATÁRIO.</p>

                        <hr>
                        <h4 class="card-title">CLÁUSULA TERCEIRA – DOS ITENS DISPONIBILIZADOS</h4>

                        <p>3.1 Todos os itens da lista abaixo foram conferidos, testados e recebidos pelo COMODATÁRIO
                            sem qualquer defeito e em pleno funcionamento, atendendo a todos os requisitos de segurança
                            aplicáveis aos mesmos.</p>

                        <hr>

                        <div class="page-break"></div>
                        <div style="margin-top: 150px;"></div>

                        <h4 class="card-title">Ítens Retirados</h4>
                        <table class="table table-bordered table-striped table-houver">
                            <thead>
                                <tr>
                                    <th> Obra </th>
                                    <th> Solicitante </th>
                                    <th> Funcionário </th>
                                    <th> Item </th>
                                    <th> Data de Inclusão </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalhes->itens as $item)
                                    <tr>
                                        <td>{{ $detalhes->codigo_obra }}</td>
                                        <td>{{ $detalhes->name }}</td>
                                        <td>{{ $detalhes->funcionario }}</td>
                                        <td>
                                            <div class="badge badge-danger">{{ $item->item_codigo_patrimonio }}
                                            </div>
                                            <div class="badge badge-info">{{ $item->item_nome }}</div>
                                        </td>
                                        <td>{{ Tratamento::FormatarData($detalhes->created_at) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p>Data para devolução:
                            <b>{{ Tratamento::FormatarData($detalhes->data_devolucao_prevista) }}</b>
                        </p>

                        <hr>
                        <h4 class="card-title">Assinaturas</h4>

                        <table class="table table-bordered">
                            <tr>
                                <td width="50%"><b>COMODANTE</b></td>
                                <td width="50%"><b>COMODATÁRIO</b></td>
                            </tr>
                            <tr>
                                <td>ENGETECNICA ENGENHARIA E CONSTRUCAO LTDA</td>
                                <td><b>Nome:</b> {{ $detalhes->funcionario }}</td>
                            </tr>
                            <tr>
                                <td><b>Representante:</b> {{ $detalhes->name }}</td>
                                <td><b>Matrícula:</b> {{ $detalhes->funcionario_matricula }}</td>
                            </tr>
                        </table>
                        
                        <div style="margin-top: 100px;"></div>
                        <p><b>Este termo foi gerado através da Plataforma SGA-E</b></p>
                        <p>{{ date('d/m/Y H:i:s') }}</p>

                        @if($detalhes->autenticado)
                            <div style="margin-top: 50px;"></div>
                            <h4 style="color:red !important">ESTE DOCUMENTO ESTÁ AUTENTICADO: {{ Tratamento::FormatarData($detalhes->autenticado->created_at) }}</h4>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
</body>


</html>
