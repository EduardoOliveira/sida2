<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" method="post">
            <div class="panel panel-default "><!--panel-toggled-->
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Filters</strong></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Modulos</label>

                                <div class="col-md-9">
                                    <select class="form-control select" name="module"
                                            onchange="document.getElementById('fetch-sub').click()">
                                        <option value="0">Selecione uma opção</option>
                                        <?php foreach ($modules as $module): ?>
                                            <option value="<?= $module->designacaoModulo ?>"
                                                    <?php if (!empty($input['module']) && $input['module'] == $module->designacaoModulo): ?>selected="selected"<?php endif; ?>>
                                                <?= $module->designacaoModulo ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block">Escolha um modulo</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Select</label>

                                <div class="col-md-9">
                                    <select class="form-control select" name="sub-model"
                                            onchange="document.getElementById('fetch-parent').click()">
                                        <option value="0">Selecione uma opção</option>
                                        <?php foreach ($sub_modules as $sub_module): ?>
                                            <option value="<?= $sub_module->designacaoSubModulo ?>"
                                                    <?php if (!empty($input['sub-model']) && $input['sub-model'] == $sub_module->designacaoSubModulo): ?>selected="selected"<?php endif; ?>>
                                                <?= $sub_module->designacaoSubModulo ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block">Select box example</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Dificuldades</label>

                                <div class="col-md-9">
                                    <select class="form-control select" name="difficulty">
                                        <option value="0">Selecione uma opção</option>
                                        <?php foreach ($difficulties as $difficulty): ?>
                                            <option value="<?= $difficulty->idNivel ?>"
                                                    <?php if (!empty($input['difficulty']) && $input['difficulty'] == $difficulty->idNivel): ?>selected="selected"<?php endif; ?>>
                                                <?= $difficulty->designacaoNivel ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block">Escolha um nivel de dificuldade</span>
                                </div>
                            </div>
                            <?php if (!empty($docente_mode) && $docente_mode): ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Respostas:</label>

                                    <div class="col-md-9">
                                        <label class="check">
                                            <input type="checkbox" class="icheckbox" <?php if($input['minhas_respostas']=="yes"):?>checked="checked"<?php endif;?> name="minhas_respostas" value="yes"/>
                                            Mostrar apenas as minhas respostas
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Inicio</label>

                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="text" class="form-control datepicker"
                                               value="<?= $input['inicio'] ?>" name="inicio">
                                    </div>
                                    <span class="help-block">Data de Inicio</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Fim</label>

                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="text" class="form-control datepicker" value="<?= $input['fim'] ?>"
                                               name="fim">
                                    </div>
                                    <span class="help-block">Data de Fim</span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="panel-footer">
                    <input type="submit" class="btn btn-primary pull-right" name="submit" value="Submit">
                    <input style="display: none" type="submit" class="btn btn-primary pull-right" name="fetch"
                           value="fetch-sub" id="fetch-sub">
                    <input style="display: none" type="submit" class="btn btn-primary pull-right" name="fetch"
                           value="fetch-parent" id="fetch-parent">
                </div>
            </div>
        </form>

    </div>
</div>