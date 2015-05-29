<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Basic</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Basic Tables</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <?= $filters ?>

    <div class="row">
        <div class="col-md-12">

            <!-- START LINE CHART -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Chart</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div id="morris-line-example" style="height: 300px;"></div>
                </div>
            </div>
            <!-- END LINE CHART -->

        </div>
    </div>
    <div class="row">

        <div class="col-md-12">

            <!-- START DATATABLE EXPORT -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">DataTable Export</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                    </ul>
                    <div class="btn-group pull-right">
                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i>
                            Export Data
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'json',escape:'false'});"><img
                                        src='img/icons/json.png' width="24"/> JSON</a></li>
                            <li><a href="#"
                                   onClick="$('#respostas').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img
                                        src='img/icons/json.png' width="24"/> JSON (ignoreColumn)</a></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'json',escape:'true'});"><img
                                        src='img/icons/json.png' width="24"/> JSON (with Escape)</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'xml',escape:'false'});"><img
                                        src='img/icons/xml.png' width="24"/> XML</a></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'sql'});"><img
                                        src='img/icons/sql.png' width="24"/> SQL</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'csv',escape:'false'});"><img
                                        src='img/icons/csv.png' width="24"/> CSV</a></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'txt',escape:'false'});"><img
                                        src='img/icons/txt.png' width="24"/> TXT</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'excel',escape:'false'});"><img
                                        src='img/icons/xls.png' width="24"/> XLS</a></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'doc',escape:'false'});"><img
                                        src='img/icons/word.png' width="24"/> Word</a></li>
                            <li><a href="#"
                                   onClick="$('#respostas').tableExport({type:'powerpoint',escape:'false'});"><img
                                        src='img/icons/ppt.png' width="24"/> PowerPoint</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'png',escape:'false'});"><img
                                        src='img/icons/png.png' width="24"/> PNG</a></li>
                            <li><a href="#" onClick="$('#respostas').tableExport({type:'pdf',escape:'false'});"><img
                                        src='img/icons/pdf.png' width="24"/> PDF</a></li>
                        </ul>
                    </div>

                </div>
                <div class="panel-body">
                    <table id="respostas" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Módulo</th>
                            <th>Sub-Modulo</th>
                            <th>Dificuldade</th>
                            <th>Resposta dada</th>
                            <th>Avaliação</th>
                            <th>Detalhes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($table_content)):?>
                            <?php foreach($table_content as $row):?>
                                <tr>
                                    <td><?=$row->dataResposta?></td>
                                    <td><?=$row->designacaoModulo?></td>
                                    <td><?=$row->designacaoSubModulo?></td>
                                    <td><?=$row->designacaoNivel?></td>
                                    <td><?=$row->respostaEscolhida?></td>
                                    <td><?php if($row->resposta===$row->respostaEscolhida):?>
                                            Certo
                                        <?php else:?>
                                            Errado
                                        <?php endif;?>
                                    </td>
                                    <td><button class="btn btn-primary">Detalhes</button></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- END DATATABLE EXPORT -->

        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->