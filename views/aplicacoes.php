                <div class="container mt-4">
                    <h3 class="mb-4"><i class="bi bi-layers"></i> Inventário de Aplicações</h3>
                    
                    <div class="accordion shadow-sm" id="accordionApps">
                        <?php foreach ($aplicacoes as $app): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $app['id'] ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse<?= $app['id'] ?>" aria-expanded="false">
                                        <div class="d-flex justify-content-between w-100 pe-3">
                                            <span>
                                                <strong><?= htmlspecialchars($app['sistema']) ?></strong>
                                            </span>
                                            <!-- <span class="badge bg-primary rounded-pill">
                                                <?= count($app['sistema']) ?> aplicações
                                            </span> -->
                                        </div>
                                    </button>
                                </h2>
                                
                                <div id="collapse<?= $app['id'] ?>" class="accordion-collapse collapse" 
                                    data-bs-parent="#accordionApps">
                                    <div class="accordion-body bg-light">
                                        <p class="text-muted small">Descrição: <?= htmlspecialchars($app['descricao'] ?? 'N/A') ?></p>
                                        <p class="text-muted small">Objetivo: <?= htmlspecialchars($app['objetivo'] ?? 'N/A') ?></p>
                                        <p class="text-muted small">Linguagens: <?= htmlspecialchars($app['linguagens'] ?? 'N/A') ?></p>
                                        <p class="text-muted small">Bancos de dados: <?= htmlspecialchars($app['bancos_dados'] ?? 'N/A') ?></p>
                                        <p class="text-muted small">Área da tecnologia: <?= htmlspecialchars($app['area_tecnologia'] ?? 'N/A') ?></p>
                                        <p class="text-muted small">Área de negócio: <?= htmlspecialchars($app['area_negocio'] ?? 'N/A') ?></p>
                                        
                                        // AJUSTAR A EXIBIÇÃO DAS INSTÂNCIAS PELA TABELA instancia_aplicacao
                                        <!-- <?php #if (empty($app['instancias'])): ?>
                                            <div class="alert alert-warning py-2">Nenhuma instância configurada para esta aplicação.</div>
                                        <?php #else: ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm bg-white border">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Sistema</th>
                                                            <th>Área da TM</th>
                                                            <th>Área de Negócio</th>
                                                            <th>Bancos de dados</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php #foreach ($app['aplicacoes'] as $inst): ?>
                                                            <tr>
                                                                <td class="fw-bold text-primary">
                                                                    <i class="bi bi-server"></i> <?= htmlspecialchars($inst['sistema']) ?>
                                                                </td>
                                                                <td><code class="text-dark"><?= htmlspecialchars($inst['area_tecnologia'] ?? '-') ?></code></td>
                                                                <td><small class="text-muted"><?= htmlspecialchars($inst['area_negocio'] ?? '-') ?></small></td>
                                                                <td><?= htmlspecialchars($inst['bancos_dados'] ?? '-') ?></td>
                                                            </tr>
                                                        <?php #endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php #endif; ?> -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>