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
    <div class="row">
        <div class="col-md-4">

            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">
                        <?php if($stats['total']>0):?>
                            <?= round(($stats['certas'] / $stats['total']) * 100, 2) ?>
                        <?php else:?>
                            0
                        <?php endif;?>
                        %</div>
                    <div class="widget-title">Respostas Certas</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">
                        <?php if($stats['total']>0):?>
                        <?= round(100 - (($stats['certas'] / $stats['total']) * 100), 2) ?>
                        <?php else:?>
                            0
                        <?php endif;?>
                        %</div>
                    <div class="widget-title">Respostas Certas</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?= $stats['total'] ?></div>
                    <div class="widget-title">Total de Respostas</div>
                </div>
            </div>

        </div>
    </div>
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
            <script>
                $(function () {
                    Morris.Line({
                        element: 'morris-line-example',
                        data: [
                            <?php foreach($chart_content as $y => $a):?>
                            {y: <?=$y?>, a: <?=($a['certas']/$a['total'])*100?>},
                            <?php endforeach;?>
                        ],
                        xkey: 'y',
                        ykeys: ['a'],
                        labels: ['% Respostas Certas'],
                        resize: true,
                        lineColors: ['#33414E']
                    });
                });
            </script>
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
                            <th>Aluno</th>
                            <th>Resposta dada</th>
                            <th>Avaliação</th>
                            <th>Detalhes</th>
                            <th>Média</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($table_content)): ?>
                            <?php foreach ($table_content as $row): ?>
                                <tr>
                                    <td><?= $row->dataResposta ?></td>
                                    <td><?= $row->designacaoModulo ?></td>
                                    <td><?= $row->designacaoSubModulo ?></td>
                                    <td><?= $row->designacaoNivel ?></td>
                                    <td><?= $row->nome ?></td>
                                    <td><?= $row->respostaEscolhida ?></td>
                                    <td><?php if ($row->resposta === $row->respostaEscolhida): ?>
                                            Certo
                                        <?php else: ?>
                                            Errado
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal_details_<?= $row->idQuestao ?>">Detalhes
                                        </button>
                                    </td>

                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal_media_<?= $row->idQuestao ?>">Média
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- END DATATABLE EXPORT -->

        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->
<?php if (!empty($table_content)): ?>
    <?php foreach ($table_content as $row): ?>
        <div class="modal" id="modal_details_<?= $row->idQuestao ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Auto-avaliação de conhecimentos</h4>
                    </div>
                    <div class="modal-body">
                        <div>Pergunta: <?=$row->texto?></div>
                        <div>Resposta correcta: <?=$row->resposta?></div>
                        <div>Outras opções de resposta: ???????????????????</div>
                        <div>Explicação:</div>
                        <div><?=$row->explicacao?></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<!-- END PAGE CONTENT WRAPPER -->
<?php if (!empty($table_content)): ?>
    <?php foreach ($table_content as $row): ?>
        <div class="modal" id="modal_media_<?= $row->idQuestao ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Média do aluno</h4>
                    </div>
                    <div class="modal-body">
                        <div>Média no modulo "<?=$row->designacaoModulo?>" é <?=$row->media?></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>