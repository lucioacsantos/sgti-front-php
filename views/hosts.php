                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-pc-display"></i> Gerenciamento de Hosts</h3>
                    <span class="me-3 text-muted">
                        <h4><i class="bi bi-person"></i> <?= htmlspecialchars($user['username']) ?> (<?= $user['role'] ?>)</h4>
                    </span>

                    <a href="logout.php" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Filtrar por hostname ou área...">
                            <button class="btn btn-outline-secondary" type="button" id="clearSearch" style="display: none;">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Hostname</th>
                                <th>Ambiente</th>
                                <th>Área</th>
                                <th>S.O.</th>
                                <th>Aplicação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hosts as $h): ?>
                            <tr>
                                <td><?= htmlspecialchars($h['nome']) ?></td>
                                <td><span class="badge bg-info text-dark"><?= $h['ambiente'] ?></span></td>
                                <td><span class="badge bg-secondary"><?= $h['responsavel'] ?></span></td>
                                <td><span class="badge bg-secondary"><?= $h['sor'] ?></span></td>
                                <td><span class="badge bg-secondary"> - </span></td>
                                <!--<td>
                                    <?php if ($h['aplicacoes']): ?>
                                        <?php 
                                        $apps = explode(', ', $h['aplicacoes']); 
                                        foreach ($apps as $app): ?>
                                            <span class="badge bg-secondary"><?= htmlspecialchars($app) ?></span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-muted small">Nenhuma aplicação</span>
                                    <?php endif; ?>
                                </td>-->
                                <td>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>